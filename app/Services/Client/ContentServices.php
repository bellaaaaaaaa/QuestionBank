<?php

namespace App\Services\Client;

use App\Content;
use App\Image;
use App\Question;

use Illuminate\Http\Request;
use App\Services\TransformerService;
use App\Services\Client\ImageServices;

class ContentServices extends TransformerService{
  protected $imageServices;

  function __construct(ImageServices $imageServices) {
    $this->imageServices = $imageServices; 
  }

  public function getContents(Question $question) {
    $contents = $question->questionContents()->orderBy('order', 'ASC')->get();

    if(!$contents) {
      return;
    }

    return $this->transformCollection($contents);
  }

  public function morphContent($content) {
    switch($content->item_type) {
      case 'Table':
      return $content->item->content;
      break;

      case 'Image':
      return $this->imageServices->getPreview($content->item);
      break;

      case 'Paragraph':
      return $content->item->description;
      break;

      default:
      return null;
      break;
    }
  }

	public function transform($content) {
		return [
      'id' => $content->id,
      'itemId' => $content->item_id,
      'item' => $this->morphContent($content),
      'type' => $content->item_type
		];
	}
}
