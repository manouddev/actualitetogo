<?php

namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Models\Publication;
use App\Models\PublicationTags;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OneSlugController extends BaseController
{
    public function slug(Request $request, $slug){

        $articles_count = Publication::where('visible', 1)->where('status', 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            if($slug === 'forum'){

                return view('oneSlugPage.forum');

            }elseif($slug === 'evenements'){

                return view('oneSlugPage.evenements');

            }elseif($slug === 'contact'){

                return view('oneSlugPage.contact');

            }elseif($slug === 'about'){

                $users = User::where('visible', 1)->where('status', 1)->paginate(10);

                return view('oneSlugPage.about', ['users' => $users]);

            }elseif($slug === 'videos'){

                return view('oneSlugPage.videos');

            }elseif ($slug === 'publicites') {

                return view('oneSlugPage.pub');

            }elseif ($slug === 'infos-pratiques') {

                return view('oneSlugPage.infos-pratiques');

            }elseif ($slug === 'all-category') {

                $categories = Category::query();

                if($request->input('search')){

                    $categories = DB::table("categories")
                    ->where('categories.visible', '=', 1)
                    ->where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.slug', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.updated_at', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.count_publications', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->paginate(9);

                    $categoryCount = DB::table("categories")
                    ->where('categories.visible', '=', 1)
                    ->where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.slug', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.updated_at', 'like', '%'. $request->input('search') . '%')
                    ->orWhere('categories.count_publications', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->count();

                }else{

                    $categories = DB::table("categories")
                    ->where('categories.visible', '=', 1)
                    ->orderBy('categories.count_publications', 'desc')
                    ->paginate(9);

                    $categoryCount = Category::where('visible', 1)->count();

                }

                return view('oneSlugPage.all-category', ['categories' => $categories, 'categoryCount'=> $categoryCount]);

            }else if($slug === "search-posts"){

                $categories = Category::query();

                if($request->input('query')){

                    $search = $request->input('query');

                    $articles = Publication::where('publications.visible', 1)
                    ->where('publications.status', 1)
                    ->where('publications.deja_citer', 0)
                    ->where('publications.title', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.category_name', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.author_name', 'like', '%'. $request->input('query') . '%')
                    ->orderBy('publications.date_publish', 'desc')
                    ->get();

                    $count = Publication::where('publications.visible', 1)
                    ->where('publications.status', 1)
                    ->where('publications.deja_citer', 0)
                    ->where('publications.title', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.category_name', 'like', '%'. $request->input('query') . '%')
                    ->orWhere('publications.author_name', 'like', '%'. $request->input('query') . '%')
                    ->orderBy('publications.date_publish', 'desc')
                    ->count();

                    return view('oneSlugPage.search-article', ['articles' => $articles, 'search' => $search, 'count' => $count]);

                }else{

                    $search = false;

                    $count = false;

                    $articles = Publication::where('visible', 1)->where('status', 1)->where('deja_citer', 0)->orderBy('date_publish', 'desc')->take(10)->get();

                    return view('oneSlugPage.search-article', ['articles' => $articles, 'search' => $search, 'count' => $count]);

                }
            }else{

                $category = Category::where('slug', $slug)->where('visible', 1)->first();

                $article = Publication::where('slug', $slug)->where('visible', 1)->where("status", 1)->first();

                if (($category == null) && ( $article == null)) {

                    return view('errors.ErrorSlugPage');

                }elseif(($category !== null) && ( $article == null)) {


                    $otherCategory = Category::where('visible', 1)->get();

                    $articles = Publication::where("publications.visible", 1)
                    ->where("publications.status", 1)
                    ->where("publications.category_id", $category->id)
                    ->orderBy('publications.date_publish', 'desc')
                    ->paginate(6);

                    $alireaussi = Publication::where("publications.visible", 1)
                    ->where("publications.deja_citer", 0)
                    ->where("publications.status", 1)
                    ->orderBy('publications.date_publish', 'desc')
                    ->take(5)
                    ->get();

                    return view('oneSlugPage.category', ['articles' => $articles, 'alireaussi' => $alireaussi, 'category' => $category, 'otherCategory' => $otherCategory]);

                }else{

                    $categoriesH = Publication::where("publications.visible", 1)
                    ->where("publications.id", $article->id)
                    ->get();

                    $tags = PublicationTags::select(array("tags.name", "tags.id", "tags.slug"))
                    ->where("publications.visible", 1)
                    ->where("publications.id", $article->id)
                    ->leftJoin("publications", "publications.id", "=", "publication_tags.publication_id")
                    ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                    ->get();

                    $tagsCount = PublicationTags::select(array("tags.name", "tags.id", "tags.slug"))
                    ->where("publications.visible", 1)
                    ->where("publications.id", $article->id)
                    ->leftJoin("publications", "publications.id", "=", "publication_tags.publication_id")
                    ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                    ->count();

                    $files = Publication::select(array("fichiers.file_url"))
                    ->where("publications.visible", 1)
                    ->where("publications.id", $article->id)
                    ->leftJoin("publication_fichiers", "publication_fichiers.publication_id", "=", "publications.id")
                    ->leftJoin("fichiers", "fichiers.id", "=", "publication_fichiers.file_id")
                    ->get();



                    $previous = Publication::select('title', 'slug')->where('id', '<' ,$article->id)->where('visible', 1)->where("status", 1)->where("deja_citer", 0)->orderBy('publications.date_publish', 'desc')->first();

                    $next = Publication::select('title', 'slug')->where('id', '>' ,$article->id)->where('visible', 1)->where("status", 1)->where("deja_citer", 0)->orderBy('publications.date_publish', 'desc')->first();

                    if($previous && $next){

                        $category = Publication::where("publications.visible", 1)
                        ->where("publications.id", $article->id)
                        ->first();

                        $similars = Publication::where("visible", 1)
                        ->where("status", 1)
                        ->where("category_id", $category->category_id)
                        ->where("id", "!=" ,$article->id)
                        ->where("id", "!=" ,$previous->id)
                        ->where("id", "!=" ,$next->id)
                        ->where("deja_citer", 0)
                        ->orderBy('date_publish', 'desc')
                        ->take(9)->get();

                    }else{

                        $category = Publication::where("publications.visible", 1)
                        ->where("publications.id", $article->id)
                        ->first();

                        $similars = Publication::where("visible", 1)
                        ->where("status", 1)
                        ->where("category_id", $category->category_id)
                        ->where("deja_citer", 0)
                        ->where("id", "!=" ,$article->id)
                        ->orderBy('date_publish', 'desc')
                        ->take(9)->get();

                    }

                    return view('oneSlugPage.article',[
                        'article' => $article,
                        'files' => $files,
                        'tags' => $tags,
                        'tagsCount' => $tagsCount,
                        'previous' => $previous,
                        'next' => $next,
                        'similars' => $similars,
                        'categoriesH' => $categoriesH
                    ]);

                }
            }

        }
    }

    public function tags($slug)
    {


        $articles_count = Publication::where('visible', 1)->where('status', 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            $tag = Tags::where('slug', $slug)->where('visible', 1)->first();

            if ($tag == null) {

                return view('errors.ErrorSlugPage');

            } else {



                $articles = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
                ->where("publications.visible", 1)
                ->where("publications.status", 1)
                ->where("tags.id", $tag->id)
                ->where("publications.deja_citer", 0)
                ->leftJoin("publication_tags", "publication_tags.publication_id", "=", "publications.id")
                ->leftJoin("tags", "tags.id", "=", "publication_tags.tag_id")
                ->orderBy('publications.date_publish', 'desc')
                ->paginate(6);

                return view('oneSlugPage.tags', ['articles' => $articles, 'tag' => $tag]);

            }
        }
    }

    public function authors($slug)
    {

        $articles_count = Publication::where('visible', 1)->where('status', 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            $author = Author::where('slug', $slug)->where('visible', 1)->first();

            if ($author == null) {

                return view('errors.ErrorSlugPage');

            } else {

                $articles = Publication::where("visible", 1)
                ->where("status", 1)
                ->where("deja_citer", 1)
                ->where("author_slug", $author->slug)
                ->orderBy('date_publish', 'desc')
                ->paginate(6);

                return view('oneSlugPage.authors', ['articles' => $articles, 'author' => $author]);

            }
        }
    }

}
