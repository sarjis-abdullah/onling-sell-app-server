<?php

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
        factory(App\Tag::class, 5)->create();
        factory(App\Category::class, 5)->create();
        factory(App\Post::class, 5)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
