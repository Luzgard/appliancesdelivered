<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Abel Ponce',
            'email' => 'abel@square1.io',
        ]);
        
        factory(User::class)->create([
            'name' => 'Juan Diego Morales',
            'email' => 'juan@square1.io',
        ]);
    }
}
