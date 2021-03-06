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
    "selecteditem"
);

foreach ($metaData as $data) { 
    $key = $data;
    $$key = get_post_meta(get_the_ID(), $data,true);
}

        $featured_img_url=get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
        <div class="card col-6 py-2 my-1">
        <div class="item">
                <img class="card-img-top mt-1" src="<?php echo $featured_img_url ?>" alt="">
                <?php if($selecteditem): ?>
                <span class="notify-badge">Utvald fastighet!</span>

                <?php endif; ?>
            </div>
            <div class="card-body">
				<h4 class="card-title"><?php the_title(); ?></h4>
				<hr>
               
                <p class="card-text"> Adress: <?=$address?></p>
                <p class="card-text"> Postnr: <?=$zipcode?> <?=$city?></p>
                <p class="card-text"> Visningsdatum: <?=$showdate?></p>
                <p class="card-text"> Antal rum: <?=$noofrooms?> rum</p>
                <p class="card-text"> Storlek: <?=$kvm?> kvm</p>
                <p class="card-text"> Utgångspris: <?=$initialbid?> SEK</p>
                <a href="<?= esc_url( get_permalink() ) ?>" class="btn btn-success btn-block">Visa bostaden</a>
               
            </div>
</div>