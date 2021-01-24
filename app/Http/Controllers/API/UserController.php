<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
//use Illuminate\Contracts\Validation\Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function index (){
        $users =User::all();
        return parent::success($users,200);
    }//end of index

    public function store  (Request $request){
        $validation = validator::make($request->all(),$this->rules());

        if ( $validation->fails()){
            return parent::error($validation->errors());
        }
        $data = $request->only(['name','phone','email']);
        $data['password'] = Hash::make($request->input('password'));

        $user = User::create($data);
        /*
         *  notes for response{{password}}
         *  you must to remember the password and remember_token I make them hidden so you cant find them in response
         */
        return parent::success($user,200);
    }//end of store

    public function update (Request $request , $id){
        echo 'test';
        dd($request->all());
    }//end of update

    public function rules  (){
        return [
            'name' => 'required|min:3',
            'phone' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
        ];
    }//end of rules
}
