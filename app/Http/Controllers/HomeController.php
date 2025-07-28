<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YoutubeHighlight;
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

        // Fetch YouTube highlights from database
        $youtube = YoutubeHighlight::featured()
            ->latest()
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

        return view('home', compact('projects', 'testimonials', 'youtube'));
    }
}
