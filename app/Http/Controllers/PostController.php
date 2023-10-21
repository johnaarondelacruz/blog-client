<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Resources\TimelineResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TimelineResource::collection(Post::orderBy('created_at', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $fields['title'],
            'content' => $fields['content'],
        ]);

        return response ([
            'message' => 'Post Created'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response([
                'message' => 'Post not found'
            ], 404);
        }

        $fields = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $fields['title'],
            'content' => $fields['content'],
        ]);

        return response ([
            'message' => 'Post Updated'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $post = Post::find($id);

        if (!$post) {
            return response([
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();

        return response([
            'message' => 'Post Deleted'
        ], 200);
    }

    public function like(string $post_id) {
       $like = Like::where('user_id', auth()->user()->id)->where('post_id', $post_id)->first();


       if($like) {
        $like->delete();
        return $this->index();
       }

       $post = Post::find($post_id);

       if(!$post) {
        return response([
            'message' => 'Post not found'
        ]);
       }

       Like::create([
        'user_id' => auth()->user()->id,
        'post_id' => $post_id
       ]);

       return $this->index();
    }


    public function comment(Request $request, string $post_id) {
        $fields = $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post_id,
            'content' => $fields['content']
        ]);

        return $this->index();
    }

    public function category(Request $request, string $post_id) {
        $fields = $request->validate([
            'category_name' => 'required|string'
        ]);

        Category::create([
            'post_id' => $post_id,
            'category_name' => $fields['category_name']
            ]);
            return response([
                'message' => 'Category Created'
        ]);
    }
    public function categoryDelete(Request $request, string $post_id) {
        $category = Category::find($post_id);

        if (!$category) {
            return response([
                'message' => 'Post not found'
            ], 404);
        }

        $category->delete();

        return response([
            'message' => 'Post Deleted'
        ], 200);
    }

    public function categoryUpdate(Request $request, string $post_id) {
        $category = Category::find($post_id);

        if (!$category) {
            return response([
                'message' => 'Post not found'
            ], 404);
        }

        $fields = $request->validate([
            'category_name' => 'required',
        ]);

        $category->update([
            'category_name' => $fields['category_name'],
        ]);

        return response ([
            'message' => 'Post Updated'
        ], 201);
    }
}
