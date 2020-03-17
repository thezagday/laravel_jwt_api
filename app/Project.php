<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function organisation()
	{
		return $this->belongsTo('App\Organisation');
	}

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
