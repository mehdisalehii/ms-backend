<?php

namespace Tests\Unit\Controllers\API\V01\Auth;

//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Carbon\Factory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_register_validate()
    {
        $response=$this->postJson(route('auth.register'));
        $response->assertStatus(422);
    }
    public function test_user_can_be_register()
    {
        $response=$this->postJson(route('auth.register'),[
            'name'=>'mehdi',
            'email'=>'mehdi1@m.com',
            'password'=>'123'
        ]);
        $response->assertStatus(201);

    }

    public function test_user_login_validate()
    {
        $response=$this->postJson(route('auth.login'));
        $response->assertStatus(422);
    }
    public function test_user_can_be_login()
    {

//        $response=$this->postJson(route('auth.login'),[
//            'name'=>'mehdi',
//            'email'=>'mehdi@m.com',
//            'password'=>'123'
//        ]);
//        $response->assertStatus(200);
    }

    public function test_show_user_if_logged_in()
    {

    }

    public function test_logged_in_user_can_logpot()
    {
        $response=$this->postJson(route('auth.logout'));
        $response->assertStatus(200);
    }
}
