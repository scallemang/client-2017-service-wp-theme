/*jslint browser: true */
/*global $, jQuery, alert, console, gcMap:true */

var console = console || { log: function() { 'use strict'; } }; // jshint ignore:line
var APIKEY = 'AIzaSyCjOhYTFNQIGg2mIITJITOPc1WI6OSXTdM';

window.gcMap = window.gcMap || {};

(function($) {

// all Javascript code goes here
'use strict';

    $.App = function () {
        return {

            init : function () {
                try {
                    //On init, place user at brewery/HQ until geolocate is accepted, or location is searched
                    var init = true;
                    gcMap.App().geocode(jQuery('#t_hq_address').val(), init);

                    jQuery('#t_map_search_my_location').click(function(){
                        gcMap.App().geolocate(init);
                    });

                    jQuery('#t_map_search_button').click(function(){
                        gcMap.App().toggleAlert();
                        gcMap.App().geocode(jQuery('#t_map_seach_location').val(), false);
                    });

                    jQuery('#t_map_seach_location').keypress(function(e) {
                        if(e.which == 13) {
                            gcMap.App().geocode(jQuery('#t_map_seach_location').val(), false);
                        }
                    });
                } catch(err) {
                    console.log('Map did not load: ' + err);
                }

            },

            /*  gcMap.App().geolocate();
            *   Checks for HTML5 capabilities, fallback to Google Geolocation */
            geolocate : function(init) {

                //Set Brewer/HQ Location
                gcMap.App().geocode(jQuery('#t_hq_address').val(), init);

                //Perform a location lookup
                var t_location = jQuery('#t_map_seach_location');
                if ("geolocation" in navigator) {
                    //If HTML5 GeoLocation
                    navigator.geolocation.getCurrentPosition(function(position) {
                        t_location.val([position.coords.latitude, position.coords.longitude]);
                        gcMap.App().geocode(t_location.val());
                    });
                } else {
                    var url = 'https://www.googleapis.com/geolocation/v1/geolocate?key='+APIKEY;
                    var jqxhr = jQuery.get( url , function(data) {
                        t_location.val(data);
                        gcMap.App().geocode(t_location.val());
                    });
                }
            },

            /*  gcMap.App().geocode();
            *   Uses Google Geolcode service to translate address to geocorodinates */
            geocode : function(t_location, init = false) {
                if(!init) {
                    gcMap.App().animateOut();
                }
                switch(typeof t_location) {
                    case 'object':
                        gcMap.App().wp_prepDom(t_location.results[0].formatted_address);
                        break;
                    case 'string':
                        t_location = t_location.split(' ');
                        t_location = t_location.join('+');
                        try {
                            var url = 'https://maps.googleapis.com/maps/api/geocode/json?address='+t_location+'&key='+APIKEY;
                            var jqxhr = jQuery.get( url, function(data) {
                                if(init === true) {
                                    gcMap.App().updateOriginLocation(data, init);
                                    return;
                                }

                                var address = data.results[0].formatted_address;
                                var addressParts = data.results[0].address_components;

                                gcMap.App().wp_prepDom([address, addressParts]);
                            });
                        }
                        catch(e) {
                            gcMap.App().toggleAlert();
                        }
                        break;
                }
            },

            toggleAlert: function () {
                jQuery("#productFinder #t_filters .alert").toggleClass('alert--hide').toggleClass('alert--show');
            },

            /*  gcMap.App().wp_prepDom();
                Communicates with teledent.php to build window.productFinder
            */
            wp_prepDom :function (data) {
                var vars = {
                    'action': 'prepDomAction',
                    'location': data
                };

                jQuery.post(ajaxurl, vars, function(data) {

                    try {
                        jQuery("#productFinder #t_filters .alert").addClass('alert--hide').removeClass('alert--show');
                        jQuery("#productFinder").removeClass('loadState');

                        data = data.replace(']}{"0":[',',');
                        var jsonLocations = jQuery.parseJSON(data),
                            lcboTemp = jsonLocations['loc'],
                            vendorTemp = jsonLocations['0'],
                            objTemp = {
                                'loc': jQuery.extend([], lcboTemp, vendorTemp)
                            };

                        window.productFinder = objTemp;
                        gcMap.App().updateOriginLocation(objTemp);
                    }
                    catch(e) {
                        gcMap.App().toggleAlert();
                    }


                });
            },

            /*  gcMap.App().animateOut();
            *   Distract the user while operations are carried out */
            animateOut : function() {
                jQuery('#t_cover_up').addClass('do');

                var info_cards = document.getElementById('t_info_cards');
                while(info_cards.firstChild) {
                    info_cards.removeChild(info_cards.firstChild);
                }

            },

            /*  gcMap.App().animateIn();
            *   Update map and tiles and filters */
            animateIn : function() {
                jQuery('#t_cover_up').removeClass('do');
            },

            /*  gcMap.App().updateOriginLocation();
            *   Send Callback data to clear and redraw */
            updateOriginLocation :function (locationsByDistance, init = false) {
                var origin = ( init ? '#t_hq_address' : '#t_map_seach_location' );
                origin = jQuery(origin).val();
                var url = 'https://maps.googleapis.com/maps/api/geocode/json?address='+origin+'&key='+APIKEY;
                var jqxhr = jQuery.get( url, function(data) {

                    if( init ) {
                        gcMap.App().drawCards(locationsByDistance, init);
                    }

                    gcMap.App().drawMap(
                        data.results[0].geometry.location.lat,
                        data.results[0].geometry.location.lng,
                        init
                    );

                });
            },

            /*  gcMap.App().drawMap();
            *   Draws a map, set styles, trigger marker placement */
            drawMap : function(gcLat, gcLng, init = false) {

                var mapDiv,
                    draggableScrollable = false,
                    map,
                    zoomLevel = jQuery(document).width() >= 1200 ? 14 : 12;

                draggableScrollable = jQuery(document).width() > 1024 ? true : false;
                mapDiv = document.getElementById('t_map');
                map = new google.maps.Map(mapDiv, {
                    draggable: draggableScrollable,
                    scrollwheel: draggableScrollable,
                    center: {lat: gcLat, lng: gcLng},
                    mapTypeControl: false,
                    streetViewControl: false
                });

                //Make it pretty
                gcMap.App().setStyles(map);

                //call createLocations, pass HQ coords if init is true
                (init ? gcMap.App().createLocations(map, gcLat, gcLng) : gcMap.App().createLocations(map));

            },

            /*
                gcMap.App().createLocations();
                is Init (based on gcLang truthy)? - Load HQ location
                else - Use window.location to calculate distances by origin,
                    build new window.locSorted object to build location card and marker

                called in drawMap, recieves map object and geolocated origin
             */
            createLocations : function (map, gcLat = false, gcLng = false) {

                window.productFinder.locSorted = {};
                window.productFinder.locSorted.loc = {};

                //Set map bounds
                var bounds = new google.maps.LatLngBounds();
                var finishUp = false;

                //If non-init, loop from window object, else show HQ
                if(!gcLat) {

                    var locations = window.productFinder.loc,
                        locationCount = Object.keys(locations).length,
                        limit = 100,
                        newSortArr = [];

                    //Distance Matrix errors OVER_LIMIT at 100 queries
                    if(locationCount >= 100) {
                        locations = locations.slice(0, limit);
                        locationCount = 100;
                    }

                    var seachAddress = jQuery('#t_map_seach_location').val();
                    var origin = ( seachAddress ? seachAddress : jQuery("#t_hq_address").val() );

                    //Loop through locations array, process and sort via distance matrix
                    jQuery.each(locations, function( index, location ) {

                        var destination = new google.maps.LatLng(location.latitude, location.longitude),
                            _id = location._id,
                            locDist,
                            locId;

                        // Distance Calculations
                        // Two functions:
                        // 1. populate array with distance from orgin values
                        // 2. doMarker for sortedArray items
                        var matrixResponse = calculateDistances([origin],[destination])
                        .done(function(response) {

                            var origins = response.originAddresses;
                            for (var i = 0; i < origins.length; i++) {
                                var results = response.rows[i].elements;
                                for (var j = 0; j < results.length; j++) {
                                    if(response.rows[0].elements[0].status === "OK") {
                                        newSortArr.push([
                                            index,
                                            response.rows[0].elements[0].distance.value

                                        ]);
                                    } else {
                                        newSortArr.push([index, 0]);
                                    }
                                }
                            }

                        })
                        .done(function(response) {
                            // 2. doMarker() on distace sorted array
                            if(locationCount === index + 1) {

                                var sorted = newSortArr.sort(function(a, b) {
                                    return a[1] - b[1];
                                });

                                //Sort array, make new window object
                                jQuery.each(sorted, function( i, distance ) {
                                    locDist = sorted[i][1];
                                    locId   = sorted[i][0];

                                    if(0 < parseInt(locDist,10)) {
                                        window.productFinder.locSorted.loc[i] = locations[locId];
                                    }
                                });

                                var sliced = window.productFinder.locSorted.loc;

                                //Draw the cards based on this sorted object
                                gcMap.App().drawCards(sliced, false);

                                //Sort array, put distance in object, doMarker()
                                jQuery.each(sliced, function( i, distance ) {
                                    locDist = sorted[i][1];
                                    locId   = sorted[i][0];

                                    locations[locId].distance_in_meters = locDist;

                                    gcMap.App().doMarker(
                                            map,
                                            bounds,
                                            locations[locId].latitude,
                                            locations[locId].longitude,
                                            locations[locId],
                                            i
                                        );
                                    }
                                );

                                //Fit map to all markers
                                map.fitBounds(bounds);
                                google.maps.event.addListener(
                                    map,
                                    'click',
                                    map.fitBounds(bounds)
                                );
                            }
                        });

                        gcMap.App().animateIn();

                    });

                    function calculateDistances(origins, destinations) {
                        var service = new google.maps.DistanceMatrixService();
                        var d = jQuery.Deferred();
                        service.getDistanceMatrix({
                                origins: origins,
                                destinations: destinations,
                                travelMode: google.maps.TravelMode.DRIVING,
                                unitSystem: google.maps.UnitSystem.METRIC,
                                avoidHighways: false,
                                avoidTolls: true
                            },
                            function(response, status){
                              if (status != google.maps.DistanceMatrixStatus.OK) {
                                 d.reject(status);
                              } else {
                                 d.resolve(response);
                              }
                            });
                        return d.promise();
                    }

                } else {

                    var hq = {
                        'address' : jQuery("#t_hq_address").val(),
                        'hours' : jQuery("#t_hq_hours").val(),
                        'phone' : jQuery("#t_hq_phone").val(),
                        'name' : jQuery("#t_brewer").val(),
                        'type' : 'brewer',
                        '_id' : 'brewer'
                    };

                    //marker(hq.lat, hq.lng, hq);
                    gcMap.App().doMarker(map, bounds, gcLat, gcLng, hq);

                    //center and zoom out
                    var latLng = new google.maps.LatLng(gcLat, gcLng);
                    map.setCenter(latLng);
                    map.setZoom(8);
                }

            },

            /*  gcMap.App().drawCards();
            *   Draw the cards - called from createLocation() */
            drawCards : function(locations, init = false) {
                if(!init) {

                    locations = (locations.loc ? locations.loc : locations);
                    var cardMarkup;

                    jQuery.each(locations, function( i, value ) {
                        cardMarkup = '<div id="marker_'+value._id+'" class="location item '+ value.type + (i === '0' ? ' active' : '') + '" data-type="'+ value.type +'">';
                        cardMarkup += '<span class="icon '+value.type+'"></span>';
                        cardMarkup += '<div class="cont">';
                        cardMarkup += '<h3>'+value.name+'</h3>';
                        cardMarkup += '<p class="address"> '+ value.address +', ' + value.city + '</p>';
                        cardMarkup += '<ul class="bullet">';
                        if(jQuery('#t_map_seach_location').val() !== undefined) { cardMarkup += '<li class="directions active"><span></span></li>';}
                        if(value.telephone !== undefined) { cardMarkup += '<li class="phone"><span></span></li>';}
                        if(gcMap.App().hours(value) !== undefined) { cardMarkup += '<li class="hours"><span></span></li>';}
                        if(value.url !== undefined) { cardMarkup += '<li class="url"><span></span></li>';}
                        cardMarkup += '</ul>';
                        cardMarkup += '<ul class="text">';
                        if(jQuery('#t_map_seach_location').val() !== undefined) { cardMarkup += '<li class="directions active"><p><a class="button directions" href="https://www.google.ca/maps/dir/'+ jQuery('#t_map_seach_location').val() +'/'+ value.address +'+'+ value.city +'/">Open in map &raquo;</a></p></li>';}
                        if(value.telephone !== undefined) { cardMarkup += '<li class="phone fa"><p><a href="tel:' + value.telephone + '"> ' + value.telephone + '</a></li>';}
                        if(gcMap.App().hours(value) !== undefined) { cardMarkup += '<li class="hours fa"><p>' + gcMap.App().hours(value) + '</p></li>';}
                        if(value.url !== undefined) { cardMarkup += '<li class="url" title=""><p>' + value.url + '</p></li>'; }
                        cardMarkup += '</ul>';
                        cardMarkup += '</div>';
                        cardMarkup += '</div>';
                        // cardMarkup += '<p><span>Distance:</span> ' + parseFloat(value.distance_in_meters/1000).toFixed(1) + 'km</p>';

                        jQuery("#t_info_cards").append(cardMarkup);

                    });

                    jQuery('ul.bullet li').click(function() {
                        var this_node = jQuery(this);
                        var the_parent = this_node.parent().parent().parent().attr('id');
                        var classes = this_node.attr("class");
                        jQuery('#' + the_parent +' ul.bullet li, #' + the_parent +' ul.text li').removeClass('active');
                        this_node.addClass('active');
                        jQuery('#' + the_parent +' ul li.'+ classes).addClass('active');
                    });

                } else {
                        var value = {
                            'name' : jQuery('#t_brewer').val(),
                            'address' : jQuery('#t_hq_address').val(),
                            'telephone' : jQuery('#t_hq_phone').val(),
                            'hours' : jQuery('#t_hq_hours').val()
                        }

                        cardMarkup = '<div id="marker_brewer" class="location item brewer" data-type="brewer">';
                        cardMarkup += '<h3>'+value.name+'</h3>';
                        cardMarkup += '<ul>';
                        cardMarkup += '<li><span class="icon brewer"></span></li>';
                        cardMarkup += '<li class="address"><span></span><p> '+ value.address + '</p></li>';
                        cardMarkup += '<li class="hours"><span></span><p> '+ value.hours + '</p></li>';
                        cardMarkup += '<li class="phone"><span></span><p> <a href="tel:' + value.telephone + '"> ' + value.telephone + '</a></p></li>';
                        cardMarkup += '</ul>';
                        cardMarkup += '</div>';
                        gcMap.App().animateIn();
                        jQuery("#t_info_cards").append(cardMarkup);
                        gcMap.App().animateIn();
                }
            },

            //Markup and bindings for EACH marker, looped below
            doMarker : function(map, bounds, gcLat, gcLng, value, i = false) {
                var url,
                    image = {},
                    myLatLng,
                    marker,
                    iconPath = '/wp-content/plugins/spirit-finder/images/icons/',
                    content,
                    infoCardByMarkerId;

                var markerCardLinkFn;

                switch(value.type) {
                    case 'brewer':
                        image.url = iconPath + value.type + '-pin-active.png';
                        break;
                    default:
                        image.url = iconPath + value.type + '-pin.png';
                }

                myLatLng = new google.maps.LatLng(gcLat, gcLng);
                marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: myLatLng,
                    map: map,
                    title:  value.name,
                    icon: image,
                    metadata: {type: value.type, id: value._id}
                });

                if(i === '0') {
                    marker.setZIndex(1000);
                    marker.setIcon(iconPath + value.type + '-pin-active.png');
                }

                bounds.extend(myLatLng);

                //Not init/brewer - create info window s
                if(value._id !== 'brewer') {

                    content = '<div id="content"><h1 id="firstHeading" class="firstHeading">' + value.name + '</h1></div>';

                    /**
                    Marker / Card interactions
                    //card click: calls openWindowFn
                    //marker touch/click: calls openWindowFn, scroll cards
                    */

                    markerCardLinkFn = function() {

                        if(typeof window.productFinder.tempMarker == "object") {
                            window.productFinder.tempMarker.setZIndex(1);
                            window.productFinder.tempMarker.setIcon('/wp-content/plugins/spirit-finder/images/icons/' + window.productFinder.tempMarker.metadata.type + '-pin.png');
                            window.productFinder.tempMarker.setZIndex(1);
                        }

                        window.productFinder.tempMarker = marker;

                        jQuery('#t_info_cards .location').removeClass('active');
                        jQuery('#t_info_cards #marker_' + value._id + '.location').addClass('active');

                    }

                    infoCardByMarkerId = jQuery('#t_info_cards #marker_' + value._id);

                    /** Action: marker click
                    // - Calls openWindowFn()
                    // - Sets active marker
                    // - Scrolls to card
                    */
                    google.maps.event.addListener(marker, 'click', function() {
                        markerCardLinkFn();
                        marker.setZIndex(100);
                        marker.setIcon('/wp-content/plugins/spirit-finder/images/icons/' + marker.metadata.type + '-pin-active.png');
                        marker.setZIndex(1000);

                        jQuery('#t_info_cards').animate({
                            scrollTop: jQuery("#marker_" + marker.metadata.id).offset().top
                        }, 365);

                    });

                    /** Action: card click
                    // - Calls openWindowFn()
                    // - change icon to active state */
                    infoCardByMarkerId.click(function() {
                        markerCardLinkFn();
                        marker.setZIndex(100);
                        marker.setIcon('/wp-content/plugins/spirit-finder/images/icons/' + marker.metadata.type + '-pin-active.png');
                        marker.setZIndex(1000);
                    });


                }
            },

            hours :  function(l) {

                var days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

                var hours = {},
                    open,
                    close,
                    display = "Open today: ";

                var d = new Date(),
                    now = days[d.getDay()],
                    hour,
                    mins,
                    h24,
                    h12,
                    time,
                    ampm;

                switch(l.type) {
                 case 'beer':
                     break;
                 case 'lcbo':

                    switch(now) {
                        case "sunday":
                            hours.open = l.sunday_open;
                            hours.close = l.sunday_close;
                            break;
                        case "monday":
                            hours.open = l.monday_open;
                            hours.close = l.monday_close;
                            break;
                        case "tuesday":
                            hours.open = l.tuesday_open;
                            hours.close = l.tuesday_close;
                            break;
                        case "wednesday":
                            hours.open = l.wednesday_open;
                            hours.close = l.wednesday_close;
                            break;
                        case "thursday":
                            hours.open = l.thursday_open;
                            hours.close = l.thursday_close;
                            break;
                        case "friday":
                            hours.open = l.friday_open;
                            hours.close = l.friday_close;
                            break;
                        case "saturday":
                            hours.open = l.saturday_open;
                            hours.close = l.saturday_close;
                            break;
                        break;
                     }

                    function msmTo24time(msm) {
                      hour = msm / 60;
                      mins = msm % 60;

                      return [hour, mins];
                    }

                    function msmTo12time(msm) {
                        time = msmTo24time(msm);
                        h24  = time[0];
                        h12  = (0 == h24 ? 12 : (h24 > 12 ? (h24 - 10) - 2 : h24));
                        ampm = (h24 >= 12 ? 'PM' : 'AM');

                        if(h12 % 1 != 0) {
                            h12 = Math.trunc(h12);
                        }

                        if(time[1] === 0) {
                            time[1] = "00";
                        }

                        return [h12 +':'+ time[1] +''+  ampm];
                    }

                    open = msmTo12time(hours.open);
                    close = msmTo12time(hours.close);

                    display += open + '-' + close ;

                    return display;
                    break;
                }
            },

            setStyles : function(map) {
                map.set('styles', [
                    {
                        stylers: [
                            { color: '#F5F5F5' }
                        ]
                    }, {
                        featureType: "administrative",
                        elementType: 'labels',
                        stylers: [
                            { color: '#142B4C' },
                            { weight: 0.5 },
                        ]
                    }, {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [
                            { color: '#C3C6C9' },
                            { weight: 0.1 }
                        ]
                    }, {
                        featureType: 'road.highway',
                        elementType: 'labels',
                        stylers: [
                            { "visibility": "off" },
                        ]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [
                            { color: '#A7A9AC' },
                            { visibility: "on" }
                        ]
                    }, {
                        featureType: "road.arterial",
                        elementType: "labels",
                        stylers: [
                            { visibility: "on" }
                        ]
                    }, {
                        featureType: "road.local",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    }, {
                        featureType: "transit.line",
                        elementType: "geometry",
                        stylers: [
                            { "color": "#A7A9AC" },
                            { weight: 0.45 }
                        ]
                    }, {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    }, {
                        featureType: "administrative.neighborhood",
                        elementType: "labels",
                        stylers: [
                            { "visibility": "off" }
                        ]
                    }, {
                        featureType: 'transit.station',
                        elementType: 'all',
                        stylers: [
                            { visibility: 'off' }
                        ]
                    }, {
                        featureType: 'road',
                        elementType: 'labels',
                        stylers: [
                            { color: '#58595B' }
                        ]
                    }, {
                        featureType: 'road',
                        elementType: 'labels.icon',
                        stylers: [
                            { visibility: 'off' }
                        ]
                    }, {
                        featureType: 'road',
                        elementType: 'labels.text.stroke',
                        stylers: [
                            { color: '#fff' },
                            { weight: 2 }
                        ]
                    }, {
                        featureType: 'water',
                        stylers: [
                            { color: '#D1D3D4' }
                        ]
                    }, {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [
                            { visibility: 'off' }
                        ]
                    }
                ]);
            }

        };

    };

})(gcMap);
