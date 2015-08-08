<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package sbmd
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function sbmd_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'sbmd_infinitesbmdcroll_render',
		'footer'    => 'page',
	) );
} // end function sbmd_jetpack_setup
add_action( 'after_setup_theme', 'sbmd_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function sbmd_infinitesbmdcroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function sbmd_infinitesbmdcroll_render
