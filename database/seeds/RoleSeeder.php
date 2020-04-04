<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $sysadmin = new Role();
	    $sysadmin->title = 'sysadmin';
	    $sysadmin->description = 'Manage all users';
	    $sysadmin->save();

	    $admin = new Role();
	    $admin->title = 'admin';
	    $admin->description = 'Manage only current organisation users';
	    $admin->save();

	    $user = new Role();
	    $user->title = 'user';
	    $user->description = 'Manage nobody';
	    $user->save();
    }
}
