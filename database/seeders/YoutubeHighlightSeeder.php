<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\YoutubeHighlight;
use Carbon\Carbon;

class YoutubeHighlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $highlights = [
            [
                'title' => 'Bill Walsh Leadership Lessons',
                'description' => 'Like to know the secrets of transforming a 2-14 team into a 3-time Super Bowl champion? Learn from the legendary Bill Walsh.',
                'author' => 'Alec Whitten',
                'thumbnail' => 'images/b.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'youtube_id' => 'example1',
                'published_date' => '2022-01-17',
                'tags' => ['Leadership', 'Management', 'Sports'],
                'views' => 15420,
                'likes' => 892,
                'is_featured' => true
            ],
            [
                'title' => 'Productivity Hacks for Developers',
                'description' => 'Discover the top 10 productivity hacks that successful developers use to write better code faster.',
                'author' => 'Sarah Chen',
                'thumbnail' => 'images/c.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'youtube_id' => 'example2',
                'published_date' => '2022-02-15',
                'tags' => ['Programming', 'Productivity', 'Development'],
                'views' => 23450,
                'likes' => 1203,
                'is_featured' => true
            ],
            [
                'title' => 'UI/UX Design Principles',
                'description' => 'Master the fundamental principles of UI/UX design that will make your applications stand out.',
                'author' => 'Maria Rodriguez',
                'thumbnail' => 'images/a.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example3',
                'youtube_id' => 'example3',
                'published_date' => '2022-03-10',
                'tags' => ['Design', 'UI/UX', 'Creative'],
                'views' => 18920,
                'likes' => 756,
                'is_featured' => false
            ],
            [
                'title' => 'Laravel Best Practices 2024',
                'description' => 'Learn the latest Laravel best practices and patterns that will make your code more maintainable.',
                'author' => 'John Smith',
                'thumbnail' => 'images/d.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example4',
                'youtube_id' => 'example4',
                'published_date' => '2022-04-05',
                'tags' => ['Laravel', 'PHP', 'Backend'],
                'views' => 32100,
                'likes' => 1456,
                'is_featured' => true
            ],
            [
                'title' => 'React Performance Optimization',
                'description' => 'Optimize your React applications for better performance and user experience.',
                'author' => 'David Kim',
                'thumbnail' => 'images/b.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example5',
                'youtube_id' => 'example5',
                'published_date' => '2022-05-12',
                'tags' => ['React', 'JavaScript', 'Frontend'],
                'views' => 27650,
                'likes' => 1123,
                'is_featured' => false
            ],
            [
                'title' => 'Database Design Fundamentals',
                'description' => 'Understand the core principles of database design and optimization.',
                'author' => 'Lisa Wang',
                'thumbnail' => 'images/c.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example6',
                'youtube_id' => 'example6',
                'published_date' => '2022-06-20',
                'tags' => ['Database', 'SQL', 'Backend'],
                'views' => 19870,
                'likes' => 678,
                'is_featured' => false
            ],
            [
                'title' => 'DevOps for Beginners',
                'description' => 'A comprehensive guide to DevOps practices and tools for beginners.',
                'author' => 'Mike Johnson',
                'thumbnail' => 'images/a.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example7',
                'youtube_id' => 'example7',
                'published_date' => '2022-07-08',
                'tags' => ['DevOps', 'CI/CD', 'Infrastructure'],
                'views' => 15680,
                'likes' => 445,
                'is_featured' => false
            ],
            [
                'title' => 'API Design Best Practices',
                'description' => 'Learn how to design RESTful APIs that are scalable, maintainable, and developer-friendly.',
                'author' => 'Emma Davis',
                'thumbnail' => 'images/d.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example8',
                'youtube_id' => 'example8',
                'published_date' => '2022-08-14',
                'tags' => ['API', 'REST', 'Backend'],
                'views' => 22340,
                'likes' => 987,
                'is_featured' => true
            ],
            [
                'title' => 'Mobile App Development Trends',
                'description' => 'Explore the latest trends in mobile app development and what\'s coming next.',
                'author' => 'Alex Thompson',
                'thumbnail' => 'images/b.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example9',
                'youtube_id' => 'example9',
                'published_date' => '2022-09-22',
                'tags' => ['Mobile', 'App Development', 'Trends'],
                'views' => 18950,
                'likes' => 723,
                'is_featured' => false
            ],
            [
                'title' => 'Machine Learning Basics',
                'description' => 'Introduction to machine learning concepts and practical applications.',
                'author' => 'Dr. Robert Chen',
                'thumbnail' => 'images/c.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example10',
                'youtube_id' => 'example10',
                'published_date' => '2022-10-30',
                'tags' => ['Machine Learning', 'AI', 'Data Science'],
                'views' => 34560,
                'likes' => 1678,
                'is_featured' => true
            ],
            [
                'title' => 'Web Security Fundamentals',
                'description' => 'Essential web security practices every developer should know.',
                'author' => 'Security Expert',
                'thumbnail' => 'images/a.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example11',
                'youtube_id' => 'example11',
                'published_date' => '2022-11-15',
                'tags' => ['Security', 'Web Development', 'Best Practices'],
                'views' => 26780,
                'likes' => 1234,
                'is_featured' => false
            ],
            [
                'title' => 'Cloud Computing Explained',
                'description' => 'Understanding cloud computing services and deployment strategies.',
                'author' => 'Cloud Guru',
                'thumbnail' => 'images/d.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=example12',
                'youtube_id' => 'example12',
                'published_date' => '2022-12-03',
                'tags' => ['Cloud Computing', 'AWS', 'Deployment'],
                'views' => 19890,
                'likes' => 567,
                'is_featured' => false
            ]
        ];

        foreach ($highlights as $highlight) {
            YoutubeHighlight::create($highlight);
        }
    }
}
