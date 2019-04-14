<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestBoards extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBoardExistence()
    {
        $board = factory('App\Board')->create();

        $response = $this->get('/api/boards');

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonFragment([
                'name' => $board->name,
                'description' => $board->description,
            ]);
    }
}
