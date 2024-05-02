<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_Postの公開・非公開のscope()
    {
        $open = Post::factory()->create();
        $closed = Post::factory()->closed()->create();

        $posts = Post::onlyOpen()->get();

        $this->assertTrue($posts->contains($open));
        $this->assertFalse($posts->contains($closed));
    }

    public function test_PostのbelongsTo()
    {
        $post = Post::factory()->create();

        $instance = $post->user;

        $this->assertInstanceOf(User::class, $instance);
    }
}
