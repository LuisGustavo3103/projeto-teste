<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function delete(Post $post)
    {
        if ($post->user_id === auth()->user()->id) {
            $post->delete();
        }

        return back();
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $incomingFields = $request->validated();

        try {
            Post::create([
                'title' => data_get($incomingFields, 'title'),
                'description' => data_get($incomingFields, 'description'),
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            response()->json('Erro inesperado', 500);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post criado com sucesso!');
    }
}
