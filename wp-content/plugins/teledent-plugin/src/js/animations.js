/*jslint browser: true */
/*global $, jQuery, alert, console, gcAnimate:true */

var console = console || { log: function() { 'use strict'; } }; // jshint ignore:line


window.gcAnimate = window.gcAnimate || {};

(function($) {

// all Javascript code goes here
'use strict';

    $.App = function () {

        return {

            preloader : function () {

            },

            keyScroll : function () {
                jQuery(window).keydown(function(e) {

                    e.preventDefault();

                    var targetElement;
                    if (e.keyCode == 40) {
                        targetElement = jQuery('.active').next('section');
                    } else if (e.keyCode == 38) {
                        targetElement = jQuery('.active').prev('section');
                    }
                    if (!targetElement.length) {return;}
                    jQuery('.active').removeClass('active');
                    targetElement.addClass('active');

                    jQuery('html, body').clearQueue().animate({scrollTop: targetElement.offset().top }, 1000);

                });
            }
        };
    };
})(gcAnimate);