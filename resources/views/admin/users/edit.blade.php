@extends('layouts.admin')
@section('content')
    <h1>Edit Users</h1>
    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update', $user->id], 'files' => true]) !!}
    <div class="row">
        <div class="col-md-3">
            @if($user->image)
            <img height="50" src="{{$user->image->file}}" alt="image" class="src img-rounded">
            @else
            <img height="50" src="http://placehold.it/400x400" alt="image" class="src img-rounded">
            @endif
        </div>    
        <div class="col-md-9">
            <div class="form-group">
                {!! Form::label('name', 'Name:' )!!}
                {!! Form::text('name',null, ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email:' )!!}
                {!! Form::email('email',null, ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id', 'Role:' )!!}
                {!! Form::select('role_id', $roles, null, ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active', 'Status:' )!!}
                {!! Form::select('is_active',array(1=>'Active', 0 => 'Not Active'), null, ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password:' )!!}
                {!! Form::password('password', ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::label('image_id', 'Image:' )!!}
                {!! Form::file('image_id', ['class' => 'form-control'] )!!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary'] )!!}
            </div>
        </div>
    </div>
    {!! Form::close()!!}
    <div class="row">
        @include('includes/form-error')
    </div>    
@endsection