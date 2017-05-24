<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FlowException;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected function response($data = [], $status = 200)
    {
        return response()->json($data, $status);
    }

    protected function modelDeleted($key = null, $message = null)
    {
        $message = is_null($key)
            ? 'The data with given key has been deleted successfully.'
            : (! is_null($message) ?: '{$key} has been deleted successfully.');

        return $this->ok([
            'message' => $message,
        ]);
    }

    protected function ok($data = [])
    {
        return $this->response($data);
    }

    protected function notFound($data = [])
    {
        return $this->response($data, 404);
    }

    protected function conflict($message)
    {
        throw new FlowException([
            'message' => $message,
        ]);
    }
}
