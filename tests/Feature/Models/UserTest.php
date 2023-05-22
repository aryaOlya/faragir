<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $name;
    protected $password;
    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::query()->create(["name"=>"arya","password"=>"olya"]);
        $this->name = $this->user->name;
        $this->password = $this->user->password;
    }
    /**
     * A basic feature test example.
     */
    public function testSuccessUserInsert(): void
    {
       $user = User::query()->create(["name"=>"test","password"=>"test"]);
       $this->assertModelExists($user);
    }


    public function testLoginPath()
    {
        $response = $this->post('/api/v1/login',['name'=>'arya12','password'=>'1234']);
        $response->assertStatus(202)
            ->assertJson(fn (AssertableJson $json)=>
            $json->has('status')
                ->has('message')
                ->has('code')
                ->has('data',fn ($json)=>
                $json->has('token')
                    ->has('user')
                )
            );
    }

    public function testRegisterPath()
    {
        $response = $this->post('/api/v1/register',['name'=>'test','password'=>'1234']);
        $response->assertStatus(201);
    }
}
