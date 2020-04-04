<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
	        $table->bigInteger('user_id')->unsigned();
	        $table->bigInteger('project_id')->unsigned();
            $table->timestamps();
	        $table->softDeletes();

	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

	        $table->primary(['user_id','project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_user');
    }
}
