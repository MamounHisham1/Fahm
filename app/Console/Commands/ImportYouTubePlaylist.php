<?php

namespace App\Console\Commands;

use App\Enums\LessonType;
use App\Models\Client;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportYouTubePlaylist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:import-playlist
                            {playlist-url : The YouTube playlist URL or ID}
                            {subject : The subject name}
                            {teacher-email : The teacher\'s email address}
                            {client-domain : The client domain}
                            {--api-key= : YouTube Data API key (optional if set in .env)}
                            {--skip-existing : Skip videos that already exist in the database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import YouTube playlist videos as lessons';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $playlistUrl = $this->argument('playlist-url');
        $subjectName = $this->argument('subject');
        $teacherEmail = $this->argument('teacher-email');
        $clientDomain = $this->argument('client-domain');
        $apiKey = $this->option('api-key') ?? env('YOUTUBE_API_KEY');
        $skipExisting = $this->option('skip-existing');

        if (!$apiKey) {
            $this->error('YouTube API key is required. Set YOUTUBE_API_KEY in .env or use --api-key option.');
            return;
        }

        // Find or create required models
        $client = Client::where('domain', $clientDomain)->first();
        $teacher = User::where('email', $teacherEmail)->first();
        $subject = Subject::where('name', $subjectName)->where('client_id', $client->id)->first();

        if (!$client) {
            $this->error("Client with domain '{$clientDomain}' not found.");
            return;
        }

        if (!$teacher) {
            $this->error("Teacher with email '{$teacherEmail}' not found.");
            return;
        }

        if (!$subject) {
            $this->info("Subject '{$subjectName}' not found. Creating new subject...");
            $subject = Subject::create([
                'client_id' => $client->id,
                'name' => $subjectName,
                'slug' => Str::slug($subjectName),
            ]);
        }

        // Extract playlist ID from URL
        $playlistId = $this->extractPlaylistId($playlistUrl);
        if (!$playlistId) {
            $this->error('Invalid playlist URL. Could not extract playlist ID.');
            return;
        }

        $this->info("Importing playlist videos for subject '{$subjectName}'...");

        // Fetch playlist videos
        $videos = $this->fetchPlaylistVideos($playlistId, $apiKey);

        if (empty($videos)) {
            $this->error('No videos found in the playlist or API request failed.');
            return;
        }

        $this->info("Found " . count($videos) . " videos in playlist.");

        // Create lessons from videos
        $createdCount = 0;
        $skippedCount = 0;

        foreach ($videos as $video) {
            // Check if lesson already exists
            if ($skipExisting && Lesson::where('url', $video['id'])->exists()) {
                $this->line("Skipping existing video: {$video['title']}");
                $skippedCount++;
                continue;
            }

            try {
                // Truncate description to fit database column (varchar typically 255 chars)
                $description = $video['description'] ?? 'No description available';
                $description = Str::limit($description, 250); // Limit to 250 characters for safety

                Lesson::create([
                    'user_id' => $teacher->id,
                    'client_id' => $client->id,
                    'subject_id' => $subject->id,
                    'title' => $video['title'],
                    'slug' => Str::slug($video['title']),
                    'description' => $description,
                    'url' => $video['id'],
                    'type' => LessonType::Youtube->value,
                ]);

                $this->line("✓ Created lesson: {$video['title']}");
                $createdCount++;
            } catch (\Exception $e) {
                $this->error("Failed to create lesson for: {$video['title']} - {$e->getMessage()}");
            }
        }

        $this->info("Import completed! Created: {$createdCount}, Skipped: {$skippedCount}");
    }

    /**
     * Extract playlist ID from YouTube URL
     */
    private function extractPlaylistId(string $url): ?string
    {
        // If it's already a playlist ID
        if (preg_match('/^[A-Za-z0-9_-]+$/', $url)) {
            return $url;
        }

        // Clean the URL by removing all escaped characters
        $cleanUrl = stripslashes($url);

        // Extract from YouTube URL
        $patterns = [
            '/[&?]list=([A-Za-z0-9_-]+)/',
            '/youtube\.com\/playlist\?list=([A-Za-z0-9_-]+)/',
            '/list=([A-Za-z0-9_-]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $cleanUrl, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Fetch videos from YouTube playlist
     */
    private function fetchPlaylistVideos(string $playlistId, string $apiKey): array
    {
        $videos = [];
        $nextPageToken = null;

        do {
            $url = "https://www.googleapis.com/youtube/v3/playlistItems?" . http_build_query([
                'part' => 'snippet',
                'playlistId' => $playlistId,
                'maxResults' => 50,
                'pageToken' => $nextPageToken,
                'key' => $apiKey,
            ]);

            $context = stream_context_create([
                'http' => [
                    'ignore_errors' => true,
                    'timeout' => 30,
                ],
            ]);

            $response = @file_get_contents($url, false, $context);

            if (!$response) {
                $this->error('Failed to fetch data from YouTube API. Check your API key and network connection.');
                break;
            }

            $data = json_decode($response, true);

            if (isset($data['error'])) {
                $errorMessage = $data['error']['message'] ?? 'Unknown error';
                $this->error('YouTube API Error: ' . $errorMessage);

                // Provide helpful suggestions
                if (str_contains($errorMessage, 'API key')) {
                    $this->line('💡 Make sure your YouTube Data API key is valid and has the YouTube Data API v3 enabled.');
                } elseif (str_contains($errorMessage, 'quota')) {
                    $this->line('💡 You may have exceeded your YouTube API quota. Try again later.');
                }
                break;
            }

            if (!isset($data['items'])) {
                $this->error('No items found in playlist. The playlist may be private or empty.');
                break;
            }

            foreach ($data['items'] as $item) {
                if (isset($item['snippet']['resourceId']['videoId'])) {
                    $videos[] = [
                        'id' => $item['snippet']['resourceId']['videoId'],
                        'title' => $item['snippet']['title'],
                        'description' => $item['snippet']['description'],
                    ];
                }
            }

            $nextPageToken = $data['nextPageToken'] ?? null;

            if ($nextPageToken) {
                $this->info("Fetching next page of videos...");
            }

        } while ($nextPageToken);

        return $videos;
    }
}
