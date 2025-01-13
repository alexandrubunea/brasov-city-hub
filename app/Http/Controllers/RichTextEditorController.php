<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RichTextEditorController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:10248',
        ]);

        $path = $request->file('upload')->store('public-images', 'public');
        
        return response()->json([
            'location' => Storage::url($path)
        ]);
    }
}
