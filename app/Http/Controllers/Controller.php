<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Throws an unauthorized exception.
     *
     * @param  string  $message
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function deny($message = 'This action is unauthorized.')
    {
        throw new AuthorizationException($message);
    }
}
