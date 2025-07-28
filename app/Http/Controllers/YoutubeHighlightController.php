<?php

namespace App\Http\Controllers;

use App\Models\YoutubeHighlight;
use Illuminate\Http\Request;

class YoutubeHighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = YoutubeHighlight::latest();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by tags
        if ($request->has('tag') && $request->tag) {
            $query->whereJsonContains('tags', $request->tag);
        }
        
        // Filter featured videos
        if ($request->has('featured') && $request->featured) {
            $query->featured();
        }
        
        $highlights = $query->paginate(9);
        
        // Get all unique tags for filter
        $allTags = YoutubeHighlight::whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->values();
        
        return view('youtube-highlights.index', compact('highlights', 'allTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('youtube-highlights.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thumbnail' => 'nullable|string',
            'video_url' => 'nullable|url',
            'youtube_id' => 'nullable|string',
            'published_date' => 'required|date',
            'tags' => 'nullable|string',
            'views' => 'nullable|integer|min:0',
            'likes' => 'nullable|integer|min:0',
            'is_featured' => 'boolean'
        ]);

        // Convert tags string to array
        if (isset($validated['tags']) && $validated['tags']) {
            if (is_string($validated['tags'])) {
                $validated['tags'] = json_decode($validated['tags'], true) ?? [];
            }
        } else {
            $validated['tags'] = [];
        }

        YoutubeHighlight::create($validated);

        return redirect()->route('youtube-highlights.index')
            ->with('success', 'YouTube highlight created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(YoutubeHighlight $youtubeHighlight)
    {
        return view('youtube-highlights.show', compact('youtubeHighlight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(YoutubeHighlight $youtubeHighlight)
    {
        return view('youtube-highlights.edit', compact('youtubeHighlight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, YoutubeHighlight $youtubeHighlight)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thumbnail' => 'nullable|string',
            'video_url' => 'nullable|url',
            'youtube_id' => 'nullable|string',
            'published_date' => 'required|date',
            'tags' => 'nullable|array',
            'views' => 'nullable|integer|min:0',
            'likes' => 'nullable|integer|min:0',
            'is_featured' => 'boolean'
        ]);

        $youtubeHighlight->update($validated);

        return redirect()->route('youtube-highlights.index')
            ->with('success', 'YouTube highlight updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YoutubeHighlight $youtubeHighlight)
    {
        $youtubeHighlight->delete();

        return redirect()->route('youtube-highlights.index')
            ->with('success', 'YouTube highlight deleted successfully!');
    }
}
