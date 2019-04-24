<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    /**
     * A basic user registration test.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        // Trying invalid data by appending a special character to the user name
        $response = $this->post('/api/register',
            [
                'name' => 'Test_User$',
                'email' => 'test@test.com',
                'password' => 'secret',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        // Validation failed
        $response->assertStatus(422);

        // Trying valid data now
        $response = $this->post('/api/register',
            [
                'name' => 'Test_User',
                'email' => 'test@test.com',
                'password' => 'secret',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'Test_User',
                'email' => 'test@test.com',
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test_User',
            'email' => 'test@test.com',
        ]);
    }
}
