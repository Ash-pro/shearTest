<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendingCodeController extends Controller
{
    public function sendMail (Request $request){
//        dd($request->all());
        //find all data of email
        $codeForEmail = User::where('email',$request->email)->first();

        //create new random code
        $digits = 5;
        $random = rand(pow(10, $digits-1), pow(10, $digits)-1);

//        $codeForEmail['code'] = $random;
        User::where('id', $codeForEmail->id)->update(array('code' => $random));


        $details =[
            "title"=>"this mail from shear company to send your code to Restore password",
            "body"=>"your code is ".$random,
        ];

        Mail::to("ashraf.zza89@gmail.com")->send(new TestMail($details));
        return 'Email Send';
    }//end of mailto
}
