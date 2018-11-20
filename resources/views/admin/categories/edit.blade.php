@extends('layouts.admin')
@section('content')
    @component('includes.page-header')
        Edit Category
    @endcomponent
    {!!Form::model($category,['method' => 'PATCH', 'action' => ["AdminCategoriesController@update", $category->id]])!!}
    <div class="form-group">
        {!!Form::label('name', 'Category Name')!!}
        {!!Form::text('name', null, ['class' => 'form-control'] )!!}
    </div>
    <div class="form-group">
        {!!Form::label('description', 'Category Description')!!}
        {!!Form::textarea('description', null, ['class' => 'form-control'] )!!}
    </div>
    <div class="form-group">
        {!!Form::submit('Update Category',['class' => 'btn btn-primary'])!!}
    </div>
    {!!Form::close()!!}
    @include('includes.form-error')
@endsection