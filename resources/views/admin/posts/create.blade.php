@extends('layouts.admin')
@section('content')
    @component('includes.page-header')
        Create Post
    @endcomponent
    {!!Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true ])!!}
        
        <div class="form-group">
            {!!Form::label('title', 'Post Title')!!}
            {!!Form::text('title', null, [ 'class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('content', 'Post Content')!!}
            {!!Form::textarea('content', null, [ 'class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('category_id', 'Post Category')!!}
            {!!Form::select('category_id[]', $categories,null, [ 'class' => 'form-control','multiple' => 'multiple'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('image_id', 'Featured Image')!!}
            {!!Form::file('image_id', [ 'class' => 'form-control'])!!}
        </div>
        {!!Form::submit('Create Post', ['class' => 'btn btn-primary'])!!}

    {!!Form::close()!!}
@endsection