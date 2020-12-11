
@extends('layouts.theme')

@if(isset($blogdetail))
  @section('title',"$blogdetail->title")
@endif
@section('main-wrapper')
 <section class="">
  <div class="container">
    @php
      $uname=App\User::where('id',$blogdetail->user_id)->get();
      foreach($uname as $name)
      {
        $user_name = $name->name;
      }

    @endphp
    <div class="plan-block-dtl">
      <h3 class="plan-dtl-heading" style="color:white;">{{$blogdetail->title}}</h3>
      <span style="color:white;"><i class="fa fa-clock-o"></i>&nbsp;{{date ('d.m.Y',strtotime($blogdetail->created_at))}}&emsp;<i class="fa fa-user" style="color:white;"></i>&nbsp;{{$user_name}}</span>
    </div>
    <div class="row">
    <div class="col-lg-9 col-md-12 col-sm-12  blog-detail">
      <div class="col-sm-12  plan-title">
         <img src="{{ asset('images/blog/'.$blogdetail->image) }}" class="img-responsive" alt="image">
      </div><br/>
      <div class=" col-sm-12 main-plan-section">
        <p class="blog" style="font-size:16px;">{!! $blogdetail->detail !!}</p>
     </div>
     <br/>
      @if(Auth::check() && Auth::user() != NULL)
        <div>
          @php
            $like=App\Like::orderBy('created_at','desc')->where('added','1')->where('blog_id',$blogdetail->id)->count();
             $unlike=App\Like::orderBy('created_at','desc')->where('added','-1')->where('blog_id',$blogdetail->id)->count();
          @endphp
          <a  id="{{$blogdetail->id}}"  class="col-sm-2 like_list"><i class="fa fa-thumbs-o-up" style="font-size:22px;"> {{$like}}</i></a> 
          <a data-id="{{$blogdetail->id}}"  class="col-sm-2 unlike"><i class="fa fa-thumbs-o-down" style="font-size:22px;"> {{$unlike}}</i></a>
          <br/>
        </div>
      @endif
    </div>
    @if(isset($exceptblog) && $exceptblog != NULL && count($exceptblog) > 0)
    <div class="col-lg-3 col-md-12 col-sm-12  ">
      <div class="blog-recent-detail">
        <div class="col-sm-12  plan-recent-title">
         <h4 class="recent-heading text-center">{{__('staticwords.recentpost')}}</h4>  <br/>
        </div>
      
       @foreach($exceptblog as $eblog)
       <div class="col-sm-12 main-plan-section">
        <ul>
          <li>
            <span>
             <a href="{{url('account/blog/'.$eblog->slug)}}"> 
              <img src="{{ asset('images/blog/'.$eblog->image) }}" class="img-responsive recent-img " style="float:left;" alt="image">
            </a>
            </span>
            <span>  
              <a href="{{url('account/blog/'.$eblog->slug)}}">
                <p class="main-plan-text">{{$eblog->title}}</p></a>  
                <small> {!! str_limit($eblog->detail, 150) !!}</small>
            </span>
             <hr>
          </li>
        </ul>
      </div>
        
        @endforeach
       <br/>
    </div>
    @endif
    </div>
    </div>
  </div>
  <br/>
@if(Auth::check() && Auth::user() != NULL)
<div class="container">
   <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab">{{__('staticwords.comment')}}</a></li>
    <li role="presentation"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab">{{__('staticwords.postcomment')}}</a></li>
  </ul>
  <br/>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
      <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$blogdetail->comments->count()}} {{__('staticwords.comment')}}</h4> <br/>
          @foreach ($blogdetail->comments as $comment)
              <div class="comment">
                <div class="author-info">
                  <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                  <div class="author-name">
                    <h4>{{ucfirst($comment->name)}} </h4>
                      <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                  </div>
                  @if(Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id)
                    <a title="Delete?" type="button" class="pull-right btn btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="    position: relative;left: 8px;"><i class="fa fa-trash-o"></i></a>
                  @endif
                    <a title="Reply" type="button" class="btn btn-primary btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i></a> &nbsp;&nbsp;
                </div>
                <div class="comment-content">
                  {{$comment->comment}}
                </div>
              </div>{{-- 
              <div> --}}

              <div id="deleteModal{{$comment->id}}" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading comment-delete-heading">{{__('staticwords.areyousure')}}</h4>
                      <p class="comment-delete-detail">{{__('staticwords.modelmessage')}}</p>
                    </div>
                     <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['CommentController@deletecomment', $comment->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
                    <!-- Modal -->
              <br/>
              <div id="{{$comment->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-md" style="margin-top:70px;">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                       
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                     <h4 style="color:#B1B1B1;"> {{__('staticwords.replyfor')}} {{$comment->name}}</h4>
                    </div>
                    <div class="modal-body text-center">
                       
                        <form action="{{route('comment.reply', ['cid' =>$comment->id,'bid'=> $blogdetail->id])}}" method ="POST">
                          {{ csrf_field() }}
                        {{Form::label('reply','Your Reply:')}}
                        {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                        <br/>
                          <button type="submit" class="btn btn-danger">{{__('staticwords.submit')}}</button>
                     </form>
                    </div>
                    <div class="modal-footer">
                     
                    </div>
                  </div>
                </div>
              </div>{{-- 
              </div> --}}
               @foreach($comment->subcomments as $subcomment)

                <div class="comment" style="margin-left:50px;">
                  <div class="author-info">
                    @php
                      $name=App\User::where('id',$subcomment->user_id)->first();
                    @endphp
                    <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                    <div class="author-name">
                     
                      <h5>{{ucfirst($name->name)}}</h5>
                     
                      <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                    </div>
                     @if(Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id)
                        <a title="Delete" type="button" class="btn btn-danger btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></a>
                      @endif
                  </div>

                  <div class="comment-content">
                    {{$subcomment->reply}}
                  </div>
                  <div>
                    <div id="deleteModal{{$subcomment->id}}" class="delete-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading">{{__('staticwords.areyousure')}}</h4>
                            <p class="comment-delete-detail">{{__('staticwords.modelmessage')}}</p>
                          </div>
                           <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['CommentController@deletesubcomment', $subcomment->id]]) !!}
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('staticwords.no')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('staticwords.yes')}}</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          @endforeach
    </div>
    @auth
    <div role="tabpanel" class="tab-pane fade" id="postcomment">
        <div style="width: 90%;color:#B1B1B1;" class=" " >
            <h3>{{__('staticwords.postcomment')}}:</h3><br/>
                {{Form::open( ['route' => ['comment.store', $blogdetail->id], 'method' => 'POST'])}}
                {{Form::label('name', __('staticwords.name'))}}
                {{Form::text('name', null, ['class' => 'form-control',])}}
                <br/>
                {{Form::label('email', __('staticwords.email'))}}
                 {{Form::email('email', null, ['class' => 'form-control'])}}
                <br/>
                {{Form::label('comment',__('staticwords.comment'))}}
                {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}}
                <br/>
                {{Form::submit(__('staticwords.addcomment'), ['class' => 'btn btn-md btn-primary'])}}
        </div>

    </div>
    @endauth
  </div>
</div>
@endif
 </section>
 <script>
$(document).ready(function() {
    $(".like_list").click(function() {
    var item = $(this).attr('id');
    
    $.ajax({
      url: '{{route('addtolike')}}',
      type: 'GET',
      data: { item: item},
      success:function(data){ 
        //console.log(data);
        if(data == 'exist'){
          swal({
            title:"Oops !",
            text: "This post is already liked",
            icon:'warning'
          });
          //sweetalert("Oops ..... ", "This Post is Already Liked");
          console.log('Already liked');
        }else{
            swal({
            title:"Success !",
            text: "Post Liked successfully!",
            icon:'success'
          });
        }
       
      }
    
    });
  });

    $(".unlike").click(function() {
    var item = $(this).attr('data-id');
    //alert(item);
    $.ajax({
      url: '{{route('unlike')}}',
      type: 'GET',
      data: { item: item},

      success:function(data){ 
        if(data == 'exist'){
          swal({
            title:"Oops !",
            text: "This post is already unliked",
            icon:'warning'
          });
          //sweetalert("Oops ..... ", "This Post is Already Liked");
          console.log('Already liked');
        }else{
            swal({
            title:"Success !",
            text: "Post UnLiked successfully!",
            icon:'success'
          });
        }
       
      }
    
    });
  });


});

</script>

 @endsection