<?php

namespace App\Http\Controllers;
use App\GlobalVariables;
use App\Bot;
use Illuminate\Pagination;
use Auth;

use Illuminate\Http\Request;

class GlobalVariablesController extends Controller
{
     public function index(){
        $variables = GlobalVariables::where('user_id',Auth::user()->id )->first();
        $bots = Bot::where('chatfuelBotId', $variables->chatfuelBotId )->get();
        return view('Bot.variablestable', compact('bots','variables'));
    }
}
