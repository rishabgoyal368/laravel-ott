@extends('layouts.admin')
@section('title','Slider')
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('appslider.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Add App Slide</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> Delete Selected</a>   
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">Are You Sure ?</h4>
              <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'AppSliderController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="info">You can change the position of items by DRAG &amp; DROP</p>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            #
          </th>
          <th>Movie</th>
          <th>Tv Series</th>
          <th>App Slide Image</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
        </thead>
        @if ($app_slides)
          <tbody>
          @foreach ($app_slides as $key => $app_slide)
            <tr id="item-{{$app_slide->id}}">
              <td>
                <div class="inline">
                  <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$app_slide->id}}" id="checkbox{{$app_slide->id}}">
                  <label for="checkbox{{$app_slide->id}}" class="material-checkbox"></label>
                </div>
                <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                {{$key+1}}
              </td>
              <td>{{$app_slide->movie ? $app_slide->movie->title : '-'}}</td>
              <td>{{$app_slide->tvseries ? $app_slide->tvseries->title : '-'}}</td>
              <td>
                @if(isset($app_slide->slide_image))
                  @if($app_slide->movie)
                    @if ($app_slide->slide_image != null)
                      <img src="{{asset('images/app_slider/movies/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($app_slide->movie->poster != null)
                      <img src="{{asset('images/movies/posters/'. $app_slide->movie->poster)}}" class="img-responsive" alt="slider-image">
                    @endif
                  @elseif(isset($app_slide->tvseries))
                    @if ($app_slide->slide_image != null)
                      <img src="{{asset('images/app_slider/shows/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($app_slide->tvseries['poster'] != null)
                      <img src="{{asset('images/tvseries/posters/'. $app_slide->tvseries['poster'])}}" class="img-responsive" alt="slider-image">
                    @endif
                  @else
                      @if ($app_slide->slide_image != null)
                        <img src="{{asset('images/app_slider/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                      @endif
                  
                  @endif
                
                @endif
              </td>
              <td>{{$app_slide->active == 1 ? 'Active' : 'inactive'}}</td>
              <td>
                <div class="admin-table-action-block">
                  <a href="{{route('appslider.edit', $app_slide->id)}}" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                  <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$app_slide->id}}deleteModal"><i class="material-icons">delete</i> </button>
                </div>
              </td>
            </tr>
            <!-- Delete Modal -->
            <div id="{{$app_slide->id}}deleteModal" class="delete-modal modal fade" role="dialog">
              <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="delete-icon"></div>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="modal-heading">Are You Sure ?</h4>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AppSliderController@destroy', $app_slide->id]]) !!}
                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
  var app = new Vue({});
  $('table.db tbody').sortable({
    cursor: "move",
    revert: true,
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    forcePlaceholderSize: true,
    zIndex: 999999,
    axis: 'y',
    update: function(event, ui) {
      var data = $(this).sortable('serialize');
      app.$http.post('{{route('slide_reposition')}}', {item: data}).then((response) => {
        console.log(data);
        console.log('re');
        console.log(response);
      }).catch((e) => {
        console.log($(this).sortable('serialize'));
        console.log(e);
        console.log('err');
      });
    }
  });
  $(window).resize(function() {
    $('table.db tr').css('min-width', $('table.db').width());
  });
</script>
@endsection