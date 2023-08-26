<?php get_header(); ?>

<div class="container mt-5">

    <header class="search-header">
        <h1 class="search-title">
            <?php printf(esc_html__('Search Results for: %s', 'bootstrap-ultra'), '<span>' . get_search_query() . '</span>'); ?>
        </h1>
    </header>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card mb-4">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Read More</a>
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
        <p><?php _e('Sorry, no posts matched your search criteria.', 'bootstrap-ultra'); ?></p>
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
