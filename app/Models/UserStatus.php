<?php

namespace App\Models;

trait UserStatus
{
    public static $statuses = [
        'active' => [
            0, 'Active'
        ],
        'banned' => [
            1, 'Banned'
        ],
    ];

    /**
     * Get the user status representation.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return array_column(static::$statuses, 1)[array_search($this->status, array_column(static::$statuses, 0))];
    }

    /**
     * Get the listing of the statuses without the complete name.
     *
     * @return Collection
     */
    public static function statuses()
    {
        return collect(array_combine(array_keys(static::$statuses), array_column(static::$statuses, 0)));
    }

    /**
     * Get the listing of the statuses.
     *
     * @return Collection
     */
    public static function statusesAll()
    {
        return collect(static::$statuses);
    }

    /**
     * Scope a query to only include user that is active.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', static::$statuses['active'][0]);
    }

     /**
     * Scope a query to only include user that is banned.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBanned($query)
    {
        return $query->where('status', static::$statuses['banned'][0]);
    }

    /**
     * Determine whether the user is active.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->status === static::$statuses['active'][0];
    }

    /**
     * Determine whether the user is banned.
     *
     * @return boolean
     */
    public function isBanned()
    {
        return $this->status === static::$statuses['banned'][0];
    }
}
