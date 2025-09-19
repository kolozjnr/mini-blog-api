<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\IPostRepository;

class PostRepository implements IPostRepository
{
    public function getAll(array $filters = [], int $perPage = 10)
    {
        $query = Post::with('author');
        //dd($query);
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->whereFullText(['title', 'body'], $search);
        }

        return $query->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Post::with('author')->findOrFail($id);
    }

     public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(int $id, array $data)
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete(int $id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}
