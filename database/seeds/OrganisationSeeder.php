<?php

use Illuminate\Database\Seeder;
use App\Organisation;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $itransition = new Organisation();
	    $itransition->title = 'Itransition';
	    $itransition->save();
    }
}
