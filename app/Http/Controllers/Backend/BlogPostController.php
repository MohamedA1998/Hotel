<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategorie;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\ImageFacade;

class BlogPostController extends Controller
{
    // ------ RelashenShep ---------
    // images
    // user
    // blogcat

    // ----- Attabut -----
    // ['PostTitile' , 'PostSlug' , 'ShortDesc' , 'LongDesc']

    public function index()
    {        
        return view('backend.post.index' , ['BlogPosts' => BlogPost::all()]);
    }

    
    
    public function create()
    {
        return view('backend.post.form' , ['category' => BlogCategorie::all()]);
    }

    

    public function store(Request $request)
    {
        $blogpost = BlogPost::create([
            'user_id'               => Auth::id(),
            'blog_categorie_id'     => $request->blogcat,
            'PostTitile'            => $request->PostTitile ,
            'PostSlug'              => strtolower(str_replace(' ' , '-' , $request->PostTitile)) ,
            'ShortDesc'             => $request->ShortDesc ,
            'LongDesc'              => $request->LongDesc   ,            
        ]);

        // Image::save($blogpost , 'photo' , 'upload/blogpost');

        toastr()->success('BlogPost Was Created!'); 

        return redirect()->route('blogpost.index');
    }


    public function show(BlogPost $blogpost)
    {
        
    }
    

    public function edit(BlogPost $blogpost)
    {
        return view('backend.post.form' , [
            'blogpost' => $blogpost ,
            'category' => BlogCategorie::all()
        ]);
    }

    
    
    public function update(Request $request, BlogPost $blogpost)
    {
        // $request->validate([]);
        
        $blogpost->update([
            'user_id'               => Auth::id(),
            'blog_categorie_id'     => $request->blogcat,
            'PostTitile'            => $request->PostTitile ,
            'PostSlug'              => strtolower(str_replace(' ' , '-' , $request->PostTitile)) ,
            'ShortDesc'             => $request->ShortDesc ,
            'LongDesc'              => $request->LongDesc   ,
        ]);

        ImageFacade::size(1000 , 1000)->update($blogpost , 'photo' , 'upload/blogpost');

        toastr()->success('BlogPost Was Updated!');        

        return redirect()->route('blogpost.index');
    }

    
    
    public function destroy(BlogPost $blogpost)
    {
        // Image::delete($blogpost);

        $blogpost->delete();

        toastr()->error('BlogPost Was Deleted!');

        return redirect()->route('blogpost.index');
    }



    public function BlogDetailsBySlug($slug)
    {
        $post = BlogPost::where('PostSlug' , $slug)->first();
        
        return view('frontend.blog.blog-details' , [
            'blogpost'          => $post ,
            'LimitPost'         => BlogPost::latest()->limit(3)->get(),
            'BlogCategorie'     => BlogCategorie::latest()->get(),
            'comments'          => Comment::where('blog_post_id' , $post->id)->where('status' , 1)->limit(5)->get(),
        ]);
    }



    public function BlogPostByCategoryId($id)
    {
        return view('frontend.blog.blog_by_category_id' , [
            'blogpost'          => BlogPost::where('blog_categorie_id' , $id)->get(),
            'CatId'             => BlogCategorie::find($id),
            'LimitPost'         => BlogPost::latest()->limit(3)->get(),
            'BlogCategorie'     => BlogCategorie::latest()->get(),
        ]);
    }



    public function BlogPostAllData()
    {
        return view('frontend.blog.blog' , [
            'blogpost'          => BlogPost::latest()->paginate(2),
            'LimitPost'         => BlogPost::latest()->limit(3)->get(),
            'BlogCategorie'     => BlogCategorie::latest()->get(),
        ]);
    }


}
