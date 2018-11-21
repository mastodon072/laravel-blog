<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('users')->truncate();
        // DB::table('category_post')->truncate();
        // DB::table('posts')->truncate();
        // DB::table('categories')->truncate();
        // $this->call(UsersTableSeeder::class);
        // factory(App\User::class, 10)->create();
        // factory(App\Post::class, 10)->create();
        // factory(App\Category::class, 10)->create();
        // factory(App\User::class, 10)->create()->each(function($user){
        //     $user->posts()->save(factory(App\Post::class)->make())->each(function($post){
        //         $post->categories()->save(factory(App\Category::class)->make());
        //     });
        // });
    }
}
