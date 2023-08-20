<?php get_header(); ?>

<div class="container mt-5">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>

            <!-- Display Tags -->
            <div class="post-tags mt-3">
                <?php the_tags('<span class="tag-label">Tags:</span> ', ', ', ''); ?>
            </div>
		</div>

        <!-- Comments Section -->
        <div class="comments-section mt-5">
            <?php 
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>

    <?php endwhile; else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'bootstrap-ultra'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
