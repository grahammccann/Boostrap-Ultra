<?php $theme_style = get_theme_mod('theme_style', 'light'); ?>

<footer class="bg-<?php echo $theme_style; ?> py-4 text-<?php echo ($theme_style == 'light') ? 'dark' : 'light'; ?>">
    <div class="container">
        <p class="text-center mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. Powered by <a href="https://wordpress.org/" class="text-<?php echo ($theme_style == 'light') ? 'dark' : 'light'; ?>">WordPress</a>.</p>
        <p class="text-center">Theme "Bootstrap Ultra" created by <a href="<?php echo esc_url(get_theme_mod('bootstrap_ultra_theme_creator_link', 'https://www.gm-seo-services.com/')); ?>" target="_blank" rel="noopener noreferrer"><strong>Graham McCann</strong></a>.</p>
        <p class="text-center">Theme licensed under the <a href="<?php echo esc_url(get_theme_mod('bootstrap_ultra_license_link', 'http://www.gnu.org/licenses/gpl-2.0.html')); ?>" class="text-<?php echo ($theme_style == 'light') ? 'dark' : 'light'; ?>">GNU General Public License v2 or later</a>.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>