<?php

namespace App\Services\Admin;

use App\Paragraph;

use Illuminate\Http\Request;

class ParagraphServices {
  public function handle($content, $type) {
    if($type == 'create') {
      return $this->create($content);
    }else {
      return $this->update($content);
    }
  }

  public function create($content) {
    return Paragraph::create([
      'description' => $content->item
    ]); 
  }

  public function update($content) {
    $paragraph = Paragraph::find($content->itemId);
    $paragraph->description = $content->item;
    $paragraph->save();
    
    return $paragraph;
  }
}