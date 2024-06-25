<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearPublication;
use App\Models\TypePublication;
use App\Models\Publication;
use App\Models\PublicationTag;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationController extends BaseController
{

    public function publicationCreateBySlugType(Request $request){

        $slug = $request->slug;

        if(auth()->user()->role_id === 1){

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun type de publication n\'est enregistré.');

            }else{

                $categoryCount = Category::orderBy('count_publications', 'desc')->count();

                if($categoryCount === 0){

                    return $this->sendResponse(['status' => 401, 'categoryCount'=> $categoryCount], 'Aucune catégorie n\'est enregistrée.');

                }else{

                    $authorsCount = Author::orderBy('count_publications', 'desc')->count();

                    if($authorsCount === 0){

                        return $this->sendResponse(['status' => 401, 'authorsCount'=> $authorsCount], 'Aucun auteur n\'est enregistré.');

                    }else{

                        $categories = Category::orderBy('categories.count_publications', 'desc')->get();

                        $tags = Tag::orderBy('tags.count_publications', 'desc')->get();

                        $authors = Author::orderBy('authors.count_publications', 'desc')->get();

                        $typePublication = TypePublication::where('slug', $slug)->first();

                        return $this->sendResponse(['typePublication' => $typePublication,'tags' => $tags, 'categories' => $categories,'authors' => $authors ,'typePublicationCount'=> $typePublicationCount,'status' => 200], 'Liste des types de publications.');

                    }

                }

            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function changeStatusPublicationPrgramm(){

        $publicationCount = Publication::where('presently', 1)->count();

        if($publicationCount !== 0){

            $publications = Publication::where('status', 2)->where('presently', 1)->get();

            foreach($publications as $publication){

                if($publication->date_publish <= now()){

                    $publication->status = 1;

                    $publication->update();

                }

            }

            $publicationsH = Publication::where('status', 1)->where('presently', 1)->get();

            foreach($publicationsH as $publication){

                if($publication->date_publish_end <= now()){

                    $publication->status = 4;

                    $publication->update();

                }

            }

            return $this->sendResponse(['status' => 200], 'Changement de status effectué.');

        }else{

            return $this->sendResponse(['status' => 422], 'Erreur de changment de status.');

        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function storeInfoAlertAnnonce(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'title' => ['required','string', 'unique:publications'],
                'status' => ['required'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'title.unique' => 'Ce :attribute est déjà enregistré.',
            ], [
                'title' => 'titre de la publication',

            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun type de publication n\'est enregistré.');

            }else{

                $typePublication = TypePublication::where('slug', $slug)->first();

                if($datas['date_publish'] <= now()){

                    return $this->sendResponse(['status' => 422], 'Veuillez bien revoir votre date de debut de publication .');

                }else{

                    if($datas['date_publish_end'] <= now()){

                        return $this->sendResponse(['status' => 422], 'Veuillez bien revoir votre date de fin de publication .');

                    }else{

                        if($datas['date_publish_end'] <= $datas['date_publish']){

                            return $this->sendResponse(['status' => 422], 'Votre date de fin de publication ne peut être antérieure à la date de debut de publication ');

                        }else{

                            $datas['type_publication_id'] = $typePublication->id;

                            $datas['type_publication_name'] = $typePublication->name;

                            $datas['type_publication_slug'] = $typePublication->slug;

                            $datas['user_id'] = auth()->user()->id;

                            $datas['presently'] = 1;

                            $datas['slug'] = Str::slug($datas['title']);

                            $date = Carbon::parse(now());

                            $mois_id = $date->format('m');

                            $year = $date->format('Y');

                            $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                            $date_name = $mois->month.' '.$year;

                            $datas['date_name'] =  $date_name;

                            $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                            if(!$verify_date_name){

                                InfosMonthYearPublication::create(['date_name' => $date_name]);

                            }

                            $publicationCreateData =  Publication::create($datas);

                            if($publicationCreateData){

                                return $this->sendResponse(['publicationCreateData' => $publicationCreateData, 'status' => 200], 'Publication enregistrée.');

                            }else{

                                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette publication.');

                            }

                        }

                    }

                }

            }


        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function storeArticleFirstStep(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'title' => ['required','string', 'unique:publications'],
                'author' => ['required'],
                'category' => ['required'],
                'source' => ['required','string'],
            ],[
                'required' => ':attribute est obligatoire.',
                'title.unique' => 'Ce :attribute est déjà enregistré.',
            ], [
                'title' => 'titre de la publication',
                'source' => 'La source de la publication',
                'category' => 'La categorie de la publication',
                'author' => 'L\'auteur de la publication',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun type de publication n\'est enregistré.');

            }else{

                $typePublication = TypePublication::where('slug', $slug)->first();

                if(count($datas['category']) === 1){
 
                    $datas['status'] = 0;

                    $datas['date_publish'] = now();

                    $datas['deja_citer'] = 0;

                    $datas['type_publication_id'] = $typePublication->id;

                    $datas['type_publication_name'] = $typePublication->name;

                    $datas['type_publication_slug'] = $typePublication->slug;

                    $datas['category_id'] = $datas['category']['0']['id'];

                    $datas['category_name'] = $datas['category']['0']['name'];

                    $datas['category_slug'] = $datas['category']['0']['slug'];

                    $datas['author_id'] = $datas['author']['id'];

                    $datas['author_name'] = $datas['author']['authorName'];

                    $datas['author_slug'] = $datas['author']['slug'];

                    $datas['user_id'] = auth()->user()->id;

                    $datas['presently'] = 1;

                    $datas['slug'] = Str::slug($datas['title']);

                    $datas['title_truncate'] = Str::words($datas["title"], 10, ' ...');

                    $date = Carbon::parse(now());

                    $mois_id = $date->format('m');

                    $year = $date->format('Y');

                    $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                    $date_name = $mois->month.' '.$year;

                    $datas['date_name'] =  $date_name;

                    $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                    if(!$verify_date_name){

                        InfosMonthYearPublication::create(['date_name' => $date_name]);

                    }

                    $publicationCreateData =  Publication::create($datas);

                    for ($i=0; $i<= count($datas['tag']) - 1; $i++ ){

                        $tag = PublicationTag::create([
                            'publication_id' => $publicationCreateData->id,
                            'tag_id' => $datas['tag'][$i]['id'],
                            'date_publish' => now(),

                        ]);

                        if($tag->count_publications === 0){

                            $tag->count_publications = 1;

                            $tag->update();

                        }else{

                            $tag->count_publications++;

                            $tag->update();

                        }
 
                    }

                    if($publicationCreateData){

                        return $this->sendResponse(['publicationCreateData' => $publicationCreateData, 'status' => 200], 'Publication enregistrée.');

                    }else{

                        return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette publication.');

                    }

                }else{

                    $datas['status'] = 0;

                    $datas['date_publish'] = now();

                    $datas['deja_citer'] = 0;

                    $datas['type_publication_id'] = $typePublication->id;

                    $datas['type_publication_name'] = $typePublication->name;

                    $datas['type_publication_slug'] = $typePublication->slug;

                    $datas['category_id'] = $datas['category']['0']['id'];

                    $datas['category_name'] = $datas['category']['0']['name'];

                    $datas['category_slug'] = $datas['category']['0']['slug'];

                    $datas['author_id'] = $datas['author']['id'];

                    $datas['author_name'] = $datas['author']['authorName'];

                    $datas['author_slug'] = $datas['author']['slug'];

                    $datas['user_id'] = auth()->user()->id;

                    $datas['presently'] = 1;

                    $datas['slug'] = Str::slug($datas['title']);

                    $datas['title_truncate'] = Str::words($datas["title"], 10, ' ...');

                    $date = Carbon::parse(now());

                    $mois_id = $date->format('m');

                    $year = $date->format('Y');

                    $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                    $date_name = $mois->month.' '.$year;

                    $datas['date_name'] =  $date_name;

                    $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                    if(!$verify_date_name){

                        InfosMonthYearPublication::create(['date_name' => $date_name]);

                    }

                    $publicationCreateData =  Publication::create($datas);

                    for ($i=0; $i<= count($datas['tag']) - 1; $i++ ){

                        $tag = PublicationTag::create([
                            'publication_id' => $publicationCreateData->id,
                            'tag_id' => $datas['tag'][$i]['id'],
                            'date_publish' => now(),

                        ]);

                        if($tag->count_publications === 0){

                            $tag->count_publications = 1;

                            $tag->update();

                        }else{

                            $tag->count_publications++;

                            $tag->update();

                        }
 
                    }

                    for ($i=1; $i<= count($datas['category']) - 1; $i++ ){

                        $datas['status'] = 0;

                        $datas['date_publish'] = now();

                        $datas['deja_citer'] = 1;

                        $datas['type_publication_id'] = $typePublication->id;

                        $datas['type_publication_name'] = $typePublication->name;

                        $datas['type_publication_slug'] = $typePublication->slug;

                        $datas['category_id'] = $datas['category'][$i]['id'];

                        $datas['category_name'] = $datas['category'][$i]['name'];

                        $datas['category_slug'] = $datas['category'][$i]['slug'];

                        $datas['author_id'] = $datas['author']['id'];

                        $datas['author_name'] = $datas['author']['authorName'];

                        $datas['author_slug'] = $datas['author']['slug'];

                        $datas['user_id'] = auth()->user()->id;

                        $datas['presently'] = 1;

                        $datas['slug'] = Str::slug($datas['title']);

                        $datas['title_truncate'] = Str::words($datas["title"], 10, ' ...');

                        $date = Carbon::parse(now());

                        $mois_id = $date->format('m');

                        $year = $date->format('Y');

                        $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                        $date_name = $mois->month.' '.$year;

                        $datas['date_name'] =  $date_name;

                        $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                        if(!$verify_date_name){

                            InfosMonthYearPublication::create(['date_name' => $date_name]);

                        }

                        $publicationCreateData =  Publication::create($datas);

                        for ($i=0; $i<= count($datas['tag']) - 1; $i++ ){

                            $tag = PublicationTag::create([
                                'publication_id' => $publicationCreateData->id,
                                'tag_id' => $datas['tag'][$i]['id'],
                                'date_publish' => now(),
    
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

                    if($publicationCreateData){

                        return $this->sendResponse(['publicationCreateData' => $publicationCreateData, 'status' => 200], 'Publication enregistrée.');

                    }else{

                        return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette publication.');

                    }

                }

            }
        }
    }
}
