@extends('layouts.frontoffice_base')

@section('title') Forum @endsection

@section('content')

    @include('includes.header')

    <main style="margin-top: -30px">
        <section class="position-relative">
            <div class="container" data-sticky-container>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="mb-4">
                            <h1 class="display-4">Forum</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

    @include('includes.footer')
    
@endsection