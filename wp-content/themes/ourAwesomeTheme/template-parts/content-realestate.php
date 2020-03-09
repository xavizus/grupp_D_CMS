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

foreach ($metaData as $data) {
    $key = $data;
    $$key = get_post_meta(get_the_ID(), $data,true);
}

?>

        <?php $featured_img_url=get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
        <div class="card col-6 py-2 my-1">
            <img class="card-img-top mt-1" src="<?php echo $featured_img_url ?>" alt="">
            <div class="card-body">
				<h4 class="card-title"><?php the_title(); ?></h4>
				<hr>
               
                <p class="card-text"><?=$address?></p>
                <p class="card-text"><?=$zipcode?></p>
                <p class="card-text"><?=$city?></p>
                <p class="card-text"><?=$showdate?></p>
                <p class="card-text"><?=$noofrooms?></p>
                <p class="card-text"><?=$kvm?></p>
                <p class="card-text"><?=$initialbid?></p>
                <a href="<?= esc_url( get_permalink() ) ?>" class="btn btn-success btn-block">View property</a>
               
            </div>
        </div>