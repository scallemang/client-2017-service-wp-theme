/*jslint browser: true */
/*global $, jQuery, alert, console, gcConcierge:true */

/***
*    Welcome to the Concierge.
*    This is where we will kick off the JavaScript for this app.
*    Here we will check our browser and server variables, set-up the pages,
*    and listen for changes along the way.
*
*    Related classes:
*       gcInits.App()         = Initializer
*       gcUtz.App()          = Reusable utilities
*       gcTabbedList.App()    = Tabbed bullet list handler
*       gcQuotes.App() = Testimonials handler
*       gcMap.App() = Google Map handler
*       gcCatFilter.App() = Categories filter handler
*
***/

var console = console || { log: function() { 'use strict'; } }; // jshint ignore:line

window.gcConcierge = window.gcConcierge || {};

(function($) {
    'use strict';

    $.App = function () {

        return {
            elements: {},
            sortOrder: {},
            settings: {
                debug: false,
                breakpoints: {
                    xsmall: 0,
                    small: 435,
                    medium: 768,
                    large: 1024,
                    xlarge: 1280,
                    xxlarge: 1440
                }
            },


            init: function () {

                if (this.settings.debug) { console.log('init()'); }

                //Show debug if settings specify
                this.elements.body =  jQuery('body', 'html');
                this.elements.debug = jQuery('#txtDebug', this.elements.body);
                if (this.elements.debug.val()) {
                    this.settings.debug = true;
                    gcInits.App().debugInit();
                }

                //Start Me Up (JS kick-off)
                gcAnimate.App().preloader();
                gcMap.App().init();
                gcUtz.App().htmlClasses();
                gcUtz.App().responsibleResize();

            }

        };

    };

})(gcConcierge);

jQuery(document).ready(function() {
    'use strict';
    gcConcierge.App().init();
});