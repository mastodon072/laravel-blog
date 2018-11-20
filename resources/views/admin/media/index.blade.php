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
        All Media
    @endcomponent
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Path</th>
            <th>Created</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{$image->id}}</td>
                    <td>
                        <img height="50" src="{{$image->file}}" alt="Image">
                    </td>
                    <td>{{$image->file}}</td>
                    <td>{{$image->created_at->diffForHumans() }}</td>
                    <td><a href="{{route("medias.show", $image->id)}}">View</a></td>
                    <td><a href="{{route("medias.edit", $image->id)}}">Edit</a></td>
                    <td>
                        {!!Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy',$image->id] ])!!}

                        {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}

                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection