<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ourAwesomeTheme
 */

get_header();
?>

<div id="primary" class="content-area mt-5">
	<main id="main" class="site-main contentBG container about">
		<div class="row">
			<?php
			$size = is_active_sidebar('sidebar-1') ? "col-9" : "col-12";
			?>
			<div class="<?= $size ?>">
				<div class="row <?= $size ?> m-1">
					<?php
					while (have_posts()) :
						the_post();

						get_template_part('template-parts/content', 'page');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
			<div class="col-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
		<div class="row">
			<?php get_footer(); ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->