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
    {!!Form::model($comment, [ 'method' => 'PATCH','action' => ['PostCommentsController@update',$comment->id]])!!}
            <div class="form-group">
                    <div class="form-group">
                        {!!Form::label('author','Name')!!}
                        {!!Form::text('author', null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('email','Email')!!}
                        {!!Form::email('email', null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('body','Comment')!!}
                        {!!Form::textarea('body', null,['class' => 'form-control', 'rows' => 3] )!!}
                        {!!Form::hidden('post_id',$comment->post->id)!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('body','Status')!!}
                        {!!Form::select('is_active',['1' => 'Approve', '0' => 'Unapprove'], 
                             $comment->is_active, ['class' =>'form-control', 'placeholder' => 'choose option..'])!!}
                    </div>
            </div>
            {!!Form::submit('Submit ',['class' => 'btn btn-primary'])!!}
            @if (Session::has('comment_message'))
                <div class="alert alert-info">
                    {{session('comment_message')}}
                </div>                
            @endif
        {!!Form::close()!!}
@endsection