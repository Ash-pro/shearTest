<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\MessageBag;
use phpDocumentor\Reflection\Types\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success ($data, $status = 200){
        return response()->json([
                 'case'=>'success',
                 'errors'=>0,
                 'status'=>$status,
                 'data'=>$data
            ]
            ,$status)->header('content-type','application/json');
    }//end of success

    public function error ($messages , $status = 400){

//       this section to find number of error
        $messageCount = 1;
        if (is_array($messages))
            $messageCount = sizeof($messages);
        elseif ($messages instanceof Collection)
            $messageCount = $messages->count();
        elseif ($messages instanceof MessageBag)
            $messageCount = $messages->count();

//       this section to get first error in MessageBag errors
        if ($messages instanceof MessageBag)
            $messages = $messages->first();

//       this section to return json response
        return response()->json([
            'status'=>'error',
            'errors'=>$messageCount,
            'data'=>$messages
        ],$status)->header('content-type','application/json');
    }//end of error
}
