<?php

if ( !function_exists('generate_password') ) :

  function generate_password( $length = 12, $special_chars = true, $extra_special_chars = false ) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		if ( $special_chars )
			$chars .= '!@#$%^&*()';
		if ( $extra_special_chars )
			$chars .= '-_ []{}<>~`+=,.;:/?|';

		$password = '';
		for ( $i = 0; $i < $length; $i++ ) {
			$password .= substr($chars, rand (0, strlen($chars) - 1), 1);
		}

		// random_password filter was previously in random_password function which was deprecated
		return $password;
	}
endif;

function remote_retrieve_body(&$response) {
	if ( ! isset($response['body']) )
		return '';

	return $response['body'];
}

//random
$secret_keys = array();
for ( $i = 0; $i < 8; $i++ ) {
  $secret_keys[] = generate_password( 64, true, true );
}

// $secret_keys = explode( "\n", remote_retrieve_body( $secret_keys ) );
foreach ( $secret_keys as $k => $v) {
	$secret_keys[$k] = substr( $v, 28, 64 );
}

var_dump($secret_keys);

