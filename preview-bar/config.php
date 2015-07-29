<?php
/**
 * Constants / config
 */
define( 'BASE_URL', '//demo.magemill.com/' ); // url where this preview bar is installed
define( 'ENVATO_USERNAME', 'Mage-Mill' ); // for the refferal link
define( 'AUTHOR', 'MageMill' ); // displayed in author meta tags
define( 'LOGO_LINK', 'http://codecanyon.net/user/Mage-Mill//portfolio?ref=Mage-Mill' ); // Linked wrapped around logo
define( 'MADE_BY_LINK', 'http://www.magemill.com' ); // displayed in author meta tags
define( 'MADE_BY_TEXT', 'MageMill' ); // displayed in author meta tags
define( 'FB_TRACKING_PX', '814211265325915'); // facebook tracking pixel
define( 'GA_ID', 'UA-62676099-4'); // google analytics ID

define( 'FALLBACK_ITEM_URL', 'http://www.magemill.com/' ); //if there is no item choosen, this URL will be displayed
define( 'FALLBACK_ITEM_TITLE_PREFIX', 'Item Preview - by ' ); // for the refferal link
define( 'FALLBACK_ITEM_TITLE_SHORT', 'Item Preview' ); // for the refferal link

/**
 * Array of our themes
 */
$items = array(
	'successpage' => array(
		'title'       => 'Magento Extended Success Page - by ' . ENVATO_USERNAME,
		'title_short' => 'Extended Success Page',
		'description' => 'Demo of Magento Extended Success Page extension',
		'author' => AUTHOR,
		'demo_url'    => '//demo.magemill.com/successpage/checkouttester/index/success/',
		'url'         => 'http://codecanyon.net/item/magento-product-images-in-orders/11301557?license=regular&open_purchase_for_item_id=11301557&purchasable=source',
		'price'       => '$20',
		'analytics'   => array(
			'tracking_id'     => 'UA-62676099-2',
			'allowed_domains' => array(
				'demo.magemill.com'
			),
		),
	),
	'orderimages' => array(
		'title'       => 'Magento Product Images in Orders - by ' . ENVATO_USERNAME,
		'title_short' => 'Order Images',
		'description' => 'Demo of Magento Product Images in Orders extension',
		'author' => AUTHOR,
		'demo_url'    => '//demo.magemill.com/orderimages/landing/index.html',
		'url'         => 'http://codecanyon.net/item/magento-extended-success-page/12124706?license=regular&open_purchase_for_item_id=12124706&purchasable=source',
		'price'       => '$15',
		'analytics'   => array(
			'tracking_id'     => 'UA-62676099-3',
			'allowed_domains' => array(
				'demo.magemill.com'
			),
		),
	)
);