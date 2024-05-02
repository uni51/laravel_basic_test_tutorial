<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberControllerTest extends TestCase
{
    public function test_非ログイン時は、ログイン画面に飛ばされる()
    {
        $response = $this->get('members');

        // ルート名 `login` にリダイレクトされるか
        $response->assertRedirectToRoute('login');
    }

    public function test_ログイン時は、挨拶文が表示される()
    {
        $user = User::factory()->make(['name' => '与太郎']);

        $response = $this
            ->actingAs($user)
            ->get('members');

        $response
            ->assertOk()
            ->assertSee('ようこそ与太郎さん！');
    }
}
