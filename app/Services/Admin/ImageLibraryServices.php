<?php

namespace App\Services\Admin;

use Storage;

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

  public function update($file, $image, $path = 'media') {
    if($image) {
      Storage::delete('public/' . $path . '/' . $image->name);
    }

    return $this->create($file);
  }

  public function fullPath($name, $path = 'media') {
    $baseUrl = url('/');

    if($name) {
      return $baseUrl . '/storage/' . $path . '/' . $name;
    }

    return '';
  }
}