@extends('layouts.admin')

@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(session()->has($key))
        <div class="alert alert-{{$key}}"> 
            {!! session($key) !!}
        </div>
    @endif
@endforeach
@section('content')
    @component('includes.page-header')
        All Categories
    @endcomponent
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->created_at->diffForHumans() }}</td>
                    <td>{{$category->updated_at->diffForHumans() }}</td>
                    <td><a href="{{route("categories.show", $category->id)}}">View</a></td>
                    <td><a href="{{route("categories.edit", $category->id)}}">Edit</a></td>
                    <td>
                        {!!Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy',$category->id] ])!!}

                        {!!Form::submit('Delete Category', ['class' => 'btn btn-danger'])!!}

                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection