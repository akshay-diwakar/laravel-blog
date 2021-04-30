<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\blog;
use Session;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Images;
use Image;
use File;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $Blogs_description = blog::paginate(2);
    	return view('Backend.Admin.Blog.view',compact('Blogs_description'));
    }

    public function create(Request $request)
    {
    	return view('Backend.Admin.Blog.add');
    }

    // public function store(Request $request)
    // {
    //       // $fileupload = $request->hasFile('file')
    // 	  $data = $request->all();
    //       $rules = array(
    //         // validating input names
    //         'Blog_title' => 'required',
    //         'description'=> 'required' ,
    //         'Image' => 'required | mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                 
    //       );


    //      // make validation
    //     $validate = Validator::make($rules,$data);
    //     if ($validate->fails()) {
    //         return redirect()->back()->withInput()->withErrors($validate);
    //     }
    //     else{


    //         $form_data= array(
    //           'blog_title' => $data['Blog_title'], 
    //            'file_path' => $data['Image'],
    //            'blog_descripiton' => $data['description']
    //         );

    //         // Save the file locally in the storage/public/ folder under a new folder named /product
    //         $Blog = blog::create($form_data);
    //         $message = "successfully added";
    //         return redirect('/admin/Blog')->with('success',$message);
    //     }

    // }

    public function store(Request $request)
    {
            $request->validate([
            'Blog_title' => 'required',
            'Image' => 'required|mimes:png,jpg,jpeg|max:5048',
            'description' => 'required'
            ]);

            //Naming the image file ( nameOfBlog + imageExtension)
            $newImageName =  $request->Blog_title . '.' . $request->Image->extension();
            //Moving image to the public\file_upload_images folder
             // $data= $request->file->store('file_upload_images', 'public');
            $request->Image->move(public_path('file_upload_images'), $newImageName);
            //If its valid it will proceed
            //It it's not valid, throw a new ValidationException
            $blog = blog::create([
            'blog_title' => $request->input('Blog_title'),
            'file_path' => $newImageName,
            // using strip _tags so that tags with description don't get inserted in database
            'blog_descripiton' => strip_tags($request->input('description'))
            ]);
            
            $message = "successfully added";
                return redirect('/admin/Blog')->with('success',$message);
    }

     public function edit(Request $request) 
    {
            $Blog = blog::find($request->id);
            return view('Backend.Admin.Blog.edit',compact('Blog'));   
    }       

    public function update(Request $request)
    {
                 $data = $request->all();
                 $Blog = blog::find($data['id']);
                    // checking if file is there or not
            if ($request->hasFile('Image')){
                $image_path = public_path("/file_upload_images/".$Blog->Blog_title);
                 // if file exits , delete that file
                if (File::exists($image_path)) {
                    File::delete($image_path);
                   }
                $BlogImage = $request->file('Image');
                // The function GetClientOriginalName() is used to retrieve the file's original name at the time of upload in laravel and that'll only be possible if the data is sent as array and not as a string. Hence, you must add enctype="multipart/form-data" whenever you are creating a form with input fields for files or images.
                $imgName = $BlogImage->getClientOriginalName();
                // storing photo back to root folder
                $destinationPath = public_path('/file_upload_images/');
                $BlogImage->move($destinationPath, $imgName);
                } 
                else 
                {
                $imgName = $Blog->blog_title;
                }

                $Blog->blog_title = $request->Blog_title;
                $Blog->file_path = $imgName;
                $Blog->blog_descripiton = strip_tags($request->description);

                $Blog->save();
                $message  = "successfully updated";
                return redirect('/admin/Blog')->with('success',$message);

    } 

    public function delete($id)
    {
        $Blog = blog::where('id','=',$id)->delete();
        return redirect('/admin/Blog')->with('success','deleted');
    
    }
}
