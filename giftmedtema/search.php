<?php
/**
 * Template de busca.
 *
 * @package GiftMedTema
 */

get_header();
?>

<main class="gm-section gm-section--soft" id="conteudo">
	<div class="gm-container">
		<header class="reveal is-visible" style="margin-bottom:2rem;">
			<p class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Busca', 'giftmedtema' ); ?></p>
			<h1 class="gm-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Resultados para: %s', 'giftmedtema' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
			<?php get_search_form(); ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="gm-news-feed" role="list">
				<?php
				while ( have_posts() ) :
					the_post();
					$image = get_the_post_thumbnail_url( get_the_ID(), 'giftmed-noticia' );
					if ( ! $image ) {
						$image = giftmedtema_asset( 'assets/img/giftmedquadrado.png' );
					}
					giftmedtema_render_noticia_card(
						array(
							'title'    => get_the_title(),
							'excerpt'  => wp_trim_words( get_the_excerpt(), 28, '…' ),
							'date'     => get_the_date( 'Y-m-d' ),
							'category' => giftmedtema_get_noticia_category_label( get_the_ID() ),
							'image'    => $image,
							'url'      => get_permalink(),
						),
						1,
						'archive'
					);
				endwhile;
				?>
			</div>
			<nav class="gm-pagination" style="display:flex;justify-content:space-between;margin-top:2rem;">
				<div><?php previous_posts_link( __( '← Anteriores', 'giftmedtema' ) ); ?></div>
				<div><?php next_posts_link( __( 'Próximos →', 'giftmedtema' ) ); ?></div>
			</nav>
		<?php else : ?>
			<p class="gm-card__text"><?php esc_html_e( 'Nenhum resultado encontrado.', 'giftmedtema' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
