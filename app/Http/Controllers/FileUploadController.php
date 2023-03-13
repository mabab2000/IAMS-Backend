<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
class FileUploadController extends Controller
{
   public function FileUpload(Request $request)
   {

     $uploaded_files=$request->file->store('public/upload');
    
     $blog=new Blog;
     $blog->title=$request->title;
     $blog->details=$request->details;
     $blog->blog_image=$request->file->hashName();
     $results=$blog->save();
    if($results){
        return["Result"=>"Saved sucessfully"];
     }
     else{
        return["Result"=>"Saved fails"];
     }
    
   }
}
