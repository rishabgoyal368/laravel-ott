@extends('layouts.admin')
@section('title','Edit Package')
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/packages')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Edit Package</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($package, ['method' => 'PATCH', 'action' => ['PackageController@update', $package->id]]) !!}
            <div class="form-group{{ $errors->has('plan_id') ? ' has-error' : '' }}">
                {!! Form::label('plan_id', 'Your Unique Plan Id') !!}
                <p class="inline info"> - Please enter your unique plan id for package</p>
                {!! Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => 'Create Your Unique Plan ID ex. basic10', 'data-placement' => 'bottom']) !!}
                <small class="text-danger">{{ $errors->first('plan_id') }}</small>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Plan Name') !!}
                <p class="inline info"> - Please enter your plan name</p>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            {!! Form::hidden('currency', $currency_code) !!}
    
            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                {!! Form::label('amount', ' Your Plan Amount') !!}
                <p class="inline info"> - Please enter your plan amount (Min. Amount should be 1)</p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="{{$currency_symbol}}"></i></span>
                  {!! Form::number('amount', null, ['min' => 1,'step'=>'0.01', 'class' => 'form-control', 'required' => 'required']) !!}  
                </div>
                @if($package->currency_symbol=='')
                 <input type="text" name="currency_symbol" id="currency_symbol" value="{{$currency_symbol}}" hidden="true">
                 @else
                   <input type="text" name="currency_symbol" id="currency_symbol" value="{{$package->currency_symbol}}" hidden="true">
                 @endif
                <small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>
             
            <div class="menu-block">
              <h6 class="menu-block-heading">Please Select Menu</h6>
              @if (isset($menus) && count($menus) > 0)
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox{{100}}" >
                        <label for="checkbox{{100}}" class="material-checkbox"></label>
                      </div>
                      All Menus
                    </li>
                  @foreach ($menus as $menu)
                 
                    <li>
                      <div class="inline">
                        <input @foreach($menu->getpackage as $pkg) {{ $pkg->menu_id == $menu->id && $package->id == $pkg->pkg_id? "checked" : "" }} @endforeach type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                      </div>
                      {{$menu->name}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="form-group{{ $errors->has('screens') ? ' has-error' : '' }}">
                {!! Form::label('screens', 'Screens') !!}
                <p class="inline info"> - Please enter screens for users (max:4)</p>
                {!! Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4' ,'disabled="disabled']) !!}
                <small class="text-danger">{{ $errors->first('screens') }}</small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('download', 'Do you want download limit?') !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('download', 1, $package->download, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('download') }}</small>
              </div>
            </div>
            <small class="text-danger">{{ $errors->first('downloadlimit') }}</small>
            <div id="downloadlimit" class="form-group{{ $errors->has('downloadlimit') ? ' has-error' : '' }}" style="{{ $package->download != '' ? ""  : "display:none" }}">
                {!! Form::label('downloadlimit', 'Download Limit') !!}
                <p class="inline info"> - Please enter download limit for users</p>
                {!! Form::number('downloadlimit', null, ['class' => 'form-control']) !!}
                <small class="text-danger">Note :- The download limit you entered will be multiply with given screens.</small>
                
            </div>

            <!--------------- end download limit ------------------->
           
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Status') !!}
                <p class="inline info"> - Please select status</p>
                {!! Form::select('status', array('0' => 'Inactive', '1' => 'Active'), null, ['class' => 'form-control select2', 'placeholde' => '']) !!}
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom-script')
 <script type="text/javascript">
    $(document).ready(function(){
      var check = [];
    
    $('.one').each(function(index){

      if($(this).is(':checked')){
        check.push(1);
      }else{
        check.push(0);
      }

    });
   console.log(check);
    var flag = 1;

    if (jQuery.inArray(0, check) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }

  });

    // if one checkbox is unchecked remove checked on all menu option

    $(".one").click(function(){
      if($(this).is(':checked'))
      {
       
        var checked = [];
       $('.one').each(function(){
        if($(this).is(':checked')){
          checked.push(1);
        }else{
          checked.push(0);
        }
       })
       
       var flag = 1;

    if (jQuery.inArray(0, checked) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

       if(flag == 0){
        $('.all').prop('checked',false);
       }else{
         $('.all').prop('checked',true);
       }
      }
      else{
        
        $('.all').prop('checked',false);
      }
    });

// when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })

  </script>
  <script>
    $('#download_enable').on('change',function(){
      if($('#download_enable').is(':checked')){
        //show
        $('#downloadlimit').show();
      }else{
        //hide
         $('#downloadlimit').hide();
      }
    });
</script>

@endsection