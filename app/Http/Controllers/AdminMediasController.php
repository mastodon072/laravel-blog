<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    //
    public function index(){
        $images = Image::all();
        return view('admin.media.index',compact('images'));
    }

    public function create(){
        return view('admin.media.create');
    }

    public function store(Request $request){
        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('images',$name);
        Image::create(['file' => $name]);
    }

    public function destroy($id){
        $image = Image::find($id);
        unlink(public_path().$image->file);
        $image->delete();
        return redirect(route('medias.index'));
    }

    public function deleteMedia(Request $request){
        $images = Image::findOrFail($request->cheboxes_array);
        foreach($images as $image){
            $image->delete();
            // unlink(public_path().$image->file);
        }
        return redirect(route('medias.index'));
    }
}
