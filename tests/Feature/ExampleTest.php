<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        dump('setUp');
    }

    protected function tearDown(): void
    {
        dump('tearDown');

        parent::tearDown();
    }

    public function test_sample1(): void
    {
        $response = $this->get('/');

        dump('sample1');

        $response->assertStatus(200);
    }

    public function test_sample2(): void
    {
        $response = $this->get('/');

        dump('sample2');

        $response->assertStatus(200);
    }
}
