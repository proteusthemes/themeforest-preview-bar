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
		<script>window.top.location.href = "<?php echo BASE_URL; ?>?theme=<?php echo $_GET['theme']; ?>";</script>
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
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>preview-bar/stylesheets/style.css?ver=2" type="text/css" media="all" />

	<!-- Fav icon -->
	<link rel="shortcut icon" href="<?php echo BASE_DOMAIN; ?>/favicon.ico">

	<script type="text/javascript">
		var viewportState = (function viewportState (argument) {
			'use strict';

			var currentState = 'desktop', // default
				possibleStates = ['desktop', 'tablet', 'mobile'];

			return {
				getState: function () {
					return currentState;
				},

				getStates: function () {
					return possibleStates;
				},

				switchTo: function (newState) {
					if ( possibleStates.indexOf(newState) > -1 ) {
						currentState = newState;
					}

					calcHeight();

					return this.getState();
				},
			};
		})();

		var utils = {
			// http://youmightnotneedjquery.com/#extend
			extendObj: function(out) {
				'use strict';
				out = out || {};

				for (var i = 1; i < arguments.length; i++) {
					if (!arguments[i]) {
						continue;
					}

					for (var key in arguments[i]) {
						if (arguments[i].hasOwnProperty(key)) {
							out[key] = arguments[i][key];
						}
					}
				}

				return out;
			},

			objToArray: function (obj) {
				'use strict';
				return Object.keys(obj).map(function (key) {
					return obj[key];
				});
			},

			each: function (obj, cb, context) {
				'use strict';
				for (var key in obj) {
					if (obj.hasOwnProperty(key)) {
						if (context) {
							cb.call(context, obj[key], key, obj);
						} else {
							cb(obj[key], key, obj);
						}
					}
				}
				return obj;
			},

			addClass: function (el, className) {
				'use strict';
				if (el.classList) {
					el.classList.add(className);
				} else {
					el.className += ' ' + className;
				}
			},

			removeClass: function (el, className) {
				'use strict';
				if (el.classList) {
					el.classList.remove(className);
				} else {
					el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
				}
			},
		};

		var calcHeight = function() {
			'use strict';

			var previewBar = document.getElementById( 'custom-preview-bar' ),
				previewFrame = document.getElementById( 'main-preview-frame' );

			if ( previewFrame && previewBar ) {
				var possibleMaxHeight = window.innerHeight - previewBar.offsetHeight;

				previewFrame.style.height = possibleMaxHeight + 'px';

				switch (viewportState.getState()) {
					case 'mobile':
						previewFrame.style.maxHeight = Math.min( ( possibleMaxHeight - 109 ), 668 ) + 'px';
						break;
					case 'tablet':
						previewFrame.style.maxHeight = Math.min( ( possibleMaxHeight - 113 ), 1005 ) + 'px';
						break;
					default:
						previewFrame.style.maxHeight = possibleMaxHeight + 'px';
						break;
				}
			}

			document.body.style.minHeight = window.innerHeight + 'px';
		};

		var init = function init () {
			'use strict';

			// calc height of the iframe on init
			calcHeight();

			// iframe size swithcer
			var btns = document.querySelectorAll('.js-switcher > a');
			utils.objToArray(btns).forEach(function (btn) {
				btn.addEventListener('click', function (ev) {
					ev.preventDefault();

					var holder = document.querySelector('#iframe-holder'),
						switchToClass = ev.currentTarget.getAttribute('data-switchto');

					viewportState.getStates().forEach(function (classToRemove) {
						utils.removeClass(holder, classToRemove);
					});

					utils.addClass(holder, switchToClass);

					viewportState.switchTo(switchToClass);
				});
			});
		};

		document.addEventListener( 'DOMContentLoaded', init );
		window.addEventListener( 'resize', calcHeight );
	</script>

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
			<a class="preview-bar__remove-frame" href="<?php echo $item['demo_url']; ?>" title="Close This Frame">
				<img class="preview-bar__remove-frame__x" src="preview-bar/images/x.png"> <span class="preview-bar__remove-frame__text">Remove Frame</span>
			</a>
			<!-- Buy Now Button -->
			<a class="preview-bar__purchase-button" href="<?php echo $item['url']; ?>&ref=<?php echo ENVATO_USERNAME; ?>">Buy now</a>
			<!-- Mobile/Tablet/Desktop switcher -->
			<div class="preview-bar__switcher js-switcher">
				<a href="#" class="switcher-btn switcher-btn--active switcher--desktop" data-switchto="desktop">desk</a>
				<a href="#" class="switcher-btn switcher--tablet" data-switchto="tablet">table</a>
				<a href="#" class="switcher-btn switcher--mobile" data-switchto="mobile">mobile</a>
			</div>
		</div>

	<div id="iframe-holder">
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
	</div>

		<!-- custom, not so important JS at the end -->
		<script>
			document.addEventListener('DOMContentLoaded', function() {

				/**
				 * Constructor
				 * @return {[type]} [description]
				 */
				var utmDecorator = function () {
					this.autosetParameters();
					this.stringifyObj( this.parametersObj );
				};

				utils.extendObj( utmDecorator.prototype, {
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
					decorate: function ( $el ) {
						var prepend = $el.search.length > 0 ? '&' : '?';

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
						this.utmParams.forEach( function ( utmParam ) {
							var utmParamVal = this.getParameterByName( utmParam );
							if ( utmParamVal ) {
								this.parametersObj[ utmParam ] = utmParamVal;
							}
						}, this );

						return this;
					},

					/**
					 * Build the HTTP GET query
					 * @param  {object} obj
					 * @return this
					 */
					stringifyObj: function ( obj ) {
						var urlAppend = [];

						utils.each( obj, function ( val, key ) {
							debugger;
							urlAppend.push( key + '=' + val );
						} );

						this.urlAppend = urlAppend.join( '&' );

						return this;
					}
				} );

				// decorate all links to themeforest and to our demo page on page load
				var decorator = new utmDecorator;
				var elms = document.querySelectorAll( 'a[href*="themeforest.net"], a[href*="proteusthemes.com"]' );
				elms = utils.objToArray(elms);

				elms.forEach( function ( $el ) {
					decorator.decorate( $el );
				} );
			});
		</script>
	</body>
</html>
