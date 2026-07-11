<?php
/**
 * Assets do tema.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enfileira estilos e scripts.
 */
function giftmedtema_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'giftmedtema-fonts',
		giftmedtema_asset( 'assets/css/fonts.css' ),
		array(),
		$version
	);

	wp_enqueue_style(
		'giftmedtema-style',
		get_stylesheet_uri(),
		array( 'giftmedtema-fonts' ),
		$version
	);

	wp_enqueue_style(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/css/theme.css' ),
		array( 'giftmedtema-style' ),
		$version
	);

	wp_enqueue_script(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/js/theme.js' ),
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'giftmedtema_scripts' );
