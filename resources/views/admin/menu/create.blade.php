@extends('layouts.admin')
@section('title','Create Menu')
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/menu')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Create Menu</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'MenuController@store']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter menu name eg:Home"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter menu name']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group" class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
              <label>Choose section: <span class="text-danger">*</span></label>
              <br>
              <small class="text-muted"> <i class="fa fa-question-circle"></i> Menu will contain following section for display items</small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> Atlease one section is required</small>

              <br><br>

              <label>
                <div class="inline">
                  <input value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                Recently Added 
              </label>
              <br>

              <div style="display: none" class="section1">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section1">
                 
                   <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                Genre 
              </label>
              <div style="display: none" class="section2">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section2">
                 
                   <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>
    
              <br>
              <label>
                <div class="inline">
                  <input value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                Featured
              </label>
           
                <div style="display: none" class="section3">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[3]" id="select3" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section3">
                 
                   <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>
              
              <br>
              <label>
                <div class="inline">
                  <input value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                Best on intrest
              </label>
           
                <div style="display: none" class="section4">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section4">
                 
                   <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[4]" id="select4" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>

              <br/>

              <label>
                <div class="inline">
                  <input value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                Continue Watch
              </label>
           
                <div style="display: none" class="section5">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[5]" id="select5" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section5">
                 
                  <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>
              
              <br/>


                <label>
                <div class="inline">
                  <input value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
                Language
              </label>
           
                <div style="display: none" class="section6">
                  <div class="form-group">
                    <label>Limit:</label>
                    <input id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>View In:</label>
                    <select name="view[6]" id="select6" class="form-control">
                      <option value="1">Slider View</option>
                      <option value="0">Grid View</option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section6">
                 
                  <div class="form-group">
                    <label>Order In:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option value="1">DESC Order</option>
                      <option value="0">ASC Order</option>
                    </select>
                  </div>
              </div>
              
              <br/>
                <label>
                <div class="inline">
                  <input value="7" id="pramotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="pramotion" class="material-checkbox"></label>
                </div>
                Movie & Tvseries pramotion
              </label>
              <br/>
              <label>
                <div class="inline">
                  <input value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                Blog
              </label>
           

                <small class="text-danger">{{ $errors->first('section') }}</small>
            </div>
          
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom-script')
  <script>
    
      $('#recent_added').on('change',function(){
           
          if($(this).is(':checked')){
              $('.section1').show('fast');
              $('#limit1').attr('required','required');
              $('#order1').attr('required','required');
              $('#select1').attr('required','required');
          }else{
            $('.section1').hide('fast');
            $('#limit1').removeAttr('required');
             $('#order1').removeAttr('required','required');
            $('#select1').removeAttr('required');
          }
      });

      $('#genre_added').on('change',function(){
          if($(this).is(':checked')){
            $('.section2').show('fast');
            $('#limit2').attr('required','required');
             $('#order2').attr('required','required');
            $('#select2').attr('required','required');
          }else{
            $('.section2').hide('fast');
            $('#limit2').removeAttr('required');
             $('#order2').removeAttr('required','required');
            $('#select2').removeAttr('required');
          }
      });

      $('#featured').on('change',function(){
          if($(this).is(':checked')){
            $('.section3').show('fast');
            $('#limit3').attr('required','required');
             $('#order3').attr('required','required');
            $('#select3').attr('required','required');
          }else{
            $('.section3').hide('fast');
            $('#limit3').removeAttr('required');
             $('#order3').removeAttr('required','required');
            $('#select3').removeAttr('required');
          }
      });

      $('#intrest').on('change',function(){
          if($(this).is(':checked')){
            $('.section4').show('fast');
            $('#limit4').attr('required','required');
             $('#order4').attr('required','required');
            $('#select4').attr('required','required');
          }else{
            $('.section4').hide('fast');
            $('#limit4').removeAttr('required');
             $('#order4').removeAttr('required','required');
            $('#select4').removeAttr('required');
          }
      });

      $('#history').on('change',function(){
          if($(this).is(':checked')){
            $('.section5').show('fast');
            $('#limit5').attr('required','required');
             $('#order5').attr('required','required');
            $('#select5').attr('required','required');
          }else{
            $('.section5').hide('fast');
            $('#limit5').removeAttr('required');
             $('#order5').removeAttr('required','required');
            $('#select5').removeAttr('required');
          }
      });

      $('#language').on('change',function(){
          if($(this).is(':checked')){
            $('.section6').show('fast');
            $('#limit6').attr('required','required');
             $('#order6').attr('required','required');
            $('#select6').attr('required','required');
          }else{
            $('.section6').hide('fast');
            $('#limit6').removeAttr('required');
             $('#order6').removeAttr('required','required');
            $('#select6').removeAttr('required');
          }
      });

   
   
  </script>
@endsection
