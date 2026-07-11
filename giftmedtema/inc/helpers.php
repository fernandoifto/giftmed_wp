<?php
/**
 * Helpers gerais do tema.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URI de um asset do tema.
 *
 * @param string $path Caminho relativo dentro do tema.
 * @return string
 */
function giftmedtema_asset( $path = '' ) {
	return GIFTMEDTEMA_URI . ( $path ? '/' . ltrim( $path, '/' ) : '' );
}

/**
 * Lê uma opção do Customizer com fallback.
 *
 * @param string $key     Chave sem o prefixo.
 * @param mixed  $default Valor padrão.
 * @return mixed
 */
function giftmedtema_mod( $key, $default = '' ) {
	return get_theme_mod( 'giftmedtema_' . $key, $default );
}

/**
 * Meta auxiliar de um post.
 *
 * @param int    $post_id ID do post.
 * @param string $key     Chave do meta.
 * @param string $default Valor padrão.
 * @return string
 */
function giftmedtema_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( '' !== $value && false !== $value ) ? (string) $value : $default;
}

/**
 * Indica se o código de seed deve ser carregado.
 *
 * @return bool
 */
function giftmedtema_should_load_seed() {
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		return true;
	}

	return giftmedtema_should_seed_noticias();
}

/**
 * Indica se o seed automático de notícias está habilitado.
 *
 * Requer GIFTMED_SEED_NOTICIAS=1. Em production exige também GIFTMED_SEED_FORCE=1.
 *
 * @return bool
 */
function giftmedtema_should_seed_noticias() {
	$flag = getenv( 'GIFTMED_SEED_NOTICIAS' );
	if ( '1' !== $flag && 'true' !== strtolower( (string) $flag ) ) {
		return false;
	}

	if ( function_exists( 'wp_get_environment_type' ) && 'production' === wp_get_environment_type() ) {
		$force = getenv( 'GIFTMED_SEED_FORCE' );
		return '1' === $force || 'true' === strtolower( (string) $force );
	}

	return true;
}

/**
 * Linhas de textarea → array.
 *
 * @param string $raw Texto.
 * @return string[]
 */
function giftmedtema_lines( $raw ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $raw );
	$out   = array();
	foreach ( (array) $lines as $line ) {
		$line = trim( $line );
		if ( '' !== $line ) {
			$out[] = $line;
		}
	}
	return $out;
}
