<?php get_header(); ?>

<div class="container mt-5 content-container">

    <div class="row">
        <!-- Main Content -->
        <?php 
        // Check the layout choice
        $layout = get_theme_mod('bootstrap_ultra_index_layout', 'sidebar');
        $content_class = ($layout == 'full-width') ? 'col-lg-12' : 'col-lg-8';
        ?>
        <div class="<?php echo $content_class; ?>">
            
            <!-- Sticky Post -->
            <?php 
            $sticky = get_option('sticky_posts');
            $args = array(
                'posts_per_page' => 1,
                'post__in'  => $sticky,
                'ignore_sticky_posts' => 1
            );
            $query = new WP_Query($args);
            if (isset($sticky[0])): 
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="card bg-dark text-white mb-4">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-light">Read More</a>
                        </div>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
            endif; ?>

            <!-- Recent Posts -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('full'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p class="card-text"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on <?php the_date(); ?> by <?php the_author(); ?> | <?php comments_number(); ?>
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

        <!-- Sidebar -->
        <?php if ($layout != 'full-width') : ?>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>