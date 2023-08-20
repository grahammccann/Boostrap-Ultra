<div id="comments" class="comments-area mt-4">
    <?php if (have_comments()) : ?>
        <h4 class="comments-title mb-4">
            <?php
            $comment_count = get_comments_number();
            echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'bootstrap-ultra');
            ?>
        </h4>

        <ul class="list-unstyled">
            <?php
			wp_list_comments(array(
				'style'      => 'ul',
				'short_ping' => true,
				'avatar_size'=> 50,
				'format'     => 'html5',
				'callback'   => 'bootstrap_ultra_comment'
			));
            ?>
        </ul>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php if (!comments_open()) : ?>
        <p class="no-comments mt-3"><?php _e('Comments are closed.', 'bootstrap-ultra'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'           => 'comment-form', 
        'class_submit'         => 'submit btn btn-primary mt-3',     
        'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title mt-4">',
        'title_reply_after'    => '</h5>',
    ));
    ?>
</div>