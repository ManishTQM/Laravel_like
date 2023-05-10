<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
            {{ __('Dashboard') }}
            <div class="p-6 bg-white border-b border-gray-200">

    <br><br><a href="{{route('auth.addPost') }}"><button class="btn btn-primary">Add Post</button></a>
                   <br><br>
                   <div class='col-12'>
                   <div class='row'>
                @if(isset($post) && !empty($post))
                @foreach($post as $key=>$posts)
                
              
                @if(isset($posts->user) && !empty($posts->user))

                <div class="card" id="cardId" style="width: 18rem;">
                    <h3>Post By:-<?php echo $posts->user->name ?><h3>
                    <img  src="{{ URL::asset('/images/images/'.$posts['image']) }}" style="height:250px" class="card-img-top" alt="">
                    <div class="card-body center">
                        <h5 class="card-title">Post id:-<?php echo $posts['id']?></h5>
                        <h5 class="card-title">Post Title:-<?php echo $posts['post_title']?></h5>
                        <h5 class="card-title">Post Description:-<?php echo $posts['description']?></h5>
                        @if(empty($posts->reaction))
                        <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"><i class="fa fa-thumbs-up likes " ></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-down likes"  ></i></a>
                        @endif
                     
                       <?php $reactionarray = array();
                                 $a=0;$b=0;
                                 foreach($posts->reaction as $reactions ){
                                 
                                     $reactionarray[] =+ $reactions->user_id;  
                                     $a= $a + $reactions->upvote ;
                                     $b= $b + $reactions->downvote;
                                    }
                        ?>
                       @if (in_array(auth()->id(), $reactionarray))
                        @foreach($reaction as $reactions )
                         
                        @if($reactions->user_id == auth()->id() && $reactions->post_id == $posts['id'])
                                @if($reactions->upvote==1)
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"><i class="fa fa-thumbs-up likes " style="color:blue"> <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-down likes" ><?php  echo $b; ?></i></a>
                                @elseif($reactions->downvote==1)
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-up likes" > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-down likes" style="color:red;" ><?php  echo $b; ?></i></a>

                                @else
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"><i class="fa fa-thumbs-up likes " > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-down likes"  ><?php  echo $b; ?></i></a>
                                @endif
                           @endif
                       @endforeach
                      @else
                         <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"><i class="fa fa-thumbs-up likes " > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$posts['id']}}"> <i class="fa fa-thumbs-down likes"  ><?php  echo $b; ?></i></a>
                      @endif
                        <a href="{{route('auth.addComment', [$posts['id']]) }}"> <i class="fa-solid fa-comment">
                         
                        @if(isset($posts->comments) && !empty($posts->comments))
                            {{$posts->comments->count()}}
                            @endif
                        </i></a>
                    </div>
                </div>
                    @endif
                @endforeach
                @else
                    <h1> No Post Available </h1>
                @endif
                <div>
</div>
                </x-slot>
</x-app-layout>

<script>

    $(".liked").click(function (event) {
    event.preventDefault();
    var post = $(this).data("postid");
    var user_id = $(this).data("userid");
        
    $.ajax({
      method: "post",
      url : '{{url("post")}}',
      data:{
        _token : '{{csrf_token()}}',
        'user_id': user_id,
        'post_id': post,
      }, 
      success: function (response) {
          var data = JSON.parse(response);
          window.location.reload();
          
        } 
      
    })
  })

  $(".dislike").click(function (event) {
    event.preventDefault();
    var post = $(this).data("postid");
    var user_id = $(this).data("userid");
        
    $.ajax({
      method: "post",
      url : '{{url("postdislike")}}',
      data:{
        _token : '{{csrf_token()}}',
        'user_id': user_id,
        'post_id': post,
      }, 
      success: function (response) {
          var data = JSON.parse(response);
        //   if (data.message=="add dislike") {
        //     $('#dislike').css('color','blue');
            
        //   }
            window.location.reload();
        }  
      
    })
  })
</script>