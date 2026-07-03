<?php
/**
 * GiftMed Tema — funções do tema.
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
	return get_template_directory_uri() . ( $path ? '/' . ltrim( $path, '/' ) : '' );
}

/**
 * Configuração do tema.
 */
function giftmedtema_setup() {
	load_theme_textdomain( 'giftmedtema', get_template_directory() . '/languages' );

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

	add_image_size( 'giftmed-team', 200, 200, true );
}
add_action( 'after_setup_theme', 'giftmedtema_setup' );

/**
 * Enfileira estilos e scripts.
 */
function giftmedtema_scripts() {
	wp_enqueue_style(
		'giftmedtema-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_script(
		'giftmedtema-tailwind',
		'https://cdn.tailwindcss.com',
		array(),
		null,
		false
	);

	wp_enqueue_style(
		'giftmedtema-style',
		get_stylesheet_uri(),
		array( 'giftmedtema-fonts' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/css/theme.css' ),
		array( 'giftmedtema-style' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/js/theme.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'giftmedtema_scripts' );

/**
 * Classes dos links do menu principal.
 *
 * @param array $atts Atributos do link.
 * @return array
 */
function giftmedtema_nav_link_attributes( $atts ) {
	$atts['class'] = 'hover:text-teal-600 transition-colors';
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'giftmedtema_nav_link_attributes' );

/**
 * Menu de fallback (âncoras da home) quando nenhum menu está atribuído.
 *
 * @param array $args Argumentos do wp_nav_menu.
 */
function giftmedtema_fallback_menu( $args ) {
	$items = array(
		'#desafio'         => __( 'O Desafio', 'giftmedtema' ),
		'#solucao'         => __( 'A Solução', 'giftmedtema' ),
		'#como-funciona'   => __( 'Como Funciona', 'giftmedtema' ),
		'#funcionalidades' => __( 'Recursos', 'giftmedtema' ),
		'#impacto'         => __( 'Impacto', 'giftmedtema' ),
		'#equipe'          => __( 'Equipe', 'giftmedtema' ),
	);

	$menu_class = isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : '';
	echo '<ul class="' . $menu_class . '">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s" class="hover:text-teal-600 transition-colors">%s</a></li>',
			esc_url( home_url( '/' ) . $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Trecho curto para cards da home.
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

/**
 * Meta auxiliar de um post (cargo, ícone, etc.).
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
 * Query de posts por slug de categoria.
 *
 * @param string $category_slug Slug da categoria.
 * @param int    $posts_per_page Quantidade.
 * @return WP_Query
 */
function giftmedtema_query_by_category( $category_slug, $posts_per_page = -1 ) {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => true,
			'orderby'             => 'menu_order date',
			'order'               => 'ASC',
			'category_name'       => $category_slug,
		)
	);
}

/**
 * Processa o formulário de demonstração.
 */
function giftmedtema_handle_demo_request() {
	if ( ! isset( $_POST['giftmed_demo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_demo_nonce'] ) ), 'giftmed_demo' ) ) {
		wp_safe_redirect( home_url( '/#contato' ) );
		exit;
	}

	$name     = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$orgao    = isset( $_POST['orgao'] ) ? sanitize_text_field( wp_unslash( $_POST['orgao'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$redirect = home_url( '/#contato' );

	if ( $name && $orgao && is_email( $email ) ) {
		$subject = sprintf( '[GiftMed] Solicitação de demo — %s', $name );
		$body    = sprintf(
			"Nome: %s\nÓrgão/Município: %s\nE-mail: %s\n",
			$name,
			$orgao,
			$email
		);
		wp_mail( get_option( 'admin_email' ), $subject, $body );
		$redirect = add_query_arg( 'demo', 'ok', $redirect );
	} else {
		$redirect = add_query_arg( 'demo', 'erro', $redirect );
	}

	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_nopriv_giftmed_demo', 'giftmedtema_handle_demo_request' );
add_action( 'admin_post_giftmed_demo', 'giftmedtema_handle_demo_request' );
