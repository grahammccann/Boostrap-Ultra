<?php get_header(); ?>

<div class="container mt-5 content-container">

    <div class="row">
        <!-- Main Content -->
        <?php 
        // Check the layout choice for pages
        $layout = get_theme_mod('bootstrap_ultra_page_layout', 'sidebar');
        $content_class = ($layout == 'full-width') ? 'col-lg-12' : 'col-lg-8';
        ?>
        <div class="<?php echo $content_class; ?>">
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('card mb-4'); ?>>
                    <div class="card-body">
                        <h2 class="card-title"><?php the_title(); ?></h2>
                        <p class="card-text"><?php the_content(); ?></p>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <p><?php _e('Sorry, no page found.', 'bootstrap-ultra'); ?></p>
            <?php endif; ?>

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