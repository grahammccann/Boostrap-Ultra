<?php if (is_active_sidebar('main-sidebar')) : ?>
    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
        <div class="card mb-4">
            <div class="card-body">
                <?php dynamic_sidebar('main-sidebar'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>