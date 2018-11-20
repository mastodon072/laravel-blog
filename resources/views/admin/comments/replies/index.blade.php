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
        All Replies
    @endcomponent
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Comment ID</th>
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
            @foreach ($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->comment_id }}</td>
                    <td>{{$reply->author }}</td>
                    <td>{{$reply->email }}</td>
                    <td>{{$reply->body }}</td>
                    <td>{{ $reply->is_active == 1 ? 'Active' : 'Awaiting Moderation' }}</td>
                    <td>{{ $reply->created_at->diffForHumans() }}</td>
                    <td>{{ $reply->updated_at->diffForHumans() }}</td>
                    <td>
                        @if ($reply->is_active == 0)
                            {!!Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update',$reply->id] ])!!}

                                {!!Form::hidden('is_active',1)!!}
                            
                                {!!Form::submit('Approve', ['class' => 'btn btn-primary'])!!}

                            {!!Form::close()!!}
                        @else
                            {!!Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update',$reply->id] ])!!}

                                {!!Form::hidden('is_active',0)!!}
                            
                                {!!Form::submit('Un-Approve', ['class' => 'btn btn-warning'])!!}

                            {!!Form::close()!!}
                        @endif
                    </td>
                    <td><a href="{{route("replies.edit", $reply->id)}}" class="btn btn-info">Edit</a></td>
                    <td>
                        {!!Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy',$reply->id] ])!!}

                        {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}

                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection