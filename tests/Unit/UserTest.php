<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $userData = [
            'name' => 'Teste Usuario',
            'email' => 'teste@example.com',
            'password' => 'password123'
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }

    public function test_user_has_required_attributes()
    {
        $user = new User();
        
        $this->assertEquals([
            'name',
            'email',
            'password',
        ], $user->getFillable());

        $this->assertEquals([
            'password',
            'remember_token',
        ], $user->getHidden());

        $this->assertEquals([
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ], $user->getCasts());
    }

    public function test_password_is_hidden()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
    }

    public function test_email_must_be_unique()
    {
        $firstUser = User::factory()->create([
            'email' => 'teste@example.com'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'email' => 'teste@example.com'
        ]);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();
        
        $newData = [
            'name' => 'Novo Nome',
            'email' => 'novo@example.com'
        ];

        $user->update($newData);
        $user->refresh();

        $this->assertEquals($newData['name'], $user->name);
        $this->assertEquals($newData['email'], $user->email);
    }
} 