<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Stevebauman\Purify\Facades\Purify;

class PostsController extends Controller
{
    public function postsPage(Request $request)
    {
        $pageSize = $request->input('page_size', 10);
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate($pageSize);

        $this->shortenContent($posts->items());

        return view('posts/posts', ['posts' => $posts, 'pageSize' => $pageSize]);
    }

    public function postPage(Post $post)
    {
        return view('posts/post', ['post' => $post]);
    }

    public function myPostsPage(Request $request)
    {
        $pageSize = $request->input('page_size', 10);
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->paginate($pageSize);

        $this->shortenContent($posts->items());

        return view('posts/me', ['posts' => $posts, 'pageSize' => $pageSize]);
    }

    public function createPostPage()
    {
        return view('posts/create-post');
    }

    public function editPostPage(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect('/posts/me');
        }

        return view('posts/edit-post', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:250'],
            'content' => ['required', 'min:3', 'max:10000'],
        ]);

        if ($validator->fails()) {
            logger($request->all());
            return back()->withErrors($validator)->withInput();
        }

        $formData = $validator->validated();

        $formData = $this->purifyPost($formData);

        $formData['user_id'] = Auth::id();

        Post::create($formData);

        return redirect('/posts/me');
    }

    public function updatePost(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect('/posts/me');
        }

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:250'],
            'content' => ['required', 'min:3', 'max:10000'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $formData = $validator->validated();

        $formData = $this->purifyPost($formData);

        $newPost['user_id'] = Auth::id();

        $post->update($formData);

        return redirect('/posts/me');
    }

    public function deletePost(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect('/posts/me');
        }

        $post->delete();

        return redirect('/posts/me');
    }

    private function shortenContent(array $posts)
    {
        foreach ($posts as $post) {
            if ($post->content && strlen($post->content) > 100) {
                $post->content = substr($post->content, 0, 100);
            }
        }
    }

    // config/purify.php for configuration
    private function purifyPost(array $formData): array
    {
        $formData['title'] = Purify::config('custom')->clean($formData['title']);
        $formData['content'] = Purify::config('custom')->clean($formData['content']);

        return $formData;
    }
}
