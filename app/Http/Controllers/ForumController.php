<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    // ===============1==============
    // Get all books from the database, order by latest, and pass to 'books.index' view.
    public function index()
{
    $forums = Forum::with('user') // Eagerly load the user for "By User Name"
        ->withCount('comments') // <-- ADD THIS LINE
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Or use get() if you don't paginate
    
    return view('forum.index', compact('forums'));
}

    // ===============2==============
    // Display the details of a specific book based on the book parameter.
    public function show(Forum $forum)
    {
        return view('forum.show', compact('forum'));
    }

    // ===============3==============
    // Display the form to add a new book.
    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        // Validation now checks for 'title', 'body', and 'image' (which is the input name)
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        
        // 💡 FIX 1: Change file check to match the form input name ('image')
        if ($request->hasFile('image')) { 
            // The file input is named 'image' and the column is also named 'image'
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $validated['user_id'] = auth()->id();

        Forum::create($validated);
        return redirect()->route('forum.index')->with('success', 'Forum added successfully!');
    }


    // ===============4==============
    // Display the form to edit a specific book based on the book parameter.
    public function edit(Forum $forum)
    {
        return view('forum.update', compact('forum'));
    }

    public function update(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Note: If your Forum model column is named 'image', this check should be:
            if ($forum->image) { 
                Storage::disk('public')->delete($forum->image);
            }
            $validated['image'] = $request->file('image')->store('image', 'public');
        }
        $forum->update($validated);
        return redirect()->route('forum.show', $forum)->with('success', 'Forum updated successfully!');
    }
    
    // ===============5==============
    // Delete a specific book based on the book parameter.
    public function destroy(Forum $forum)
    {
        // 💡 FIX 2: Ensure you are deleting the image file if it exists
        if ($forum->image) {
             Storage::disk('public')->delete($forum->image);
        }
        
        $forum->delete();
        session()->flash('success', 'Forum successfully deleted!');
        
        // 💡 FIX 3: Redirect to the index page after deleting (not show, as the item no longer exists)
        return redirect()->route('forum.index'); 
    }
}