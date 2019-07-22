<?php

namespace App\Services;

use App\Guardian;
use Illuminate\Http\Request;

class GuardianServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at';
        $order = $request->order ? $request->order : 'desc';
        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->offset ? $request->offset : 0;
        $query = $request->search ? $request->search : '';

        $guardians =  Guardian::where('name', 'like', "%{$query}%")->orderBy($sort, $order);
        $listCount = $guardians->count();

        $guardians = $guardians->limit($limit)->offset($offset)->get();

        // return respond(['rows' => $questions, 'total' => $listCount]);
        return respond(['rows' => $this->transformCollection($guardians), 'total' => $listCount]);
	}

    // public function transformDate($date) {

        
    //     return $date;
    // }

	public function transform($guardian){
		return [
            'id' => $guardian->id,
            'name' => $guardian->name,
            'email' => $guardian->email
            // 'name' => $this->transformDate($question->created_at),
        ];  
	}
}
