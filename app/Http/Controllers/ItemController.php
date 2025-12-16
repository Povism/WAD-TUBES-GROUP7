<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query()
            ->with('user')
            ->where(function ($q) {
                $q->where('status', 'active');

                if (Auth::check()) {
                    $q->orWhere('user_id', Auth::id());
                }
            });

        if ($request->filled('q')) {
            $q = $request->string('q')->toString();
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        $conditions = $request->input('condition');
        if (is_array($conditions) && count($conditions) > 0) {
            $query->whereIn('condition', $conditions);
        }

        if ($request->boolean('eco')) {
            $query->where('eco_friendly', true);
        }

        $sort = $request->string('sort')->toString();
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $items = $query->paginate(12)->withQueryString();

        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        if ($item->status !== 'active' && (!Auth::check() || (Auth::id() !== $item->user_id && Auth::user()->role !== 'admin'))) {
            abort(404);
        }

        $item->load('user');

        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'condition' => ['required', 'string', 'max:255'],
            'eco_friendly' => ['nullable'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['file', 'image', 'max:5120'],
        ]);

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images', []) as $file) {
                $paths[] = $file->store('items', 'public');
            }
        }

        $item = Item::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'eco_friendly' => $request->boolean('eco_friendly'),
            'status' => 'active',
            'images' => $paths ?: null,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created and published.');
    }

    public function edit(Item $item)
    {
        if (Auth::id() !== $item->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('items.update', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        if (Auth::id() !== $item->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'condition' => ['required', 'string', 'max:255'],
            'eco_friendly' => ['nullable'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['file', 'image', 'max:5120'],
        ]);

        $paths = $item->images ?? [];
        if ($request->hasFile('images')) {
            if (count($paths) + count($request->file('images', [])) > 3) {
                return back()->withErrors([
                    'images' => 'You can upload a maximum of 3 images per item.',
                ])->withInput();
            }
            foreach ($request->file('images', []) as $file) {
                $paths[] = $file->store('items', 'public');
            }
        }

        $item->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'eco_friendly' => $request->boolean('eco_friendly'),
            'images' => $paths ?: null,
        ]);

        return redirect()->route('items.show', $item)->with('success', 'Item updated.');
    }

    public function destroy(Item $item)
    {
        if (Auth::id() !== $item->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        if (is_array($item->images)) {
            foreach ($item->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted.');
    }
}
