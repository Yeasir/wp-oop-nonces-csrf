<?php
require_once "test_functions.php";
use PHPUnit\Framework\TestCase;
use wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf;

class WpOopCsrfTest extends TestCase {

	public function test_wp_oop_create_nonce() {
		$Wp_Csrf_Nonce = new Wp_Oop_Nonces_Csrf();
		$csrf_nonce    = $Wp_Csrf_Nonce->wp_oop_create_nonce( 'csrf-nonce' );
		$this->assertEquals( $Wp_Csrf_Nonce->wp_oop_verify_nonce( $csrf_nonce, 'csrf-nonce' ), 1 );
	}

	public function test_wp_oop_nonce_csrf_field() {
		$Wp_Csrf_Nonce    = new Wp_Oop_Nonces_Csrf();
		$csrf_nonce_field = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_field( 'csrf-nonce', '_csrf_nonce', true, false );
		$dom         = new DOMDocument();
		$dom->loadHTML( $csrf_nonce_field );
		$input = $dom->getElementsByTagName( 'input' )->item( 0 );
		if ( ! empty( $input ) ) {
			$csrf_nonce = $input->getAttribute( 'value' );
			$this->assertEquals( $Wp_Csrf_Nonce->wp_oop_verify_nonce( $csrf_nonce, 'csrf-nonce' ), 1 );
		} else {
			$this->assertTrue( false );
		}
	}

	public function test_wp_oop_nonce_csrf_URL() {
		$Wp_Csrf_Nonce   = new Wp_Oop_Nonces_Csrf();
		$url        = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_URL( 'http://csrf-nonce-url.com' );
		$parsed_url = parse_url( $url );
		$query      = $parsed_url['query'];
		$params     = explode( '=', $query );
		$csrf_nonce      = $params[1];
		$this->assertEquals( $Wp_Csrf_Nonce->wp_oop_verify_nonce( $csrf_nonce ), 1 );
	}

	public function test_wp_oop_nonce_csrf_check_admin_referer() {
		$Wp_Csrf_Nonce             = new Wp_Oop_Nonces_Csrf();
		$csrf_nonce                = $Wp_Csrf_Nonce->wp_oop_create_nonce( 'csrf-nonce' );
		$_REQUEST['_csrf_nonce'] = $csrf_nonce;
		$this->assertEquals( $Wp_Csrf_Nonce->wp_oop_nonce_csrf_check_admin_referer( 'csrf-nonce', '_csrf_nonce' ), 1 );
	}

	public function test_wp_oop_nonce_csrf_checka_ajax_referer() {
		$Wp_Csrf_Nonce             = new Wp_Oop_Nonces_Csrf();
		$csrf_nonce                = $Wp_Csrf_Nonce->wp_oop_create_nonce( 'csrf-nonce' );
		$_REQUEST['_csrf_nonce'] = $csrf_nonce;
		$this->assertEquals( $Wp_Csrf_Nonce->wp_oop_nonce_csrf_checka_ajax_referer( 'csrf-nonce', '_csrf_nonce' ), 1 );
	}

	public function test_wp_oop_nonce_csrf_referer_field() {
		$Wp_Csrf_Nonce    = new Wp_Oop_Nonces_Csrf();
		$csrf_nonce_field = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_referer_field(false);
		$dom         = new DOMDocument();
		$dom->loadHTML( $csrf_nonce_field );
		$input = $dom->getElementsByTagName( 'input' )->item( 0 );
		if ( ! empty( $input ) ) {
			$server_uri = 'http://csrf-nonce.com';
			$csrf_nonce_uri = $input->getAttribute( 'value' );
			$this->assertEquals( $csrf_nonce_uri, $server_uri );
		} else {
			$this->assertTrue( false );
		}
	}

	public function test_wp_nonce_ays_oop($action='log-out') {
		$Wp_Csrf_Nonce = new Wp_Oop_Nonces_Csrf();
		$nonceAys = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_ays($action='log-out');
		$this->assertEquals('logout', $nonceAys);
	}

}