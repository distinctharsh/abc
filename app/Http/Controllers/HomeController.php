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
        // For Dr. Sarkar Social, show a detailed page with social media posts and videos
        if (str_contains(strtolower($about->title), 'dr. sarkar social')) {
            // Array of social media post URLs to show as previews
            $socialMediaPosts = [
                [
                    'url' => 'https://www.facebook.com/CrackAddictzYT/videos/799548115735810',
                    'platform' => 'facebook'
                ],
                [
                    'url' => 'https://x.com/mansukhmandviya/status/1703426121227026550',
                    'platform' => 'twitter'
                ],
                [
                    'url' => 'https://www.instagram.com/reels/DHQvEpYS6ja/',
                    'platform' => 'instagram'
                ]
            ];

            // Dummy data for YouTube videos
            $videos = [
                ['id' => 'U91AUYttTyc', 'title' => 'Day in the Life: Heart Surgeon', 'url' => 'https://youtu.be/U91AUYttTyc?si=dIWyTbYYRdH31VaN'],
                ['id' => 'RN3zhb9Y4jc', 'title' => 'The AIIMS Neurosurgery Story', 'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ];

            return view('about.detail', compact('about', 'socialMediaPosts', 'videos'));
        }

        // For other about items, just show a simple page with title and description
        return view('about.simple', compact('about'));
    }
}
