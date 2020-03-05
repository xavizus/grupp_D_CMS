<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ourAwesomeTheme
 */
/*
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
*/
?>
<h2>Sidebar</h2>
<aside id="secondary" class="widget-area">
	<?php echo do_shortcode( '[searchandfilter fields="search,propertytype,post_date,noOfRooms" types=",,daterange" post_types="realestate"]' ); ?>
	<?php # dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
