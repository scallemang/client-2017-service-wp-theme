(function($) {

	const articleContainer = $('.main-row > .page');

	function init() {
		loadUsers();
	};
	init();

	function loadUsers() {
		let users = new wp.api.collections.Users();
		users.fetch({ data: { } }).done( () => {
				clearPosts();
				users.each( user => loadUser( user.attributes ) );
		});
		console.log(users);
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
