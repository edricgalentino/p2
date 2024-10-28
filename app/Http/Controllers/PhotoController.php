<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo; // Import the Photo model
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    //
    public function deletePhoto($id)
    {
        $photo = Photo::find($id);

        Storage::disk('public')->delete($photo->url);

        $photo->delete();
        return response()->json(['message' => 'Photo deleted successfully']);
    }
}
