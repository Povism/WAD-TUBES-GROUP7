<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query()->with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('q')) {
            $q = $request->string('q')->toString();
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                    });
            });
        }

        $items = $query->latest()->paginate(20);

        return view('admin.items.index', compact('items'));
    }

    public function edit(Item $item)
    {
        $item->load('user');

        return view('items.update', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'condition' => ['required', 'string', 'max:255'],
            'eco_friendly' => ['nullable'],
            'status' => ['required', 'in:pending,active,sold,rejected'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['file', 'image', 'max:5120'],
        ]);

        $paths = $item->images ?? [];
        if ($request->hasFile('images')) {
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
            'status' => $validated['status'],
            'images' => $paths ?: null,
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Item updated.');
    }

    public function destroy(Item $item)
    {
        if (is_array($item->images)) {
            foreach ($item->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item deleted.');
    }
}
