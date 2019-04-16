<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUploadFile()
    {
        Storage::fake('public');

        $picture1 = UploadedFile::fake()->image('testpicture1.jpg', 320, 240);
        $picture2 = UploadedFile::fake()->image('testpicture2.jpg', 65, 195);


        $response = $this->json('POST', '/api/upload', [
            'files' => [$picture1, $picture2],
        ]);

        Storage::disk('public')->assertExists('testpicture1.jpg');
        Storage::disk('public')->assertExists('/thumbnails/testpicture1.jpg');
        Storage::disk('public')->assertExists('testpicture2.jpg');
        Storage::disk('public')->assertExists('/thumbnails/testpicture2.jpg');
    }
}
