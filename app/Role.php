<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const SYSADMIN = 1;
    const ADMIN = 2;
    const USER = 3;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
