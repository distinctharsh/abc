<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        $youtube = [
            [
                'img' => 'yt1.jpg',
                'title' => 'Bill Walsh leadership lessons',
                'desc' => 'Like to know the secrets of transforming a 2-14 team...',
                'author' => 'Alec Whitten',
                'date' => '17 Jan 2022',
                'tags' => ['Leadership', 'Management'],
            ],
        ];

        return view('home', compact('projects', 'testimonials', 'youtube'));
    }
}
