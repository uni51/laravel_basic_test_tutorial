<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostManageControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_自分の投稿一覧のみ表示()
    {
        $me = $this->login();

        Post::factory()->for($me)->create(['title' => '私のブログタイトル']);
        Post::factory()->create(['title' => '他人様のブログタイトル']);

        $response = $this->get('members/posts');

        $response
            ->assertOk()
            ->assertSee('私のブログタイトル')
            ->assertDontSee('他人様のブログタイトル');
    }

    public function test_自分の新規ブログ投稿ができる()
    {
        $me = $this->login();

        $validData = [
            'title' => '私のブログタイトル',
            'body' => '私のブログ本文',
            'status' => '1',
        ];

        $response = $this->post(route('posts.store'), $validData);

        $response->assertRedirect(route('posts.edit', Post::first()));

        $this->assertDatabaseHas('posts',
            array_merge($validData, ['user_id' => $me->id])
        );
    }

    public function test_自分のブログの編集画面は開ける()
    {
        $post = Post::factory()->create();

        $this->login($post->user);

        $this->get(route('posts.edit', $post))
            ->assertOk();
    }

    public function test_他人様のブログの編集画面は開けない()
    {
        $post = Post::factory()->create();

        $this->login();

        $this->get(route('posts.edit', $post))
            ->assertForbidden();
    }
}
