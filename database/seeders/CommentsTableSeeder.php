<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Commentator;
use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 11 ; $i++){

            $comments = Http::get('https://www.togoactualite.com/wp-json/wp/v2/comments?per_page=100&page='.$i)->json();

            foreach ($comments as  $value) {

                $check_commentator = Commentator::where('visible', 1)->where('nom_complet', $value['author_name'])->first();

                $check_articles = Article::where('visible', 1)->where('wp_article_id', $value['post'])->get();

                if($check_articles){

                    foreach ($check_articles as  $check_article) {

                        if ($check_commentator) {

                            $comment_create = Comment::create([
                                'content' => $value['content']['rendered'],
                                'article_id' => $check_article->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                'sender_contact_id' => $check_commentator->id
                            ]);


                        } else {

                            $commentator_create = Commentator::create([
                                'nom_complet' => $value['author_name'],
                            ]);

                            $comment_create = Comment::create([
                                'content' => $value['content']['rendered'],
                                'article_id' => $check_article->id,
                                'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                'sender_contact_id' => $commentator_create->id
                            ]);


                        }

                        $check_article->comment_count += 1;

                        $check_article->update();
                    }
                }


            }

        }
    }
}
