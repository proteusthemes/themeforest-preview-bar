<?php

/**
 * Constants / config
 */
define( "BASE_DOMAIN" , 'http://www.proteusthemes.com/' );
define( "BASE_URL" , BASE_DOMAIN . 'themes/' );
define( "ENVATO_USERNAME" , 'ProteusThemes' ); // for the refferal link



/**
 * Redirect, need to be done using JS
 */
$js = NULL;

if( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
	if( FALSE !== strstr( $_SERVER['HTTP_REFERER'], 'themeforest.net' ) ) {
		$js = 'window.top.location.href = "' . BASE_URL . '?theme=' . $_GET['theme'] . '";';
	}
}



/**
 * Array of our themes
 */
$items = array(
	// key is the folder relative the the BASE_URL contant above. 'hairpress' here will open up the:
	// http://www.proteusthemes.com/themes/hairpress
	'hairpress' => array(
		// title which will be shown in the browser
		'title' => 'Hairpress - HTML Template for Hair Salons Preview - by ' . ENVATO_USERNAME,
		// short title is used in the drop-down menu
		'title_short' => 'Hairpress HTML',
		// needs any explanation? URL to your item in ThemeForest
		'url' => 'http://themeforest.net/item/hairpress-html-template-for-hair-salons/3803346'
	),
	'hairpress-wp' => array(
		'title' => 'Hairpress - Wordpress Theme for Hair Salons Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Hairpress WP',
		'url' => 'http://themeforest.net/item/hairpress-wordpress-theme-for-hair-salons/4099496'
	),
	'webmarket-html' => array(
		'title' => 'Webmarket - HTML Template for Online Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Webmarket HTML',
		'url' => 'http://themeforest.net/item/webmarket-html-template-for-online-shop/5409539'
	),
	'webmarket-wp' => array(
		'title' => 'Webmarket - WP WooCommerce Theme for Online Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Webmarket WP + WooCommerce',
		'url' => 'http://themeforest.net/item/webmarket-wp-woocommerce-theme-for-online-shop/6437728'
	),
	'webmarket-magento' => array(
		'title' => 'Webmarket - Magento Theme for Online Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Webmarket Magento',
		'url' => 'http://themeforest.net/item/webmarket-magento-theme-for-online-shop/6382713'
	),
);


/**
 * Check for current item
 */
if( key_exists( @$_GET['theme'], $items ) ) {
	$item = $items[$_GET['theme']];
	$theme = $_GET['theme'];
	
} else {
	$item = array(
		'title' => 'Theme Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Theme Preview',
		'url' => 'http://themeforest.net/user/' . ENVATO_USERNAME . '/portfolio'
	);
	$theme = $item['url'];
}

/**
 * Function which returns the url to the theme
 */
function site_url( $uri = "" ) {
	return BASE_URL . $uri;
}


/**
 * Can show the site URL of portfolio of the item
 * @param  string $uri [description]
 * @return [type]      [description]
 */
function iframe_url( $uri = '' ) {
	if ( false === strstr( $uri, '://' ) ) {
		return site_url( $uri );
	} else {
		return $uri;
	}
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
	<meta charset="utf-8">
	<title><?php echo $item['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Demo theme preview">
	<meta name="author" content="ProteusNet d.o.o.">

	<?php if( NULL !== $js ) : ?>
		<script type="text/javascript">
			<?php echo $js; ?>
		</script>
	<?php endif; ?>
	
	<!--  = CSS stylesheets =  -->
	<link rel="stylesheet" href="preview-bar/stylesheets/style.css" type="text/css" media="all" />

	<!-- Fav icon -->
	<link rel="shortcut icon" href="http://www.proteusthemes.com/favicon.ico">
	
	<!--  = JS =  -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

	
	<script type="text/javascript">
		$(document).ready(function() {
			//function to fix height of iframe!
			var calcHeight = function() {
				var headerDimensions ;
				if( $('#custom-preview-bar').is(':visible') ) {
					headerDimensions = $('#custom-preview-bar').outerHeight();
				} else {
					headerDimensions = 0;
				}
				$('#main-preview-frame').height($(window).height() - headerDimensions);
				console.log(headerDimensions);
			}

			$(window)
				.resize(function() {
					calcHeight();
				})
				.load(function() {
					calcHeight();
				});
			
			// dropdown menu
			// $(document).ready(function() {
			// 	$('.selectable').hover(function() {
			// 		$(this).find('.other-themes').stop(true, true).slideDown(250);
			// 	}, function() {
			// 		$(this).find('.other-themes').stop(true, true).delay(100).slideUp();
			// 	});
			// });
		});

		</script>
	</head>

	<body>
		<div id="custom-preview-bar">
			<a class="logo" href="http://www.proteusthemes.com/" target="_blank">
				<img src="preview-bar/images/logo.png" alt="ProteusThemes - www.proteusthemes.com" width="262" height="59" />
			</a>
			<div class="center">
				<div class="selectable">
					<?php echo $item['title_short']; ?>
					<ul class="other-themes">
						<?php foreach($items as $slug => $item) : ?> 
						<li><a href="<?php echo site_url('?theme=' . $slug); ?>"><?php echo $item['title_short']; ?></a></li>
					<?php endforeach; ?> 
				</ul>
			</div>

		</div>
		<div class="right">
			<a href="<?php echo $item['url']; ?>?ref=<?php echo ENVATO_USERNAME; ?>" class="purchase"><img src="preview-bar/images/purchase.png" alt="Purchase this theme" width="164" height="59" /></a>
			<a href="<?php echo site_url( $theme ); ?>" class="close" title="Close This Frame">×</a>
		</div>
	</div>
	<iframe src="<?php echo iframe_url( $theme ); ?>" frameborder="0" id="main-preview-frame"></iframe>
</body>
</html>
