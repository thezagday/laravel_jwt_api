<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function projects()
	{
		return $this->hasMany('App\Project');
	}

	public function users()
	{
		return $this->hasMany('App\User');
	}
}
