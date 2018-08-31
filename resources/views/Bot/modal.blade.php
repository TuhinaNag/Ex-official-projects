{{--Add Bot Modal--}}
<div class="modal fade" id="addBotModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action={{route('addBot')}}>
                @csrf
                    <table class="table">
                        <tr>
                            <td>BOT NAME:</td>
                            <td><input type="text" class="form-control" name="botName"></td>
                        </tr>
                        <tr>
                            <td>BOT ID:</td>
                            <td> <input type="text" class="form-control" name="botId"></td>
                        </tr>
                        <tr>
                            <td>BOT TOKEN:</td>
                            <td><input type="text" class="form-control" name="botToken" ></td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="Add Bot" id="addBot">
                </form>
           </div>
        </div>
    </div>
</div>
{{--Edit Bot Modal--}}
<div class="modal fade" id="editBotModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="updateBotForm">
                    @csrf
                    <table class="table">
                        <input type="hidden" id="botId" name="id">
                        <tr>
                            <td>BOT NAME:</td>
                            <td><input type="text" class="form-control" name="botName" id="editBotName"></td>
                        </tr>
                        <tr>
                            <td>BOT ID:</td>
                            <td> <input type="text" class="form-control" name="botId" id="editChatfuelBotId"></td>
                        </tr>
                        <tr>
                            <td>BOT TOKEN:</td>
                            <td><input type="text" class="form-control" name="botToken" id="editApiToken"></td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="Update Bot" id="updateBot">
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
{{--Add Global Variable--}}
<div class="modal fade" id="addVarModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action={{route('addGlobalVar')}} autocomplete="off" id="addGlobalVarform">
                @csrf
                    <table class="table">
                        <tr>
                            <td>NAME:</td>
                            <td><input type="text" class="form-control" name="varName" required="required"></td>
                        </tr>
                        <tr>
                            <td>Data Type:</td>
                            <td>
                                <select class="form-control dataType" name = "dataType" id="data" required="required">
                                    <option value="" selected="selected" id="default" disabled>--Data Types--</option><option value="1" data-dataType="1">Number</option>
                                    <option value="2" data-dataType="2">Decimal</option>
                                    <option value="3" data-dataType="3">String</option>
                                    <option value="4" data-dataType="4">Date</option>
                                    <option value="5" data-dataType="5">Time Stamp</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Initial Value:</td>
                            <td><input type="text" class="form-control" name="initialValue" required="required"></td>
                        </tr>
                        <tr>
                            <td>Default Value:</td>
                            <td><input type="text" class="form-control" name="defaultValue" required="required"></td>
                        </tr>
                    </table>
                    @if(count($bots)>0)
                        <div class="row">
                            <div class="col-6">
                                <label class="switch">
                                  <input type="checkbox" data-toggle="collapse" data-target="#bots">
                                  <span class="slider round"></span>
                                </label>
                                <label class="on">&nbspBot Specific</label>
                            </div>
                            <div class="col-6 bots" id="bots">
                                <label>Select your bot name:</label>
                                <select name="chatfuelBotId">
                                    <option value="" selected="selected" id="default" disabled>--Bot names--</option>
                                        @if($bots != null)              
                                            @foreach($bots as $bot)
                                                <option value="{{$bot->chatfuelBotId}}" data-chatfuel-bot-id="{{ $bot->chatfuelBotId }}" data-bot-name="{{$bot->bot_name}}">{{$bot->bot_name}}</option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                    @endif
                    <p><input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="Add Global Variable" id="addGlobalVar"></p>
                </form>
           </div>
        </div>
    </div>
</div>
{{--Edit Global Variable Modal--}}
<div class="modal fade" id="editVarModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="updateVarForm">
                    @csrf
                    <table class="table">
                        <input type="hidden" id="editvarId" name="id">
                        <input type="hidden" id="updateVarName" name="varName">
                        <input type="hidden" id="updateDataType" name="dataType">
                        <tr>
                            <td>NAME:</td>
                            <td id="editVarName"></td>
                        </tr>
                        <tr>
                            <td>Data Type:</td>
                            <td id="editDataType">
                            </td>
                        </tr>
                        <tr>
                            <td>Initial Value:</td>
                            <td><input type="text" class="form-control" id="editInitialVal" name="initialValue" required="required"></td>
                        </tr>
                        <tr>
                            <td>Current Value:</td>
                            <td><input type="text" class="form-control" id="editCurrentVal" name="currentValue" required="required"></td>
                        </tr>
                        <tr>
                            <td>Default Value:</td>
                            <td><input type="text" class="form-control" id="editDefaultVal" name="defaultValue" required="required"></td>
                        </tr>
                    </table>
                    {{-- <div class="row">
                        <div class="col-6">
                            <label class="switch">
                              <input type="checkbox" data-toggle="collapse" data-target="#select">
                              <span class="slider round"></span>
                            </label>
                            <label class="on">&nbspBot Specific</label>
                        </div>
                        <div class="col-6 bots" id="select">
                            <label>Select your bot name:</label>
                            <select name="chatfuelBotId" id="editBotName">
                                <option value="" selected="selected" id="default" disabled>--Bot names--</option>
                                    @if($bots != null)              
                                        @foreach($bots as $bot)
                                            <option value="{{$bot->chatfuelBotId}}" data-chatfuel-bot-id="{{ $bot->chatfuelBotId }}" data-bot-name="{{$bot->bot_name}}">{{$bot->bot_name}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div> --}}
                    <input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="Update Global Variable" id="updateVar">
                </form>
            </div>
        </div>
        </div>
    </div>
</div>