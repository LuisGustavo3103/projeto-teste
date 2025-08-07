<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $searchTitle = $request->input('title');
        $searchDescription = $request->input('description');

        $posts = Post::query()
            ->when($searchTitle, function ($query) use ($searchTitle) {
                $query->where('title', 'like', '%' . $searchTitle . '%');
            })
            ->when($searchDescription, function ($query) use ($searchDescription) {
                $query->where('description', 'like', '%' . $searchDescription . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function delete(Post $post)
    {
        if ($post->user_id === auth()->user()->id) {
            if ($post->image) {
                Storage::delete($post->image);
            };
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
        $filePath = Storage::disk('public')->put('posts', $request->file('image'));

        $incomingFields = $request->validated();

        try {
            Post::create([
                'title' => data_get($incomingFields, 'title'),
                'description' => data_get($incomingFields, 'description'),
                'user_id' => auth()->user()->id,
                'image' => $filePath,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post criado com sucesso!');
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !== auth()->user()->id, 403);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, PostRequest $request)
    {
        $incomingFields = $request->validated();

        try {
            $filePath = null;

            if ($request->file('image')) {
                if ($post->image) {
                    Storage::delete($post->image);
                };

                $filePath = Storage::disk('public')->put('posts', $request->file('image'));
            }

            $post->update([
                'title' => data_get($incomingFields, 'title'),
                'description' => data_get($incomingFields, 'description'),
                'user_id' => auth()->user()->id,
                'image' => $filePath,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('posts.edit')
                ->with('error', 'Erro ao editar o post!');
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post editado com sucesso!');
    }
}
