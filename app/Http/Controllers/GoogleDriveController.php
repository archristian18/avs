<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    public function upload()
    {
        $content = 'Hello from Laravel to Google Drive!';
        Storage::disk('google')->put('test_laravel_drive.txt', $content);

        return 'File uploaded successfully!';
    }

    public function listFiles()
    {
        $files = Storage::disk('google')->files();
        return response()->json($files);
    }

    public function download($filename)
    {
        if (!Storage::disk('google')->exists($filename)) {
            return response('File not found', 404);
        }

        $fileContent = Storage::disk('google')->get($filename);
        $mime = Storage::disk('google')->mimeType($filename);

        return response($fileContent)
            ->header('Content-Type', $mime);
    }
}
