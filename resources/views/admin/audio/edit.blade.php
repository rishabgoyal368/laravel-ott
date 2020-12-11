@extends('layouts.admin')
@section('title',"Edit Audio - $audio->title")
<style type="text/css">
    body{
            background-color: #efefef;
        }
        .container-4 input#hyv-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
         .container-4 input#vimeo-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .container-4 button.icon {
            height: 30px;
            background: #f0f0f0 url('images/searchicon.png') 10px 1px no-repeat;
            background-size: 24px;
            -webkit-border-top-right-radius: 5px;
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-topright: 5px;
            -moz-border-radius-bottomright: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border: 1px solid #c6c6c6;
            width: 50px;
            margin-left: -44px;
            color: #4f5b66;
            font-size: 10pt;
        }
    
</style>
@section('content')
<div class="admin-form-main-block">
  <h4 class="admin-form-text"><a href="{{url('admin/audio')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Edit Audio</h4>
  <div class="row">
    <div class="col-md-6">
     <div class="admin-form-block z-depth-1">
       {!! Form::model($audio, ['method' => 'PATCH', 'action' => ['AudioController@update',$audio->id], 'files' => true]) !!}

      <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', 'Audio Title') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter audio title"></i>
        <input  type="text" class="form-control" name="title" value="{{ $audio->title }}">
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>
         <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
          {!! Form::label('selecturls', 'Add Audio ') !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select one of the options to add audio"></i>
           <select class="form-control select2" id="selecturl" name="selecturl">
         
            @if($audio['audiourl']!='')
            <option value="audiourl" selected="">Audio URL</option>
            @else
              <option value="audiourl">Audio URL</option>
            @endif
            
           
             @if($audio['upload_audio']!='')
             <option value="upload_audio" selected="">Upload Audio</option>
              @else
               <option value="upload_audio">Upload Audio</option>
            @endif
            

           
          </select>
           <small class="text-danger">{{ $errors->first('selecturl') }}</small>
         </div>


         <div id="ifbox" style="{{$audio['audiourl']!='' ? '' : "display: none" }}" class="form-group">
          <label for="audiourl">Audio URL: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="audiourl" placeholder="" value="{{$audio['audiourl']}}">
        </div>



       {{-- upload video --}}
       <div id="upload_audio" style="{{$audio['upload_audio']!='' ? '' : "display: none" }}"class="form-group{{ $errors->has('upload_audio') ? ' has-error' : '' }} input-file-block">
        {!! Form::label('upload_audio', 'Upload Audio') !!} - <p class="inline info">Choose A Video</p>
        {!! Form::file('upload_audio', ['class' => 'input-file', 'id'=>'upload_audio']) !!}
        <label for="upload_video" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Upload Audio">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose Audio</p>
        <small class="text-danger">{{ $errors->first('upload_audio') }}</small>
     </div>
     {{-- select to upload or add links code ends here --}}

     <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
      {!! Form::label('a_language', 'Audio Languages') !!}
      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select audio language"></i>
      <div class="input-group">
        {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
      </div>
      <small class="text-danger">{{ $errors->first('a_language') }}</small>
    </div>
    <div class="form-group{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
      {!! Form::label('maturity_rating', 'Maturity Rating') !!}
      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select maturity rating"></i>
      {!! Form::select('maturity_rating', array('all age' => 'All age', '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}
      <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
    </div>
    <div class="form-group" style="display: none">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('', 'Choose custom thumbnail & poster') !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch for-custom-image">
            {!! Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']) !!}
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>
    <div class="upload-image-main-block">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('thumbnail', 'Thumbnail') !!} - <p class="info">Help block text</p>
            {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}
            <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Thumbnail">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">Choose a File</span>
            </label>
            <p class="info">Choose custom thumbnail</p>
            <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('poster', 'Poster') !!} - <p class="info">Help block text</p>
            {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
            <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Poster">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">Choose a File</span>
            </label>
            <p class="info">Choose custom poster</p>
            <small class="text-danger">{{ $errors->first('poster') }}</small>
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('featured', 'Featured') !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            {!! Form::checkbox('featured', 1, 0, ['class' => 'checkbox-switch']) !!}
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('featured') }}</small>
      </div>
    </div>

    <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('is_protect', 'Protected Video ?') !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('is_protect') }}</small>
      </div>
    </div>
    <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
      {!! Form::label('password', 'Protected Password For Video') !!}
      {!! Form::password('password', null, ['class' => 'form-control','id'=>'password']) !!}
      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
      <small class="text-danger">{{ $errors->first('password') }}</small>
    </div>



      <div class="form-group">
        <label for="">Meta Keyword: </label>
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Enter Meta Keyword"></i>
        <input name="keyword" type="text" class="form-control" data-role="tagsinput"/>
      </div>

    
      <div class="menu-block">
        <h6 class="menu-block-heading">Please Select Menu</h6>
        @if (isset($menus) && count($menus) > 0)
        <ul>
          @foreach ($menus as $menu)
          <li>
            <div class="inline">
              @php
              $checked = null;
              if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                if ($menu->menu_data->where('audio_id', $audio->id)->where('menu_id', $menu->id)->first() != null) {
                  $checked = 1;
                }
              }
              @endphp
              @if ($checked == 1)
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" checked>
              <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
              @else
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
              <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
              @endif
            </div>
            {{$menu->name}}
          </li>
          @endforeach
        </ul>
        @endif
      </div>
  
      <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
        {!! Form::label('rating', 'Ratings') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter ratings eg:8"></i>
        {!! Form::text('rating',  null, ['class' => 'form-control', ]) !!}
        <small class="text-danger">{{ $errors->first('rating') }}</small>
      </div>
          
      <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
       {!! Form::label('genre_id', 'Genre') !!}
       <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select your genres"></i>
       <div class="input-group">
          <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">
            @if(isset($old_genre) && count($old_genre) > 0)
            @foreach($old_genre as $old)
            <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 
            @endforeach
            @endif
            @if(isset($genre_ls))
            @foreach($genre_ls as $rest)
            <option value="{{$rest->id}}">{{$rest->name}}</option> 
            @endforeach
            @endif
          </select>  
          <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>
        </div>
        <small class="text-danger">{{ $errors->first('genre_id') }}</small>
      </div>
      <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
         {!! Form::label('detail', 'Description') !!}
         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter audio description"></i>
         {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
         <small class="text-danger">{{ $errors->first('detail') }}</small>
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



<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Language</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
      <div class="modal-body">
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
          {!! Form::label('language', 'Language') !!}
          {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('language') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info">Reset</button>
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Genre</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'GenreController@store']) !!}
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
        </div>
      </div>
      <div class="clear-both"></div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script>
  $(document).ready(function(){
   
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'audiourl') {
    $('#ifbox').show();
    $('#upload_audio').hide();
    


  }else if (selecturl == 'upload_audio') {
   $('#upload_audio').show();
   $('#ifbox').hide();
   

 }

});
 
  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
   
  });
</script>
{{-- vimeo api code --}}


<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
@endsection