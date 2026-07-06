<?php
/**
 * Template de post individual (notícias e demais posts).
 *
 * @package GiftMedTema
 */

get_header();

$archive_url = giftmedtema_get_noticias_archive_url();
?>

<main id="primary" class="gm-section gm-single-section">
	<div class="gm-container">
		<nav class="gm-single__nav reveal is-visible" aria-label="<?php esc_attr_e( 'Navegação do artigo', 'giftmedtema' ); ?>">
			<a href="<?php echo esc_url( $archive_url ); ?>" class="gm-single__back">
				<span aria-hidden="true">←</span>
				<?php esc_html_e( 'Todas as notícias', 'giftmedtema' ); ?>
			</a>
		</nav>

		<?php
		while ( have_posts() ) :
			the_post();

			$category_label = giftmedtema_get_noticia_category_label( get_the_ID() );
			$excerpt        = get_the_excerpt();
			?>
			<article <?php post_class( 'gm-single__article reveal is-visible' ); ?>>
				<header class="gm-single__hero">
					<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Atualizações', 'giftmedtema' ); ?></span>

					<div class="gm-single__meta">
						<span class="gm-news-category gm-news-category--light"><?php echo esc_html( $category_label ); ?></span>
						<time class="gm-single__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
					</div>

					<h1 class="gm-single__title"><?php the_title(); ?></h1>

					<?php if ( $excerpt ) : ?>
						<p class="gm-single__lead"><?php echo esc_html( wp_strip_all_tags( $excerpt ) ); ?></p>
					<?php endif; ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="gm-single__media">
						<?php the_post_thumbnail( 'giftmed-noticia', array( 'class' => 'gm-single__media-img' ) ); ?>
					</figure>
				<?php endif; ?>

				<div class="gm-single__content">
					<?php the_content(); ?>
				</div>

				<footer class="gm-single__footer">
					<div class="gm-single__footer-bar">
						<p class="gm-single__footer-label">
							<?php esc_html_e( 'Publicado em', 'giftmedtema' ); ?>
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						</p>
					</div>
					<div class="gm-single__footer-actions">
						<a href="<?php echo esc_url( $archive_url ); ?>" class="gm-btn gm-btn--secondary">
							<?php esc_html_e( '← Todas as notícias', 'giftmedtema' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/#noticias' ) ); ?>" class="gm-btn gm-btn--primary">
							<?php esc_html_e( 'Ir para a home', 'giftmedtema' ); ?>
						</a>
					</div>
				</footer>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
