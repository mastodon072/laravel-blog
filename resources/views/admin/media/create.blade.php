@extends('layouts.admin')

@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js" type="text/javascript"></script>
@endsection

@section('content')

    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(session()->has($key))
            <div class="alert alert-{{$key}}"> 
                {!! session($key) !!}
            </div>
        @endif
    @endforeach

    @component('includes.page-header')
        Upload Media
    @endcomponent
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!!Form::open(['method' => 'POST', 'action' => 'AdminMediasController@store', 'class' => 'dropzone' ])!!}
            
                {!!Form::close()!!}
            </div>
        </div>
    </div>
    
@endsection