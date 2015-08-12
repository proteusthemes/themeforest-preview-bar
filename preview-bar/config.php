<?php
/**
 * Constants / config
 */
define( 'BASE_DOMAIN', 'https://www.proteusthemes.com' ); // domain where preview bar is installed, with protocol
define( 'BASE_URL', BASE_DOMAIN . '/themes/' ); // url where this preview bar is installed
define( 'ENVATO_USERNAME', 'ProteusThemes' ); // for the refferal link
define( 'AUTHOR', 'ProteusThemes' ); // displayed in author meta tags
define( 'LOGO_LINK', 'http://themeforest.net/user/ProteusThemes/portfolio?ref=ProteusThemes' ); // Linked wrapped around logo
define( 'MADE_BY_LINK', BASE_DOMAIN ); // displayed in author meta tags
define( 'MADE_BY_TEXT', 'ProteusThemes' ); // displayed in author meta tags
define( 'FB_TRACKING_PX', '650819048377184'); // facebook tracking pixel
define( 'GA_ID', 'UA-33538073-12'); // google analytics ID

define( 'FALLBACK_ITEM_URL', BASE_DOMAIN ); // if there is no item choosen, this URL will be displayed
define( 'FALLBACK_ITEM_TITLE_PREFIX', 'Item Preview - by ' ); // if there is no item choosen
define( 'FALLBACK_ITEM_TITLE_SHORT', 'Item Preview' ); // if there is no item choosen

/**
 * Array of our themes
 */
$items = array(
	'hairpress' => array(
		// title which will be shown in the browser
		'title'       => 'Hairpress - HTML Template for Hair Salons Preview - by ' . ENVATO_USERNAME,
		// short title is used in the drop-down menu
		'title_short' => 'Hairpress HTML',
		// URL to demo site
		'demo_url'    => '//www.proteusthemes.com/themes/hairpress/',
		// needs any explanation? URL to your item in ThemeForest
		'url'         => 'http://themeforest.net/item/hairpress-html-template-for-hair-salons/3803346?license=regular&open_purchase_for_item_id=3803346&purchasable=source',
		// Price of the item
		'price'       => '$17',
	),
	'hairpress-wp' => array(
		'title'       => 'Hairpress - Wordpress Theme for Hair Salons Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Hairpress WP',
		'demo_url'    => '//demo.proteusthemes.com/hairpress/',
		'url'         => 'http://themeforest.net/item/hairpress-wordpress-theme-for-hair-salons/4099496?license=regular&open_purchase_for_item_id=4099496&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-4',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	'webmarket-html' => array(
		'title'       => 'Webmarket - HTML Template for Online Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Webmarket HTML',
		'demo_url'    => '//www.proteusthemes.com/themes/webmarket-html/',
		'url'         => 'http://themeforest.net/item/webmarket-html-template-for-online-shop/5409539?license=regular&open_purchase_for_item_id=5409539&purchasable=source',
		'price'       => '$16',
	),
	'webmarket-wp' => array(
		'title'       => 'Webmarket - WP WooCommerce Theme for Online Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Webmarket WP + Woo',
		'demo_url'    => '//demo.proteusthemes.com/webmarket/',
		'url'         => 'http://themeforest.net/item/webmarket-wp-woocommerce-theme-for-online-shop/6437728?license=regular&open_purchase_for_item_id=6437728&purchasable=source',
		'price'       => '$58',
	),
	'organique-html' => array(
		'title'       => 'Organique - HTML Template For Healthy Food Store Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Organique HTML',
		'demo_url'    => '//www.proteusthemes.com/themes/organique-html/',
		'url'         => 'http://themeforest.net/item/organique-html-template-for-healthy-food-store/6779086?license=regular&open_purchase_for_item_id=6779086&purchasable=source',
		'price'       => '$17',
	),
	'organique-wp' => array(
		'title'       => 'Organique - WordPress Theme For Healthy Food Shop Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Organique WP + Woo',
		'demo_url'    => '//demo.proteusthemes.com/organique/',
		'url'         => 'http://themeforest.net/item/organique-wordpress-theme-for-healthy-food-shop/7312458?license=regular&open_purchase_for_item_id=7312458&purchasable=source',
		'price'       => '$58',
	),
	'carpress-wp' => array(
		'title'       => 'Carpress - WordPress Theme For Mechanic Workshops Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Carpress WP',
		'demo_url'    => '//demo.proteusthemes.com/carpress/',
		'url'         => 'http://themeforest.net/item/carpress-wordpress-theme-for-mechanic-workshops/7042577?license=regular&open_purchase_for_item_id=7042577&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-10',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	'readable-html' => array(
		'title'       => 'Readable - HTML Template For Blog Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Readable HTML',
		'demo_url'    => '//www.proteusthemes.com/themes/readable-html/',
		'url'         => 'http://themeforest.net/item/readable-blog-template-focused-on-readability/7499064?license=regular&open_purchase_for_item_id=7499064&purchasable=source',
		'price'       => '$16',
	),
	'readable-wp' => array(
		'title'       => 'Readable - WordPress Theme Focused on Readability Preview - by ' . ENVATO_USERNAME,
		'title_short' => 'Readable WP',
		'demo_url'    => '//demo.proteusthemes.com/readable/',
		'url'         => 'http://themeforest.net/item/readable-wordpress-theme-focused-on-readability/7712790?license=regular&open_purchase_for_item_id=7712790&purchasable=source',
		'price'       => '$43',
	),
	'restaurant-wp' => array(
		'title'       => 'Dining Restaurant - WordPress Theme For Chefs - by ' . ENVATO_USERNAME,
		'title_short' => 'Dining Restaurant WP',
		'demo_url'    => '//demo.proteusthemes.com/restaurant/',
		'url'         => 'http://themeforest.net/item/dining-restaurant-wordpress-theme-for-chefs/8294419?license=regular&open_purchase_for_item_id=8294419&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-11',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	'buildpress-wp' => array(
		'title'       => 'BuildPress - WP Theme For Construction Business - by ' . ENVATO_USERNAME,
		'title_short' => 'BuildPress WP',
		'demo_url'    => '//demo.proteusthemes.com/buildpress/',
		'url'         => 'http://themeforest.net/item/buildpress-wp-theme-for-construction-business/9323981?license=regular&open_purchase_for_item_id=9323981&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-13',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	'mentalpress-wp' => array(
		'title'       => 'MentalPress - Psychiatrists WP Theme - by ' . ENVATO_USERNAME,
		'title_short' => 'MentalPress WP',
		'demo_url'    => '//demo.proteusthemes.com/mentalpress/',
		'url'         => 'http://themeforest.net/item/mentalpress-psychiatrists-wp-theme/10676732?license=regular&open_purchase_for_item_id=10676732&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-16',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	'cargopress-wp' => array(
		'title'       => 'CargoPress - Transportation, Logistic WP Theme - by ' . ENVATO_USERNAME,
		'title_short' => 'CargoPress WP',
		'demo_url'    => '//demo.proteusthemes.com/cargopress/',
		'url'         => 'http://themeforest.net/item/cargopress-logistic-warehouse-transport-wp/11601531?license=regular&open_purchase_for_item_id=11601531&purchasable=source',
		'price'       => '$58',
		'analytics'   => array(
			'tracking_id'     => 'UA-33538073-18',
			'allowed_domains' => array(
				'demo.proteusthemes.com'
			),
		),
	),
	// 'legalpress-wp' => array(
	// 	'title'       => 'LegalPress - Law, Lawyer, Attorney WP Theme - by ' . ENVATO_USERNAME,
	// 	'title_short' => 'LegalPress WP',
	// 	'demo_url'    => '//demo.proteusthemes.com/legalpress/',
	// 	'url'         => 'http://themeforest.net/item/cargopress-logistic-warehouse-transport-wp/11601531?license=regular&open_purchase_for_item_id=11601531&purchasable=source',
	// 	'price'       => '$58',
	// 	'analytics'   => array(
	// 		'tracking_id'     => 'UA-33538073-18',
	// 		'allowed_domains' => array(
	// 			'demo.proteusthemes.com'
	// 		),
	// 	),
	// ),
);

// fix: first element last in the dropdown
$items = array_reverse( $items );