<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-bordered" style="width:100%" id="variableTable">
            <thead>
                <div class="row">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Data Type
                        </th>
                        <th>
                            Bot Name
                        </th>
                        <th>
                            Initial Value
                        </th>
                        <th>
                            Current Value
                        </th>
                        <th>
                            Default Value
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </div>
            </thead>
            <tbody>
                @if($variables != null)
               {{--{{$i}}--}}
                    @foreach($variables as $global)
                        <tr>
                            <td class="varId" varId="{{$global->id}}"> 
                                {{$global->id}}
                            </td>
                            <td  class="varName" varName="{{$global->var_name}}">
                                {{$global->var_name}}
                            </td>
                            <td class="dataType">
                                @if ($global->dataType == '1')
                                    Number
                                     <span datatype="{{$global->dataType}}" datatypeText='Number' ></span> 
                                @elseif ($global->dataType == '2')
                                    Decimal
                                     <span datatype="{{$global->dataType}}" datatypeText='Decimal'></span> 
                                @elseif ($global->dataType == '3')
                                    String
                                     <span datatype="{{$global->dataType}}" datatypeText='String'></span> 
                                @elseif ($global->dataType == '4')
                                    Date
                                     <span datatype="{{$global->dataType}}" datatypeText='Date'></span> 
                                @else
                                    Time Stamp
                                     <span datatype="{{$global->dataType}}" datatypeText='Time Stamp'></span> 
                                @endif  
                               
                            </td>
                            @php  $chatfuelBotId = $global->chatfuelBotId ; @endphp
                            <td class="bot_Name" bot_Name="{{$botAtts->$chatfuelBotId}}">
                                {{$botAtts->$chatfuelBotId}}
                            </td>
                            <td class="initialValue" initialValue="{{ $global->initialVal }}">
                                {{$global->initialVal}}
                            </td>
                            <td class="currentValue" currentValue={{$global->currentVal}}>
                                {{$global->currentVal}}
                            </td>
                            <td class="defaultValue" defaultValue={{$global->defaultVal}}>
                                {{$global->defaultVal}}
                            </td>
                            <td>
                                <a class="btn btn-primary a-btn-slide-text editVar" >
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>
                                </a>
                                <a href="/deletevar/{{$global->id}}" class="btn btn-primary a-btn-slide-text deleteVar">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4>There is no global variable that you have added.</h4>
                @endif
            </tbody>
        </table>
    </div>
</div>
{{--this script to load the datatable--}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#variableTable').DataTable();
    });
</script>