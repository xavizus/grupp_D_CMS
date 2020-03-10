<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ourAwesomeTheme
 */

get_header();
?>

<section id="primary" class="content-area mt-5">
	<main id="main" class="site-main contentBG container">
		<?php if (have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf(esc_html__('Sökresultat: %s', 'ourawesometheme'), '<span>' . get_search_query() . '</span>');
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="row">
				<div class="col-9">
					<div class="row">

					<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part('template-parts/content', 'search');

					endwhile;

					the_posts_navigation();

				else :

					get_template_part('template-parts/content', 'none');

				endif;
					?>

					</div>
					<?php wpbeginner_numeric_posts_nav(); ?>
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
</section><!-- #primary -->
