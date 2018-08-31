<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \stdClass;
use App\GlobalVariables;

class ApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkMessage() {
        $message = $_POST['message'];
        dd($message);
        $name = $_POST['name'];;
        if ($name == 'Clear attribute'){
             $this->clearAttribute($message);
        } elseif ($name == 'Show Day') {
             $this->showDay($message);
        } elseif ($name == 'Show Date') {
             $this->showDate($message);
        } elseif ($name == 'Set global variable') {
             $this->setglobalvariable($message);
        } elseif ($name == 'Show Time') {
             $this->showTime($message);
        } elseif ($name == 'Get global variable') {
             $this->getglobalvariable($message);
        } elseif ($name == 'Reset global variable') {
             $this->resetglobalvariable($message);
        } elseif ($name == 'Increment variable') {
             $this->incrementglobalvariable($message);
        } elseif ($name == 'Decrement variable') {
             $this->decrementglobalvariable($message);
        } else {
            exit();
        }
        
    }
    public function clearAttribute(Request $request, $message)
    {
        $attrdata = $request->input();
        dd($message);
	    $userdata=new stdClass();
        $result=new stdClass();
        if($attrdata){
            $userdata->set_attributes=new stdClass();
            foreach ($attrdata as $key=>$value) {
		       // $val = $value;
                $result->$key="";
            }
            $userdata->set_attributes=$result;
            if($message){
                $msg = array('text' => $message);
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);
            } else {
                return response()->json($userdata);
            }
        } else {
            $text=new stdClass();
            $msg = new stdClass();
            $msg->text = "Please provide attributes to clear";
            $parent = array();
            array_push($parent,$msg);
            $text->messages = $parent;
            return response()->json($text);
        }
    }

    /*
    * This function returns the current date in dd-mm-YYYY format
    */
    public function showDate(Request $request,$message)
    {
        $date = Carbon::now()->format('d-m-y'); /*date('d-m-Y');*/
        $attr=$request->input();
        $varname='';
        $varval ='';
        foreach ($attr as $key => $value) {
          $varname=$key;
        }
        if($attr){
            $userdata=new stdClass();
            $dateVal = new stdClass();
            $userdata->set_attributes=new stdClass();
            $dateVal->$varname=$date;
            $userdata->set_attributes=$dateVal;
            $msg = array('text' => "Current date: ".$date);
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);  
        } else {
            $userdata=new stdClass();
            $msg = array('text' => "Please pass an attribute to get it back as current date");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
        

    }

    /**
     * This function returns the current day of the week
     */
    public function showDay(Request $request,$message)
    {
        $day = Carbon::now()->format( 'l' );
        $attr=$request->input();
        $varname='';
        $varval ='';
        foreach ($attr as $key => $value) {
          $varname=$key;
        }
        if($attr){
            $userdata=new stdClass();
            $dayVal = new stdClass();
            $userdata->set_attributes=new stdClass();
            $dayVal->$varname=$day;
            $userdata->set_attributes=$dayVal;
            $msg = array('text' => "Current day: ".$day);
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);  
        } else {
            $userdata=new stdClass();
            $msg = array('text' => "Please pass an attribute to get it back as current day");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
        
    }

    /**
     * This function returns the current UTC Time
     */
    public function showTime(Request $request,$message)
    {
        $attr=$request->input();
        $time = date('H:i:s');
        $varname='';
        $varval ='';
        foreach ($attr as $key => $value) {
          $varname=$key;
        }
        if($attr){
            $userdata=new stdClass();
            $timeVal = new stdClass();
            $userdata->set_attributes=new stdClass();
            $timeVal->$varname=$time;
            $userdata->set_attributes=$timeVal;
            $msg = array('text' => "Current time: ".$time);
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);  
        } else {
            $userdata=new stdClass();
            $msg = array('text' => "Please pass an attribute to get it back as current time");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
        
    }
    public function setglobalvariable(Request $request,$message)
    {
        $attr=$request->input();
        $varname='';
        $varval ='';
        $userid=urldecode(base64_decode($attr['user']));
        unset($attr['user']);
        foreach ($attr as $key => $value) {
          $varname=$key;
          $varval=$value;
        }
        if($varname){
            $result = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->update(['currentVal'=>$varval]);

            if($result){

                $userdata=new stdClass();
                $msg = array('text' => "Your global variable  ".$varname." set as ".$varval);
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);  

            }else{
                $userdata=new stdClass();
                $msg = array('text' => "Your global variable  ".$varname." does not exist");
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);
            }
        }else{
            $userdata=new stdClass();
            $msg = array('text' => "No variable passed to set a new value");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
        
    }

    public function getglobalvariable(Request $request,$message)
    {
        $attr=$request->input();
        $varname='';
        $varval ='';
        $userid=urldecode(base64_decode($attr['user']));
        unset($attr['user']);
        foreach ($attr as $key => $value) {
          $varname=$key;
//          $varval=$value;
        }
        if($varname){
             $result = GlobalVariables::where('var_name','=',$varname)->where('user_id',$userid)->value('currentVal');
            if(!empty($result)){
                $userdata=new stdClass();
                $currentVal = new stdClass();
                $userdata->set_attributes=new stdClass();
                $currentVal->$varname=$result;
                $userdata->set_attributes=$currentVal;
                $msg = array('text' => "Your global variable: ".$varname." value is ".$result);
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);  
            }else{
                $userdata=new stdClass();
                $msg = array('text' => "No value available  for ".$varname);
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);
            }
            
        }else{
            $userdata=new stdClass();
            $msg = array('text' => "Please pass a valid variable to fetch the latest value");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
       
    }

    public function resetglobalvariable(Request $request,$message)
    {
        $attr=$request->input();
        $varname='';
        $userid=urldecode(base64_decode($attr['user']));
        unset($attr['user']);
        foreach ($attr as $key => $value) {
          $varname=$value;
        }
        if($varname){
            $result = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->value('initialVal');

            if(!empty($result)){

                    $val = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->update(['currentVal'=>$result]);
                if($val){

                    $userdata=new stdClass();
                    $currentVal = new stdClass();
                    $userdata->set_attributes=new stdClass();
                    $currentVal->$varname=$result;
                    $userdata->set_attributes=$currentVal;
                    $msg = array('text' => "Your global variable: ".$varname." value reset to initial value ".$result);
                    $parent = array();
                    array_push($parent,$msg);
                    $userdata->messages = $parent;
                    return response()->json($userdata);   

                }else{
                    $userdata=new stdClass();
                    $msg = array('text' => "Reset unsuccessful! Please check everything and try again");
                    $parent = array();
                    array_push($parent,$msg);
                    $userdata->messages = $parent;
                    return response()->json($userdata);
                }
            } else {
                $userdata=new stdClass();
                $msg = array('text' => "No value exists for ".$varname);
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);   
            }
        } else {
            $userdata=new stdClass();
            $msg = array('text' => "Please provide a variable to reset its current value to initial");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);   
    }
               
    }

    public function incrementglobalvariable(Request $request,$message)
    {
        $attr=$request->input();
        if(array_key_exists("attr",$attr)){
            $varname=$attr['attr'];
            $incrementval ='';
            $userid=urldecode(base64_decode($attr['user']));
            unset($attr['user']);
            unset($attr['attr']);
            foreach ($attr as $key => $value) {
              $incrementval=$value;
            }

            if($varname){
                if($incrementval) {
                    $exists = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->exists();
                    if($exists) {
                        $vardetail = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->select('datatype','currentVal')->first();

                        if(is_numeric($incrementval)){

                            if($vardetail->datatype == 1 || $vardetail->datatype == 2 ){
                                //int
                                $currentVal= $vardetail->currentVal+$incrementval;

                            }else if($vardetail->datatype == 4){
                                //date
                                $currentVal = date('Y-m-d', strtotime('+'.$incrementval.' days', strtotime($vardetail->currentVal)));
                            }          

                            //update database
                            $result = GlobalVariables::where('currentVal', '=' ,$vardetail->currentVal)->update(['currentVal' => $currentVal]);
                            if($result){
                                $userdata=new stdClass();
                                $currentValue = new stdClass();
                                $userdata->set_attributes=new stdClass();
                                $currentValue->$varname=$currentVal;
                                $userdata->set_attributes=$currentValue;
                                $msg = array("text" => "Your global variable: ".$varname." value is incremented to ".$currentVal." by ".$incrementval);
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);

                            } else {
                                $userdata=new stdClass();
                                $msg = array('text' => "Your global variable  ".$varname." could not be incremented. Please make sure everything is proper and try again");
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);
                            }
                           

                        } else {
                           if($vardetail->datatype == 5){
                                //timestamp
                                $incrementarray = preg_split("/(\d+)/", $incrementval, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                                $incrementval =implode(" ", $incrementarray);

                                $currentVal = date('Y-m-d H:i:s', strtotime('+'.$incrementval, strtotime($vardetail->currentVal)));

                                 $result = GlobalVariables::where('currentVal', '=' ,$vardetail->currentVal)->update(['currentVal'=> $currentVal]);
                                if($result){
                                 //chatfuel msg+setattr
                                    $userdata=new stdClass();
                                    $currentValue = new stdClass();
                                    $userdata->set_attributes=new stdClass();
                                    $currentValue->$varname=$currentVal;
                                    $userdata->set_attributes=$currentValue;
                                    $msg = array('text' => "Your global variable: ".$varname." value is incremented to ".$currentVal." by ".$incrementval);
                                    $parent = array();
                                    array_push($parent,$msg);
                                    $userdata->messages = $parent;
                                    return response()->json($userdata);
                                } else {
                                    $userdata=new stdClass();
                                    $msg = array('text' => "Your global variable  ".$varname." could not be incremented. Please make sure everything is proper and try again");
                                    $parent = array();
                                    array_push($parent,$msg);
                                    $userdata->messages = $parent;
                                    return response()->json($userdata);
                                }

                            }else if( $vardetail->dataType == 3){
                               $userdata=new stdClass();
                                $msg = array('text' => "Your global variable  ".$varname." is a string type, hence cannot be incremented");
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);
                            }  
                            
                        }

                    }else {
                        $userdata=new stdClass();
                        $msg = array('text' => "The variable ".$varname." does not exist");
                        $parent = array();
                        array_push($parent,$msg);
                        $userdata->messages = $parent;
                        return response()->json($userdata);
                    }

                } else {
                    $userdata=new stdClass();
                    $msg = array('text' => "Please pass a valid data to increment your variable with");
                    $parent = array();
                    array_push($parent,$msg);
                    $userdata->messages = $parent;
                    return response()->json($userdata);
                } 
            } else {
                $userdata=new stdClass();
                $msg = array('text' => "No variable passed to increment its value");
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);
            }
        } else {
            $userdata=new stdClass();
            $msg = array('text' => "No variable passed to increment its value");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
    }

    public function decrementglobalvariable(Request $request,$message)
    {
        $attr=$request->input();
        if(array_key_exists("attr",$attr)){
            $varname=$attr['attr'];
            $decrementval ='';
            $userid=urldecode(base64_decode($attr['user']));
            unset($attr['user']);
            unset($attr['attr']);
            foreach ($attr as $key => $value) {
              $decrementval=$value;
            }
            if($varname){
                if($decrementval){
                    $exists = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->exists();
                    if($exists){
                        $vardetail = GlobalVariables::where('var_name', '=' ,$varname)->where('user_id',$userid)->select('datatype','currentVal')->first();

                        if(is_numeric($decrementval)){

                            if($vardetail->datatype == 1 || $vardetail->datatype == 2 ){
                                //int
                                $currentVal= $vardetail->currentVal-$decrementval;
                            }else if($vardetail->datatype == 4){
                                //date
                                 $currentVal = date('Y-m-d', strtotime('-'.$decrementval.' days', strtotime($vardetail->currentVal)));
                            }          

                            //update database
                            $result = GlobalVariables::where('currentVal', '=' ,$vardetail->currentVal)->update(['currentVal' => $currentVal]);
                            if($result){
                                 //chatfuel msg+setattr
                                $userdata=new stdClass();
                                $currentValue = new stdClass();
                                $userdata->set_attributes=new stdClass();
                                $currentValue->$varname=$currentVal;
                                $userdata->set_attributes=$currentValue;
                                $msg = array('text' => "Your global variable: ".$varname." value is decremented to ".$currentVal." by ".$decrementval);
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);
                            } else {
                                $userdata=new stdClass();
                                $msg = array('text' => "Your global variable  ".$varname." couldnot be decremented. Please check everything and try again");
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);
                            }
                           

                        }else{
                           if ($vardetail->datatype == 5){
                                //timestamp
                                $incrementarray = preg_split("/(\d+)/", $decrementval, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                                $decrementval =implode(" ", $incrementarray);

                                $currentVal = date('Y-m-d H:i:s', strtotime('-'.$decrementval, strtotime($vardetail->currentVal)));

                                 $result = GlobalVariables::where('currentVal', '=' ,$vardetail->currentVal)->update(['currentVal' => $currentVal]);
                                if($result){
                                 //chatfuel msg+setattr
                                    $userdata=new stdClass();
                                    $currentValue = new stdClass();
                                    $userdata->set_attributes=new stdClass();
                                    $currentValue->$varname=$currentVal;
                                    $userdata->set_attributes=$currentValue;
                                    $msg = array('text' => "Your global variable: ".$varname." value is decremented to ".$currentVal." by ".$decrementval);
                                    $parent = array();
                                    array_push($parent,$msg);
                                    $userdata->messages = $parent;
                                    return response()->json($userdata);
                                } else {
                                    $userdata=new stdClass();
                                    $msg = array('text' => "Your global variable  ".$varname." couldnot be decremented. Please check everything and try again");
                                    $parent = array();
                                    array_push($parent,$msg);
                                    $userdata->messages = $parent;
                                    return response()->json($userdata);
                                }

                            }else if( $vardetail->dataType == 3){
                               $userdata=new stdClass();
                                $msg = array('text' => "Your global variable  ".$varname." is a string type, hence cannot be decremented");
                                $parent = array();
                                array_push($parent,$msg);
                                $userdata->messages = $parent;
                                return response()->json($userdata);
                            }
                            
                        }
                    }else{
                        $userdata=new stdClass();
                        $msg = array('text' => "The variable ".$varname." does not exist");
                        $parent = array();
                        array_push($parent,$msg);
                        $userdata->messages = $parent;
                        return response()->json($userdata);
                    }
                }else{
                    $userdata=new stdClass();
                    $msg = array('text' => "Please pass a valid data to decrement your variable from");
                    $parent = array();
                    array_push($parent,$msg);
                    $userdata->messages = $parent;
                    return response()->json($userdata); 
                }

            }else{
                $userdata=new stdClass();
                $msg = array('text' => "No variable passed to decrement its value");
                $parent = array();
                array_push($parent,$msg);
                $userdata->messages = $parent;
                return response()->json($userdata);
            }
        }else{
            $userdata=new stdClass();
            $msg = array('text' => "No variable passed to decrement its value");
            $parent = array();
            array_push($parent,$msg);
            $userdata->messages = $parent;
            return response()->json($userdata);
        }
    }
}  
    


