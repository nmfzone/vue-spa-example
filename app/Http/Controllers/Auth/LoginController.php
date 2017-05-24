<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $errorMessage = 'The credentials not found in our database.';

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $this->credentials($request);

        if (! $this->checkUser($credentials)) {
            return $this->sendFailedLoginResponse();
        }

        return $this->access('password', $credentials);
    }

    /**
     * Handle a refresh token request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        return $this->access('refresh_token', [
            'refresh_token' => $request->cookie('refresh_token'),
        ]);
    }

    /**
     * Send request to the laravel passport.
     *
     * @param  string  $grantType
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    private function access($grantType, array $data = [])
    {
        try {
            $data = array_merge([
                'username'      => $data['email'],
                'client_id'     => config('secrets.client_id'),
                'client_secret' => config('secrets.client_secret'),
                'grant_type'    => $grantType,
            ], $data);

            $http = new Client();

            $guzzleResponse = $http->post(config('app.url').'/oauth/token', [
                'form_params' => $data,
            ]);
        } catch(\GuzzleHttp\Exception\BadResponseException $e) {
            $guzzleResponse = $e->getResponse();
        }

        $response = json_decode($guzzleResponse->getBody());

        if (! is_null($response) && property_exists($response, "access_token")) {
            cookie()->queue('refresh_token',
                $response->refresh_token,
                $response->expires_in,
                null,
                null,
                false,
                true
            );

            $response = [
                'token_type'    => $response->token_type,
                'expires_in'    => $response->expires_in,
                'access_token'   => $response->access_token,
            ];
        }

        $response = response()->json($response);
        $response->setStatusCode($guzzleResponse->getStatusCode());

        $headers = $guzzleResponse->getHeaders();
        foreach($headers as $headerType => $headerValue) {
            $response->header($headerType, $headerValue);
        }

        return $response;
    }

    /**
     * Check the given user credentials.
     *
     * @return boolean
     */
    protected function checkUser($credentials)
    {
        $user = User::whereEmail($credentials['email'])->first();

        if (! is_null($user) && Hash::check($credentials['password'], $user->password)) {
            if ($user->isBanned()) {
                $this->errorMessage = 'You have been banned from our services.';
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Get the failed login response instance.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse()
    {
        return response()->json([
            'message' => $this->errorMessage,
        ], 401);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
