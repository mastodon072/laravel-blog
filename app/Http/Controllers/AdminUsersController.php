<?php

namespace App\Http\Controllers;

use App\Image;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\http\Requests\UsersRequest;
use App\http\Requests\UserEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->toArray();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        if($request->password == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt( $request->password );
        }
        if( $file = $request->file('image_id') ){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $image = Image::create(['file' => $name]);
            $input['image_id'] = $image->id;
        }
        User::create($input);

        $request->session()->flash('success', 'User is created successfully.');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->toArray();
        return view('admin.users.edit',compact('user','roles'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->password == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt( $request->password );
        }
        if( $file = $request->file('image_id') ){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $image = Image::create(['file' => $name]);
            $input['image_id'] = $image->id;
        }
        $user->update($input);
        $request->session()->flash('success', 'User is updated successfully.');
        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        unlink(public_path().$user->image->file);
        $request->session()->flash('success', 'User is successfully deleted');
        return redirect(route('users.index'));
    }
}
