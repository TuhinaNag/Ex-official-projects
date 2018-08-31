<div class="row">

    <table class="table table-hover align-content-center">
        @foreach($apis as $api)
            <tr>
                <td>
                   <h4>{{$api->api_name}}</h4>
                </td>
                <td class="api">
                   {{$_SERVER['REQUEST_SCHEME']}}://{{$api->api_url}}
                </td>
                <td>
                     <div class="col-3">
                            <a type="button" class="btn btn-primary float-right useBtn" href="{{ URL::to('buildapi')."/".$api->id }}">
                                use
                            </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>