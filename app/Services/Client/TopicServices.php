<?php

namespace App\Services\Client;

use App\Topic;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class TopicServices extends TransformerService{

	public function transform($topic){
		return [
      'id' => $topic->id,
      'name' => $topic->name,
      'subject_name' => $topic->subject ? $topic->subject->name : '-'
		];
	}
}
