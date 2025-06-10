<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = blog::latest()->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Category::all()->pluck('name', 'id');
        return view('blog.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {
        $blog = new blog();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $newImageName = "blog_image" . uniqid() . "." . $file->extension();
            $file->storeAs("public/BlogImage", $newImageName);
            //  $request->merge(['image' => "$newImageName"]);
            $blog->image = $newImageName;
        }
        // return $newImageName;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->type = $request->type;
        $blog->image = $newImageName;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateblogRequest $request, blog $blog)
    {
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->type = $request->type;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $newImageName = "blog_image" . uniqid() . "." . $file->extension();
            $file->storeAs("public/BlogImage", $newImageName);
            $blog->image = $newImageName;
        }
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {

        $image= json_decode($blog->image, true);
        if($image){
            $imagePath = storage_path("app/public/BlogImage/" . $image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully');
    }

    public function showPublicBlogs(Request $request)
    {
        $query = blog::query();

        if($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // $blogs = blog::latest()->paginate(10);
        $blogs = $query->latest()->paginate(10);
        return view('public.blog.index', compact('blogs'));
    }

    public function showPublicBlogsDetail(blog $blog)
    {
        // return $blog;
        return view('public.blog.blogDetail', compact('blog'));
    }
    public function showPublicHomeBlogs()
    {
        $blogs = blog::first()->take(3)->get();
        return response()->json($blogs);
    }


}
