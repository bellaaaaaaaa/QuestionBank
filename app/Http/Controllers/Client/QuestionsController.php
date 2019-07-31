<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Question;

class QuestionsController extends Controller {
    protected $path = 'client.questions.'; 

    public function showQuestion() {
        $subject = Subject::first();
        $topics = $subject->topics;
        $topic = $topics[0];
        $questions = $topic->questions;
        $question = $questions[0];
        $answers = $question->answers;

        return view($this->path . 'mcq', ['subject' => $subject]);
    }
}
