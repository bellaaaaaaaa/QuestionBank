<?php

namespace App\Http\Controllers\Client;

use App\Topic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Client\TrialServices;

class TrialsController extends Controller {
  protected $path = 'client.trials.'; 
  protected $trialServices;
  
  public function __construct(TrialServices $trialServices) {
    $this->trialServices = $trialServices;
  }

  public function showQuestions() {
    $subject = json_encode(get_student_subject());
    $questions = json_encode($this->trialServices->getQuestions($topic));
    $topic = json_encode($this->trialServices->transform($topic));

    return view($this->path . 'question', ['subject' => $subject, 'topic' => $topic, 'questions' => $questions]);
  }

  public function answer(Request $reqeust) {
    return $this->trialServices->saveAnswer($reqeust);
  }
}
