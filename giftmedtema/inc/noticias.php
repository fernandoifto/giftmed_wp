<?php
/**
 * Consultas e helpers de notícias.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Query de posts por slug de categoria.
 *
 * @param string $category_slug  Slug da categoria.
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
 * URL do arquivo com todas as notícias.
 *
 * @return string
 */
function giftmedtema_get_noticias_archive_url() {
	$category = get_category_by_slug( 'noticias' );

	if ( $category instanceof WP_Term ) {
		return get_category_link( $category->term_id );
	}

	return home_url( '/' );
}

/**
 * Consulta posts da categoria Notícias.
 *
 * @param int $count Quantidade de posts.
 * @return WP_Query
 */
function giftmedtema_get_noticias_query( $count = 5 ) {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $count,
			'ignore_sticky_posts' => true,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'category_name'       => 'noticias',
			'no_found_rows'       => true,
		)
	);
}

/**
 * Rótulo de categoria exibido no card.
 *
 * @param int $post_id ID do post.
 * @return string
 */
function giftmedtema_get_noticia_category_label( $post_id ) {
	$categories = get_the_category( $post_id );

	foreach ( $categories as $category ) {
		if ( ! in_array( $category->slug, array( 'noticias', 'uncategorized' ), true ) ) {
			return $category->name;
		}
	}

	return ! empty( $categories ) ? $categories[0]->name : __( 'Notícias', 'giftmedtema' );
}

/**
 * Itens de notícia a partir de posts reais.
 *
 * @param int $count Quantidade.
 * @return array<int, array<string, string>>
 */
function giftmedtema_get_noticias_items( $count = 5 ) {
	$query = giftmedtema_get_noticias_query( $count );
	$items = array();

	if ( ! $query->have_posts() ) {
		return $items;
	}

	while ( $query->have_posts() ) {
		$query->the_post();

		$image = get_the_post_thumbnail_url( get_the_ID(), 'giftmed-noticia' );
		if ( ! $image ) {
			$image = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
		}

		$excerpt = get_the_excerpt();
		if ( '' === trim( wp_strip_all_tags( $excerpt ) ) ) {
			$excerpt = wp_trim_words( wp_strip_all_tags( get_the_content( null, false ) ), 28, '…' );
		} else {
			$excerpt = wp_trim_words( $excerpt, 28, '…' );
		}

		$items[] = array(
			'title'    => get_the_title(),
			'excerpt'  => $excerpt,
			'date'     => get_the_date( 'Y-m-d' ),
			'category' => giftmedtema_get_noticia_category_label( get_the_ID() ),
			'image'    => $image ? $image : giftmedtema_asset( 'assets/img/giftmedquadrado.png' ),
			'url'      => get_permalink(),
		);
	}

	wp_reset_postdata();

	return $items;
}
