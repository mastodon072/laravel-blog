@extends('layouts.admin')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(session()->has($key))
        <div class="alert alert-{{$key}}"> 
            {!! session($key) !!}
        </div>
    @endif
@endforeach
    @component('includes.page-header')
        All Posts
    @endcomponent
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>Author</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="4" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>
                        @if($post->image)
                            <img height="50" src="{{$post->image->file}}" alt="Image">
                        @else
                            No Image
                        @endif  
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->content, 100, ' (...)')}}</td>
                    <td>
                        @if($post->categories)
                            <ul>
                                @foreach ($post->categories as $category)
                                <li>{{$category->name}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        {{$post->user->name}}
                    </td>
                    <td>{{$post->created_at->diffForHumans() }}</td>
                    <td>{{$post->updated_at->diffForHumans() }}</td>
                    <td><a href="{{route('comments.show',$post->id)}}">View Comments</a></td>
                    <td><a href="{{route("home.post", $post->slug)}}">View</a></td>
                    <td><a href="{{route("posts.edit", $post->id)}}">Edit</a></td>
                    <td>
                        {!!Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy',$post->id] ])!!}

                        {!!Form::submit('Delete Post', ['class' => 'btn btn-danger'])!!}

                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection