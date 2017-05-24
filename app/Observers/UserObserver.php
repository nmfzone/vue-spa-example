<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Listen to the User created event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        $permissions = require resource_path('roles/defaults.php');

        $user->allow($permissions[get_class($user)]);
    }
}
