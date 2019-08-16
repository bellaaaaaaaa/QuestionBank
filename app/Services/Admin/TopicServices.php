<?php

namespace App\Services\Admin;

use App\Topic;
use App\Subject;

use Storage;
use App\Jobs\ImportTopics;

use Illuminate\Http\Request;
use App\Services\TransformerService;

class TopicServices extends TransformerService {

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
    $order = $request->order ? $request->order : 'desc';
    $limit = $request->limit ? $request->limit : 10;
    $offset = $request->offset ? $request->offset : 0;
    $query = $request->search ? $request->search : '';

    $topics =  Topic::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
    $listCount = $topics->count();

    $topics = $topics->limit($limit)->offset($offset)->get();

    return respond(['rows' => $this->transformCollection($topics), 'total' => $listCount]);
  }
  
  public function import(Request $request, Subject $subject) {
    $request->validate([
      'topics' => 'required'
    ]);

    $file = $request->file('topics');
    $dirPath = imports_dir_path('topics');
    $fileName = md5(str_random(30) . time()) . '.csv';
    Storage::putFileAs($dirPath, $file, $fileName, 'public');
    $filePath = imports_dir_path('topics') . $fileName;
    ImportTopics::dispatch($filePath, $subject);

    return redirect()->back()->with('success', 'Great! Please refresh after a few seconds if you do not see the changes.');
  }

  public function search(Request $request) {
    $topics = Topic::where('name', 'like', "%{$request->search}%");
    
    return $this->transformCollection($topics->limit(10)->get());
  }

	public function transform($topic){
		return [
      'id' => $topic->id,
      'name' => $topic->name,
      'subject_name' => $topic->subject ? $topic->subject->name : '-'
		];
	}
}
