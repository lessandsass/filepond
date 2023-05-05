<?php

namespace App\Http\Controllers;

use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Storage;

class DeleteTemporaryImageController extends Controller
{
    public function __invoke()
    {
        $temporaryImage = TemporaryImage::where('folder', request()->getContent())->first();

        if ($temporaryImage) {
            Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return response()->noContent();
    }
}
