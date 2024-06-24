@extends('layouts.frontoffice_base')

@section('title') {{ $category->name }} @endsection

@section('content')


    @include('includes.header')

        <!-- **************** MAIN CONTENT START **************** -->
        <main style="margin-top: -20px; margin-bottom: -20px">

            <!-- =======================Inner intro START -->
            <section class="pt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-primary bg-opacity-10 p-4 p-md-5 rounded-3 text-center">
                                <h1 class="text-primary">{{ $category->name }}</h1>
                                <nav class="d-flex justify-content-center" aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-dots m-0">
                                        <li class="breadcrumb-item"><a href="/"><i class="bi bi-house me-1"></i>Accueil</a></li>
                                        <li class="breadcrumb-item active"> {{ $category->slug }} </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- =======================
            Inner intro END -->
            <!-- =======================Inner intro END -->

            <!-- =======================Main content START -->
            <!-- =======================Main content START -->
        <section class="position-relative pt-0">
                <div class="container" data-sticky-container>

                    @if (count($articles) == 0)

                        <section class="overflow-hidden">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9 text-center mx-auto my-0 my-md-5 py-0 py-lg-5 position-relative z-index-9">
                                        <!-- SVG shape START -->
                                        <figure class="position-absolute top-50 start-50 translate-middle opacity-7 z-index-n9">
                                            <svg width="650" height="379" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"  viewBox="0 0 510 297">
                                                <g>
                                                <path class="fill-primary opacity-1" d="M121,147.4c0,6-4.8,10.8-10.8,10.8H47.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V147.4z"/>
                                                <path class="fill-primary opacity-1" d="M179.4,90.2c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V78.7c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V90.2z"/>
                                                <path class="fill-primary opacity-1" d="M459.1,26.3c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V14.8c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V26.3z"/>
                                                <path class="fill-primary opacity-1" d="M422.1,66.9c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V55.3c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V66.9z"/>
                                                <path class="fill-primary opacity-1" d="M275.8,282.6c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V282.6z"/>
                                                <path class="fill-primary opacity-1" d="M87.7,42.9c0,5.9-4.8,10.8-10.8,10.8H14.3c-6,0-10.8-4.8-10.8-10.8V31.4c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V42.9z"/>
                                                <path class="fill-primary opacity-1" d="M505.9,123.4c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V123.4z"/>
                                                <path class="fill-primary opacity-1" d="M482.5,204.9c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                                c5.9,0,10.8,4.8,10.8,10.8V204.9z"/>
                                                <path class="fill-primary opacity-1" d="M408.3,258.8c0,5.9-4.8,10.8-10.8,10.8H335c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V258.8z"/>
                                                <path class="fill-primary opacity-1" d="M147,252.5c0,5.9-4.8,10.8-10.8,10.8H73.6c-6,0-10.8-4.8-10.8-10.8V241c0-5.9,4.8-10.8,10.8-10.8h62.6
                                                c6,0,10.8,4.8,10.8,10.8V252.5z"/>
                                                </g>
                                            </svg>
                                        </figure>
                                        <h1 class="display-1 text-primary">Aucun</h1>
                                        <p>Aucun article n'a été publié pour la categorie {{ $category->name }}</p>
                                        <a href="/" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Page d'acceuil</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                    @else
                        <div class="row">
                            <!-- Main Post START -->
                            <div class="col-lg-8">
                                <div class="row gy-4">
                                    @foreach ($articles as $result )

                                        <div class="col-sm-6 col-lg-6 grid-item business-category">
                                            <div class="card">
                                                <!-- Card img -->
                                                <div class="position-relative">
                                                    <img class="card-img" src="https://togoactualite.com/wp-content/{{$result->og_file_url}}" style="height: 260px; width: 550px ; object-fit: cover" alt="{{ $result->title }}">

                                                </div>
                                                <div class="card-body px-0 pt-3">
                                                    <h5 class="card-title"><a href="/{{$result->slug}}" class="btn-link text-reset fw-bold"> {!! $result->title !!} </a></h5>                                        <!-- Card info -->
                                                    <div>
                                                        <div>{!! $result->truncate_content !!}</div>
                                                    </div>
                                                    <ul class="nav nav-divider align-items-center  d-sm-inline-block">
                                                        <li class="nav-item">
                                                            <div class="nav-link">
                                                                <div class="d-flex align-items-center position-relative">
                                                                    <div class="avatar avatar-xs">
                                                                        <div class="avatar-img rounded-circle bg-success">
                                                                            <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ strtoupper($result->author_name[0].''.$result->author_name[1]) }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <span class="ms-3">par  <a href="/authors/{{$result->author_slug}}" class="stretched-link text-reset btn-link">{{ $result->author_name }}</a></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item">{{ date('d/m/Y', strtotime($result->date_publish) )}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <br> <br>
                                {{ $articles->links() }}

                            </div>
                            <div class="col-lg-4 mt-5 mt-lg-0">
                                <div data-sticky data-margin-top="80" data-sticky-for="767">

                                    <div class="row g-2 mb-2">
                                        <!-- Facebook -->
                                        <div class="col-6 col-sm-3">
                                            <a href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank" class="bg-facebook rounded text-center text-white-force p-3 d-block">
                                            <i class="fab fa-facebook-square fs-5 mb-2"></i>
                                            <h6 class="m-0">1.5K</h6>
                                            <span class="small">Abonnés</span>
                                            </a>
                                        </div>
                                        <!-- Twitter -->
                                        <div class="col-6 col-sm-3">
                                            <a href="https://x.com/Togoactualite" target="_blank" class="bg-dark rounded text-center text-white-force p-3 d-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x fs-5 mb-2" viewBox="0 0 16 16">
                                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                            </svg>
                                            <h6 class="m-0">5K</h6>
                                            <span class="small">abonnés</span>
                                            </a>
                                        </div>
                                        
                                        <!-- Whatsapp -->
                                        <div class="col-6 col-sm-3">
                                            <a href="https://wa.link/qf0v9s" target="_blank" class="bg-success rounded text-center text-white-force p-3 d-block">
                                            <i class="fab fa-whatsapp fs-5 mb-2"></i>
                                            <h6 class="m-0">Nous</h6>
                                            <span class="small">Joindre</span>
                                            </a>
                                        </div>
                                        
                    
                                        <!-- Linkedin -->
                                        <div class="col-6 col-sm-3">
                                            <a href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank" class="bg-linkedin rounded text-center text-white-force p-3 d-block">
                                            <i class="fab fa-linkedin fs-5 mb-2"></i>
                                            <h6 class="m-0">1.8K</h6>
                                            <span class="small">Abonnés</span>
                                            </a>
                                        </div>
                                       
                                    </div>

                                    <!-- Categories -->
                                    <div class="row g-2">
                                        <h5>Catégories populaires</h5>
                                        @for ($i=0; $i<= count($otherCategory) - 1; $i++ )

                                            @if ( $i == 4)

                                                <div class="d-flex justify-content-between align-items-center bg-warning bg-opacity-15 rounded p-2 position-relative">
                                                    <h6 class="m-0 text-warning">{{$otherCategory[$i]['name']}}</h6>
                                                    <a href="/{{ $otherCategory[$i]['slug'] }}" class="badge bg-warning text-dark stretched-link">{{$otherCategory[$i]['count']}}</a>
                                                </div>

                                            @endif

                                            @if ( $i == 10)

                                                <div class="d-flex justify-content-between align-items-center bg-success bg-opacity-15 rounded p-2 position-relative">
                                                    <h6 class="m-0 text-light">{{$otherCategory[$i]['name']}}</h6>
                                                    <a href="/{{ $otherCategory[$i]['slug'] }}" class="badge bg-success text-light stretched-link">{{$otherCategory[$i]['count']}}</a>
                                                </div>

                                            @endif

                                            @if ( $i == 9)

                                                <div class="d-flex justify-content-between align-items-center bg-primary bg-opacity-15 rounded p-2 position-relative">
                                                    <h6 class="m-0 text-primary">{{$otherCategory[$i]['name']}}</h6>
                                                    <a href="/{{ $otherCategory[$i]['slug'] }}" class="badge bg-primary text-light stretched-link">{{$otherCategory[$i]['count']}}</a>
                                                </div>

                                            @endif

                                            @if ( $i == 19)

                                                <div class="d-flex justify-content-between align-items-center bg-linkedin bg-opacity-15 rounded p-2 position-relative">
                                                    <h6 class="m-0 text-light">{{$otherCategory[$i]['name']}}</h6>
                                                    <a href="/{{ $otherCategory[$i]['slug'] }}" class="badge bg-linkedin text-light stretched-link">{{$otherCategory[$i]['count']}}</a>
                                                </div>

                                            @endif

                                            @if ( $i == 20)

                                                <div class="d-flex justify-content-between align-items-center bg-danger bg-opacity-15 rounded p-2 position-relative">
                                                    <h6 class="m-0 text-danger">{{$otherCategory[$i]['name']}}</h6>
                                                    <a href="/{{ $otherCategory[$i]['slug'] }}" class="badge bg-danger text-light stretched-link">{{$otherCategory[$i]['count']}}</a>
                                                </div>

                                            @endif


                                        @endfor
                                        <div class="text-center mt-3">
                                            <a href="/all-category" class="fw-bold text-body text-primary-hover"><u>Voir toutes les catégories</u></a>
                                        </div>

                                        <!-- Most read -->
                                        <div>
                                            <br>
                                            <br>
                                            <h5 class="mb-3">A LIRE AUSSI </h5>
                                            <div class="tiny-slider dots-creative mt-3 mb-1">
                                                <div class="tiny-slider-inner"
                                                    data-autoplay="true"
                                                    data-hoverpause="true"
                                                    data-gutter="0"
                                                    data-arrow="false"
                                                    data-dots="true"
                                                    data-items="1">

                                                    @foreach ($alireaussi as  $result)

                                                        <!-- Card item START -->
                                                    <div class="card">
                                                        <!-- Card img -->
                                                        <div class="position-relative">
                                                            <img class="card-img" src="https://togoactualite.com/wp-content/{{ $result->og_file_url }}" style="height: 230px; width: 550px ; object-fit: cover" alt="{{ $result->title }}">
                                                            <div class="card-img-overlay d-flex align-items-start flex-column p-3">

                                                                <!-- Card overlay bottom -->
                                                                <div class="w-100 mt-auto">
                                                                    <a href="/{{$result->category_slug}}" class="badge text-bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$result->category_name}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-0 pt-3">
                                                            <h6 class="card-title"><a href="/{{$result->slug}}" class="btn-link text-reset fw-bold">{!! $result->title !!}</a></h6>
                                                        </div>
                                                    </div>
                                                    <!-- Card item END -->

                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>

                                        <!-- Advertisement -->
                                        <div class="mt-4">
                                            <a href="#" class="d-block card-img-flash">
                                                <img src="/assets/images/adv.png" alt="">
                                            </a>
                                        </div>

                                        <!-- Right sidebar END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
        </section>
        </main>

    @include('includes.footer')

@endsection
