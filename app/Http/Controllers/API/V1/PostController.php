<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\IPostRepository;

class PostController extends Controller
{
    protected $posts;

    public function __construct(IPostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search']);
        $perPage = $request->get('per_page', 10);

        $posts = $this->posts->getAll($filters, $perPage);
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = $this->posts->getById($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);
        $data['user_id'] = auth()->id();

        return response()->json($this->posts->create($data), 201);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body'  => 'sometimes|required|string',
        ]);

        return response()->json($this->posts->update($post, $data));
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->posts->delete($post);
        return response()->json(null, 204);
    }
}
