/*jslint browser: true */
/*global $, jQuery, alert, console, gcUtz:true */

var console = console || { log: function() { 'use strict'; } }; // jshint ignore:line

window.gcUtz = window.gcUtz || {};

(function($) {

// all Javascript code goes here
'use strict';

    $.App = function () {

        return {
            /** htmlClasses -
                @ Set and manage HTML classes based on
                @ display width
                @ screen orientation
                @ device detection
            */
            htmlClasses : function () {

                var browserWidth = (this.whatWidth() > gcConcierge.App().settings.breakpoints.large + 1 ? { "desktop" : true, "handheld" : false } : { "desktop" : false, "handheld" : true } );
                var browserOrientation = (this.whatOrientation() > 0 ? { "landscape" : true, "portrait" : false } : { "portrait" : true, "landscape" : false } );
                var protocol = (window.location.protocol === "https:" ? { "https" : true, "http" : false } : { "https" : false, "http" : true } );

                var browserInfo = {},
                    htmlClasses = {},
                    htmlClass;

                browserInfo.chrome = (bowser.chrome ? true : false);
                browserInfo.mac = (bowser.mac ? true : false);
                browserInfo.tablet = (bowser.tablet ? true : false);
                browserInfo.iphone = (bowser.iphone ? true : false);
                browserInfo.ipod = (bowser.ipod ? true : false);
                browserInfo.ipad = (bowser.ipad ? true : false);
                browserInfo.safari = (bowser.safari ? true : false);
                browserInfo.windows = (bowser.windows ? true : false);
                browserInfo.msie = (bowser.msie ? true : false);
                browserInfo.webkit = (bowser.webkit ? true : false);
                browserInfo.ios = (bowser.ios ? true : false);
                browserInfo.android = (bowser.android ? true : false);
                browserInfo.mobile = (bowser.mobile ? true : false);
                browserInfo.firefox = (bowser.firefox ? true : false);

                jQuery.extend(htmlClasses, browserInfo, browserOrientation, browserWidth, protocol);

                for(htmlClass in htmlClasses) {
                    if(htmlClasses[htmlClass]) {
                        jQuery('html').addClass("cactus-" + htmlClass);
                    } else {
                        jQuery('html').removeClass("cactus-" + htmlClass);
                    }
                }

            },

            getData : function (url) {
                jQuery.get( url, function( data ) {
                   return data;
                });
            },

            whatWidth: function (w) {
                return jQuery( window ).width();
            },

            whatOrientation: function () {
                var orientation,
                    w = window;

                if(w.screen) {
                    if(w.screen.orientation) {
                        orientation = w.screen.orientation.angle
                    } else {
                    orientation = w.orientation;
                    }
                } else {
                    orientation = w.orientation;
                }

                return orientation;

            },

            copyrightYear: function () {
                var d = new Date();
                var currentYear = jQuery('#copyright span');
                currentYear.html(d.getFullYear());
            },

            getPosition: function(node) {
                var top = left = 0;
                while (node) {
                   if (node.tagName) {
                       top = top + node.offsetTop;
                       left = left + node.offsetLeft;
                       node = node.offsetParent;
                   } else {
                       node = node.parentNode;
                   }
                }
                return [top, left];
            },

            mobileHoverHandler : function(){
                jQuery('html.cactus-handheld .thumbs article .helper').addClass('hovered').attr("style","display: flex; left: 0px; top: 0px; transition: all 300ms ease;");
                jQuery('html.cactus-desktop .thumbs article .helper').removeClass('hovered').attr("style","");
            },

            responsibleResize : function () {
                var optimizedResize = (function() {

                    var callbacks = [],
                        running = false;

                    // fired on resize event
                    function resize() {

                        if (!running) {
                            running = true;

                            if (window.requestAnimationFrame) {
                                window.requestAnimationFrame(runCallbacks);
                            } else {
                                setTimeout(runCallbacks, 66);
                            }
                        }

                    }

                    // run the actual callbacks
                    function runCallbacks() {

                        callbacks.forEach(function(callback) {
                            callback();
                        });

                        running = false;
                    }

                    // adds callback to loop
                    function addCallback(callback) {

                        if (callback) {
                            callbacks.push(callback);
                        }

                    }

                    return {
                        // public method to add additional callback
                        add: function(callback) {
                            if (!callbacks.length) {
                                window.addEventListener('resize', resize);
                            }
                            addCallback(callback);
                        }
                    }
                }());

                // start process
                optimizedResize.add(function() {
                    gcUtz.App().htmlClasses();
                    gcUtz.App().mobileHoverHandler();
                });
            },

            matchHeight : function (elem) {
                 jQuery(elem).matchHeight();
            },

            goToTop : function () {
                jQuery('.arrow-back-to-top a').click(function(e){
                    if ((jQuery('div.scrollpage').length) || (jQuery(window).width() <= 1024)) {
                        gcUtz.App().scrollTo('body', 0);
                    } else {
                        e.preventDefault();
                        jQuery.fn.fullpage.moveTo(1, 1);
                    }
                });
            },

            reinitHTML5Video: function () {
                var video = jQuery('#video-cactus').get()[0];
                    video.play();
            },

            scrollTo : function(element, target, offset){
                jQuery(element).scrollTo(target, {
                  axis: 'y',
                  duration: 265,
                  offset: {top: (offset ? offset : 0)}
                });
            },

            onVisibilityChange : function ( el, callback) {
                var old_visible;
                return function () {
                    var visible = isElementInViewport(el);
                    if (visible != old_visible) {
                        old_visible = visible;
                        if (typeof callback == 'function') {
                            callback();
                        }
                    }
                }
            },

            objectCount: function (o) {
                return Object.keys(o).length
            },


            exploder: function (s, i, c) {
                var a = s.split(c);
                    a = a.filter( function(n) { return n !== ""; } );
                if(!i || i === -1) {
                    return a;
                } else {
                    return a[i];
                }
            }

        };

    };

})(gcUtz);