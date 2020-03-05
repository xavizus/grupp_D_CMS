<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ourAwesomeTheme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			
			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(); ?>

			<p><?php 
			echo get_post_meta(get_the_ID(), 'address', $single = true); ?> <?php
			echo get_post_meta(get_the_ID(), 'zipcode', $single = true); ?> <?php
			echo get_post_meta(get_the_ID(), 'city', $single = true); ?><br><?php
			echo get_post_meta(get_the_ID(), 'noofrooms', $single = true); ?> rooms, <?php
			echo get_post_meta(get_the_ID(), 'kvm', $single = true); ?>kvm<br>
			utgångspris: <?php echo get_post_meta(get_the_ID(), 'initialbid', $single = true); ?>kr<br>
			visningsdatum: <?php echo get_post_meta(get_the_ID(), 'showdate', $single = true); ?>
			</p>
			
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
