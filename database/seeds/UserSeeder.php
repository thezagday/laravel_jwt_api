<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Organisation;
use App\Project;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$itransition = Organisation::where('title', 'Itransition')->first();

	    $faversham = Project::where('title', 'Faversham')->first();

	    $sysadmin = Role::where('title', 'sysadmin')->first();
	    $admin = Role::where('title', 'admin')->first();
	    $user = Role::where('title', 'user')->first();

	    $user1 = new User();
	    $user1->name = 'Roman Zagday';
	    $user1->email = 'roman@zagday.com';
	    $user1->password = bcrypt('zagday');
	    $user1->role()->associate($sysadmin);
	    $user1->organisation()->associate($itransition);
	    $user1->save();
	    $user1->projects()->save($faversham);


	    $user2 = new User();
	    $user2->name = 'Mike Thomas';
	    $user2->email = 'mike@thomas.com';
	    $user2->password = bcrypt('thomas');
	    $user2->role()->associate($admin);
	    $user2->organisation()->associate($itransition);
	    $user2->save();
	    $user2->projects()->save($faversham);

	    $user3 = new User();
	    $user3->name = 'Brad Pit';
	    $user3->email = 'brad@pit.com';
	    $user3->password = bcrypt('pit');
	    $user3->role()->associate($user);
	    $user3->organisation()->associate($itransition);
	    $user3->save();
	    $user3->projects()->save($faversham);
    }
}
