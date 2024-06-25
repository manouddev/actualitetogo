@extends('layouts.frontoffice_base')

@section('title') Accueil @endsection

@section('content')

    @include('includes.header')

    <main>

        <section class="position-relative" style="margin-top: -45px; margin-bottom: -25px">

            @include('sectionHomePage.alaUne.alaUne')

        </section>

        {{-- <div id="home_page"></div> --}}

        <section class="position-relative" style="margin-top: -95px; margin-bottom: -25px">

            @include('sectionHomePage.toutelActualite.toutelActualite')

        </section>

    </main>
    @include('includes.footer')

@endsection
