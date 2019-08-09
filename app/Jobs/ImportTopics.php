<?php

namespace App\Jobs;

use App\Topic;

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

class ImportTopics implements ShouldQueue {
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
      $file_name = md5('topics.' . time()) . '.csv';
      Storage::disk('local')->put($file_name, $file);
      Storage::delete($this->file_path);
      $file_url = storage_path('app/' . $file_name);
      
      Excel::load($file_url)->each(function (Collection $csvLine) {
        $name = $csvLine->get('name');
        $abbreviation = $csvLine->get('abbreviation');
        
        $topic = Topic::where('subject_id', $this->subject->id)->where('name', $name)->where('abbreviation', $abbreviation)->first();
        
        if(!$topic) {
          Topic::create([
            'subject_id' => $this->subject->id,
            'name' => $name,
            'abbreviation' => $abbreviation
          ]);
        }
      });

      unlink($file_url);
  }
}
