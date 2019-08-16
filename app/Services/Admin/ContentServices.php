<?php

namespace App\Services\Admin;

use App\Content;
use App\Table;
use App\Image;
use App\Paragraph;
use App\Question;

use Illuminate\Http\Request;
use App\Services\Admin\TableServices;
use App\Services\Admin\ImageServices;
use App\Services\Admin\ParagraphServices;
use App\Services\TransformerService;

class ContentServices extends TransformerService{
  protected $tableServices;
  protected $imageServices;
  protected $paragraphServices;

  function __construct(TableServices $tableServices, ImageServices $imageServices, ParagraphServices $paragraphServices) {
    $this->tableServices = $tableServices;
    $this->imageServices = $imageServices; 
    $this->paragraphServices = $paragraphServices; 
  }

	public function handleContents(Request $request, Question $question){
		if($request->contents) {
      $order = 0;

      foreach($request->contents as $content) {
        if(isset($content->id) && isset($content->deleted)) {
          $this->delete($content);
        }elseif(isset($content->id)) {
          $this->update($request, $content, $order);
          $order++;
        }else {
          $this->create($request, $content, $question, $order);
          $order++;
        }
      }
    }
  }

  public function delete($content) {
    $content = Content::find($content->id);
    $content->item->delete();
    $content->delete();
  }

  public function update($request, $content, $order) {
    $contentExist = Content::find($content->id);
  
    if(!$contentExist) {
      return;
    }

    $contentExist->order = $order;
    $contentExist->save();

    $item = $this->handleItem($request, $content, 'update');
  }

  public function create($request, $content, $question, $order) {
    if($content->type == 'Image') {
      $imageFound = $this->imageServices->findImage($request, $content);

      if(!$imageFound) {
        return;
      }
    }

    $newContent = Content::create([
      'question_id' => $question->id,
      'order' => $order
    ]);

    $item = $this->handleItem($request, $content, 'create');
    
    if($item) {
      $item->item()->save($newContent);
    }
  }

  public function handleItem($request, $content, $type) {
    switch($content->type) {
      case 'Table':
      $item = $this->tableServices->handle($content, $type);
      break;

      case 'Image':
      $item = $this->imageServices->handle($request, $content, $type);
      break;

      case 'Paragraph':
      $item = $this->paragraphServices->handle($content, $type);
      break;

      default:
      $item = false;
      break;
    }

    return $item;
  }

  public function getContents($question) {
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
      return (object) [ 
        'file' => true,
        'identifier' => $content->item->name,
        'preview' => $this->imageServices->getPreview($content->item),
        'hasOldImage' => true
      ];
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
