<?php

namespace App\Http\Controllers;

use App\Models\ArticleLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = ArticleLevel::ordered()->get();
        return view('article-levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article-levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:article_levels,name',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'status' => 'required|in:active,inactive',
            'level_order' => 'nullable|integer|min:1',
        ]);

        $data = $request->all();

        // Generate slug dari name
        $data['slug'] = Str::slug($request->name);

        // Set level_order otomatis jika tidak diisi
        if (empty($data['level_order'])) {
            $lastLevel = ArticleLevel::orderBy('level_order', 'desc')->first();
            $data['level_order'] = $lastLevel ? $lastLevel->level_order + 1 : 1;
        }

        ArticleLevel::create($data);

        return redirect()->route('article-levels.index')
            ->with('success', 'Level artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleLevel $articleLevel)
    {
        // Tidak perlu show page untuk level artikel
        return redirect()->route('article-levels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleLevel $articleLevel)
    {
        return view('article-levels.edit', compact('articleLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleLevel $articleLevel)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:article_levels,name,' . $articleLevel->id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'status' => 'required|in:active,inactive',
            'level_order' => 'nullable|integer|min:1',
        ]);

        $data = $request->all();

        // Update slug jika name berubah
        if ($request->name !== $articleLevel->name) {
            $data['slug'] = Str::slug($request->name);
        }

        // Set level_order otomatis jika tidak diisi
        if (empty($data['level_order'])) {
            $lastLevel = ArticleLevel::where('id', '!=', $articleLevel->id)
                ->orderBy('level_order', 'desc')
                ->first();
            $data['level_order'] = $lastLevel ? $lastLevel->level_order + 1 : 1;
        }

        $articleLevel->update($data);

        return redirect()->route('article-levels.index')
            ->with('success', 'Level artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleLevel $articleLevel)
    {
        // Cek apakah level ini digunakan oleh artikel
        try {
            $articleCount = $articleLevel->articles ? $articleLevel->articles->count() : 0;
        } catch (\Exception $e) {
            $articleCount = 0;
        }

        if ($articleCount > 0) {
            return redirect()->route('article-levels.index')
                ->with('error', "Tidak dapat menghapus level ini karena digunakan oleh {$articleCount} artikel.");
        }

        $articleLevel->delete();

        return redirect()->route('article-levels.index')
            ->with('success', 'Level artikel berhasil dihapus.');
    }

    /**
     * Update order of levels (reordering)
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'levels' => 'required|array',
            'levels.*.id' => 'required|exists:article_levels,id',
            'levels.*.order' => 'required|integer|min:1',
        ]);

        foreach ($request->levels as $levelData) {
            ArticleLevel::where('id', $levelData['id'])
                ->update(['level_order' => $levelData['order']]);
        }

        return response()->json(['success' => true]);
    }
}