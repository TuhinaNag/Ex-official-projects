<?php

namespace App\Http\Controllers;

use App\Api;
use App\Bot;
use Illuminate\Http\Request;
use Session;
use Illuminate\Pagination;
use Auth;
use App\GlobalVariables;
use \stdClass;

class BotController extends Controller
{
    /**
     * This function is to show all the bot in dashboard.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $bots = Bot::all()->where('user_id', '=' ,Auth::user()->id );
        $apis = Api::all();
        $variables = GlobalVariables::where('user_id',Auth::user()->id )->get();
        $botAtts=new stdClass;
        foreach ($variables as $key => $value) {
            $chatfuelBotId = $value->chatfuelBotId;
            if(!empty($chatfuelBotId)){
                $botName = Bot::where('chatfuelBotId', $chatfuelBotId )->select('bot_name')->first();
                $botAtts->$chatfuelBotId=$botName->bot_name;
            }else{
                $botAtts->$chatfuelBotId="";
            }
        }
        return view('Bot.tables', compact('bots','apis','variables','botAtts'));
    }

    /**
     * This function gets all the bot details from modals and retuns an array to use in other functions.
     * @param Request $request
     * @return array
     */
    public function getBotDetailsFromModal(Request $request){
        $botName = $request['botName'];
        $botId = $request['botId'];
        $broadcastApiToken = $request['botToken'];
        return $botArray = ['botId' => $botId ,
                            'botName' => $botName,
                            'broadcastApiToken' => $broadcastApiToken];

    }

    /**
     * This function is to add the bots from the modal.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addBotDetails(Request $request){
        $bot = $this->getBotDetailsFromModal($request);

        $botDbInstance = new Bot();
        $botDbInstance->bot_name = $bot['botName'];
        $botDbInstance->chatfuelBotId = $bot['botId'];
        $botDbInstance->broadcast_token = $bot['broadcastApiToken'];
        $botDbInstance->user_id = Auth::user()->id;
        $botDbInstance->save();
        return redirect()->route('dashboard');
    }

    /**
     * This is to delete one bot from the database.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteBot($id){
        $bot = Bot::where('id', $id)->first();
        $var = GlobalVariables::where('chatfuelBotId',$bot->chatfuelBotId);
        $var->delete();
        $bot->delete();
        return redirect()->route('dashboard');

    }

    public function updateBotDetails(Request $request, $id)
    {
        $bot = $this->getBotDetailsFromModal($request);
        $botDbInstance = Bot::where('id', $id)->first()
            ->update(['bot_name' => $bot['botName'],
                'chatfuelBotId' => $bot['botId'],
                'broadcast_token' => $bot['broadcastApiToken']
            ]);
    }

    public function addGlobalVar(Request $request) {

        $varname = GlobalVariables::where('user_id',Auth::user()->id)->pluck('var_name')->toArray();
        if (!in_array($request['varName'], $varname)) {
            $globalVar = new GlobalVariables();
            $globalVar->user_id = Auth::user()->id;
            $globalVar->chatfuelBotId = $request['chatfuelBotId'];
            $globalVar->var_name = $request['varName'];
            $globalVar->dataType = $request['dataType'];
            $globalVar->initialVal = $request['initialValue'];
            $globalVar->currentVal = $request['initialValue'];
            $globalVar->defaultVal = $request['defaultValue'];
            $globalVar->save();
            return json_encode(array("status"=>1));
        } else {
           return json_encode(array("status"=>0));
        }
    }

    public function updateVarDetails(Request $request, $id)
    {   
        $globalVar = GlobalVariables::where('id', $id)->update(['initialVal' => $request['initialValue'],
                'defaultVal' => $request['defaultValue'], 'currentVal' => $request['currentValue']
            ]);
            return json_encode($globalVar);
    }

    public function deleteVar($id){
        $var = GlobalVariables::where('id', $id)->first();
        $var->delete();
        return redirect()->route('dashboard');

    }
}
