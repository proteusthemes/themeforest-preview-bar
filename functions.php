<?php

/**
 * Constants / config
 */
define( 'BASE_DOMAIN', 'http://www.proteusthemes.com/' );
define( 'BASE_URL', BASE_DOMAIN . 'themes/' );
define( 'ENVATO_USERNAME', 'ProteusThemes' ); // for the refferal link


/**
 * Redirect ASAP, need to be done using JS
 */
if( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
	if( FALSE !== strstr( $_SERVER['HTTP_REFERER'], 'themeforest.net' ) ) {
		?>
<!DOCTYPE html>
<html>
	<head>
		<script>window.top.location.href = "<?php echo BASE_URL; ?>?theme=<?php echo $_GET['theme']; ?>";</script>
	</head>
	<body></body>
</html>
		<?php
		exit;
	}
}


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