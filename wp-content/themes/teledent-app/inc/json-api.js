(function($) {

	const articleContainer = $('.main-row > .page');

	function init() {
		loadUsers();
	};
	init();

	function loadUsers() {
		// let users = new wp.api.collections.Users();
		// users.fetch({ data: { } }).done( () => {
		// 		clearPosts();
		// 		users.each( user => loadUser( user.attributes ) );
		// });
		
		var me = new wp.api.models.User({
			id: 50
		});
		me.fetch().done( () => {
				//console.log(me);
		});

		// var me2 = new wp.api.models.Me();
		// me2.fetch().done( () => { /* continue when loaded */
		//    var meUser2 = new wp.api.models.User( me.attributes );
		//    console.log(meUser2);
		// });


		jQuery.ajax( {
		    url: wpApiSettings.root + 'wp/v2/users/me',
		    method: 'GET',
		    beforeSend: function ( xhr ) {
		        xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
		    }
		} ).done( function ( response ) {
		    console.log( response );
		} );
	}

	function loadUser( user ) {
		let article = $('<article class="user"></article>'),
				titleLink = $('<a></a>').attr( 'href', user.link ).text( user.name ),
				title = $('<h2 class="entry-title"></h2>').append( titleLink ),
				keysValuesString = '<pre>';
				keyValues = function() {
					for (i in user){
					    keysValuesString += (i + ": " + user[i] + '\n');
					}
				};
				keyValues(user);
				keysValuesString += '</pre>';

		$(article).append(title).append(keysValuesString);
		$(articleContainer).append(article) ;
	}

	/**
	 * clearPosts - Clears posts on the page
	 *
	 */
	function clearPosts() {
		$(articleContainer).html('');
	}

})( jQuery );
