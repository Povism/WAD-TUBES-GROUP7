<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum; // To handle the parent forum object
use App\Models\Comment; // You must create this model!

class CommentController extends Controller
{

    // app/Http/Controllers/ForumController.php

    public function show(Forum $forum)
    {
        // Eager load the comments and the user that created the comment
        $forum->load([
            'comments' => function ($query) {
                $query->with('user'); // Load the user for each comment
            },
            'user' // Load the user for the forum post itself
        ]);
        
        return view('forum.show', compact('forum'));
    }
    public function store(Request $request, Forum $forum)
    {
        // 1. Validation
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // 2. Create the comment
        $comment = new Comment();
        $comment->user_id = auth()->id(); // Assuming user is logged in
        $comment->forum_id = $forum->id; // Associate with the current forum post
        $comment->body = $request->input('comment');
        $comment->save();

        // 3. Redirect back to the forum post
        return redirect()->route('forum.show', $forum)->with('success', 'Your comment has been posted!');
     }


     public function destroy(Comment $comment)
    {
        // 1. BACKEND AUTHORIZATION: Ensure only the comment creator can delete it
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Capture the parent forum post ID for redirection
        $forum = $comment->forum;
        
        // 2. Delete the comment
        $comment->delete();

        // 3. Redirect back to the forum show page
        // Using the forum relationship to get the parent post ID for the redirect
        return redirect()->route('forum.show', $forum)->with('success', 'Comment deleted successfully!');
    }
}