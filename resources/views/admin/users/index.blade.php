@extends('layouts.admin')
@section('content')
    <h1>Users</h1>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        @if($user->image)
                            <img height="50" src="{{$user->image->file}}" alt="Image">
                        @else
                            No Image
                        @endif  
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active == 1 ? 'Active': 'Not Active'}}</td>
                    <td>{{$user->created_at->diffForHumans() }}</td>
                    <td>{{$user->updated_at->diffForHumans() }}</td>
                    <td><a href="{{route("users.show", $user->id)}}">View</a></td>
                    <td><a href="{{route("users.edit", $user->id)}}">Edit</a></td>
                    <td><a href="{{route("users.destroy", $user->id)}}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection