<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ourAwesomeTheme
 */

get_header();
?>

<div id="primary" class="content-area mt-5">
	<main id="main" class="site-main contentBG container">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
		<?php
			endif;
		?>
		<div class="row">
		<?php $size = is_active_sidebar( 'sidebar-1' )? "col-sm-9" : "col-sm-12"; ?>
			<div class="<?=$size?>">
				<div class="row">


					<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

				</div>
				<div class="row m-2 justify-content-center">
		<?php wpbeginner_numeric_posts_nav(); ?>
		</div>
			</div>
			<div class="col-3">
				<?php
					get_sidebar();
				?>
			</div>
			
		</div>
		<div class="row">
		<?php get_footer(); ?>
	</div>
	</main><!-- #main -->
</div><!-- #primary -->