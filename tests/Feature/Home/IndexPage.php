<?php

namespace Tests\Feature\Home;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class IndexPage extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIndexPage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json)=>
            $json->has('status')
                ->has('message')
                ->has('code')
                ->has('data',fn ($json)=>
                $json->has('name')
                    ->has('email')
                    ->has('phone')
                    ->has('github')
                    ->has('linkedin')
                )
            );;
    }
}
