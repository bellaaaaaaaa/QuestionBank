<?php

namespace App\Services\Admin;

use App\Subject;
use App\Answer;
use App\Question;
use App\Table;
use App\Image;

use Storage;
use App\Jobs\ImportQuestions;
use App\Rules\ValidateUndefined;

use Illuminate\Http\Request;
use App\Services\Admin\AnswerServices;
use App\Services\Admin\ContentServices;
use App\Services\TransformerService;

class QuestionServices extends TransformerService{
  protected $contentServices;
  protected $answerServices;

  function __construct(ContentServices $contentServices, AnswerServices $answerServices) {
    $this->contentServices = $contentServices; 
    $this->answerServices = $answerServices;
  }

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
    $order = $request->order ? $request->order : 'desc';
    $limit = $request->limit ? $request->limit : 10;
    $offset = $request->offset ? $request->offset : 0;
    $query = $request->search ? $request->search : '';

    $questions =  Question::where('description', 'like', "%{$query}%")->orderBy($sort, $order);
    $listCount = $questions->count();

    $questions = $questions->limit($limit)->offset($offset)->get();

    return respond(['rows' => $this->transformCollection($questions), 'total' => $listCount]);
	}

  public function create(Request $request){
    $request = $this->decodeArrayObjects($request);
    
    $request->validate([
      'description' => [new ValidateUndefined(), 'unique:questions'],
      'answers' => 'required|array|min:2',
      'explanation' => new ValidateUndefined(),
      'topic' => [new ValidateUndefined(), 'numeric'],
      'image' => new ValidateUndefined(),
      'images.*.*' => 'required|image|max:2000'
    ]);   

    $question = Question::create([
      'description' => $request->description,
      'topic_id' => $request->topic,
      'explanation' => $request->explanation,
      'image' => $request->image
    ]);
        
    foreach($request->answers as $answer) {
      Answer::create([
        'description' => $answer->description,
        'correct' => $answer->correct,
        'question_id' => $question->id
      ]);
    }

    $this->contentServices->handleContents($request, $question);
  }

  public function update(Request $request, Question $question){
    $request = $this->decodeArrayObjects($request);
 
    $request->validate([
      'description'=> [new ValidateUndefined(), 'unique:questions,description,' . $question->id],
      'answers' => 'required|array|min:2',
      'explanation' => new ValidateUndefined(),
      'topic' => [new ValidateUndefined(), 'numeric'],
      'image' => new ValidateUndefined(),
      'images.*.*' => 'required|image|max:2000'
    ]);   
    
    $question->description = $request->description;
    $question->topic_id = $request->topic; 
    $question->explanation = $request->explanation; 
    $question->image = $request->image;
    $question->save();

    foreach($request->answers as $answer){
      $answerExist = Answer::find($answer->id);
      
      if($answerExist && isset($answer->deleted)){
        $this->deleteAnswer($answer);
      } elseif ($answerExist) {
        $this->updateAnswer($answerExist, $answer);
      } else {
        $this->createAnswer($answer, $question);
      }     
    }

    $this->contentServices->handleContents($request, $question);
  }
  
  public function updateAnswer($answerExist, $answer){
    
    $answerExist->description = $answer->description;
    $answerExist->correct = $answer->correct;
    $answerExist->save();
  }

  public function createAnswer($answer, $question){
    $newAnswer = new Answer();
    $newAnswer->description = $answer->description;
    $newAnswer->correct = $answer->correct;
    $newAnswer->question_id = $question->id;
    $newAnswer->save();
  }

  public function deleteAnswer($answer) {
    $answer = Answer::find($answer->id);
    $answer->delete();
  }

  public function import(Request $request, Subject $subject) {
    $request->validate([
      'questions' => 'required'
    ]);

    $file = $request->file('questions');
    $dirPath = imports_dir_path('questions');
    $fileName = md5(str_random(30) . time()) . '.csv';
    Storage::putFileAs($dirPath, $file, $fileName, 'public');
    $filePath = imports_dir_path('questions') . $fileName;
    ImportQuestions::dispatch($filePath, $subject);

    return redirect()->back()->with('success', 'Great! Please refresh after a few seconds if you do not see the changes.');
  }

  public function decodeArrayObjects(Request $request){
    return $request->merge([
      'description' => $request->description,
      'answers' => json_decode($request->answers),
      'topic' => $request->topic,
      'contents' => json_decode($request->contents)
    ]);
  }

  public function getAttributes(Question $question) {
    $question->setAttribute('searchTopic', $question->topic->name);
    $question->setAttribute('answers', $question->answers);
    $question->setAttribute('contents', $this->contentServices->getContents($question));

    return $question;
  }
    
	public function transform($question){
        
		return [
      'id' => $question->id,
      'description' => $question->description,
      'correct_attempts' =>  $question->number_of_correct_attempts,
      'hasImage' => $question->image ? 'Have Image' : 'No Image'
		];
	}
}

