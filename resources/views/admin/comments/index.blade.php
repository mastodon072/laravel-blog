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
        All Comments
    @endcomponent
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->post_id }}</td>
                    <td>{{$comment->author }}</td>
                    <td>{{$comment->email }}</td>
                    <td>{{$comment->body }}</td>
                    <td>{{ $comment->is_active == 1 ? 'Active' : 'Awaiting Moderation' }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                    <td>{{ $comment->updated_at->diffForHumans() }}</td>
                    <td><a href="{{route("comments.show", $comment->id)}}">View</a></td>
                    <td><a href="{{route("comments.edit", $comment->id)}}">Edit</a></td>
                    <td>
                        {!!Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy',$comment->id] ])!!}

                        {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}

                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection