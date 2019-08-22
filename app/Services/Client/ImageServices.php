<?php

namespace App\Services\Client;

use App\Image;

use Illuminate\Http\Request;
use App\Services\ImageLibraryServices;

class ImageServices {
  protected $imageLibraryServices;

  function __construct(ImageLibraryServices $imageLibraryServices) {
    $this->imageLibraryServices = $imageLibraryServices;
  }

  public function getPreview($item) {
    return $this->imageLibraryServices->fullPath($item->name, $item->path);
  }
}