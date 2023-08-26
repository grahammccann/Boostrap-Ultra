<?php get_header(); ?>

<div class="container mt-5">
    <header class="archive-header">
        <h1 class="archive-title">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                the_post();
                echo 'Author Archives: ' . get_the_author();
                rewind_posts();
            } elseif (is_day()) {
                echo 'Daily Archives: ' . get_the_date();
            } elseif (is_month()) {
                echo 'Monthly Archives: ' . get_the_date('F Y');
            } elseif (is_year()) {
                echo 'Yearly Archives: ' . get_the_date('Y');
            } else {
                echo 'Archives';
            }
            ?>
        </h1>
    </header>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p class="card-text"><?php the_excerpt(); ?></p>
            </div>
				<div class="card-footer text-muted card-footer-muted-blue">
					<span class="badge badge-light">Posted on <?php the_date(); ?></span>
					<span style="color: red; font-weight: bold;"> | </span>
					<span class="badge badge-secondary">by <?php the_author(); ?></span>
					<span style="color: red; font-weight: bold;"> | </span>
					<?php 
					comments_number('<span class="badge badge-primary">No <strong>Comments</strong></span>', '<span class="badge badge-primary">1 <strong>Comment</strong></span>', '<span class="badge badge-primary">% <strong>Comments</strong></span>'); 
					?>
				</div>
        </div>
    <?php endwhile; else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'bootstrap-ultra'); ?></p>
    <?php endif; ?>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><?php previous_posts_link('&laquo; Newer Posts'); ?></li>
            <li class="page-item"><?php next_posts_link('Older Posts &raquo;'); ?></li>
        </ul>
    </nav>
</div>

<?php get_footer(); ?>