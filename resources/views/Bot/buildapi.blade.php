@extends('layouts.app')
@section('content')
<style type="text/css">
	.bot{
		height: 34px !important;
	}
	.attribute{
		height: 34px !important;
	}
	.copyBtn[disabled]{
		pointer-events: none !important;
	}
	.comment{
		display: none;
	}
</style>
		<div class="row" id="buildapi">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><h4>API: {{$api->api_name}}</h4></div>
		  			<div class="panel-body copy"><span id="copyAll">{{$_SERVER['REQUEST_SCHEME']}}://<span class="api" id="url" api='{{$api->api_url}}'>{{$api->api_url}}</span></span><a type="button" class="btn btn-primary float-right copyBtn" id="copy" data-clipboard-target="#copyAll" data-toggle="tooltip" title="Copied!" disabled="disabled">Copy</a>
		  			</div>
				</div>

				<h2>Details: </h2>
				<div class="well">{{$api->description}}</div>
			</div>
			<div class="col-lg-12">
                <label class="switch">
                  <input type="checkbox" data-toggle="collapse" data-target="#comment">
                  <span class="slider round"></span>
                </label>
                <label class="on">&nbspSend a message to the user on messenger</label>
            </div>
            <div class="container comment" id="comment">
			  	<div class="form-group">
			      <label for="comment">Message:</label>
			      <textarea class="form-control" name="message" rows="5" id="message" placeholder="Write  your message here as a response for this api"></textarea><br>
			      <span class="btn btn-primary" id="submitMessage">Done!</span>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
				  <label>Select your bot name:</label>
				  <select class="form-control bot">
				  	<option value="" selected="selected" id="default" disabled>--Bot names--</option>
	  					@if($bots != null)				
	  						@foreach($bots as $bot)
	   							<option value="{{$bot->id}}" data-chatfuel-bot-id="{{ $bot->chatfuelBotId }}" data-chatfuel-broadcast-token="{{$bot->broadcast_token}}">{{$bot->bot_name}}</option>
	   						@endforeach
	   					@endif
	   				</select>
		   		</div>
		   	</div>
		   	
{{-- 		   	@if($api->api_name == 'Clear attribute')
			   	<div class="col-lg-2"></div>
			   	<div class="col-lg-4">
			   		<div class="container">  
						<div class="row">  
						    <div class="col-md-5">
						     	<div class="form-group">  
				                    <form name="add_attribute" id="add_attribute">
				                    	@csrf  
				                        <div class="table-responsive">  
				                            <table class="table table-bordered" id="dynamic_field">  
			                                    <tr>  
			                                         <td><input type="text" name="attribute[]" placeholder="Add attribute" class="form-control attribute_list" autocomplete="off" /></td>  
			                                         <td><button type="button" name="add" id="add" class="btn glyphicon glyphicon-plus btn-success add"></button></td>  
			                                    </tr>  
				                            </table>  
				                            <input type="button" name="save" id="save" class="btn btn-info save" value="Save" />  
				                        </div>  
				                    </form>  
		                		</div>  
							</div>
						</div>
					</div>
				</div>
			@endif --}}
			@php $apiType=0; @endphp
			@if($api->api_name == 'Get global variable')
				@php $apiType=1; @endphp
			@elseif( $api->api_name == 'Increment variable' || $api->api_name == 'Decrement variable')
				@php $apiType=2; @endphp
			@elseif( $api->api_name == 'Reset global variable' )
				@php $apiType=3; @endphp
			@endif
					
			@if($api->api_name == 'Set global variable' ||  $api->api_name == 'Reset global variable' || $api->api_name == 'Increment variable' || $api->api_name == 'Decrement variable')
				<div class="col-lg-4">
					<div class="form-group">
					  <label>Select your variable :</label>
					  <select class="form-control attribute">
					  	<option value="" selected="selected" id="default" disabled>Select veriables</option>
		  					@if(count($var)>0)				
		  						@foreach($var as $global)
		   							<option value="{{$global->var_name}}" data-var-current-val="{{$global->currentVal}}" data-var-datatype="{{$global->dataType}}">{{$global->var_name}}</option>
		   						@endforeach
		   					@endif
		   				</select>
			   		</div>
			   	</div>
			@endif
@endsection
@section('scripts')
<script>
	$(document).ready(function () {
		$("#copy").attr("disabled",true);  //keep copy button disabled on page load
		$('#default').prop('selected', function() {
			//set a default option of select input on page load
        	return this.defaultSelected;
    	});

		$('.bot').change(function () {
			var chatfuelBotId = $(this).find(':selected').data('chatfuel-bot-id');
			var broadcastToken = $(this).find(':selected').data('chatfuel-broadcast-token');
			var mystr=$('.api').attr('api');
			mystr=mystr.replace('{bot_id}',chatfuelBotId);
			mystr=mystr.replace('{broadcast_api_token}',broadcastToken);
			var apiType="{{$apiType}}";
			if(apiType == 1){
				mystr = mystr+"?"+"user"+"="+"{{urlencode(base64_encode($userid))}}";
			}
			$('.api').text(mystr);
			$('.api').attr('api',mystr);
				setClipboard();
		});

		$('.attribute').change(function () {
			var globalattr = $(this).val();
			var globaldatatype = $(this).find(':selected').data('var-datatype');
			var globalval = $(this).find(':selected').data('var-current-val');
			var mystr=$('.api').attr('api');

			var datatype = $(this).find(':selected').data('var-datatype');
			var apiType="{{$apiType}}";
			if(datatype == 3 && apiType == 2){
				$('#copy').attr('disabled','disabled');
				swal({
	                title: "Sorry!",
	                text: "With this Variable you can't access this api",
	                icon: "error",
	                button: "Okay"
            	});
			}else{

				mystr = mystr+"?"+"user"+"="+"{{urlencode(base64_encode($userid))}}";
				if(apiType == 2 || apiType == 3){
					mystr = mystr+"&"+"attr="+globalattr;
				}else{
					mystr = mystr+"&"+globalattr+"=\{"+"\{"+globalattr+"\}"+"\}";
				}
				setClipboard();
			}
				
			$('.api').text(mystr);
			$('.api').attr('api',mystr);
		});

		function setClipboard() {
			$("#copy").attr("disabled",false);
			var clipboard = new Clipboard('.copyBtn');
			clipboard.on('success', function(e) {
			    setTooltip('Copied!');
			});
			clipboard.on('error', function(e) {
			    setTooltip('Failed!');
			});
			
			$('.copyBtn').tooltip({
			  trigger: 'click',
			  placement: 'bottom'
			});
		}

		function setTooltip(message) {
		  $('.copyBtn').tooltip('hide')
		    .attr('data-original-title', message)
		    .tooltip('show');
		}

	});
</script>
<script>  
	$(document).ready(function(){  
	  	var i=1;   
		$('body').on('click','.add',function(){ 
			
	       i++; 
	       $('#dynamic_field').append('<tr><td><input type="text" name="attribute[]" placeholder="Add attribute" class="form-control attribute_list" /></td><td><button type="button" name="add" id="'+i+'" class="btn glyphicon glyphicon-plus btn-success add"></button></td></tr>');

	       $(this).parent().html('<button type="button" name="remove" id="'+i+'" class="btn glyphicon glyphicon-trash btn-danger btn_remove"></button>');
		    
		});  
		
	  	$('body').on('click', '.btn_remove', function(){  
	       $(this).parent().parent().remove();
	  	});  


	  	$('body').on('click','.save',function(){     
	  		var i=1; 
	  		var attrstring=""; 
	  		var count = $('.attribute_list').length;     
		   $('.attribute_list').each(function(){
			   	if(i<count){
			   		attrstring += 'attr'+i+'='+$(this).val()+'&';
			   	} else {
			   		attrstring += 'attr'+i+'='+$(this).val();
			   	}
			   	i++;
		   });
		   	var mystr=$('.api').attr('api');
			mystr=mystr.replace('attr1={attribute_1}&attr2={attribute_2}',attrstring);
			$('.api').text(mystr);
	  	});  
	});  
 </script>
 <script>
 	$('#submitMessage').on('click',function(){
 		var message = $('#message').val();
 		$.ajax({
 			type: 'POST',
 			url : '/postmessage',
 			data: {
 				message:message,
 				name: '{{$api->api_name}}',
 				 _token:  '{{ csrf_token() }}'
 			} ,
 			success: function(data){
 				alert(message);
 			}
 		});
 	});
 </script>
@endsection
