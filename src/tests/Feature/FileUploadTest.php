<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUploadFile()
    {
        Storage::fake('public');

        $picture1 = UploadedFile::fake()->image('picture1.jpg', 20, 20);
        $picture2 = UploadedFile::fake()->image('picture2.jpg', 35, 185);


        $response = $this->json('POST', '/api/upload', [
            'files' => [$picture1, $picture2],
        ]);

        Storage::disk('public')->assertExists('picture1.jpg');
        Storage::disk('public')->assertExists('/thumbnails/picture1.jpg');
        Storage::disk('public')->assertExists('picture2.jpg');
        Storage::disk('public')->assertExists('/thumbnails/picture2.jpg');
    }
}
