<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_sample1(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_sample2(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertStatus(200);
    }
}
