@extends('layouts.admin')

@section('content')

    @component('includes.page-header')
        {{$post->title}}
    @endcomponent
    <div class="row">
        <div class="col-md-5">
            <img src="{{$post->image->file}}" alt="image">
        </div>
        <div class="col-md-7">
            {{$post->content}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="entry-meta">
                @if($post->user)
                <span class="author fa fa-user">Author: {{$post->user->name}}</span>
                @endif
                @if($post->categories)
                <span class="category fa fa-list">
                    {{ count($post->categories) > 1 ? 'Categories:' : 'Category:'}}
                    @foreach ($post->categories as $key => $category)
                        {{$category->name}}{{ count($post->categories) - 1 > $key ? ',': ''}}
                    @endforeach
                </span>
                @endif
            </div>
        </div>
    </div>
@endsection