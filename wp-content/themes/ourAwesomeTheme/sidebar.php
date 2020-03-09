<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ourAwesomeTheme
 */
if ( ! is_active_sidebar( 'sidebar-1' ) && !is_home()) {
	return;
}
?>
<aside id="secondary">
	<?php dynamic_sidebar( 'sidebar-1' ); 
		if(is_home()) {
			get_search_form();
		}
	?>
	
</aside><!-- #secondary -->
