<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use Auth;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function index() {
        $posts = $this->postRepository->getAllPosts();
 
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
 
    public function show($id) {
        $post = $this->postRepository->getPostById($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $post->toArray()
        ], 400);
    }
 
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ];
 
        if ($this->postRepository->createPost($post))
            return response()->json([
                'success' => true,
                'data' => $post
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $post = auth()->user()->posts()->find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
 
        $updated = $post->fill($request->all())->save();
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
    }
 
    public function destroy($id) {
        $post = $this->postRepository->getPostById($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
 
        if ($this->postRepository->deletePost($id)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be deleted'
            ], 500);
        }
    }
}