<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YoutubeHighlight;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    
    
     /**
     * Fetch Open Graph/Twitter Card metadata for a URL to build a preview card.
     * Returns ['title' => ..., 'description' => ..., 'image' => ...]
     */
    private function fetchLinkPreview(string $url): array
    {
        try {
            $resp = Http::timeout(5)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ])
                ->get($url);
            if (!$resp->ok()) return [];
            $html = $resp->body();

            libxml_use_internal_errors(true);
            $doc = new \DOMDocument();
            // Suppress warnings for malformed HTML
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            libxml_clear_errors();

            $xpath = new \DOMXPath($doc);
            $getMeta = function(array $names) use ($xpath) {
                foreach ($names as $name) {
                    // Try og: first
                    $nodes = $xpath->query("//meta[@property='".$name."']");
                    if ($nodes && $nodes->length > 0) {
                        return trim((string)$nodes->item(0)->getAttribute('content'));
                    }
                    // Fallback to name attribute
                    $nodes = $xpath->query("//meta[@name='".$name."']");
                    if ($nodes && $nodes->length > 0) {
                        return trim((string)$nodes->item(0)->getAttribute('content'));
                    }
                }
                return '';
            };

            $title = $getMeta(['og:title','twitter:title']);
            if ($title === '') {
                $titleNodes = $xpath->query('//title');
                if ($titleNodes && $titleNodes->length > 0) {
                    $title = trim($titleNodes->item(0)->textContent);
                }
            }
            $description = $getMeta(['og:description','twitter:description','description']);
            $image = $getMeta(['og:image','twitter:image']);

            // Resolve relative image URLs to absolute
            if ($image !== '') {
                $u = parse_url($url);
                $scheme = $u['scheme'] ?? 'https';
                $host   = $u['host'] ?? '';
                if (strpos($image, '//') === 0) {
                    $image = $scheme . ':' . $image;
                } elseif (strpos($image, 'http://') !== 0 && strpos($image, 'https://') !== 0 && strpos($image, 'data:') !== 0) {
                    $base = $scheme . '://' . $host;
                    if (isset($u['path']) && substr($image, 0, 1) !== '/') {
                        // If relative to path, trim filename from path
                        $dir = rtrim(substr($u['path'], 0, strrpos($u['path'] . '/', '/')), '/');
                        $base .= $dir ? $dir : '';
                    }
                    $image = rtrim($base, '/') . '/' . ltrim($image, '/');
                }
            }

            // Trim overly long fields
            if ($title !== '' && strlen($title) > 160) $title = substr($title, 0, 157) . '...';
            if ($description !== '' && strlen($description) > 300) $description = substr($description, 0, 297) . '...';

            return array_filter([
                'title' => $title,
                'description' => $description,
                'image' => $image,
            ], function($v) { return $v !== '' && $v !== null; });
        } catch (\Throwable $e) {
            return [];
        }
    }

    public function showAbout(About $about)
    {
        // Debug: Check the about title
        \Log::info('About title:', ['title' => $about->title]);
        
        // Initialize arrays for media data
        $socialMediaPosts = [];
        $videos = [];
        $pressItems = [];
        
        // Get social media updates from the database if available
        if (!empty($about->social_media_updates)) {
            $socialMediaPosts = array_map(function($item) {
                $platform = strtolower($item['platform'] ?? '');
                return [
                    'url' => $item['url'] ?? '#',
                    'platform' => $platform,
                    'title' => $item['title'] ?? ucfirst($platform) . ' Post'
                ];
            }, $about->social_media_updates);
        }
        
        // Get videos from the database if available
        if (!empty($about->videos)) {
            // Convert object to array if it's an object
            $videosData = is_object($about->videos) ? json_decode(json_encode($about->videos), true) : $about->videos;
            
            // Ensure it's an array
            $videosData = is_array($videosData) ? $videosData : [];
            
            $videos = [];
            $urls = []; // To track unique URLs
            
            foreach ($videosData as $video) {
                if (!empty($video['url'])) {
                    $url = trim($video['url']);
                    // Only add if URL is not already in the list
                    if (!in_array($url, $urls)) {
                        $urls[] = $url;
                        $videos[] = [
                            'title' => $video['title'] ?? 'Video',
                            'url' => $url,
                            'thumbnail' => $video['thumbnail'] ?? null,
                            'description' => $video['description'] ?? null
                        ];
                    }
                }
            }
        }
        
        // Get press coverage from the database if available
        if (!empty($about->press_coverage)) {
            $pressItems = array_map(function($item) {
                return [
                    'title' => $item['title'] ?? 'Press Coverage',
                    'url' => $item['url'] ?? '#',
                    'type' => strtolower($item['type'] ?? 'website'),
                    'date' => $item['date'] ?? now()->format('Y-m-d'),
                    'source' => $item['source'] ?? 'Unknown Source'
                ];
            }, $about->press_coverage);
        }
        
        // Enrich website items with Open Graph metadata for preview
        if (!empty($pressItems)) {
            $pressItems = array_map(function ($item) {
                if (($item['type'] ?? 'website') === 'website' && !empty($item['url'])) {
                    $meta = $this->fetchLinkPreview($item['url']);
                    if (!empty($meta)) {
                        $item['meta'] = $meta; // ['title','description','image']
                    }
                }
                return $item;
            }, $pressItems);
        }

        // Show the detail view with all the data
        return view('about.detail', compact('about', 'socialMediaPosts', 'videos', 'pressItems'));
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
                                <h3 class="section-title">Ward No. 84 Development Report</h3>
                                <p>By Dr. Debasish Sarkar</p>
                                <p>This report highlights the key development initiatives completed in Ward No. 84 of Asansol Municipal Corporation under the leadership of Dr. Debasish Sarkar. The works focus on infrastructure, social welfare, cultural support, sanitation, and community services, all aimed at improving the daily lives of residents.</p>

                                <div class="initiatives-section mt-5">
                                    <h4 class="section-subtitle">Social Welfare & Community Support</h4>
                                    <ul class="initiatives-list">
                                        <li>Pension schemes implemented: Lakshmi Bhandar, Old Age Pension, Widow Pension, Humane Pension – benefiting more than 1,800 residents.</li>
                                        <li>Financial aid provided for funerals, marriages, and Shraddha ceremonies.</li>
                                        <li>Free drinking water arranged during weddings and religious events.</li>
                                    </ul>

                                    <h4 class="section-subtitle">Cultural & Festival Support</h4>
                                    <ul class="initiatives-list">
                                        <li>In 2022, Dr. Debasish Sarkar introduced a new milestone in Durga Puja celebrations by felicitating Puja committees across the city, starting with Ward 84. The initiative gained wide appreciation, leading the Asansol Municipal Corporation (AMC) to entrust him in 2023 with organizing a citywide competition, where over 500 committees participated. A grand event was held at Rabindra Bhavan, marking a major success. Continuing this legacy, 2024 witnessed yet another remarkable milestone under his leadership.</li>
                                        <li>Idol Immersion Arrangements: Hydra & AMC support, drinking water, seating, attractive lighting.</li>
                                        <li>Ward 84 became the first in the industrial area to feature live bands at immersions.</li>
                                    </ul>

                                    <h5>Festival Decorations:</h5>
                                    <ul class="initiatives-list">
                                        <li>Durga Puja & Kali Puja – full ward decorations.</li>
                                        <li>Chhath Puja – decorated Chhath Ghat.</li>
                                        <li>Eid – special lighting in minority areas.</li>
                                    </ul>

                                    <h4 class="section-subtitle">Sanitation & Waste Management</h4>
                                    
                                     <ul class="initiatives-list">
                                        <li>Tetul tala.</li>
                                         <li>
                                            <ul>
                                                <li>Central park</li>
                                                <li>Purnashree pally</li>
                                                <li>Pragati Granthagar road</li>
                                            </ul>
                                        </li>
                                        <li>Pipeline upgrades (after 45 years).</li>
                                        <li>Netaji maidan to karmakar para (500 ft)</li>
                                    </ul>


                                    <h4 class="section-subtitle">Community Centres</h4>
                                    <ul class="initiatives-list">
                                        <li>Completed: Netaji Maidan Community Centre.</li>
                                        <li>Under Construction: Kora Para, Bajrang Bali Mandir.</li>
                                        <li>Proposed: Guru Nanak Pally, Lane 4 (Kali Mandir).</li>
                                    </ul>

                                    <h4 class="section-subtitle">Road Infrastructure</h4>
                                    <p>Major road repairs and new constructions across Ward 84:</p>
                                    <ul class="initiatives-list">
                                        <li>Vivekananda Pally opposite PHE (repair).</li>
                                        <li>Netaji Maidan to Barracks (Bihari Bari).</li>
                                        <li>Lakhikanta Store Road Drain.</li>
                                        <li>Dukhini Barrack (200 ft).</li>
                                        <li>Shilpi Jamini Roy Sarani to Bhuvan Barrack (350 ft).</li>
                                        <li>Shilpi Jamini Roy Sarani (Asha Shop, 200 ft).</li>
                                        <li>SUR Engineering Road (500 ft).</li>
                                        <li>Madhu Paramanik Road (30 ft).</li>
                                        <li>Pratima Sanga to Lakhikanta Store (600 ft).</li>
                                        <li>Bhama Charan Ghatak Lane.</li>
                                        <li>Gurunanak Pally Priyanka Beauty Parlor Road.</li>
                                        <li>Purnashree Pally Road (Anirban Pan).</li>
                                        <li>Gurunanak Pally Lane 7 & 8 Connector Road.</li>
                                        <li>Gurunanak Pally Lane 10.</li>
                                        <li>Gurunanak Pally Lane 11.</li>
                                        <li>Kalijhariya Road (repair & renovation).</li>
                                    </ul>

                                    <h4 class="section-subtitle">Drainage & Culverts</h4>
                                    <ul class="initiatives-list">
                                        <li>RCC Drains: Guru Nanak Pally Lane 3 & 4, Central Park Lower, Lakhikanta Store Road.</li>
                                        <li>Culverts constructed: Dhibar Para and Roy Para.</li>
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
                        'title' => 'Borough Development Updates',
                        'image' => 'borough.png',
                        'description' => 'Latest Infrastructure and Community Development Projects',
                        'full_content' => '
                            <div class="development-updates">
                                <h3>Road & Infrastructure Development</h3>
                                <ul class="project-list">
                                    <li>
                                        <strong>Chaitanya Tarani By-Lane</strong> (Ward not specified):
                                        <p>Repaired a small road on April 5, 2025, improving daily access for residents.</p>
                                    </li>
                                    <li>
                                        <strong>Vivekananda Pally to Netaji Maidan</strong> (Major Project):
                                        <p>A strong new road built on June 1, 2025, now supports around 10,000 daily commuters.</p>
                                    </li>
                                    <li>
                                        <strong>Ward 86:</strong>
                                        <ul>
                                            <li>Repaired and strengthened a culvert on June 27, 2025.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Kalijhariya & Kalipahari Colliery (Kora Para):</strong>
                                        <p>Assisted local residents in relocating and accessing the Kali Temple on July 7, 2025.</p>
                                    </li>
                                </ul>

                                <h3>Community & Social Support</h3>
                                <ul class="project-list">
                                    <li>
                                        <strong>Self-Help Groups:</strong>
                                        <p>Provided financial assistance to women\'s self-help groups on April 17, 2025, strengthening local livelihoods.</p>
                                    </li>
                                    <li>
                                        <strong>Temple Facilities:</strong>
                                        <p><strong>Loknath Temple</strong> (June 4, 2025): Arranged water and essential services for devotees during Baba Loknath Dev Puja.</p>
                                    </li>
                                </ul>

                                <div class="highlights">
                                    <h3>Highlights of Development</h3>
                                    <ul>
                                        <li>Strengthened connectivity in key areas through major road projects.</li>
                                        <li>Supported local communities with financial aid and livelihood support.</li>
                                        <li>Ensured religious and cultural events were smoothly conducted with proper facilities.</li>
                                        <li>Improved infrastructure in Ward 86 through culvert repair and roadwork.</li>
                                    </ul>
                                </div>

                                <style>
                                    .development-updates {
                                        font-family: Arial, sans-serif;
                                        line-height: 1.6;
                                    }
                                    .development-updates h3 {
                                        color: #2c5282;
                                        margin: 1.5em 0 0.8em;
                                        border-bottom: 2px solid #e2e8f0;
                                        padding-bottom: 0.3em;
                                    }
                                    .project-list {
                                        list-style-type: none;
                                        padding-left: 1em;
                                    }
                                    .project-list li {
                                        margin-bottom: 1.2em;
                                        position: relative;
                                        padding-left: 1.5em;
                                    }
                                    .project-list li:before {
                                        content: "•";
                                        color: #2c5282;
                                        font-weight: bold;
                                        position: absolute;
                                        left: 0;
                                    }
                                    .highlights {
                                        background-color: #f7fafc;
                                        padding: 1.2em;
                                        border-radius: 8px;
                                        margin-top: 2em;
                                        border-left: 4px solid #2c5282;
                                    }
                                    .highlights ul {
                                        list-style-type: disc;
                                        padding-left: 1.5em;
                                    }
                                    .highlights li {
                                        margin-bottom: 0.5em;
                                    }
                                </style>
                            </div>'
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
                        'description' => '',
                        'full_content' => '
                            <div class="adda-section">
                                <div class="adda-about mb-4">
                                    <h3 class="section-title">Overview </h3>
                                    <p> Pashe Achi Asansol is a citizen-first public service campaign launched under the leadership of Dr. Debasish Sarkar (Chairman, Borough–6) with the support of the Asansol Municipal Corporation.
 The initiative focuses on creating a transparent and accessible platform where citizens can easily register their grievances, receive timely assistance, and stay informed about government services.
</p>
                                </div>

                                <div class="role-section mb-4">
                                    <h3 class="section-title">Objective</h3>
                                    <p> To provide every citizen of Asansol with easy access to government services, ensure quick resolution of grievances, and promote accountability through a centralized and digital platform.
</p>
                                </div>

                                <div class="initiatives-section">
                                    <h3 class="section-title">Key Features</h3>
                                    <ul class="initiatives-list">
                                        <li>1.	Integrated Platform: A unified system where citizens can register and track grievances</li>
                                        <li>2.	Centralized Access: One-stop solution for all municipal and government-related services.</li>
                                        <li>3.	Trained Support Staff: Well-trained personnel to guide and assist citizens efficiently.</li>
                                        <li>4.	Digital Interface: Online facilities for grievance updates and resolution tracking.</li>
                                      
                                    </ul>
                                </div>

                               

                                <div class="role-section mb-4">
                                    <h3 class="section-title">Vision</h3>
                                    <p>The vision of Pashe Achi Asansol is to build a responsive and inclusive governance model that truly listens to its people.<p>
<p> It aims to ensure that every citizen’s concern is addressed with empathy, efficiency, and accountability.</p>
 <p>By combining digital innovation with on-ground accessibility, the campaign strives to make public service delivery smoother, faster, and more people-centered—reflecting the spirit of a united and progressive Asansol
</p>
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
                     'pujo-pokkho' => [
                        'title' => 'Pujo Pokkho',
                        'image' => 'puja.jpg',
                        'description' => '',
                        'full_content' => '
                           
                            <h3 class="section-title">Videos</h3>
                            <div class="row">
                    
                                <div class="col-md-6 col-lg-3 mb-4">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/f1DyAfrcJRc" 
                                                title="YouTube video"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-lg-3 mb-4">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/WR3hblCnuEc" 
                                                title="YouTube video"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-lg-3 mb-4">
                                    <div class="ratio ratio-16x9">
                                       <iframe src="https://drive.google.com/file/d/1kR8v9gyS5AEbjUClNHaqetSyYGJA6rY4/preview" width="640" height="480" allow="autoplay"></iframe>
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
