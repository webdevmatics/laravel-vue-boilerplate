<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $blogQuery= auth()->user()->blogs()->with('categories')->latest();

        if ($request->filled('status')) {
            $blogQuery->where('status', $request->status);
        }

        $blogs= $blogQuery->get();

        return BlogResource::collection( $blogs);
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

        $input= $request->all();

        $input['slug']= str_slug($request->title);

        if($request->filled('published_at')) {
            $input['published_at'] = Carbon::parse($request->published_at);
        }


       $blog = auth()->user()->blogs()->create($input);

       if($request->filled('categories')) {

            $categoryIds= $this->createCategories($request->categories);

            $blog->categories()->sync($categoryIds);

       }

       if($request->hasFile('featured_image')) {

            $this->uploadImage($request, $blog);

       }

        return new BlogResource($blog->load('categories'));
    }

    private function uploadImage(Request $request, Blog $blog) {

        $resize = Image::make($request->file('featured_image'))->resize(800, 600)->encode('jpg');

        $fileName = str_random(10) . '.jpg';

        $filePath = 'featured_image/' . $fileName;

        Storage::put($filePath, $resize);


        // $filePath  = Storage::putFile('featured_image', $request->file('featured_image')); 

        $blog->featured_image = $filePath;

        $blog->save();
    }

    public function createCategories(array $categories)
    {
        $ids=[];

        foreach($categories as $category){
            if(is_array($category)){
                $ids[]= $category['id'];
            }else {
                $newCategory = Category::create(['name'=> $category, 'creator_id'=> auth()->id()]);

                $ids[] = $newCategory->id;
            }
        }

        return $ids;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {

        return new BlogResource($blog->load('categories'));
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
            abort(401, "Sorry Not Authorized");
        }

        $input = $request->all();

        if ($request->filled('title')) {
            $input['slug'] = str_slug($request->title);
        }

        if ($request->filled('published_at')) {
            $input['published_at'] = Carbon::parse($request->published_at);
        }

        $blog->update($input);

        if ($request->filled('categories')) {

            $categoryIds = $this->createCategories($request->categories);

            $blog->categories()->sync($categoryIds);
        }
       

        return new BlogResource($blog->load('categories'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if(Gate::denies('update-blog', $blog)){
            abort(401, "Sorry Not Authorized");
        }

        $blog->delete();

        return response(['message' => 'blog deleted!']);

    }

    public function updateFeaturedImage(Request $request, Blog $blog)
    {
        if ($request->hasFile('featured_image')) {

            $this->uploadImage($request, $blog);
        }

        return new BlogResource($blog);
    }
}
