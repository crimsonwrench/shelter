<?php

namespace Tests\Feature;

use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateBoardTest extends TestCase
{

    /**
     * A basic board storing test.
     *
     * @return void
     */
    public function testCreateBoard()
    {

        // Trying unauthenticated
        $response = $this->post('/api/board', [
            'name' => 'SomeTestStuff',
            'description' => 'Test stuff goes here',
        ])->assertStatus(401);

        // Trying with 'user' role
        $user = factory('App\User')
            ->create()
            ->assignRole('user');

        Passport::actingAs($user);

        $response = $this->post('/api/board', [
            'name' => 'SomeTestStuff',
            'description' => 'Test stuff goes here',
        ])->assertStatus(403);

        // Trying with 'global-moderator' role
        $user->assignRole('global-moderator');

        $response = $this->post('/api/board', [
            'name' => 'SomeTestStuff',
            'description' => 'Test stuff goes here',
        ])->assertSuccessful();

    }
}
