<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // If a search term is provided, filter posts
        if ($search) {
            $post = Post::where('desc', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(20);
        } else {
            $post = Post::latest('id')->paginate(20);
        }


        return view('post.postingan', compact('post', 'search'));
    }

    public function beranda()
    {
        // Mendapatkan ID pengguna yang sedang login
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil semua posting yang dimiliki oleh pengguna tersebut
        $posts = Post::where('user_id', $userId)->get();

        return view('post.beranda', compact('posts', 'userId'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image_post' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
            'desc' => 'required|string |max:428',
        ]);

        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        $post = new Post();
        $post->desc = $request->desc;
        // Menyimpan gambar jika ada
        if ($request->hasFile('image_post')){
            $request->file('image_post')->move('imagepost/', $request->file('image_post')->getClientOriginalName());
            $post->image_post = $request->file('image_post')->getClientOriginalName();
            
        }
        // Menyimpan ID pengguna yang membuat posting
        $post->user()->associate($user);

        $post->save();

        return redirect()->back()->with('success', 'Post Successfully');
    }

    public function show($id)
    {
        $post_data_show = Post::with('user')->get();
        $post_show = Post::find($id);
        return view('post.show', compact('post_show', 'post_data_show'));
    }

    public function edit($id)
    {
        $post_edit = Post::find($id);
        return view('post.edit', compact('post_edit'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => 'required|string',
            'image_post' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the post by ID
        $post = Post::find($id);

        // Check if the post exists
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        // Update the post data
        $post->desc = $request->desc;

        // Process and update the image if a new one is provided
        if ($request->hasFile('image_post')) {
            // Delete the old image if it exists
            if ($post->image_post) {
                Storage::disk('public')->delete($post->image_post);
            }

            // Store the new image
            $imagePath = $request->file('image_post')->store('images', 'public');
            $post->image_post = $imagePath;
        }

        // Save the changes
        $post->save();

        return redirect('/')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $data = Post::findOrFail($id);
        $data->delete();

        return redirect('/')->with('error', 'Delete Successfully');
    }
}
