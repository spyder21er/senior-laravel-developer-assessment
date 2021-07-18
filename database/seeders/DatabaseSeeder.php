<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $default_user = User::find(1);
        $default_user->email = "user@example.com";
        $default_user->password = bcrypt("password");
        $default_user->save();
    }
}
