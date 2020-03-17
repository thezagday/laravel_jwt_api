<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\Organisation;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $itransition = Organisation::where('title', 'Itransition')->first();

        $faversham = new Project();
        $faversham->title = 'Faversham';
        $faversham->organisation()->associate($itransition);
        $faversham->save();
    }
}
