<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Like;
use App\Http\Resources\TimelineResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TimelineResource::collection(Post::orderBy('created_at', 'desc')->get());
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

    public function like(string $id) {
        $post = Post::find($id);

        if (!post) {
            return response([
                'message' => 'Post not found'

            ]);
        }

        Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $id
        ]);

        return $this->index();
    }

    public function unlike(string $id) {
        $like = Like::find($id);

        if (!$like) {
            return response([
                'message' => 'Like not found'
            ]);
        }

        $like->delete();

        return $this->index();
    }
}
