<?php
/**
 * Setup do tema.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configuração do tema.
 */
function giftmedtema_setup() {
	load_theme_textdomain( 'giftmedtema', GIFTMEDTEMA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 80,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'giftmedtema' ),
			'footer'  => __( 'Menu Rodapé', 'giftmedtema' ),
		)
	);

	add_image_size( 'giftmed-noticia', 640, 360, true );

	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 1120;
	}
}
add_action( 'after_setup_theme', 'giftmedtema_setup' );

/**
 * Classes dos links do menu.
 *
 * @param array $atts Atributos do link.
 * @return array
 */
function giftmedtema_nav_link_attributes( $atts ) {
	$atts['class'] = 'gm-nav-link';
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'giftmedtema_nav_link_attributes' );

/**
 * Menu de fallback (âncoras da home).
 *
 * @param array $args Argumentos do wp_nav_menu.
 */
function giftmedtema_fallback_menu( $args ) {
	$items = array(
		'#noticias'        => __( 'Notícias', 'giftmedtema' ),
		'#solucao'         => __( 'A Solução', 'giftmedtema' ),
		'#desafio'         => __( 'O Desafio', 'giftmedtema' ),
		'#como-funciona'   => __( 'Como Funciona', 'giftmedtema' ),
		'#funcionalidades' => __( 'Recursos', 'giftmedtema' ),
		'#impacto'         => __( 'Impacto', 'giftmedtema' ),
	);

	$menu_class = isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : '';
	echo '<ul class="' . $menu_class . '">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s" class="gm-nav-link">%s</a></li>',
			esc_url( home_url( '/' ) . $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Trecho curto para cards.
 *
 * @return int
 */
function giftmedtema_excerpt_length() {
	return 28;
}
add_filter( 'excerpt_length', 'giftmedtema_excerpt_length' );

/**
 * Remove reticências padrão do excerpt.
 *
 * @return string
 */
function giftmedtema_excerpt_more() {
	return '';
}
add_filter( 'excerpt_more', 'giftmedtema_excerpt_more' );
