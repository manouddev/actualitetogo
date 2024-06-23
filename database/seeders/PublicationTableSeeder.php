<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\PublicationFile;
use App\Models\PublicationTag;
use App\Models\Author;
use App\Models\Category;
use App\Models\File;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearPublication;
use App\Models\Tag;
use App\Models\TypePublication;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function str_replace_all($search, $replace, $subject) {

            return str_replace($search, $replace, $subject);

        }

        for($i = 1; $i <= 50; $i++){

            $posts = Http::get("https://www.togoactualite.com/wp-json/wp/v2/posts/?per_page=100&page=$i")->json();

            $type_publication = TypePublication::where('slug',"article")->first();

            foreach ($posts as  $value) {


                $authors = Author::get();

                if(isset($value['yoast_head_json']["og_image"][0]['url'])){

                    $link_file = $value['yoast_head_json']["og_image"][0]['url'];

                    $caractere_file = "uploads/";

                    $position_file = strpos($link_file, $caractere_file); // Trouver la position du caractère

                    if ($position_file !== false) {

                        $og_file_url_file = substr($link_file, $position_file); // Extraire la sous-chaîne à partir de la position

                        $verify_link_file = File::where('file_url', $og_file_url_file)->first();

                        if($verify_link_file){

                            if($verify_link_file->count_publications === 0){

                                $verify_link_file->count_publications = 1;

                                $verify_link_file->update();

                            }else{

                                $verify_link_file->count_publications++;

                                $verify_link_file->update();

                            }

                        }

                    }
                }

                foreach ($authors as $author) {

                    if($author->id == $value['author']){

                       $views_count =  rand(351,2564);

                       $likes_count =  rand(123,554);

                        foreach ($value['categories'] as $wp_category) {

                            $category =  Category::where('wp_category_id', $wp_category)->first();

                            $publication_verify = Publication::where('title', $value["title"]['rendered'])->count();

                            if($publication_verify){

                                $deja_citer = 1;

                            }else{

                                $deja_citer = 0;

                            }

                            if(isset($value['yoast_head_json']["og_image"][0]['url'])){

                                $link = $value['yoast_head_json']["og_image"][0]['url'];

                                $caractere = "uploads/";

                                $position = strpos($link, $caractere); // Trouver la position du caractère

                                if ($position !== false) {

                                    $og_file_url = substr($link, $position); // Extraire la sous-chaîne à partir de la position

                                    $verify_link = File::where('file_url', $og_file_url)->first();

                                    if($verify_link){

                                        $og_file_url = substr($link, $position); // Extraire la sous-chaîne à partir de la position

                                        $date = Carbon::parse(date('Y-m-d H:i:s', strtotime($value['date'])));

                                        $mois_id = $date->format('m');

                                        $year = $date->format('Y');

                                        $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                                        $date_name = $mois->month.' '.$year;

                                        $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                                        if(!$verify_date_name){

                                            InfosMonthYearPublication::create(['date_name' => $date_name]);

                                        }

                                        $post = Publication::create([
                                            'title' => $value["title"]['rendered'],
                                            'title_truncate' => \Illuminate\Support\Str::words($value["title"]['rendered'], 10, ' ...'),
                                            'deja_citer' => $deja_citer,
                                            'date_name' => $date_name,
                                            'og_file_url' => $og_file_url,
                                            'author_id' => $author->id,
                                            'author_name' => $author->authorName,
                                            'author_slug' => $author->slug,
                                            'category_id' => $category->id,
                                            'category_name' => $category->name,
                                            'category_slug' => $category->slug,
                                            'content' => str_replace_all('https://togoactualite.com/wp-content/uploads', 'https://togoactualite.com/wp-content/uploads', $value["content"]["rendered"]),
                                            'truncate_content' => \Illuminate\Support\Str::words( $value["excerpt"]["rendered"], 20, ' ...'),
                                            'truncate_content_max' => $value["excerpt"]["rendered"],
                                            'slug' => $value["slug"],
                                            'status' => $value["status"] == 'publish' ? 1 : 0,
                                            'comment_status' => $value["comment_status"] == 'open' ? 1 : 0,
                                            'views_count' => $views_count,
                                            'likes_count' => $likes_count,
                                            'shares_count' => 0,
                                            'comment_count' => 0,
                                            'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                            'wp_article_id' => $value["id"],
                                            'type_publication_id' => 1,
                                            'type_publication_name' => "ARTICLE",
                                            'type_publication_slug' => 'article',
                                            'user_id' => 1
                                        ]);


                                        if($category->count_publications === 0){

                                            $category->count_publications = 1;

                                            $category->update();

                                        }else{

                                            $category->count_publications++;

                                            $category->update();

                                        }

                                        foreach ($value['tags'] as  $result) {

                                            $tags = Tag::get();

                                            foreach ($tags as  $tag) {

                                                if ($tag->wp_tag_id === $result) {

                                                    PublicationTag::create([
                                                        'publication_id' => $post->id,
                                                        'tag_id' => $tag->id,
                                                        'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),

                                                    ]);

                                                    if($tag->count_publications === 0){

                                                        $tag->count_publications = 1;

                                                        $tag->update();

                                                    }else{

                                                        $tag->count_publications++;

                                                        $tag->update();

                                                    }

                                                }

                                            }
                                        }

                                        if(isset($value['yoast_head_json']["og_image"])){

                                            foreach ($value['yoast_head_json']["og_image"] as  $filewp) {

                                                $files = File::get();

                                                foreach ($files as  $file) {

                                                    if ($file->wp_file === $filewp['url']) {

                                                        PublicationFile::create([
                                                            'publication_id' => $post->id,
                                                            'file_id' => $file->id,
                                                            'date_publish' => date('Y-m-d H:i:s', strtotime($value['date'])),
                                                        ]);

                                                    }

                                                }

                                            }

                                        }

                                    }
                                }

                            }
                        }

                        if($author->count_publications === 0){

                            $author->count_publications = 1;

                            $author->update();

                        }else{

                            $author->count_publications++;

                            $author->update();

                        }


                        if($type_publication->count_publications === 0){

                            $type_publication->count_publications = 1;

                            $type_publication->update();

                        }else{

                            $type_publication->count_publications++;

                            $type_publication->update();

                        }

                    }

                }

            }

        }
    }
}
