<?php

use App\Models\User;
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
            'name' => 'RameIn User',
            'email' => 'ramein@example.com',
            'password' => '12345678',
        ])->assign("Administrator");
    }
}
