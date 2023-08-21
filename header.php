<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header>
        <?php $theme_style = get_theme_mod('theme_style', 'light'); ?>
		<nav class="navbar navbar-expand-lg navbar-<?php echo $theme_style; ?> bg-<?php echo $theme_style; ?>">
			<div class="container">
				<?php
				if (has_custom_logo()) {
					the_custom_logo();
				} else {
					echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name');
                    if (display_header_text()) { // Check if the tagline should be displayed
                        echo '<small class="d-block">' . get_bloginfo('description') . '</small>';
                    }
                    echo '</a>';
				}
				?>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'navbar-nav mx-auto mb-2 mb-lg-0', // Changed me-auto to mx-auto
						'fallback_cb' => 'default_menu',
						'walker' => new bootstrap_5_wp_nav_menu_walker(),
					));
					?>
                    <!-- Adding the search form to the right -->
                    <form class='d-flex' action='<?php echo esc_url(home_url('/')); ?>' method='get'>
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="s" id="search" value="<?php the_search_query(); ?>">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
				</div>
			</div>
		</nav>
    </header>
	
<div class="container mt-3 breadcrumbs">
    <?php bootstrap_ultra_breadcrumbs(); ?>
</div>

