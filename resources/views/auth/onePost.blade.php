<style>

.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
            <h1>View Post<h1>
            <div class="p-6 bg-white border-b border-gray-200">
                   <br><br>
                <div class="card" style="width: 18rem;">
                    <h3>Post By:-<?php echo $post->user->name ?><h3>
                    <img  src="{{ URL::asset('/images/images/'.$post['image']) }}" class="card-img-top" alt="">
                    <div class="card-body center">
                        <h5 class="card-title">Post Title:-<?php echo $post['post_title']?></h5>
                        <h5 class="card-title">Post Description:-<?php echo $post['description']?></h5>
                        @if(empty($post->reaction))
                        <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"><i class="fa fa-thumbs-up likes " ></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-down likes"  ></i></a>
                        @endif
                    
                       <?php $reactionarray = array();
                                 $a=0;$b=0;
                                 foreach($post->reaction as $reactions ){
                                 
                                     $reactionarray[] =+ $reactions->user_id;  
                                     $a= $a + $reactions->upvote ;
                                     $b= $b + $reactions->downvote;
                                    }
                        ?>
                       @if (in_array(auth()->id(), $reactionarray))
                        @foreach($reactions as $reactionss )
                       
                         
                        @if($reactions->user_id == auth()->id() && $reactions->post_id == $post['id'])
                                @if($reactions->upvote==1)
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"><i class="fa fa-thumbs-up likes " style="color:blue"> <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-down likes" ><?php  echo $b; ?></i></a>
                                @elseif($reactions->downvote==1)
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-up likes" > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-down likes" style="color:red;" ><?php  echo $b; ?></i></a>

                                @else
                                <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"><i class="fa fa-thumbs-up likes " > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-down likes"  ><?php  echo $b; ?></i></a>
                                @endif
                           @endif
                       @endforeach
                      @else
                         <a href="javascript:void(0)"class="liked" id="likeable" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"><i class="fa fa-thumbs-up likes " > <?php  echo $a; ?></i></a>
                                <a href="javascript:void(0)"class="dislike" data-userId="{{auth()->id()}}" data-postId="{{$post['id']}}"> <i class="fa fa-thumbs-down likes"  ><?php  echo $b; ?></i></a>
                      @endif
                       
                      
                        <a href="{{route('auth.addComment', [$post['id']]) }}"> <i class="fa-solid fa-comment"><?php echo $count?></i></a>
                       

                    </div>
                    <hr>
                    <b><h2>Comments:-</h2></b>
                    <hr>
                    <br>
                    @foreach($comment as $key=>$comments)
                   
                    @if(isset($comments->user) && !empty($comments->user))
                    <h5 class="card-title">User Name:-<?php echo $comments->user->name ?></h5>
                    <h5 class="card-title">Previous Comments ->{{$comments['coment']}}</h5>

                    <br>
                    @endif
                    @endforeach

                    <form action="{{ route('auth.commentAdd',$post['id']) }}" method="post">
                    @csrf   
                    <x-label for="coment" :value="__('Comments')" />
                        <textarea  id="coment"  name="coment" cols="27" rows="1"></textarea>
                       <br><br><div class="flex items-center justify-end mt-4">
            
                    <x-button class="ml-4">
                        {{ __('Add Comments') }}
                    </x-button>
            </div>
                    </form>
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





