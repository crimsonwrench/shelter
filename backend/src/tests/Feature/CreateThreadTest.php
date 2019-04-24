<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    
    /**
     * A basic thread storing test.
     *
     * @return void
     */
    public function testCreateThread()
    {
        $board = factory('App\Board')->create();
        $user = factory('App\User')
            ->create()
            ->assignRole('user');

        Storage::fake('public');

        // Trying unauthenticated
        $response = $this->json('POST', "/api/board/$board->name", [
            'title' => 'Test thread',
            'text' => 'Test thread description',
        ])->assertStatus(401);

        // Trying with 'user' role
        Passport::actingAs($user);

        $response = $this->json('POST', "/api/board/$board->name", [
            'title' => 'Test thread',
            'text' => 'Test thread description',
        ])->assertOk();

        $this->assertDatabaseHas('threads', [
            'board_id' => $board->id,
            'user_id' => $user->id,
            'title' => 'Test thread',
            'text' => 'Test thread description',
        ]);
    }
}
