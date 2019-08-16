<?php

namespace App\Jobs;

use App\Topic;
use App\Question;
use App\Answer;

use Excel;
use Storage;
use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportQuestions implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $timeout = 1800;
  public $file_path;
  public $subject;
  /**
   * Create a new job instance.
   *
   * @return void
   */

  public function __construct($file_path, $subject) {
    $this->file_path = $file_path;
    $this->subject = $subject;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    $file = Storage::get($this->file_path);  
      $file_name = md5('questions.' . time()) . '.csv';
      Storage::disk('local')->put($file_name, $file);
      Storage::delete($this->file_path);
      $file_url = storage_path('app/' . $file_name);
      
      Excel::load($file_url)->each(function (Collection $csvLine) {
        $questionText = $csvLine->get('question');
        $answer1 = $csvLine->get('answer_1');
        $answer2 = $csvLine->get('answer_2');
        $answer3 = $csvLine->get('answer_3');
        $answer4 = $csvLine->get('answer_4');
        $correctAnswer = $csvLine->get('correct_answer');
        $explanation = $csvLine->get('explanation');
        $topicAbbreviation = $csvLine->get('topic_abbreviation');
        $hasImage = $csvLine->get('has_image');
        
        if($correctAnswer) {
          $topic = Topic::where('subject_id', $this->subject->id)->where('abbreviation', $topicAbbreviation)->first();
          
          if($topic) {
            $question = Question::where('topic_id', $topic->id)->where('description', $questionText)->first();
            
            if(!$question) {
              $question = Question::create([
                'topic_id' => $topic->id,
                'description' => $questionText,
                'explanation' => $explanation,
                'image' => $hasImage == 'TRUE' ? true : false
              ]);

              $this->createAnswer($question, $answer1, $correctAnswer, 1);
              $this->createAnswer($question, $answer2, $correctAnswer, 2);
              $this->createAnswer($question, $answer3, $correctAnswer, 3);
              $this->createAnswer($question, $answer4, $correctAnswer, 4);
            }
          }
        }
      });

      unlink($file_url);
  }

  public function createAnswer($question, $answer, $correctAnswer, $value) {
    Answer::create([
      'question_id' => $question->id,
      'description' => $answer,
      'correct' => $this->getAnswer($correctAnswer, $value)
    ]);
  }

  public function getAnswer($correctAnswer, $value) {
    if($value == 1 && $correctAnswer == 'A') {
      return 1;
    }elseif($value == 2 && $correctAnswer == 'B') {
      return 1;
    }elseif($value == 3 && $correctAnswer == 'C') {
      return 1;
    }elseif($value == 4 && $correctAnswer == 'D') {
      return 1;
    }else {
      return 0;
    }
  }
}
