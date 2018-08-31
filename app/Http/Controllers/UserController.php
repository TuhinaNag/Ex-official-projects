<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use \stdClass;


class UserController extends Controller
{    /**
     * This function will create an user in the app using webhook.
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSignup(Request $request){

        $firstname=$request['first_name'];
        $lastname=$request['last_name'];
        $email=$request['email'];
        $pass=Hash::make('123456');

        if($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $checkForExist = User::where('email',$email)->exists();

            if(!$checkForExist){
                //add new user if doesnot exist
                $user = new User;
                $user->name = $firstname.' '.$lastname;
                $user->email = $email;
                $user->password = $pass;
                $user->save();
                Session::put('username', $firstname);
                $text=new stdClass();
                $msg = new stdClass();
                $msg->text = "User added  successfully! Your default password is: 123456";
                $parent = array();
                array_push($parent,$msg);
                $text->messages = $parent;
                return response()->json($text);
            }
            else {
                $text=new stdClass();
                $msg = new stdClass();
                $msg->text = "User exists";
                $parent = array();
                array_push($parent,$msg);
                $text->messages = $parent;
                return response()->json($text);
            }
        } else {
            $text=new stdClass();
            $msg = new stdClass();
            $msg->text = "Please provide valid email id and params";
            $parent = array();
            array_push($parent,$msg);
            $text->messages = $parent;
            return response()->json($text);
        }
    }
}
