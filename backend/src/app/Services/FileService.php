<?php

namespace App\Services;

use App\File;
use App\Http\Requests\StoreFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    public function store(StoreFile $request)
    {
        foreach ($request->file('files') as $file) {

            $queryFile = File::where('hash', sha1_file($file))->first();

            if (!$queryFile) {

                $thumbnail = Image::make($file)->resize(null, env('SHELTER_THUMBNAIL_SIZE_PX', 80), function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('thumbnails/' . $file->getClientOriginalName(), (string) $thumbnail->encode());
                Storage::disk('public')->putFileAs('/', $file, $file->getClientOriginalName());

                File::create([
                    'hash' => sha1_file($file),
                    'name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getClientSize(),
                ]);
            }
        }
    }
}
