<footer class="bg-dark pt-3">
    <div class="container">
        <div class="row pt-3">

            @include('includes.modules_footer.logo')

            @include('includes.modules_footer.description')

            @include('includes.modules_footer.newsletter')

        </div>
        <!-- Divider -->
		<hr>

		<!-- Widgets START -->
		<div class="row pt-3">

            @include('includes.modules_footer.articles_popular')

            @include('includes.modules_footer.category_popular')

            @include('includes.modules_footer.socials_links')

            @include('includes.modules_footer.mobile_links_description')

        </div>
        @include('includes.modules_footer.tags_popular')
    </div>
    @include('includes.modules_footer.footer_menu')
</footer>

<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>
