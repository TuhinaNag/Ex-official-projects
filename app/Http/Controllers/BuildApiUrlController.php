<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bot;
use App\Api;
use App\GlobalVariables;
use Auth;


class BuildApiUrlController extends Controller
{
	public function apiUrl($apiId) {
		$api = Api::find($apiId);
		$userid= Auth::user()->id;
		$bots = Bot::all()->where('user_id', '=' , Auth::user()->id);
		//dd(Auth::user()->id);
		$var = GlobalVariables::where('user_id', '=' , Auth::user()->id)->get();
		return view('Bot.buildapi', compact('bots','api','var','userid'));
	}
}
