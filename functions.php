<?php

function theme_enqueue_styles() {

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );

    $assets_uri = get_stylesheet_directory_uri() . '/assets/css/';
    $assets_path = get_stylesheet_directory() . '/assets/css/';
    $css_files = scandir($assets_path);

    foreach ($css_files as $css_file) {
        if ($css_file == '.' || $css_file == '..') {
            continue;
        }
	    wp_enqueue_style(
	            'child-' . str_replace('.css', '', $css_file),
		    $assets_uri . $css_file,
                array( 'child-style' )
        );
    }

    /*wp_enqueue_style( 'child-widget', get_stylesheet_directory_uri() . '/assets/css/widget.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-logo', get_stylesheet_directory_uri() . '/assets/css/logo.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-fonts', get_stylesheet_directory_uri() . '/assets/css/font.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-footer-menu', get_stylesheet_directory_uri() . '/assets/css/footer-menu.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-search-form', get_stylesheet_directory_uri() . '/assets/css/search-form.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-footer', get_stylesheet_directory_uri() . '/assets/css/footer.css', array( 'child-style' ) );
	wp_enqueue_style( 'child-footer', get_stylesheet_directory_uri() . '/assets/css/footer.css', array( 'child-style' ) );*/
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

require_once('inc/avada-child-dynamic-css.php');
function avada_child_title_tag_line() {
	?>
	<div class="avada-child-site-logo">
		<h1 class="avada-child-site-name"><?php bloginfo('name') ?></h1>
		<?php if (is_home() || is_front_page()): ?>
			<h2 class="avada-child-site-description"><?php bloginfo('description') ?></h2>
		<?php else: ?>
			<p class="avada-child-site-description"><?php bloginfo('description') ?></p>
		<?php endif; ?>
	</div>
	<?php
}
add_action( 'avada_logo_append', 'avada_child_title_tag_line' );