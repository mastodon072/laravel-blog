@extends('layouts.blog-post')

@section('content')
    
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}

    <hr>

    <!-- Preview Image -->
    @if ($post->image)
        <img class="img-responsive" src="{{$post->image->file}}" alt="Image">
    @endif

    <hr>

    <!-- Post Content -->
    {!! $post->content !!}
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!!Form::open([ 'method' => 'POST','action' => 'PostCommentsController@add'])!!}
            <div class="form-group">
                @unless (Auth::user())
                    <div class="form-group">
                        {!!Form::label('author','Name')!!}
                        {!!Form::text('author', null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('email','Email')!!}
                        {!!Form::email('email', null, ['class' => 'form-control'])!!}
                    </div>
                @endunless
                <div class="form-group">
                    {!!Form::label('body','Comment')!!}
                    {!!Form::textarea('body', null,['class' => 'form-control', 'rows' => 3] )!!}
                    {!!Form::hidden('post_id',$post->id)!!}
                </div>
            </div>
            {!!Form::submit('Submit ',['class' => 'btn btn-primary'])!!}
            @if (Session::has('comment_message'))
                <div class="alert alert-info">
                    {{session('comment_message')}}
                </div>                
            @endif
        {!!Form::close()!!}
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @foreach ($post->comments->where('is_active', '==', 1) as $comment)
        <div class="media comment-wrapper">
            <a class="pull-left" href="#">
                <img height="50" class="media-object" src="{{$comment->getGravatar($comment->email)}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->author}}
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                    <a class="comment-reply"><i class="fa fa-reply"></i> Reply</a>
                </h4>
                {{$comment->body}}
                @if ($comment->replies)
                    @foreach ($comment->replies->where('is_active', '==', 1) as $reply)
                        
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img height="40" class="media-object" src="{{$comment->getGravatar($reply->email)}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                        <!-- End Nested Comment -->

                    @endforeach

                @endif
                <div class="reply-form hidden">
                    <h4 class="reply-title">
                        Your Reply 
                    </h4>
                    {!!Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@add'])!!}
                        <div class="form-group">
                            @unless (Auth::user())
                                <div class="form-group">
                                    {!!Form::label('author','Name')!!}
                                    {!!Form::text('author', null, ['class' => 'form-control'])!!}
                                </div>
                                <div class="form-group">
                                    {!!Form::label('email','Email')!!}
                                    {!!Form::email('email', null, ['class' => 'form-control'])!!}
                                </div>
                            @endunless
                            <div class="form-group">
                                {!!Form::label('body','Comment')!!}
                                {!!Form::textarea('body', null,['class' => 'form-control', 'rows' => 3] )!!}
                                {!!Form::hidden('comment_id',$comment->id)!!}
                            </div>
                        </div>
                        {!!Form::submit('Submit ',['class' => 'btn btn-primary'])!!}
                    {!!Form::close()!!}
                </div>
                
            </div>
        </div>
    @endforeach
    <div id="disqus_thread"></div>
    <script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://blog-site-8.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <script id="dsq-count-scr" src="//blog-site-8.disqus.com/count.js" async></script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection