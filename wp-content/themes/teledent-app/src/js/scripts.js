


jQuery("document").ready(function(){

    //Parent Theme DOM Overrides
    (function(){
            var slugname = 'teledent';
            jQuery('html').attr('id', slugname);
    })();

    //Handle Mobile Nav Slideout Menu
    (function() {
            jQuery('#slide-out-widget-area .inner')
                .prepend('<form action="#" method="GET"><input type="text" name="s" value="" placeholder="Search"></form>')
                .prepend('<img class="stnd" alt="Liberty Ridge Homes" src="/wp-content/themes/libertyridge/assets/img/LibertyRidge_Brand_ID_Final_Reverse.svg">');
    })();

    // Section-News: append 'Read More' link
    var $sectionNews = document.querySelector('.section-news');
    if ($sectionNews) {
    	var postArray = document.querySelectorAll('.blog-recent > .col'),
    		newAnchor,
    		newAnchorText,
    		postLink,
    		innerWrap;
    	for (
    			var i = 0, max = postArray.length;
    			i < max;
    			i++
    		) {
    		newAnchor = document.createElement('a');
    		newAnchorText = document.createTextNode('Read more');
    		postLink = postArray[i].querySelector('.entire-meta-link').href;
    		innerWrap = postArray[i].querySelector('.inner-wrap');
    		newAnchor.href = postLink;
    		newAnchor.classList += 'link-read-more';
    		newAnchor.appendChild(newAnchorText);
    		innerWrap.appendChild(newAnchor);
    	}
    }

    jQuery('document').ready(function() {
        if(jQuery("div").hasClass('has-sub-menu')) {
            //SUBMENU -- build submenu and insert anchors for h2s
            var makeAnchor,
                makeText;

            jQuery("header#top nav").append('<ul id="submenu"><ul>');

            jQuery( "h2" ).each(function( index ) {
                makeText = jQuery( this ).text();
                makeAnchor = makeText.split(' ');
                makeAnchor = makeAnchor.join('-').toLowerCase().replace('&-','');
                jQuery( "#submenu" ).append('<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="#'+makeAnchor+'">'+makeText+'</a></li>');
                jQuery( this ).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().prepend('<a name="' + makeAnchor + '"></a>');
            });

            jQuery("#submenu ul").remove();
        }
    });
});