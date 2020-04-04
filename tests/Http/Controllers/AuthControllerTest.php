<?php

namespace Tests\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function it_will_register_a_user()
	{
		$response = $this->post('api/register', [
		    'name' => 'test name from test',
			'email'    => 'test2@email.com',
			'password' => '123456',
            'organisation_id' => 2
		]);

		$response->assertJsonStructure([
			'access_token',
			'token_type',
			'expires_in'
		]);
	}

	/** @test */
	public function it_will_log_a_user_in()
	{
		$response = $this->post('api/login', [
			'email'    => 'test@test.com',
			'password' => 'test'
		]);

		$response
            ->assertStatus(200);
//            ->assertJsonStructure([
//			'access_token',
//			'token_type',
//			'expires_in'
//		]);
	}

	/** @test */
	public function it_will_not_log_an_invalid_user_in()
	{
		$response = $this->post('api/login', [
			'email'    => 'test@email.com',
			'password' => 'notlegitpassword'
		]);

		$response->assertJsonStructure([
			'error',
		]);
	}
}
