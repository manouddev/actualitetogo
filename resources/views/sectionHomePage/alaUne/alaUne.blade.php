
    <!-- SVG decoration right START -->
    <div class="container">
        <div class="row">
			<div class="col-md-12">
                <div class="d-flex mb-1">
                    <div>
                        <img src="/assets/images/Icones_formes/Icones-TAAsset-78.png" class="alaune_logo" alt="alaune_logo">
                    </div>
                    <div>&nbsp; &nbsp; &nbsp;</div>
                    <div>
                        <h2 class="text-success m-0 alaune_title">A LA UNE</h2>
                        <p>Suivez nos actualités à la une.</p>
                    </div>
                </div>
				<!-- Title -->

            </div>
        </div>
        <div class="row g-4 ">
            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">

                <div class="row g-0">
                    <div class="col-12 bg-primary bg-opacity-10 p-2 rounded">
                        <div class="d-sm-flex align-items-center text-center text-sm-start">
                            <!-- Title -->

                            @if(count($annonces) !== 0)
                                <div class="me-3">
                                    <span class="badge bg-primary p-2 px-3">Annonces:</span>
                                </div>
                                <!-- Slider -->
                                <div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
                                    <div class="tiny-slider-inner"
                                        data-autoplay="true"
                                        data-hoverpause="true"
                                        data-gutter="0"
                                        data-arrow="true"
                                        data-dots="false"
                                        data-items="1">
                                        <!-- Slider items -->
                                        @foreach($annonces as $result)
                                            <div>  <a href="#" class="text-reset btn-link" style="margin-top: 8px; margin-bottom: -10px;"> {!! $result->title !!} </a> </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else

                                <div class="me-3">
                                    <span class="badge bg-primary p-2 px-3">Tendances:</span>
                                </div>
                                <!-- Slider -->
                                <div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
                                    <div class="tiny-slider-inner"
                                        data-autoplay="true"
                                        data-hoverpause="true"
                                        data-gutter="0"
                                        data-arrow="true"
                                        data-dots="false"
                                        data-items="1">
                                        <!-- Slider items -->
                                        @foreach($tendances as $result)
                                            <div>  <a href="#" class="text-reset btn-link"> {!! $result->title !!} </a></div>
                                        @endforeach

                                    </div>
                                </div>

                            @endif()
                        </div>
                    </div>
                </div> <!-- Row END -->

                <!-- SVG decoration right START -->
            </div>
        </div>
        <div class="row g-4 ">
            <div class="col-lg-7 col-sm-12 col-xs-12">
                @include('sectionHomePage.alaUne.sections.alaUneFirstSection')
            </div>
            <div class="col-lg-5 col-sm-12 col-xs-12">
                @include('sectionHomePage.alaUne.sections.alaUneSecondSection')
            </div>
        </div>
