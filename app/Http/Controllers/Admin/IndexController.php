<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{
   public function index(Request $request)
   {
   	 $Blog = blog::all();
   	 /*print_r($Blog);
   	 die();*/
   	 return view('welcome',compact('Blog'));
   }

   public function blog(Request $request)
   {
   	  $Blog = blog::all();
   	   return view('blog');
   }
}
