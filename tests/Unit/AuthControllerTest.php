<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker;
use \Call;

class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testRegister()
	{
		// Arrange
		$faker = Faker\Factory::create();
		$user = [
			'email' => $faker->unique()->safeEmail,
			'password' => 'admin1',
			'password_confirmation' => 'admin1',
			'first_name' => $faker->firstName,
	        'last_name' => $faker->lastName,
	        'gender' => 1,
	        'birth_year' => rand(1990,2000),
	        'birth_month' => rand(1,12),
	        'birth_day' => rand(1,30),
		];

		// Act
		$response = Call::post('/auth/register', ['form_params' => $user]);

		// Assert
		
		$this->assertEquals('success', $response->status);
		
		$this->assertNotEmpty($response->data);
	}

	public function testRegisterFail()
	{
		// Arrange
		$faker = Faker\Factory::create();
		$user = [
			'email' => $faker->unique()->safeEmail,
			'password' => 'admin2',
			'password_confirmation' => 'admin1',
			'first_name' => $faker->firstName,
	        'last_name' => $faker->lastName,
	        'gender' => 1,
	        'birth_year' => rand(1990,2000),
	        'birth_month' => rand(1,12),
	        'birth_day' => rand(1,30),
		];

		// Act
		$response = Call::post('/auth/register', ['form_params' => $user]);
		
		// Assert
		
		$this->assertEquals('error', $response->status);
		
		$this->assertNotEmpty($response->data);
	}
}
