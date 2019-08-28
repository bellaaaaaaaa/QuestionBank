<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\User;
use App\Purchase;
use App\Subject;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller{

	protected $path = 'admin.dashboard.';

	public function dashboard(){
		$count_admin = count(User::where('owner_type', null)->get());
		$count_subscribers = count(Purchase::select('student_id')->distinct()->get());
		$most_subscribed_subject = DB::table('purchases')->select('subject_id')->groupBy('subject_id')->orderByRaw('COUNT(*) DESC')->limit(1)->first();
		$most_subscribed_subject = Subject::where('id', $most_subscribed_subject->subject_id)->first()->name;
		$purchases_this_month = Purchase::whereBetween('updated_at',[ Carbon::now()->startOfMonth()->toDateString(),Carbon::now()->endOfMonth()->toDateString()])->get();
		$current_month_earnings = 0;
		foreach($purchases_this_month as $purchase){
			$amount = 0;
			if ($purchase->package_duration == 1){
				$amount = $purchase->subject->one_month_price;
			} elseif ($purchase->package_duration == 2) {
				$amount = $purchase->subject->two_month_price;
			} elseif ($purchase->package_duration == 3) {
				$amount = $purchase->subject->three_month_price;
			}
			$current_month_earnings += $amount;
		}
		return view($this->path . 'index', ['count_admin' => $count_admin, 'count_subscribers' => $count_subscribers, 'most_subscribed_subject' => $most_subscribed_subject, 'current_month_earnings' => $current_month_earnings]);
	}
}
