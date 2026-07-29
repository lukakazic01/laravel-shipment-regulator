<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\FileExtension;
use Intervention\Image\Laravel\Facades\Image;

trait HandleImages
{

    public function uploadImage(string $file, string $path): string
    {
        $name = uniqid() . '.webp';
        $image = Image::decode($file)->encodeUsingFileExtension(FileExtension::WEBP, quality: 90);
        Storage::disk('public')->put("$path/$name", (string) $image);
        return $name;
    }

    public function deleteImageFromStorage(string $imageToDelete, string $path): void
    {
        if ($imageToDelete && Storage::disk('public')->exists($path . $imageToDelete)) {
            Storage::disk('public')->delete($path . $imageToDelete);
        }
    }

}
