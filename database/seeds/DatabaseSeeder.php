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
//                $this->call(UsersTableSeeder::class);
//        $this->call(RolesTableSeeder::class);
        factory(App\Tag::class, 1)->create();
        factory(App\Category::class, 1)->create();
        factory(App\Post::class, 1)->create();
    }
}
