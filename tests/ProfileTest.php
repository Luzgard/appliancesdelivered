<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_profile()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Abel Ponce',
            'email' => 'abel@square1.io'
        ]);

        $this->actingAs($user)
            ->visit('/')
            ->see('Profile')
            ->visit('profile')
            ->type('Antonio Rosado', 'name')
            ->press('Update');

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'name' => 'Antonio Rosado',
            'email' => 'abel@square1.io'
        ]);
    }

    public function test_validate_email()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Abel Ponce',
            'email' => 'abel@square1.io'
        ]);

        $this->actingAs($user)
            ->visit('/')
            ->see('Profile')
            ->visit('profile')
            ->type('saas', 'email')
            ->press('Update');

        $this->see('The email must be a valid email address.');
    }

    public function test_register_user()
    {
        $this->visit('register')
            ->type('Antonio Rosado', 'name')
            ->type('antonio@gmail.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Register');

        $this->seeInDatabase('users', [
            'name' => 'Antonio Rosado',
            'email' => 'antonio@gmail.com',
        ]);
    }
}
