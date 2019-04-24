<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    /**
     * A basic file uploading test.
     *
     * @return void
     */
    public function testUploadFile()
    {
        $user = factory('App\User')
            ->create()
            ->assignRole('user');

        Storage::fake('public');
        $picture1 = UploadedFile::fake()->image('testpicture1.jpg', 320, 240);
        $picture2 = UploadedFile::fake()->image('testpicture2.jpg', 65, 195);

        // Trying unauthenticated
        $response = $this->json('POST', '/api/upload', [
            'files' => [$picture1, $picture2],
        ])->assertStatus(401);

        // Trying with 'user' role
        Passport::actingAs($user);

        $response = $this->json('POST', '/api/upload', [
            'files' => [$picture1, $picture2],
        ]);

        Storage::disk('public')->assertExists('testpicture1.jpg');
        Storage::disk('public')->assertExists('testpicture2.jpg');
    }
}
