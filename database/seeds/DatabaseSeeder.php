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
        factory(App\Category::class, 3)->create();
        $users = factory(App\User::class, 3)->create();
        factory(App\Tag::class, 3)->create();

        $users->each(function ($user){
            for ($i = 1; $i <= 5; $i++){
                $category = \App\Category::inRandomOrder()->first();
                $post = factory(\App\Post::class)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);

                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => \App\Tag::inRandomOrder()->first()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                factory(\App\Comment::class, 3)->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
            //$user->posts()->save(factory(App\Post::class)->make());
        });

    }
}
