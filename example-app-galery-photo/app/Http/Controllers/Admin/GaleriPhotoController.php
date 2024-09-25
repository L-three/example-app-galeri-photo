<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\Category;
use Iluminate\Support\Facedes\Auth;
class GaleriPhotoController extends Controller
{
    public function index()
    {
        return view('admin.galeri-photo.index', [
            'pageTitle' => 'Galeri-Photo',
            // 'listPost' => Post::all(),//Cara pertama
            'listPost' => Post::all(),
        ]);
    }

    public function create()
    {
        // dd('test');
        return view('admin.galeri-photo.create', [
           'pageTitle'      =>'Create Galeri ',
        'listCategory'      => Category::categories
    ]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
                'title'=> 'required',
                'category'=>'required',
                'description'=>'required'

       ],[
             'title.required'   => 'Judul wajib diisi....',
             'description.required'   => 'Keterangan wajib diisi....'
       ]);
            //  dd($validated);
           $post = post::create([
                'title'=>$validated['title'],
                'categoty'=>$validated['category'],
                'description'=>$validated['description'],
                'user_id'=>Auth()->user()->id

            ]);
            return redirect(route('admin-galeri-dashboard', absolute: false));
            // dd($post);
            // return redirect();
    }
    public function edit(String $postId)
    {
        $post = Post::findOrfail($postId);

        // membalikan ke halaman view admin-edit
        return view('admin.galeri-photo.edit',[
        'pageTitle'=> 'Edit Album',
        'post'     => $post,
        'listCategory'      => Category::categories
    ]);
        // dd('mau edit galeri photo..',$post);
    }
}

