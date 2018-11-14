@extends('layouts.admin')
@section('content')
    @component('includes.page-header')
        Create Category
    @endcomponent
    {!!Form::open(['method' => 'POST', 'action' => "AdminCategoriesController@store"])!!}
    <div class="form-group">
        {!!Form::label('name', 'Category Name')!!}
        {!!Form::text('name', null, ['class' => 'form-control'] )!!}
    </div>
    <div class="form-group">
        {!!Form::label('description', 'Category Description')!!}
        {!!Form::textarea('description', null, ['class' => 'form-control'] )!!}
    </div>
    <div class="form-group">
        {!!Form::submit('Add Catogory',['class' => 'btn btn-primary'])!!}
    </div>
    {!!Form::close()!!}
@endsection