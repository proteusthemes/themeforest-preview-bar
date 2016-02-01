<?php
/**
 * Function which returns the url to the theme
 */
function site_url( $uri = '' ) {
	return BASE_URL . $uri;
}


/**
 * Helper to determine if we should load the analytics script
 * @param  array  $item
 * @return boolean
 */
function has_analytics( $item ) {
	return key_exists( 'analytics', $item );
}
