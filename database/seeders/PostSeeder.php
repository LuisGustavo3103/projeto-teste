<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $gustavo = User::find(10);
        // $gustavo = User::query()->where('id', 1)->first();
        $gustavo = User::findOrFail(1);

        // $gustavo->posts()->create([
        //     'title' => 'Titulo 1',
        //     'description' => 'Descrição do titulo 1',
        // ]);

        // $user = $gustavo::factory()->has(Post::factory()->count(3), 'posts')->create();

        $posts = Post::factory()
            ->count(3)
            ->for($gustavo)
            ->create();
    }
}
