<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = Stat::sorted()->get();
        return view('backend.stats.index', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pastikan user sudah login dan memiliki akses
        if (!Auth::check() || !Auth::user()->can('view_backend')) {
            abort(403);
        }
        
        return view('backend.stats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan user sudah login dan memiliki akses
        if (!Auth::check() || !Auth::user()->can('view_backend')) {
            abort(403);
        }
        
        $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Stat::create([
            'value' => $request->value,
            'label' => $request->label,
            'label_en' => $request->label_en,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stat $stat)
    {
        // Pastikan user sudah login dan memiliki akses
        if (!Auth::check() || !Auth::user()->can('view_backend')) {
            abort(403);
        }
        
        return view('backend.stats.edit', compact('stat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stat $stat)
    {
        // Pastikan user sudah login dan memiliki akses
        if (!Auth::check() || !Auth::user()->can('view_backend')) {
            abort(403);
        }
        
        $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'label_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $stat->update([
            'value' => $request->value,
            'label' => $request->label,
            'label_en' => $request->label_en,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stat $stat)
    {
        // Pastikan user sudah login dan memiliki akses
        if (!Auth::check() || !Auth::user()->can('view_backend')) {
            abort(403);
        }
        
        $stat->delete();

        return redirect()->route('backend.stats.index')->with('message', 'Statistik berhasil dihapus.');
    }
}
