<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestBoards extends TestCase
{
    use RefreshDatabase;

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
                'name_short' => $board->name_short,
            ]);
    }
}
