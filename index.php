<?php

require_once 'preview-bar/functions.php';
require_once 'preview-bar/items.php';

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title><?php echo $item['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Demo theme preview">
	<meta name="author" content="ProteusNet d.o.o.">

	<!--  = CSS stylesheets =  -->
	<link rel="stylesheet" href="preview-bar/stylesheets/style.css?ver=2" type="text/css" media="all" />

	<!-- Fav icon -->
	<link rel="shortcut icon" href="//www.proteusthemes.com/favicon.ico">

	<script type="text/javascript">
		var calcHeight = function() {
			var previewBar = document.getElementById( 'custom-preview-bar' ),
				previewFrame = document.getElementById( 'main-preview-frame' );

			if ( previewFrame && previewBar) {
				previewFrame.style.height = ( window.innerHeight - previewBar.offsetHeight ) + 'px';
			}
		};
		document.addEventListener( 'DOMContentLoaded', calcHeight );
		window.addEventListener( 'resize', calcHeight );
	</script>

	<!-- fb tracking pixel -->
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
  _fbq.push(['addPixelId', '650819048377184']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=650819048377184&amp;ev=PixelInitialized" /></noscript>

	</head>

	<body>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('require', 'linker');

			// property for the preview bar
			ga('create', 'UA-33538073-12', 'auto');
			ga('send', 'pageview');

		<?php if ( has_analytics( $item ) ) : ?>
			// property for the item being shown
			ga('create', '<?php echo $item['analytics']['tracking_id']; ?>', 'auto', {'allowLinker': true, 'name': 'itemShown'});
			ga('linker:autoLink', ['<?php echo implode( "', '", $item['analytics']['allowed_domains'] ); ?>'] );
			ga('itemShown.send', 'pageview');
		<?php endif; ?>
		</script>

		<div class="preview-bar" id="custom-preview-bar">
			<!-- Envato Logo -->
			<div class="preview-bar__logo" href="#">
				<a href="http://themeforest.net/user/ProteusThemes/portfolio?ref=ProteusThemes">Envato Market</a>
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
			<!-- Made by ProteusThemes -->
			<span class="preview-bar__proteusthemes">made by <a href="//www.proteusthemes.com/" target="_blank">ProteusThemes</a></span>
			<!-- Close Frame -->
			<a class="preview-bar__remove-frame" href="<?php echo $item['demo_url']; ?>" title="Close This Frame">
				<img class="preview-bar__remove-frame__x" src="preview-bar/images/x.png"> <span class="preview-bar__remove-frame__text">Remove Frame</span>
			</a>
			<!-- Buy Now Button -->
			<a class="preview-bar__purchase-button" href="<?php echo $item['url']; ?>?ref=<?php echo ENVATO_USERNAME; ?>">Buy now</a>
		</div>

	<?php if ( has_analytics( $item ) ): ?>
		<div id="iframe-holder"></div>
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

		<!-- custom, not so important JS at the end -->
		<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
		<script>
			$( function() {
				/**
				 * Constructor
				 * @return {[type]} [description]
				 */
				var utmDecorator = function () {
					this.autosetParameters();
					this.stringifyObj( this.parametersObj );
				};

				$.extend( utmDecorator.prototype, {
					// from: https://support.google.com/analytics/answer/1033867?hl=en
					utmParams: [ 'utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign' ],

					parametersObj: {},

					urlAppend: '',

					/**
					 * Helper function for getting parameter by name
					 * @see  http://stackoverflow.com/a/901144
					 * @param  {string} name
					 * @return {string}
					 */
					getParameterByName: function (name) {
						name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
						var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
						results = regex.exec(location.search);
						return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
					},

					/**
					 * Pass the DOM element and it will output the decorated link
					 * @param  {DOM} el
					 */
					decorate: function ( el ) {
						var $el = $( el );

						var prepend = $el[0].search.length > 0 ? '&' : '?';

						if ( this.urlAppend ) {
							$el.attr( 'href', $el.attr( 'href' ) + prepend + this.urlAppend );
						}

						return this;
					},

					/**
					 * Set parameters, based on the existing page
					 * @return this
					 */
					autosetParameters: function () {
						// reset
						this.parametersObj = {};

						// check every
						$.each( this.utmParams, $.proxy( function ( index, utmParam ) {
							var utmParamVal = this.getParameterByName( utmParam );
							if ( utmParamVal ) {
								this.parametersObj[ utmParam ] = utmParamVal;
							}
						}, this ) );

						return this;
					},

					/**
					 * Build the HTTP GET query
					 * @param  {object} obj
					 * @return this
					 */
					stringifyObj: function ( obj ) {
						var urlAppend = [];
						$.each( obj, $.proxy( function ( key, val ) {
							urlAppend.push( key + '=' + val );
						}, this ) );

						this.urlAppend = urlAppend.join( '&' );

						return this;
					}
				} );

				// decorate all links to themeforest and to our demo page on page load
				var decorator = new utmDecorator;
				$( 'a[href*="themeforest.net"], a[href*="proteusthemes.com"]' ).each( function ( index, $el ) {
					decorator.decorate( $el );
				} );
			} );
		</script>
	</body>
</html>