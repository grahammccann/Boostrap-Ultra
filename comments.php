<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'bootstrap-ultra');
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php if (!comments_open()) : ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'bootstrap-ultra'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'           => 'comment-form polished-form', // Add custom class for styling
        'class_submit'         => 'submit btn btn-primary',     // Add Bootstrap classes
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
    ));
    ?>
</div>
