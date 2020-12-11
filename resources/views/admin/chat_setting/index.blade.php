@extends('layouts.admin')
@section('title','Edit Chat Settings')
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Chat Settinges</h4><br/>
    <div class="admin-form-block z-depth-1">
      <div class="row">
        {!! Form::model($chat,['method'=>'POST','action'=>'ChatSettingController@update']) !!}

            @if (isset($chat) && count($chat) > 0)  
              
              @foreach ($chat as $element)  
              <div class="row">
                <p class="font-700"> Chat Settings For {{ucfirst($element->key)}}</p>
                <br/>
                 {!! Form::hidden('ids['.$element->id.']', $element->id) !!}
                <div class="col-md-12">

                  @if($element->key != 'whatsapp')
                   <div class="col-md-8">
                      <div class="form-group{{ $errors->has('script') ? ' has-error' : '' }}">
                         {!! Form::label('script',' Script' )!!}
                          {{-- <p class="inline info"> - Please enter genre name</p> --}}
                          {!! Form::textarea('script['.$element->id.']', $element->script, ['class' => 'form-control','rows'=>'3']) !!}
                        <small class="text-danger">{{ $errors->first('script') }}</small>
                      </div>
                    </div>
                  @endif

                  @if($element->key != 'whatsapp')
                  <div class="col-md-4">
                      <div class="form-group{{ $errors->has('enable_messanger') ? ' has-error' : '' }}">
                       <div class="col-sm-7">
                            <h5 class="bootstrap-switch-label">Enable</h5>
                          </div>
                          <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('enable_messanger', 1, ($element->enable_messanger == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
                            </div>
                          </div>
                      <small class="text-danger">{{ $errors->first('enable_messanger') }}</small>
                    </div>
                  </div>
                  @endif
                 
                 
                  @if($element->key != 'messanger')
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        {!! Form::label('mobile', 'Whatsapp No(without [+] sign)') !!}
                        {{-- <p class="inline info"> - Please enter genre name</p> --}}
                        {!! Form::text('mobile['.$element->id.']', $element->mobile, [ 'class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                      </div>
                    </div>
                  @endif

                  @if($element->key != 'messanger')
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                      {!! Form::label('text','Welcome Text') !!} 
                      {{-- <p class="inline info"> - Please enter genre name</p> --}}
                      {!! Form::text('text['.$element->id.']', $element->text, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('text') }}</small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('header') ? ' has-error' : '' }}">
                      {!! Form::label('header','Chat Header') !!} 
                      {{-- <p class="inline info"> - Please enter genre name</p> --}}
                      {!! Form::text('header['.$element->id.']', $element->header, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('header') }}</small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                      {!! Form::label('size','Icon Size') !!} 
                      {{-- <p class="inline info"> - Please enter genre name</p> --}}
                      {!! Form::number('size['.$element->id.']', $element->size, ['class' => 'form-control','min'=>'30']) !!}
                      <small class="text-danger">{{ $errors->first('size') }}</small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                      {!! Form::label('color','Header Color') !!} 
                      {{-- <p class="inline info"> - Please enter genre name</p> --}}
                      {!! Form::color('color['.$element->id.']', $element->color, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('color') }}</small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      
                      <div class="form-group{{ $errors->has('enable_whatsapp') ? ' has-error' : '' }}">
                       <div class="col-sm-6">
                            <h5 class="bootstrap-switch-label">Enable</h5>
                        </div>
                        <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('enable_whatsapp', 1, ($element->enable_whatsapp == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
                            </div>
                        </div>
                      <small class="text-danger">{{ $errors->first('enable_whatsapp') }}</small>
                    </div>
                  </div>
                  <br/>
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                       <div class="col-sm-6">
                            <h5 class="bootstrap-switch-label">Position</h5>
                        </div>
                        <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('position', 1, ($element->position == 'right' ?'right' :'left'), ['class' => 'bootswitch', "data-on-text"=>"Left", "data-off-text"=>"Right", "data-size"=>"small"]) !!}
                            </div>
                        </div>
                      <small class="text-danger">{{ $errors->first('position') }}</small>
                    </div>
                  </div>
                  @endif
                 
                </div>
              </div>
              @endforeach
             
            @endif
          <div class="">
            <button type="submit" class="btn btn-block btn-success">Update</button>
          </div>
          <div class="clear-both"></div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
