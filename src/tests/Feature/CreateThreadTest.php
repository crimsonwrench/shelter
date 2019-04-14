<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateThread()
    {
        $board = factory('App\Board')->create();
        $user = factory('App\User')->create();

        $this->be($user);

        Storage::fake('public');

        $picture1 = UploadedFile::fake()->image('picture1.jpg', 20, 20);
        $picture2 = UploadedFile::fake()->image('picture2.jpg', 35, 185);

        $response = $this->json('POST', '/api/upload', [
            'files' => [$picture1, $picture2],
        ])->assertOk();

        Storage::disk('public')->assertExists('picture1.jpg');
        Storage::disk('public')->assertExists('/thumbnails/picture1.jpg');
        Storage::disk('public')->assertExists('picture2.jpg');
        Storage::disk('public')->assertExists('/thumbnails/picture2.jpg');

        $response = $this->json('POST', "/api/board/$board->name", [
            'title' => 'Test thread',
            'text' => 'Test text',
            'files' => [$picture1, $picture2],
        ]);

        $this->assertDatabaseHas('threads', [
            'board_id' => $board->id,
            'user_id' => $user->id,
            'title' => 'Test thread',
            'text' => 'Test text',
        ]);
    }
}
