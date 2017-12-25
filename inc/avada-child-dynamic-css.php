<?php
/**
 * Filter for dynamic css
 * Format of the $css array:
 * $css['media-query']['element']['property'] = value
 *
 * If no media query is required then set it to 'global'
 *
 * If we want to add multiple values for the same property then we have to make it an array like this:
 * $css[media-query][element]['property'][] = value1
 * $css[media-query][element]['property'][] = value2
 *
 * For watch which media_query exists see Avada/includes/dynamic_css.php:3740
 * @param $css
 *
 * @return mixed
 */
function avada_child_dynamic_css($css) {
	// $css['global']['body']['opacity'] = 0;
	$dynamic_css = Fusion_Dynamic_CSS::get_instance();
	$dynamic_css_helpers = $dynamic_css->get_helpers();
	$css['global']['.fusion-copyright-content']['max-width'] = Avada()->settings->get('site_width');
	return $css;
}
add_filter( 'avada_dynamic_css_array', 'avada_child_dynamic_css');