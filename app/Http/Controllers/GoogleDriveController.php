<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    public function upload()
    {
        Storage::disk('google')->put('example.txt', 'This file is stored in Google Drive.');
        return 'Uploaded to Google Drive!';
    }

    public function listFiles()
    {
        $files = Storage::disk('google')->files();
        return response()->json($files);
    }

    public function download($filename)
    {
        $content = Storage::disk('google')->get($filename);
        return response($content)->header('Content-Type', 'text/plain');
    }
}
