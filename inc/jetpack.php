<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package inku
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function inku_jetpack_setup() {

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'inku_infinite_scroll_render',
		'footer'    => false,
	) );

	if ( class_exists( 'Jetpack' ) ) {
		//Enable Custom CSS
        Jetpack::activate_module( 'custom-css', false, false );
        //Enable Contact Form
        Jetpack::activate_module( 'contact-form', false, false );
        //Enable Tiled Galleries
        Jetpack::activate_module( 'tiled-gallery', false, false );

        //Portfolio CPT
		add_theme_support( 'jetpack-portfolio' );
        Jetpack::activate_module( 'custom-content-types', false, false );
    }

} // end function inku_jetpack_setup
add_action( 'after_setup_theme', 'inku_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function inku_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function inku_infinite_scroll_render
