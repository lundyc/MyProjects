<?php

	/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
	 *	 SETTINGS  
	 */	

	define('APP_ID', '217395621684711');				# UPDATE
	define('SECRET_ID', '0c9bebaea02f4ebf291f2d154735a537');			# UPDATE
	define('THUMB_WIDTH', 150);
	define('THUMB_HEIGHT', 100);

			
	/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
	 *	 REDIRECTS
	 */	
	
	// *** The page to redirect to after a login
	define('REDIRECT_URL', '');
	
	// *** If your server doesn't support http_host or php _self then you'll 
	//   * need to set this constant manuallly (fb_tools/auth_user.php)
	define('REDIRECT_URL_AUTH', 'http://' . $_SERVER['HTTP_HOST'] . '' . $_SERVER['PHP_SELF'] ); 	
	
	
	/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
	 *	 ADVANCED SETTINGS  
	 */

	define('AUTH_USER', 'primary');

	//define('PUBLIC_USER', '40796308305'); # depricated
	define('PAGE_ID', '40796308305');		# this is the id of Coke. It's good for testing. We could also use their name 'Coca-Cola'.
	define('USE_PAGE_ID', false);

	define('TRACE', true);
	define('CACHE_ENABLED', true);
	define('MEMORY_CACHE_ENABLED', true);
	define('CACHE_DELETABLE', true);
	define('CACHE_FOLDER', 'cached_data');
	define('CACHE_MINUTES', 300); # 300 = 5hours
	define('DATE_FORMAT', 'd F y \a\t g:i a');
	
	define('REPLY_AS_PAGE', false); # when posting to a "page", you can post as your user or post (impersonate) as the page.
	define('USE_CUSTOM_DATA_STORE', false); # define your own saving/reading token code (eg. want to use your DB)
	define('MULTI_USER', false); # set multi user mode
?>
