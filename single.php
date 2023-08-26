<?php get_header(); ?>

<div class="container mt-5 content-container">

    <?php
    $layout = get_theme_mod('bootstrap_ultra_single_layout', 'sidebar');   
    if ($layout == 'sidebar') :
        echo '<div class="row">';
        echo '<div class="col-lg-8">';
    endif;
    ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card mb-4">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <div class="card-text"><?php the_content(); ?></div>
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
		
		<!-- Comments Section -->
		<div class="comments-section mt-5">
			<?php 
			if (comments_open() || get_comments_number()) :
				comments_template();
			else:
				$comments = get_comments(array(
					'post_id' => get_the_ID(),
					'status' => 'approve',
				));
				foreach($comments as $comment) :
			?>
				<div class="comment">
					<div class="comment-avatar">
						<?php echo get_avatar($comment->comment_author_email, 64); ?>
					</div>
					<div class="comment-content">
						<div class="comment-author">
							<?php echo $comment->comment_author; ?>
						</div>
						<div class="comment-text">
							<?php echo $comment->comment_content; ?>
						</div>
					</div>
				</div>
			<?php 
				endforeach;
			endif;
			?>
		</div>

    <?php endwhile; else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'bootstrap-ultra'); ?></p>
    <?php endif; ?>

    <?php
    if ($layout == 'sidebar') :
        echo '</div>'; // Close col-lg-8
        echo '<div class="col-lg-4">';
        get_sidebar();
        echo '</div>'; // Close col-lg-4
        echo '</div>'; // Close row
    endif;
    ?>

</div>

<?php get_footer(); ?>
