<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YoutubeHighlight;
use App\Models\About;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'title' => 'Take authentic feedbacks',
                'desc' => 'from customers of your app. Build a quick list.',
                'img' => 'images/a.jpg',
            ],
            [
                'title' => 'Make quick fixes',
                'desc' => 'based on the feedbacks you\'ve received. With a happy smile.',
                'img' => 'images/b.jpg',
            ],
            [
                'title' => 'Enjoy more than 10x revenue',
                'desc' => 'with real-time conversions. Grow your business.',
                'img' => 'images/c.jpg',
            ],
        ];

        $testimonials = [
            [
                'img' => 'test1.jpg',
                'title' => 'Grover increased their sales revenue by 29% using Clarity.',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'author' => 'Albert Flores',
                'role' => 'Co-founder',
            ],
        ];

        // Get all active about sections, ordered by order field
        $abouts = \App\Models\About::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Fetch YouTube highlights from database
        // Temporarily removing is_active condition to fix the error
        $highlights = YoutubeHighlight::orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($highlight) {
                return [
                    'img' => $highlight->thumbnail_url,
                    'title' => $highlight->title,
                    'desc' => $highlight->description,
                    'author' => $highlight->author,
                    'date' => $highlight->formatted_date,
                    'tags' => $highlight->tags ?? [],
                ];
            })
            ->toArray();

        return view('home', compact('projects', 'testimonials', 'abouts', 'highlights'));
    }

    public function showAbout(About $about)
    {
        // Debug: Check the about title
        \Log::info('About title:', ['title' => $about->title]);
        
        // For Dr. Sarkar Social, show a detailed page with social media posts and videos
        if (str_contains(strtolower($about->title), 'dr. sarkar social') || str_contains(strtolower($about->title), 'social')) {
            // Array of social media post URLs to show as previews
            $socialMediaPosts = [
                [
                    'url' => 'https://www.facebook.com/drdebashissarkar/videos/623506467472129',
                    'platform' => 'facebook'
                ],
                // [
                //     'url' => 'https://x.com/MrSinha_/status/1956680640515981546/photo/1',
                //     'platform' => 'twitter'
                // ],
                [
                    'url' => 'https://www.instagram.com/p/DMnxyHczswo/',
                    'platform' => 'instagram'
                ]
            ];
            
            // Debug: Check if data is being passed correctly
            // dd($socialMediaPosts);

            // Dummy data for YouTube videos
            $videos = [
                ['id' => 'IaiwtFOmC04', 'title' => 'Healthy and beautiful. MLA and friend Shri Narendra Nath Chakraborty, Pandaveswar Assembly', 'url' => 'https://www.youtube.com/watch?v=IaiwtFOmC04'],
                ['id' => 'oUoxM7nLrUk', 'title' => 'Our neighborhood, our solution.', 'url' => 'https://www.youtube.com/watch?v=oUoxM7nLrUk'],
            ];

            return view('about.detail', compact('about', 'socialMediaPosts', 'videos'));
        }

        // For other about items, just show a simple page with title and description
        return view('about.simple', compact('about'));
    }
    
    public function getSectionData()
    {
        return [
            'dr-sarkar' => [
                'title' => 'Dr. Sarkar Official',
                'description' => 'Official updates and activities of Dr. Sarkar',
                'type' => 'social',
                'content' => [
                    'ward' => [
                        'title' => 'Ward No. 84',
                        'image' => 'ward.png',
                        'description' => 'Updates and activities from Ward 84',
                        'full_content' => 'Detailed information about Ward 84 activities and development projects.'
                    ],
                    'borough' => [
                        'title' => 'Borough VI',
                        'image' => 'borough.png',
                        'description' => 'Updates from Borough VI',
                        'full_content' => 'Information about Borough VI initiatives and community programs.'
                    ],
                    'adda' => [
                        'title' => 'ADDA Activities',
                        'image' => 'adda.png',
                        'description' => 'Community engagement activities',
                        'full_content' => 'Details about various ADDA activities and community programs.'
                    ]
                ]
            ],
            'capigen-highlights' => [
                'title' => 'Capigen Highlights',
                'description' => 'Latest highlights and updates from Capigen',
                'type' => 'highlights',
                'content' => [
                    'pase-achi' => [
                        'title' => 'Pase Achi Asansol',
                        'image' => 'asansol.png',
                        'description' => 'Building a better tomorrow for Asansol',
                        'full_content' => 'Information about the Pase Achi Asansol initiative.'
                    ],
                    'make-asansol-greater' => [
                        'title' => 'Make Asansol Greater Again',
                        'image' => 'blank-cover.png',
                        'description' => 'Revitalizing our city\'s infrastructure',
                        'full_content' => 'Details about the Make Asansol Greater Again campaign.'
                    ],
                    'ek-daake-daktar' => [
                        'title' => 'Ek Daake Daktar',
                        'image' => 'blank-cover.png',
                        'description' => 'Healthcare initiatives and medical services',
                        'full_content' => 'Information about the Ek Daake Daktar healthcare program.'
                    ]
                ]
            ]
        ];
    }

    public function showSection($section)
    {
        $sections = $this->getSectionData();

        if (!array_key_exists($section, $sections)) {
            abort(404);
        }

        $sectionData = $sections[$section];
        return view('sections.show', compact('sectionData'));
    }

    public function showSectionItem($section, $item)
    {
        $sections = $this->getSectionData();

        if (!isset($sections[$section]['content'][$item])) {
            abort(404);
        }

        $sectionData = $sections[$section];
        $itemData = $sectionData['content'][$item];
        
        return view('sections.item', compact('sectionData', 'itemData'));
    }
}
