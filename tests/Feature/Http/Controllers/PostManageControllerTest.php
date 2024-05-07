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
}
