<?php get_header(); ?>

<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-1">404</h1>
        <p class="lead">Oops! That page can't be found.</p>
		<p>It looks like nothing was found at this location. Maybe try a search or go back to the <a href='<?php echo esc_url(home_url()); ?>'>homepage</a>?</p>

		<form method='get' class='search-form' action='<?php echo esc_url(home_url('/')); ?>'>
			<?php get_search_form(); ?>
		</form>
		
    </div>
</div>

<?php get_footer(); ?>