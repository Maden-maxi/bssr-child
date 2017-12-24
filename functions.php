<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

remove_action( 'avada_header', 'avada_secondary_header', 10 );

function print_menu_shortcode($atts, $content = null) {
	$atts =  shortcode_atts(array(
		'name' => 'Footer Menu',
		'menu_class' => 'fusion-footer-menu',
		'menu_id' => '',
		'container' => '',
		'container_class' => '',
		'container_id' => '',
		'link_before' => '',
		'link_after' => '',
	), $atts);

	return wp_nav_menu( array(
		'menu' => $atts['name'],
		'menu_class' => $atts['menu_class'],
		'menu_id' => $atts['menu_id'],
		'container' => $atts['container'],
		'container_class' => $atts['container_class'],
		'container_id' => $atts['container_id'],
		'link_before' => $atts['link_before'],
		'link_after' => $atts['link_after'],
		'echo' => false
	) );
}
add_shortcode('menu', 'print_menu_shortcode');