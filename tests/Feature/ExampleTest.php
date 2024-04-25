<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_factoryのテスト()
    {
        $post = Post::factory()->create();
        // $closed_post = Post::factory()->closed()->create(); // 非公開のブログ

        $this->dumpdb();
    }
}
