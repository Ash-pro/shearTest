<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestorePasswordController extends Controller
{
    public function RestorePassword (Request $request){

        $validation = validator::make($request->all(),$this->rules());

        $restore = User::where('code',$request->code)->first();
//        dd($restore);
        if ($restore !='' || $restore !=null){
            User::where('code', $request->code)->update(array('password' => bcrypt($request->password)));
            return parent::success('code is valid');
        }else{
           return parent::error('code is invalid');
        }

    }//end of RestorePassword

    public function rules  (){
        return [
            'code' => 'required|min:5|numeric',
            'password' => 'required|min:6|confirmed',
        ];
    }//end of rules
}
