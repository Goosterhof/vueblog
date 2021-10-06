<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
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
        $this->call([
            ArticleSeeder::class,
            CommentSeeder::class,
            ReplySeeder::class,
            TagSeeder::class
        ]);

        $articles = Article::all();
        $tags = Tag::all();
        foreach($articles as $article){
            $article->tags()->attach(
                $tags->random(rand(1, 2))->pluck("id")
            );
            if(count($article->tags) === 2){
                if($article->tags[0] === $article->tags[1]){
                    $article->tags[1]->delete();
                }
            }
           
        }
    }
}
