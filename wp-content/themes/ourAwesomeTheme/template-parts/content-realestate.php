<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ourAwesomeTheme
 */

$metaData = array(
    "address",
    "zipcode",
    "city",
    "showdate",
    "noofrooms",
    "kvm",
    "initialbid",
    "selecteditems"
);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php

        if (!is_home()) :
		    if ( is_singular() ) :
			    the_title( '<h1 class="entry-title">', '</h1>' );
		    else :
			    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		    endif;
		?>
			<div class="entry-meta">
				<?php
				ourawesometheme_posted_on();
				ourawesometheme_posted_by();
				?>
			</div><!-- .entry-meta -->
        <!-- if home header: -->
        <?php else : ?>



		<?php endif;
		     foreach ($metaData as $data) {
				$key = $data;
				$$key = get_post_meta(get_the_ID(), $data,true);
			}
		?>
        <!-- end if home header -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if (!is_home()) :
			
	ourawesometheme_post_thumbnail();

		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ourawesometheme' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
        ) );
        
   

        echo "Rummet är " . $kvm . " kvm stort <br>";
        echo "Fastigheten finns på adressen: $address <br>";
        echo "Fastigheten har $noofrooms rum";

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ourawesometheme' ),
			'after'  => '</div>',
        ) );
        ?>

        <!-- is home content -->
        <?php else:?>
  <div class="row justify-content-between d-flex">
 
    <?php $featured_img_url=get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
    <div class="col-lg-4">
      <div class="card mb-2">
        <img class="card-img-top" src="<?php echo $featured_img_url ?>" alt="">
        <div class="card-body">
          <h4 class="card-title"><?php the_title(); ?></h4>
		  <p class="card-text"></p>
		  <p class="card-text"><?=$address?></p>
		  <p class="card-text"><?=$zipcode?></p>
		  <p class="card-text"><?=$city?></p>
		  <p class="card-text"><?=$showdate?></p>
		  <p class="card-text"><?=$noofrooms?></p>
		  <p class="card-text"><?=$kvm?></p>
		  <p class="card-text"><?=$initialbid?></p>
	

);

          <a href="#" class="solid-btn">View</a>
        </div>
      </div>
   
  
   
  </div>
</div> <!-- .container -->

        <?php
        endif;
        ?>´
        <!-- is home conten end -->
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ourawesometheme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
