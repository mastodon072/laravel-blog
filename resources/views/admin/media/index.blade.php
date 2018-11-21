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
    <form action="media/delete" class="from-inline" method="post">
        <div class="form-group">
            <select name="action" id="action">
                <option value="delete">Delete</option>
            </select>
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><input type="checkbox" name="select_all" id="options"></th>
                <th>ID</th>
                <th>Image</th>
                <th>Path</th>
                <th>Created</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                    <tr>
                        <td><input type="checkbox" name="cheboxes_array[]" class="checkboxes" value="{{$image->id}}"></td>
                        <td>{{$image->id}}</td>
                        <td>
                            <img height="50" src="{{$image->file}}" alt="Image">
                        </td>
                        <td>{{$image->file}}</td>
                        <td>{{$image->created_at->diffForHumans() }}</td>
                        <td><a href="{{route("medias.show", $image->id)}}">View</a></td>
                        <td><a href="{{route("medias.edit", $image->id)}}">Edit</a></td>
                        {{-- <td>
                            {!!Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy',$image->id] ])!!}

                            {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}

                            {!!Form::close()!!}
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
   
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $('#options').on('click',function(){
               if(this.checked){
                   $('.checkboxes').each(function(){
                       this.checked = true;
                   });
               }else{
                    $('.checkboxes').each(function(){
                       this.checked = false;
                   });
               }
            });
        });
    </script>
@endsection