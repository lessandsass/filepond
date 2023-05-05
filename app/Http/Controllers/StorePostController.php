<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StorePostController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:4',
            'description' => 'required|min:12',
        ]);

        $temporaryImages = TemporaryImage::all();

        if ($validator->fails()) {

            foreach($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            return redirect('/')->withErrors($validator)->withInput();
        }

        $post = Post::create($validator->validated());

        foreach ($temporaryImages as  $temporaryImage) {
            Storage::copy('images/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file, 'images/' . $temporaryImage->folder . '/' . $temporaryImage->file);
            Image::create([
                'post_id' => $post->id,
                'name' => $temporaryImage->file,
                'path' => $temporaryImage->folder . '/' . $temporaryImage->file
            ]);
            Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return redirect('/');

    }
}
