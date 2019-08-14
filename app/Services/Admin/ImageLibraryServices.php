<?php

namespace App\Services\Admin;

use Storage;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class ImageLibraryServices {
  public function create($file, $path = 'media') { 
    if(!$file) {
      return;
    }
    
    $fileName = (integer) round(microtime(true) * 1000) . '.' . $file->extension(); 
    Storage::disk('public')->putFileAs($path, $file, $fileName);
    
    return (object) [
      'path' => $path,
      'name' => $fileName
    ];
  }

  public function update(Request $request, $imageName) {
    if($request->hasOldImage) {
      return $imageName;
    }

    if($imageName) {
      Storage::delete('public/media/' . $imageName);
    }

    $file = $request->file('image');
    return $this->storeImage($file);
  }

  public function storeImage($file) {
    if(!$file) {
      return;
    }
    
    $fileName = Carbon::now()->timestamp . '.' . $file->extension(); 
    Storage::disk('public')->putFileAs('media', $file, $fileName);
    
    return $fileName;
  }

  public function fullPath($image) {
    $baseUrl = url('/');

    if($image) {
      return $baseUrl . '/storage/media/' . $image;
    }

    return '';
  }

  public function validateImage($file) {
    $fileArray = ['image' => $file];

    $rules = [
      'image' => 'nullable|image|max:2000|dimensions:min_width=640,min_height=960'
    ];

    $validator = Validator::make($fileArray, $rules);

    if($validator->fails()) {
      return false;
    }

    return true;
  }
}