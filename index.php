<?php

require_once 'preview-bar/config.php';
require_once 'preview-bar/functions.php';

/**
 * Redirect ASAP, need to be done using JS
 */
if( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
	if( FALSE !== strstr( $_SERVER['HTTP_REFERER'], 'themeforest.net' ) ) {
		?>
<!DOCTYPE html>
<html>
	<head>
		<script>window.top.location.href = "<?php echo BASE_URL; ?>?theme=<?php echo htmlspecialchars($_GET['theme']); ?>";</script>
	</head>
	<body></body>
</html>
		<?php
		exit;
	}
}


/**
 * Check for current item
 */
if( key_exists( @$_GET['theme'], $items ) ) {
	$item  = $items[$_GET['theme']];

} else {
	$item = array(
		'title'       => FALLBACK_ITEM_TITLE_PREFIX.ENVATO_USERNAME,
		'title_short' => FALLBACK_ITEM_TITLE_SHORT,
		'url'         => FALLBACK_ITEM_URL,
		'demo_url'    => FALLBACK_ITEM_URL,
		'price'       => '',
	);
}

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title><?php echo $item['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Demo theme preview">
	<meta name="author" content="<?php echo AUTHOR; ?>">

	<!--  = CSS stylesheets =  -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>preview-bar/stylesheets/style.css?ver=<?php echo ASSETS_VERSION; ?>" type="text/css" media="all" />

	<!-- Fav icon -->
	<link rel="shortcut icon" href="<?php echo BASE_DOMAIN; ?>/favicon.ico">

	<script src="<?php echo BASE_URL; ?>preview-bar/js/main.js?ver=<?php echo ASSETS_VERSION; ?>" async></script>

	<!-- fb tracking pixel -->
	<?php if ( defined( 'FB_TRACKING_PX' ) && ! empty( FB_TRACKING_PX ) ): ?>
	<script>(function() {
		var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
			var fbds = document.createElement('script');
			fbds.async = true;
			fbds.src = '//connect.facebook.net/en_US/fbds.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(fbds, s);
			_fbq.loaded = true;
		}
		_fbq.push(['addPixelId', '<?php echo FB_TRACKING_PX; ?>']);
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', 'PixelInitialized', {}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=<?php echo FB_TRACKING_PX; ?>&amp;ev=PixelInitialized" /></noscript>
	<?php endif; ?>

	</head>

	<body>
		<?php if ( defined( 'GA_ID' ) && ! empty( GA_ID ) ): ?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('require', 'linker');

			// property for the preview bar
			ga('create', '<?php echo GA_ID; ?>', 'auto');
			ga('send', 'pageview');

		<?php if ( has_analytics( $item ) ) : ?>
			// property for the item being shown
			ga('create', '<?php echo $item['analytics']['tracking_id']; ?>', 'auto', {'allowLinker': true, 'name': 'itemShown'});
			ga('linker:autoLink', ['<?php echo implode( "', '", $item['analytics']['allowed_domains'] ); ?>'] );
			ga('itemShown.send', 'pageview');
		<?php endif; ?>
		</script>
		<?php endif; ?>

		<div class="preview-bar" id="custom-preview-bar">
			<!-- Envato Logo -->
			<div class="preview-bar__logo" href="#">
				<a href="<?php echo LOGO_LINK; ?>">Envato Market</a>
			</div>
			<!-- Select Theme -->
			<div class="preview-bar__select-theme">
				<?php echo $item['title_short']; ?>
				<ul class="preview-bar__select-theme__all-themes">
					<?php foreach($items as $slug => $single_item) : ?>
					<li><a href="<?php echo site_url('?theme=' . $slug); ?>"><?php echo $single_item['title_short']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<!-- Made by -->
			<span class="preview-bar__proteusthemes">made by <a href="<?php echo MADE_BY_LINK; ?>" target="_blank"><?php echo MADE_BY_TEXT; ?></a></span>
			<!-- Close Frame -->
			<a class="preview-bar__remove-frame  js-link-to-demo" href="<?php echo $item['demo_url']; ?>" title="Close This Frame">
				<img class="preview-bar__remove-frame__x" src="preview-bar/images/x.png"> <span class="preview-bar__remove-frame__text">Remove Frame</span>
			</a>
			<!-- Buy Now Button -->
			<a class="preview-bar__purchase-button" href="<?php echo $item['url']; ?>&ref=<?php echo ENVATO_USERNAME; ?>">Buy now</a>
			<!-- Mobile/Tablet/Desktop switcher -->
			<div class="preview-bar__switcher js-switcher">
				<a href="#" class="switcher-btn switcher-btn--active switcher--desktop" data-switchto="desktop"><span></span></a>
				<a href="#" class="switcher-btn switcher--tablet" data-switchto="tablet"><span></span></a>
				<a href="#" class="switcher-btn switcher--mobile" data-switchto="mobile"><span></span></a>
			</div>
		</div>

		<div id="iframe-holder" class="desktop">
		<?php if ( has_analytics( $item ) ): ?>
			<script>
				/**
				 * Dynamically create the iframe with the proper linker for analytics
				 */
				var linker;

				function addiFrame( divId, url, opt_hash ) {
					return function( tracker ) {
						window.linker = window.linker || new window.gaplugins.Linker( tracker );
						var iFrame    = document.createElement( 'iFrame' );
						iFrame.src    = window.linker.decorate( url, opt_hash );
						iFrame.id     = 'main-preview-frame';
						iFrame.setAttribute( 'frameborder', '0' );
						document.getElementById( divId ).appendChild( iFrame );
						calcHeight();
					};
				}

				// Dynamically add the iFrame to the page with proper linker parameters.
				ga( addiFrame( 'iframe-holder', '<?php echo $item['demo_url']; ?>' ) );
			</script>
		<?php else : ?>
			<iframe src="<?php echo $item['demo_url']; ?>" frameborder="0" id="main-preview-frame"></iframe>
		<?php endif; ?>
			<div class="qr-code"><div class="qr-label">Mobile demo preview:</div></div>
		</div>
	</body>
</html>
