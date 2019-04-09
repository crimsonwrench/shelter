<?php

namespace Tests\Feature;

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
        $response = $this->get('/api/boards');

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonFragment([
                'name' => 'Random',
                'name_short' => 'b',
                'name_short' => 'pr',
                'name' => 'Gamedev',
            ]);
    }
}
