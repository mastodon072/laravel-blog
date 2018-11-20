@extends('layouts.admin')
@section('content')
    @component('includes.page-header')
        Edit Post
    @endcomponent
    @if ($post->image)
        <img src="{{$post->image->file}}" alt="Image">
    @endif
    {!!Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true ])!!}
        
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
            {!!Form::select('category_id[]', $categories, $post->categories()->pluck('category_id')->toArray(), [ 'class' => 'form-control','multiple' => 'multiple'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('image_id', 'Featured Image')!!}
            {!!Form::file('image_id', [ 'class' => 'form-control'])!!}
        </div>
        {!!Form::submit('Update Post', ['class' => 'btn btn-primary'])!!}

    {!!Form::close()!!}
    @include('includes/form-error')
@endsection