<?php

namespace App\Services\Admin;

use App\Image;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use App\Services\Admin\ImageLibraryServices;

class ImageServices {
  protected $imageLibraryServices;

  function __construct(ImageLibraryServices $imageLibraryServices) {
    $this->imageLibraryServices = $imageLibraryServices;
  }

	public function handle($request, $content, $type) {
    if($type == 'create') {
      return $this->create($request, $content);
    }else {
      return $this->update($request, $content);
    }
  }

  public function create($request, $content) {
    $images = $request->file('images');
    
    if(!$images[$content->item->identifier]) {
      return;
    }

    $file = $this->imageLibraryServices->create($images[$content->item->identifier], 'questions');
    
    return Image::create([
      'path' => $file->path,
      'name' => $file->name
    ]);   
  }

  public function update($request, $content) {
    if($content->hasOldImage) {
      return;
    }

    $images = $request->file('images'); 
    $image = Image::find($content->itemId);
    $file = $this->imageLibraryServices->update($images[$content->identifier], $image, 'questions');
  }

  public function getPreview($item) {
    return $this->imageLibraryServices->fullPath($item->name, $item->path);
  }
}