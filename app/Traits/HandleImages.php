<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\FileExtension;
use Intervention\Image\Laravel\Facades\Image;

trait HandleImages
{

    public function uploadImage(string $requestFileName, string $path): string
    {
        $name = uniqid() . '.webp';
        $file = request()->file($requestFileName);
        $path = Storage::disk('public')->path($path . $name);
        Image::decode($file)->encodeUsingFileExtension(FileExtension::WEBP, quality: 90)->save($path);
        return $name;
    }

    public function deleteImageFromStorage(string $imageToDelete, string $path): void
    {
        if ($imageToDelete && Storage::disk('public')->exists($path . $imageToDelete)) {
            Storage::disk('public')->delete($path . $imageToDelete);
        }
    }

}
