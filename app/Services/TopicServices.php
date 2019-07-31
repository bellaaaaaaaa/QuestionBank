<?php

namespace App\Services;

use App\Topic;
use Illuminate\Http\Request;

class TopicServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
        $order = $request->order ? $request->order : 'desc';
        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->offset ? $request->offset : 0;
        $query = $request->search ? $request->search : '';

        $topics =  Topic::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
        $listCount = $topics->count();

        $topics = $topics->limit($limit)->offset($offset)->get();

        // return respond(['rows' => $questions, 'total' => $listCount]);
        return respond(['rows' => $this->transformCollection($topics), 'total' => $listCount]);
	}

    // public function transformDate($date) {

        
    //     return $date;
    // }

	public function transform($topic){
		return [
            'id' => $topic->id,
            'name' => $topic->name,
            'subject_name' => $topic->subject ? $topic->subject->name : '-'
            // 'subject_id' => $topic->subject_id
            // 'name' => $this->transformDate($question->created_at),
           
		];
	}
}
