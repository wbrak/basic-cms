<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ContentController extends Controller
{
    public function __construct()
    {
    }

    public function getHome(){
        $posts = Post::orderBy('id', 'DESC')->limit('5')->get();
    	return view('home', ['posts'=>$posts]);
    }

    public function getAbout(){
    	return view('about');
    }

    public function getContact(){
    	return view('contact');
    }
}
