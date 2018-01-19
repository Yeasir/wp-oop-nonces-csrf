<?php

function wp_nonce_ays( $action ) {
	if ( 'log-out' == $action ) {
		return 'logout';
	} else {
		return 'Are you sure you want to do this?';
	}
}

function wp_nonce_field( $action = -1, $name = "_wpnonce", $referer = true , $echo = true ) {
	$name = filter_var($name, FILTER_SANITIZE_STRING);
	$nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . wp_create_nonce( $action ) . '" />';
	return $nonce_field;
}

function wp_nonce_url($actionurl='http://site.ru/url', $action = -1, $name = '_wpnonce') {
	return $actionurl . '?' . $name . '=' . wp_create_nonce( $action );
}
function wp_verify_nonce($nonce='my-nonce', $action = -1) {
	$nonce = (string) $nonce;
	if ( empty( $nonce ) ) {
		return false;
	}
	$expected = wp_create_nonce( $action );
	if ( hash_equals( $expected, $nonce ) ) {
		return 1;
	}
	return false;
}
function wp_create_nonce($action = -1) {
	return substr( hash_hmac('md5', $action, 'alseajflasdjsadfjslka'), -12, 10 );
}
function check_admin_referer($action = -1, $query_arg = '_wpnonce' ) {
	return isset($_REQUEST[$query_arg]) ? wp_verify_nonce($_REQUEST[$query_arg], $action) : false;
}
function check_ajax_referer($action = -1, $query_arg = false) {
	$nonce = '';
	if ( $query_arg && isset( $_REQUEST[ $query_arg ] ) )
		$nonce = $_REQUEST[ $query_arg ];
	elseif ( isset( $_REQUEST['_ajax_nonce'] ) )
		$nonce = $_REQUEST['_ajax_nonce'];
	elseif ( isset( $_REQUEST['_wpnonce'] ) )
		$nonce = $_REQUEST['_wpnonce'];

	return wp_verify_nonce( $nonce, $action );
}
function wp_referer_field($echo = true) {
	$url = 'http://csrf-nonce.com';
	$referer_field = '<input type="hidden" name="_wp_http_referer" value="'. $url  . '" />';
	return $referer_field;
}