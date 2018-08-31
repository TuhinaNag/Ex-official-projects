@extends('layouts.app')

@section('content')
<style type="text/css">
.dataType{
    height: 34px !important;
}
.bots{
    display: none;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px !important;
}

.slider.round:before {
  border-radius: 50% !important;
}
.on {
    position: absolute;
    width: 05px;
}
</style>
    <div class="row  align-items-lg-stretch">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header col-12 align-items-lg-stretch ">
                            Available APIs
                        </div>
                        <div class="card-body col-12">
                            @include('Bot.api')
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header col-12 align-items-lg-stretch ">
                    <div class="row">
                       <div class="col-6">
                           BOT DETAILS
                       </div>
                        <div class="col-6">
                            <a type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#addBotModal">
                                ADD NEW BOT
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body col-12">
                    @include('Bot.datatable')
                </div>
            </div>
            <p>
                           <div>
                            @if(Session::has('message') && Session::has('success'))
                                <div class="alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }}">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                           </div>
                <div class="card">
                    <div class="card-header col-12 align-items-lg-stretch ">
                        <div class="row">
                           <div class="col-6">
                                GLOBAL VARIABLES
                           </div>
                            <div class="col-6">
                                <a type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#addVarModal">
                                    ADD GLOBAL VARIABLES
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body col-12">
                        @include('Bot.variablestructure')
                    </div>
                </div>
                {{--Modal Body--}}
                @include('Bot.modal')
            </p>
        </div>
    </div>
@endsection

