<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AvatarControllerTest extends TestCase
{
    public function test_画像が保存されるかテスト()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('yotaro.jpg');

        $response = $this->post('/avatar', [
            'img' => $file,
        ]);

        $response->assertOk();
    }
}
