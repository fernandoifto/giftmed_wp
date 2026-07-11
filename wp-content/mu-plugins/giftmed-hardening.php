<?php
/**
 * Plugin Name: GiftMed Hardening
 * Description: Endurecimento básico e desativa All-in-One WP Migration por padrão.
 * Version: 1.0.0
 *
 * Ative a migração com GIFTMED_ALLOW_MIGRATION=1 no ambiente.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove AI1WM da lista de plugins ativos, salvo se permitido via env.
 *
 * @param array $plugins Plugins ativos.
 * @return array
 */
function giftmed_mu_filter_active_plugins( $plugins ) {
	$allow = getenv( 'GIFTMED_ALLOW_MIGRATION' );
	if ( '1' === $allow || 'true' === strtolower( (string) $allow ) ) {
		return $plugins;
	}

	if ( ! is_array( $plugins ) ) {
		return $plugins;
	}

	$target = 'all-in-one-wp-migration/all-in-one-wp-migration.php';
	return array_values( array_filter( $plugins, static function ( $plugin ) use ( $target ) {
		return $plugin !== $target;
	} ) );
}
add_filter( 'option_active_plugins', 'giftmed_mu_filter_active_plugins' );
add_filter( 'site_option_active_sitewide_plugins', static function ( $plugins ) {
	$allow = getenv( 'GIFTMED_ALLOW_MIGRATION' );
	if ( '1' === $allow || 'true' === strtolower( (string) $allow ) ) {
		return $plugins;
	}
	if ( is_array( $plugins ) ) {
		unset( $plugins['all-in-one-wp-migration/all-in-one-wp-migration.php'] );
	}
	return $plugins;
} );

// Desativa XML-RPC (reduz superfície de ataque em site institucional).
add_filter( 'xmlrpc_enabled', '__return_false' );

// Esconde versão do WordPress no front.
remove_action( 'wp_head', 'wp_generator' );
