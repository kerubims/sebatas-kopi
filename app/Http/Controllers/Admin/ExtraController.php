<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Extra;

class ExtraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $extras = Extra::when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();
            
        return view('admin.extras.index', compact('extras', 'search'));
    }

    public function create()
    {
        return view('admin.extras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:extras',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:coffee,snack,Coffee,Snack',
            'is_available' => 'boolean',
        ]);

        Extra::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => strtolower($request->category),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.extras.index')->with('success', 'Extra created successfully.');
    }

    public function edit(Extra $extra)
    {
        return view('admin.extras.edit', compact('extra'));
    }

    public function update(Request $request, Extra $extra)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:extras,name,' . $extra->id,
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:coffee,snack,Coffee,Snack',
            'is_available' => 'boolean',
        ]);

        $extra->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => strtolower($request->category),
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.extras.index')->with('success', 'Extra updated successfully.');
    }

    public function destroy(Extra $extra)
    {
        $extra->delete();
        return redirect()->route('admin.extras.index')->with('success', 'Extra deleted successfully.');
    }
}
