<?php
namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\SenderMessage;
use App\Models\NewsLetter;
use App\Models\Tags;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IncludesController extends BaseController
{

    public function str_replace_all($search, $replace, $subject) {

        return str_replace($search, $replace, $subject);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function togoActualiteRequestData(){

        $togoactualiteDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 34)->count();

        if($togoactualiteDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de togoactualité n\'est publié.');

        }else if ($togoactualiteDataCount !== 0){

            $togoactualiteData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 34)
            ->orWhere("publications.category_id", 1)
            ->orWhere("publications.category_id", 2)
            ->orWhere("publications.category_id", 26)
            ->orWhere("publications.category_id", 33)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'togoactualiteData' =>  $togoactualiteData,
                'status' => 200
            ], 'Liste des articles de togoactualité publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rubriquesRequestData(){

        $rubriquesDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 27)->count();

        if($rubriquesDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de rubriques n\'est publié.');

        }else if ($rubriquesDataCount !== 0){

            $rubriquesData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 25)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'rubriquesData' =>  $rubriquesData,
                'status' => 200
            ], 'Liste des articles de rubriques publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function economieRequestData(){

        $economieDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 11)->count();

        if($economieDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de économie n\'est publié.');

        }else if ($economieDataCount !== 0){

            $economieData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 11)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'economieData' =>  $economieData,
                'status' => 200
            ], 'Liste des articles de économie publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function diasporaRequestData(){

        $diasporaDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 9)->count();

        if($diasporaDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de diaspora n\'est publié.');

        }else if ($diasporaDataCount !== 0){

            $diasporaData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 9)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'diasporaData' =>  $diasporaData,
                'status' => 200
            ], 'Liste des articles de diaspora publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function internationalRequestData(){

        $internationalDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 19)->count();

        if($internationalDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de international n\'est publié.');

        }else if ($internationalDataCount !== 0){

            $internationalData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 19)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'internationalData' =>  $internationalData,
                'status' => 200
            ], 'Liste des articles de international publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sportsRequestData(){

        $sportsDataCount = Publication::where("publications.visible", 1)->where("publications.status", 1)->where("publications.category_id", 30)->count();

        if($sportsDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucun article de sports n\'est publié.');

        }else if ($sportsDataCount !== 0){

            $sportsData = Publication::select(array("publications.id", "publications.content", "publications.truncate_content","publications.title", "publications.slug", "publications.date_publish" ,"publications.author_name", "publications.author_slug","publications.og_file_url"))
            ->where("publications.visible", 1)
            ->where("publications.status", 1)
            ->where("publications.category_id", 30)
            ->orderBy('publications.date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'sportsData' =>  $sportsData,
                'status' => 200
            ], 'Liste des articles de sports publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }

    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsletterStoreRequest(Request $request )
    {

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'email' => ['required','string', 'email', 'max:255', 'unique:news_letters'],
        ],[
            'required' => 'Votre :attribute est obligatoire.',
            'email.unique' => 'Cet :attribute est déjà enregistré.'
        ], [
            'email' => 'email',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        $datas['slug'] = Str::slug($datas['email']);

        $message = NewsLetter::create($datas);

        if($message){

            return $this->sendResponse(['message' => $message, 'status' => 200], 'Email enregistré.');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cet email.');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tagsRequestData()
    {
       $tags = Tags::where('visible', 1) ->orderBy('tags.count_publications', 'desc')->take(20)->get();

       return $this->sendResponse(['tagsPopularsData' => $tags, 'status' => 200], 'les mots clés populaires');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryRequestData(){

        $category = Category::where('visible', 1)->where('id', '!=', 34 )
        ->where('id', '!=', 27 )
        ->where('id', '!=', 27 )
        ->where('id', '!=', 25 )
        ->where('id', '!=', 5 )
        ->where('id', '!=', 10 )
        ->where('id', '!=', 11 )
        ->where('id', '!=', 9 )
        ->where('id', '!=', 23 )
        ->where('id', '!=', 3 )
        ->where('id', '!=', 15 )
        ->where('id', '!=', 16 )
        ->where('id', '!=', 19 )
        ->where('id', '!=', 30 )
        ->where('id', '!=', 31 )
        ->take(14)->get();

        $FirstSectionCategory = [$category[12], $category[1], $category[2], $category[3], $category[4], $category[5], $category[6]];

        $TwoSectionCategory = [$category[7], $category[8], $category[9],$category[11], $category[13]];

        return $this->sendResponse(['FirstSectionCategory' => $FirstSectionCategory, 'TwoSectionCategory' => $TwoSectionCategory ,'status' => 200], 'les catégories populaires');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function articlesRequestData(){

        $articles = Publication::where('visible', 1)->where('status', 1)->whereDate('date_publish', '>', '2022-12-31')->orderBy('views_count', 'desc')->take(2)->get();

        return $this->sendResponse(['articlesPopularsData' => $articles, 'status' => 200], 'les articles populaires');

    }

}
