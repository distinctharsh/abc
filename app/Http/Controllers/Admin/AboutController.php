<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::orderBy('order')->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'social_media_updates' => 'nullable|json',
            'videos' => 'nullable|json',
            'press_coverage' => 'nullable|json',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/abouts');
            $validated['image'] = str_replace('public/', '', $path);
        }

        About::create($validated);

        return redirect()->route('admin.abouts.index')
            ->with('success', 'About section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return view('admin.abouts.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'social_media_updates' => 'nullable|json',
            'videos' => 'nullable|json',
            'press_coverage' => 'nullable|json',
        ]);

        // Handle file upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($about->image) {
                Storage::delete('public/' . $about->image);
            }
            
            $path = $request->file('image')->store('public/images/abouts');
            $validated['image'] = str_replace('public/', '', $path);
        }

        $about->update($validated);

        return redirect()->route('admin.abouts.index')
            ->with('success', 'About section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        // Delete the image file if it exists
        if ($about->image) {
            Storage::delete('public/' . $about->image);
        }

        $about->delete();

        return redirect()->route('admin.abouts.index')
            ->with('success', 'About section deleted successfully');
    }

    /**
     * Show the form for editing media of the specified resource.
     */
    public function editMedia(About $about)
    {
        return view('admin.abouts.media', compact('about'));
    }

    /**
     * Update the media of the specified resource in storage.
     */
    public function updateMedia(Request $request, About $about)
    {
        try {
            // Process social media
            $socialMedia = $request->input('social_media', []);
            if (is_string($socialMedia)) {
                $socialMedia = json_decode($socialMedia, true) ?? [];
            }
            $socialMedia = array_values(array_filter($socialMedia, function($item) {
                return is_array($item) && !empty($item['platform']) && !empty($item['url']);
            }));
            
            // Process videos - ensure we're getting the correct input format
            $videos = $request->input('videos', []);
            
            // Log the raw input for debugging
            \Log::info('Raw videos input:', ['videos' => $videos]);
            
            if (is_string($videos)) {
                $videos = json_decode($videos, true) ?? [];
            }
            
            // Ensure videos is an array and filter out empty entries
            $videos = is_array($videos) ? $videos : [];
            $videos = array_values(array_filter($videos, function($item) {
                return is_array($item) && !empty($item['url']);
            }));
            
            // Log the processed videos for debugging
            \Log::info('Processed videos:', ['count' => count($videos), 'videos' => $videos]);
            
            // Process press coverage
            $pressCoverage = $request->input('press_coverage', []);
            if (is_string($pressCoverage)) {
                $pressCoverage = json_decode($pressCoverage, true) ?? [];
            }
            $pressCoverage = array_values(array_filter($pressCoverage, function($item) {
                return is_array($item) && !empty($item['source']) && !empty($item['url']);
            }));
            
            // Update the model
            $about->social_media_updates = $socialMedia;
            $about->videos = $videos;
            $about->press_coverage = $pressCoverage;
            
            // Save and log the result
            $saved = $about->save();
            \Log::info('Save result:', ['saved' => $saved, 'videos_count' => count($videos)]);
            
            // Refresh the model to ensure we have the latest data
            $about->refresh();
            \Log::info('After refresh - videos count:', ['count' => is_array($about->videos) ? count($about->videos) : 0]);
            
            return redirect()
                ->route('admin.abouts.media.edit', $about)
                ->with('success', 'Media updated successfully!');
                
        } catch (\Exception $e) {
            \Log::error('Error updating media: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()
                ->withInput()
                ->with('error', 'Error updating media: ' . $e->getMessage());
        }
    }
}

