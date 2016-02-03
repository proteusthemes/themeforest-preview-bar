/* global ga */
/**
 * Utils functions
 * @type {Object}
 */
(function () {
  'use strict';

  var utils = {
    // http://youmightnotneedjquery.com/#ready
    ready: function (fn) {
      if (document.readyState !== 'loading') {
        fn();
      } else {
        document.addEventListener('DOMContentLoaded', fn);
      }
    },

    // http://youmightnotneedjquery.com/#extend
    extendObj: function(out) {
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
      return Object.keys(obj).map(function (key) {
        return obj[key];
      });
    },

    each: function (obj, cb, context) {
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
      if (el.classList) {
        el.classList.add(className);
      } else {
        el.className += ' ' + className;
      }
    },

    removeClass: function (el, className) {
      if (el.classList) {
        el.classList.remove(className);
      } else {
        el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    },
  };


  /**
   * Viewport State
   */
  var viewportState = (function viewportState () {
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


  /**
   * Calculate height of the iframe, depending on the viewportState
   */
  var calcHeight = function() {
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


  /**
   * Click even handler for toggling viewport
   */
  var toggleViewport = function toggleViewport (ev) {
    ev.preventDefault();

    var holder = document.querySelector('#iframe-holder'),
      switchToClass = ev.currentTarget.getAttribute('data-switchto');

    viewportState.getStates().forEach(function (classToRemove) {
      utils.removeClass(holder, classToRemove);
    });

    utils.addClass(holder, switchToClass);

    utils.removeClass(document.querySelector('.switcher-btn--active'), 'switcher-btn--active');
    utils.addClass(ev.currentTarget, 'switcher-btn--active');

    viewportState.switchTo(switchToClass);

    /**
     * Google Analytics event tracking
     * https://developers.google.com/analytics/devguides/collection/analyticsjs/events
     */
    if ( ga ) {
      ga( 'send', 'event', 'layout switcher', 'click', switchToClass );
    }
  };

  /**
   * Event handler for the dom ready
   */
  var init = function init () {
    // calc height of the iframe on init
    calcHeight();

    // iframe size swithcer
    var btns = document.querySelectorAll('.js-switcher > a');
    utils.objToArray(btns).forEach(function (btn) {
      btn.addEventListener('click', toggleViewport);
    });
  };

  // events
  utils.ready(init);
  window.addEventListener( 'resize', calcHeight );


  /**
   * UTM decorator - for tracking purposes
   */
  var decoratorHandler = function() {
    /**
     * Constructor
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
  };

  utils.ready(decoratorHandler);
})();
