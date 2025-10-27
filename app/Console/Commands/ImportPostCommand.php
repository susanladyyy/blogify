<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Enums\PostStatus;
use Throwable;

class ImportPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     * This is the command you will type in your terminal.
     */
    protected $signature = 'app:import-post';

    /**
     * The console command description.
     */
    protected $description = 'Imports a single random post from an external API (JSONPlaceholder or FakeStore)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting post import...');

        try {
            $source = rand(0, 1) ? 'jsonplaceholder' : 'fakestore';

            $transformedData = null;

            if ($source === 'jsonplaceholder') {
                $this->line('Fetching from JSONPlaceholder...');
                $postId = rand(1, 100);

                $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$postId}");
                $data = $response->json();

                $transformedData = [
                    'source' => 'jsonplaceholder',
                    'external_id' => $data['id'],
                    'title' => $data['title'],
                    'content' => $data['body'],
                ];

            } else {
                $this.line('Fetching from FakeStore API...');
                $productId = rand(1, 20);

                $response = Http::get("https://fakestoreapi.com/products/{$productId}");
                $data = $response->json();

                $transformedData = [
                    'source' => 'fakestore',
                    'external_id' => $data['id'],
                    'title' => $data['title'],
                    'content' => $data['description'],
                ];
            }

            $post = Post::firstOrCreate(
                [
                    'source' => $transformedData['source'],
                    'external_id' => $transformedData['external_id'],
                ],
                [
                    'user_id' => 1,
                    'title' => $transformedData['title'],
                    'content' => $transformedData['content'],
                    'status' => PostStatus::Draft,
                ]
            );

            if ($post->wasRecentlyCreated) {
                $this->info("Successfully imported new post: '{$post->title}'");
            } else {
                $this.warn("Post already exists, skipping: '{$post->title}'");
            }

            return 0;

        } catch (Throwable $e) {
            $this->error("Failed to import post: " . $e->getMessage());
            return 1;
        }
    }
}

