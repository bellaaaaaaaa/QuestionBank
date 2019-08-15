<?php

namespace App\Services\Admin;

use App\Table;

use Illuminate\Http\Request;
use App\Services\TransformerService;

class TableServices {
  public function handle($content, $type) {
    if($type == 'create') {
      return $this->create($content);
    }else {
      return $this->update($content);
    }
  }

  public function create($content) {
    return Table::create([
      'content' => json_encode($content->item)
    ]); 
  }

  public function update($content) {
    $table = Table::find($content->itemId);
    $table->content = $content->item->content;
    $table->save();
  }
}