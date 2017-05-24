<?php

namespace App\Models;

use Silber\Bouncer\Database\Ability as Model;

class Ability extends Model
{
    /**
     * Get the permissions for the ability.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
