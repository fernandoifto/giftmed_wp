<?php
/**
 * Formulário de demonstração.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Processa o formulário de demonstração.
 */
function giftmedtema_handle_demo_request() {
	$redirect = home_url( '/#contato' );

	if ( ! isset( $_POST['giftmed_demo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_demo_nonce'] ) ), 'giftmed_demo' ) ) {
		wp_safe_redirect( add_query_arg( 'demo', 'erro', $redirect ) );
		exit;
	}

	// Honeypot — bots preenchem campos ocultos.
	$honeypot = isset( $_POST['website'] ) ? trim( (string) wp_unslash( $_POST['website'] ) ) : '';
	if ( '' !== $honeypot ) {
		wp_safe_redirect( add_query_arg( 'demo', 'ok', $redirect ) );
		exit;
	}

	$ip       = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$rate_key = 'giftmed_demo_rate_' . md5( $ip );
	if ( get_transient( $rate_key ) ) {
		wp_safe_redirect( add_query_arg( 'demo', 'erro', $redirect ) );
		exit;
	}

	$name  = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$orgao = isset( $_POST['orgao'] ) ? sanitize_text_field( wp_unslash( $_POST['orgao'] ) ) : '';
	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( $name && $orgao && is_email( $email ) ) {
		$to = giftmedtema_mod( 'email_contato', get_option( 'admin_email' ) );
		if ( ! is_email( $to ) ) {
			$to = get_option( 'admin_email' );
		}

		$subject = sprintf( '[GiftMed] Solicitação de demo — %s', $name );
		$body    = sprintf(
			"Nome: %s\nÓrgão/Município: %s\nE-mail: %s\n",
			$name,
			$orgao,
			$email
		);
		wp_mail( $to, $subject, $body );
		set_transient( $rate_key, 1, 10 * MINUTE_IN_SECONDS );
		$redirect = add_query_arg( 'demo', 'ok', $redirect );
	} else {
		$redirect = add_query_arg( 'demo', 'erro', $redirect );
	}

	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_nopriv_giftmed_demo', 'giftmedtema_handle_demo_request' );
add_action( 'admin_post_giftmed_demo', 'giftmedtema_handle_demo_request' );
