<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-bordered" style="width:100%" id="dataTable">
            <thead>
                <div class="row">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Bot Name
                        </th>
                        <th>
                            Bot Id
                        </th>
                        <th>
                            Broadcast API token
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </div>
            </thead>
            <tbody>
                @if($bots != null)
                    @php  $i=1 @endphp
                    @foreach($bots as $bot)

                        <tr>
                            <td class="botId" botID="{{$bot->id}}">
                               {{ $i++ }}
                            </td>
                            <td  class="botName" >
                                {{$bot->bot_name}}
                            </td>
                            <td class="chatfuelBotId">
                                {{$bot->chatfuelBotId}}
                            </td>
                            <td class="broadcastApiToken">
                                {{$bot->broadcast_token}}
                            </td>
                            <td>
                                <a class="btn btn-primary a-btn-slide-text editBtn" >
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>
                                </a>
                                <a href="/delete/{{$bot->id}}" class="btn btn-primary a-btn-slide-text deleteBtn">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <h4>There is no bot that you have added.</h4>
                @endif
            </tbody>
        </table>
    </div>
</div>
{{--this script to load the datatable--}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>