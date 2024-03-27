<div class="navbar-top d-none d-lg-block bg-dark">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white px-2 fs-5" href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-2 fs-5" href="https://twitter.com/Togoactualite" target="_blank"><i class="fab fa-twitter-square"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-2 fs-5" href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-2 fs-5" href="https://youtube.com" target="_blank"><i class="fab fa-youtube-square"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white ps-2 pe-0 fs-5"  href="https://wa.link/qf0v9s" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </li>
                </ul>
            </div>
            <!-- Top bar left -->
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-white ps-0" href="/about">Qui sommes nous ?</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="/publicites">Publicités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/forum">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white ps-0" href="/contact">Contactez Nous</a>
                </li>
                <li class="nav-item">
                    <span id="in_first_menu"></span>
                </li>
            </ul>
            <div>
                <p class="mb-0 text-white">{{ \Carbon\Carbon::now()->isoFormat('LL') }}</p>
            </div>
            <!-- Top bar right -->
            <div class="d-flex align-items-center">
                <!-- Dark mode switch -->
                <div class="modeswitch" id="darkModeSwitch">
                    <div class="switch"></div>
                </div>
            </div>
        </div>
        <!-- Divider -->
			<div class="border-bottom border-secondary opacity-2"></div>
    </div>
</div>