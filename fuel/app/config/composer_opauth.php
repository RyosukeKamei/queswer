<?php
/**
 * Opauth basic configuration file to quickly get you started
 * ==========================================================
 * To use: rename to opauth.conf.php and tweak as you like
 * If you require advanced configuration options, refer to opauth.conf.php.advanced
 */

$config = array(
/**
 * Path where Opauth is accessed.
 *  - Begins and ends with /
 *  - eg. if Opauth is reached via http://example.org/auth/, path is '/auth/'
 *  - if Opauth is reached via http://auth.example.org/, path is '/'
 */
	'path' => '/login/action',

/**
 * Callback URL: redirected to after authentication, successful or otherwise
 */
	'callback_url' => '/login/callback',
	
/**
 * A random string used for signing of $auth response.
 */
	'security_salt' => 'korejoap',
		
/**
 * Strategy
 * Refer to individual strategy's documentation on configuration requirements.
 * 
 * eg.
 * 'Strategy' => array(
 * 
 *   'Facebook' => array(
 *      'app_id' => 'APP ID',
 *      'app_secret' => 'APP_SECRET'
 *    ),
 * 
 * )
 *
 */
	'Strategy' => array(
		// Define strategies and their respective configs here
		'Twitter' => array(
			  'key'    => 'gaaEi5eHPoseilymiR1yOII1A'
			, 'secret' => 'yi8I1UQ3zzIhdlvO0pgT2Im2X8UuIXzWpXdeq4YgOAyBAQYSWG'
		)
	),
);