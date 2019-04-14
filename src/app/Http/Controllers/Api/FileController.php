<?php

namespace App\Http\Controllers\Api;

use App\Services\FileService;
use App\Http\Requests\StoreFile;

class FileController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function store(StoreFile $request)
    {
        $this->fileService->store($request);
    }
}
