<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish post';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::unPublished()->get();

        foreach ($posts as $post) {
            $publish_date = Carbon::parse($post->published_at);

            if ($publish_date->isCurrentMinute()) {
                $post->update([
                    'status' => 1
                ]);
            }
        }
    }
}
