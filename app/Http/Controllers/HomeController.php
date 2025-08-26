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
                    'url' => 'https://www.instagram.com/sarkardr.debasish',
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
                        'description' => 'Updates and Development Activities',
                        'full_content' => '
                            <div class="ward-section">
                                <div class="initiatives-section mt-5">
                                    <h3 class="section-title">Ward No. 84</h3>
                                    <ul class="initiatives-list">
                                        <li>Daily ward visits on bike</li>
                                        <li>Rainwater Management Project (2022)</li>
                                        <li>Transparent Tender Practices (2023)</li>
                                    </ul>
                                </div>
                            </div>

                            <style>
                                .ward-section {
                                    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                                    line-height: 1.7;
                                    color: #333;
                                }
                                .section-title {
                                    color: #2c3e50;
                                    border-bottom: 2px solid #3498db;
                                    padding-bottom: 8px;
                                    margin: 25px 0 15px;
                                }
                                .highlights-grid {
                                    display: grid;
                                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                                    gap: 20px;
                                    margin: 20px 0;
                                }
                                .highlight-card {
                                    background: white;
                                    padding: 20px;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                    transition: transform 0.3s ease;
                                }
                                .highlight-card:hover {
                                    transform: translateY(-5px);
                                }
                                .highlight-icon {
                                    font-size: 2rem;
                                    color: #3498db;
                                    margin-bottom: 15px;
                                }
                                .initiatives-list {
                                    list-style-type: none;
                                    padding: 0;
                                }
                                .initiatives-list li {
                                    background: #f8f9fa;
                                    margin: 8px 0;
                                    padding: 12px 15px;
                                    border-radius: 6px;
                                    border-left: 4px solid #2ecc71;
                                    transition: transform 0.2s, box-shadow 0.2s;
                                }
                                .initiatives-list li:hover {
                                    transform: translateX(5px);
                                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                                }
                                .gallery-grid {
                                    display: grid;
                                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                                    gap: 15px;
                                    margin-top: 15px;
                                }
                                .gallery-item {
                                    position: relative;
                                    overflow: hidden;
                                    border-radius: 8px;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                }
                                .gallery-caption {
                                    position: absolute;
                                    bottom: 0;
                                    left: 0;
                                    right: 0;
                                    background: rgba(0,0,0,0.7);
                                    color: white;
                                    padding: 8px;
                                    text-align: center;
                                    font-size: 0.9rem;
                                }
                                @media (max-width: 768px) {
                                    .highlights-grid {
                                        grid-template-columns: 1fr;
                                    }
                                    .gallery-grid {
                                        grid-template-columns: repeat(2, 1fr);
                                    }
                                }
                            </style>'
                    ],
                    'borough' => [
                        'title' => 'Borough VI',
                        'image' => 'borough.png',
                        'description' => 'Updates from Borough VI',
                        'full_content' => 'Renovation of Borough VI Office'
                    ],
                    'adda' => [
                        'title' => 'ADDA Activities',
                        'image' => 'adda.png',
                        'description' => 'Asansol Durgapur Development Authority',
                        'full_content' => '
                            <div class="adda-section">
                                <div class="adda-about mb-4">
                                    <h3 class="section-title">About ADDA</h3>
                                    <p>ADDA stands for Asansol Durgapur Development Authority. It is a government statutory body responsible for the planning, development, and maintenance of infrastructure and public amenities across the Asansol-Durgapur region. Its scope includes urban planning, road construction, water supply management, housing projects, industrial development, environmental improvement, and community welfare programs.</p>
                                </div>

                                <div class="role-section mb-4">
                                    <h3 class="section-title">Role of Dr. Debasish Sarkar in ADDA</h3>
                                    <p>As the Mayor\'s Representative in ADDA, Dr. Sarkar plays a key role in policy decision-making, project supervision, and ensuring transparency in development works. His responsibilities include liaising between the community and ADDA, prioritizing projects that benefit citizens, and monitoring the execution of developmental schemes.</p>
                                </div>

                                <div class="initiatives-section">
                                    <h3 class="section-title">Major ADDA-Related Initiatives</h3>
                                    <ul class="initiatives-list">
                                        <li>Revival of Ismile Holriboe Mandir</li>
                                        <li>Reclaiming Vidya Sagar Playground</li>
                                        <li>Restoration of Rajiv Gandhi Statue</li>
                                        <li>Advocacy for labor rights and anti-corruption policies</li>
                                    </ul>
                                </div>

                                <div class="highlights-section mt-5">
                                    <h3 class="section-title">Work Highlights</h3>
                                    <div class="highlights-grid">
                                        <div class="highlight-card">
                                            <i class="fas fa-road highlight-icon"></i>
                                            <h4>Road Renaming</h4>
                                            <p>Successfully led the initiative to rename a major road after Justice Radha Binod Paul, the first such honor in West Bengal.</p>
                                        </div>
                                        <div class="highlight-card">
                                            <i class="fas fa-rupee-sign highlight-icon"></i>
                                            <h4>Development Funds</h4>
                                            <p>Secured and allocated over ₹24.5 crore for various development projects across the region.</p>
                                        </div>
                                        <div class="highlight-card">
                                            <i class="fas fa-users highlight-icon"></i>
                                            <h4>Public Engagement</h4>
                                            <p>Conducted extensive public engagement programs and welfare initiatives for community development.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="gallery-section mt-5">
                                    <h3 class="section-title">Public Engagements</h3>
                                    <div class="gallery-grid">
                                        <div class="gallery-item">
                                            <img src="' . asset('images/placeholder1.jpg') . '" alt="Public Engagement 1" class="img-fluid rounded">
                                            <div class="gallery-caption">Community Meeting</div>
                                        </div>
                                        <div class="gallery-item">
                                            <img src="' . asset('images/placeholder2.jpg') . '" alt="Public Engagement 2" class="img-fluid rounded">
                                            <div class="gallery-caption">Project Inauguration</div>
                                        </div>
                                        <div class="gallery-item">
                                            <img src="' . asset('images/placeholder3.jpg') . '" alt="Public Engagement 3" class="img-fluid rounded">
                                            <div class="gallery-caption">Public Hearing</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .adda-section {
                                    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                                    line-height: 1.7;
                                    color: #333;
                                }
                                .section-title {
                                    color: #2c3e50;
                                    border-bottom: 2px solid #3498db;
                                    padding-bottom: 8px;
                                    margin: 25px 0 15px;
                                }
                                .initiatives-list {
                                    list-style-type: none;
                                    padding: 0;
                                }
                                .initiatives-list li {
                                    background: #f8f9fa;
                                    margin: 8px 0;
                                    padding: 12px 15px;
                                    border-radius: 6px;
                                    border-left: 4px solid #3498db;
                                    transition: transform 0.2s, box-shadow 0.2s;
                                }
                                .initiatives-list li:hover {
                                    transform: translateX(5px);
                                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                                }
                                .role-section {
                                    background: #f8f9fa;
                                    padding: 20px;
                                    border-radius: 8px;
                                    border-left: 4px solid #2ecc71;
                                }
                                
                                .highlights-grid {
                                    display: grid;
                                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                                    gap: 20px;
                                    margin: 20px 0;
                                }
                                
                                .highlight-card {
                                    background: white;
                                    padding: 20px;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                    transition: transform 0.3s ease;
                                }
                                
                                .highlight-card:hover {
                                    transform: translateY(-5px);
                                }
                                
                                .highlight-icon {
                                    font-size: 2rem;
                                    color: #3498db;
                                    margin-bottom: 15px;
                                }
                                
                                .gallery-grid {
                                    display: grid;
                                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                                    gap: 15px;
                                    margin-top: 15px;
                                }
                                
                                .gallery-item {
                                    position: relative;
                                    overflow: hidden;
                                    border-radius: 8px;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                }
                                
                                .gallery-caption {
                                    position: absolute;
                                    bottom: 0;
                                    left: 0;
                                    right: 0;
                                    background: rgba(0,0,0,0.7);
                                    color: white;
                                    padding: 8px;
                                    text-align: center;
                                    font-size: 0.9rem;
                                }
                                @media (max-width: 768px) {
                                    .initiatives-list li {
                                        padding: 10px;
                                    }
                                }
                            </style>'
                        
                    ],
                ],
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
