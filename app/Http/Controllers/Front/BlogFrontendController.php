<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Http;

class BlogFrontendController extends Controller
{
    public function __construct(PostRepository $posts, AuthRepository $user)
    {
        $this->posts = $posts;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        //dd($request->all());
        $filters = $request->only(['search']);
        $perPage = $request->get('per_page', 10);

        $posts = $this->posts->getAll($filters, $perPage);
        return view('front.posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->posts->getById($id);
        return view('front.posts.show', compact('post'));
    }

    public function create()
    {
        return view('front.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $validated['user_id'] = auth()->id(); 
        $this->posts->create($validated);
        return redirect()
            ->route('blog.index')
            ->with('success', 'Post created successfully!');
    }

    public function author($id)
    {
        $author = $this->user->profile($id);
        return view('front.profile', compact('author'));
    }

}
