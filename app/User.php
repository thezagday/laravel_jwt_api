<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'organisation_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	/**
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function organisation()
	{
		return $this->belongsTo('App\Organisation');
	}

	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}

	public function setPasswordAttribute($password)
	{
		if ( !empty($password) ) {
			$this->attributes['password'] = bcrypt($password);
		}
	}

	public function hasRole(int $roleId): bool
	{
		return $this->role->id == $roleId;
	}
}
