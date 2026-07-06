<?php
/**
 * Arquivo de categoria — listagem de notícias e demais categorias.
 *
 * @package GiftMedTema
 */

get_header();

$is_noticias = is_category( 'noticias' ) || ( is_category() && get_queried_object() && 'noticias' === get_queried_object()->slug );
?>

<main id="primary" class="gm-section gm-archive-section<?php echo $is_noticias ? ' gm-archive-section--noticias' : ''; ?>">
	<div class="gm-container">
		<header class="gm-archive__head reveal is-visible">
			<span class="gm-eyebrow gm-eyebrow--navy">
				<?php echo $is_noticias ? esc_html__( 'Atualizações', 'giftmedtema' ) : esc_html__( 'Categoria', 'giftmedtema' ); ?>
			</span>
			<h1 class="gm-title">
				<?php
				if ( $is_noticias ) {
					esc_html_e( 'Todas as notícias', 'giftmedtema' );
				} else {
					single_cat_title();
				}
				?>
			</h1>
			<?php if ( $is_noticias ) : ?>
				<p class="gm-archive__desc">
					<?php esc_html_e( 'Acompanhe as novidades, campanhas e avanços da plataforma GiftMed.', 'giftmedtema' ); ?>
				</p>
			<?php else : ?>
				<?php
				$description = category_description();
				if ( $description ) :
					?>
					<div class="gm-archive__desc"><?php echo wp_kses_post( $description ); ?></div>
				<?php endif; ?>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="gm-archive__grid<?php echo $is_noticias ? ' gm-archive__grid--noticias' : ''; ?>" role="list">
				<?php
				$index = 0;
				while ( have_posts() ) :
					the_post();
					++$index;

					$item = array(
						'title'    => get_the_title(),
						'excerpt'  => wp_trim_words( get_the_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content( null, false ) ), 28, '…' ),
						'date'     => get_the_date( 'Y-m-d' ),
						'category' => giftmedtema_get_noticia_category_label( get_the_ID() ),
						'image'    => get_the_post_thumbnail_url( get_the_ID(), 'giftmed-noticia' )
							? get_the_post_thumbnail_url( get_the_ID(), 'giftmed-noticia' )
							: giftmedtema_asset( 'assets/img/giftmedquadrado.png' ),
						'url'      => get_permalink(),
					);
					?>
					<div class="gm-archive__item reveal is-visible" role="listitem">
						<?php giftmedtema_render_noticia_card( $item, ( $index % 5 ) + 1, $is_noticias ? 'archive' : 'featured' ); ?>
					</div>
				<?php endwhile; ?>
			</div>

			<nav class="gm-archive__nav" aria-label="<?php esc_attr_e( 'Paginação de notícias', 'giftmedtema' ); ?>">
				<div><?php previous_posts_link( __( '← Anteriores', 'giftmedtema' ) ); ?></div>
				<div><?php next_posts_link( __( 'Próximos →', 'giftmedtema' ) ); ?></div>
			</nav>
		<?php else : ?>
			<p class="gm-archive__empty"><?php esc_html_e( 'Nenhuma notícia encontrada.', 'giftmedtema' ); ?></p>
		<?php endif; ?>

		<div class="gm-archive__back">
			<a href="<?php echo esc_url( home_url( '/#noticias' ) ); ?>" class="gm-btn gm-btn--primary">
				<?php esc_html_e( '← Voltar à página inicial', 'giftmedtema' ); ?>
			</a>
		</div>
	</div>
</main>

<?php
get_footer();
