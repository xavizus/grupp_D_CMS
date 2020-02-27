<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ourAwesomeTheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri();?>/css/bootstrap.min.css">
	<script src="<?= get_stylesheet_directory_uri();?>/js/jquery.js"></script>
	<script src="<?= get_stylesheet_directory_uri();?>/js/bootstrap.min.js"></script>
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site container">
		<a class="skip-link screen-reader-text"
			href="#content"><?php esc_html_e( 'Skip to content', 'ourawesometheme' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$ourawesometheme_description = get_bloginfo( 'description', 'display' );
			if ( $ourawesometheme_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $ourawesometheme_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<a class="navbar-brand" href="#">Navbar</a>
					<?php
        wp_nav_menu( array(
            'theme_location'    => 'ourawesomemenu',
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
		) );
			?>
				</div>
			</nav>
		</header><!-- #masthead -->

		<div id="content" class="site-content">