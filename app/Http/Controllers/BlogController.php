<?php

namespace App\Http\Controllers;

use App\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogsQuery= auth()->user()->blogs()->latest();

        if($request->filled('status')) {
            $blogsQuery->where('status', $request->status);
        }

        return BlogResource::collection($blogsQuery->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=>'required'
        ]);

        $input = $request->all();

        $input['slug']= str_slug($request->title);

        if($request->filled('published_at')){
            $input['published_at'] = Carbon::parse($request->published_at);
        }

        $blog=auth()->user()->blogs()->create($input);

        return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        if (Gate::denies('update-blog', $blog)) {
            abort(401);
        }
        
        return new BlogResource($blog);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if (Gate::denies('update-blog', $blog)) {
            abort(401);
        }

        $input = $request->all();

        if ($request->filled('title')) {
            $input['slug'] = str_slug($request->title);
        }
        
        if ($request->filled('published_at')) {
            $input['published_at'] = Carbon::parse($request->published_at);
        }
        $blog->update($input);

        return new BlogResource($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (Gate::denies('update-blog', $blog)) {
            abort(401);
        }
        
        $blog->delete();

        return response(['message'=>'blog deleted!']);
    }
}
