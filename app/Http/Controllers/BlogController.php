<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = blog::latest()->paginate(10);
        // You can pass any additional data needed for the view
        // return $blogs;
        return view('blog.index', compact('blogs'));
        // return 'blog';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $type = Category::all()->pluck('name', 'id');
        return view('blog.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {
        $newImageName = '';
        if ($request->hasFile('image')) {
            $file = $request->image;
            $newImageName = "blog_image" . uniqid() . "." . $file->extension();
            $file->storeAs("public/BlogImage", $newImageName);
            //  $request->merge(['image' => "$newImageName"]);
            $newImageName = $newImageName;
        }
        // return $newImageName;
        $blog = new blog();
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
        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully');
    }
}
