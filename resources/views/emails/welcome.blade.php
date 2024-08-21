<h1>hello {{$user->name}}</h1>
<div>
   <h2> you created {{$post->title}}</h2>
   <p>{{$post->body}}</p>
   <img src="{{$message->embed('storage/'. $post->image)}}" alt="">
</div>