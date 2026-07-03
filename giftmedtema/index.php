<?php
/**
 * Template fallback do tema.
 *
 * @package GiftMedTema
 */

get_header();
?>

<main class="gm-section">
	<div class="gm-container" style="max-width: 48rem;">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'gm-card reveal is-visible' ); ?> style="margin-bottom: 1.5rem;">
					<h1 class="gm-title" style="font-size: 1.75rem; margin-bottom: 1rem;">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>
					<div class="gm-card__text">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<div style="display: flex; justify-content: space-between; font-weight: 700; color: var(--gm-navy);">
				<div><?php previous_posts_link( __( '← Anteriores', 'giftmedtema' ) ); ?></div>
				<div><?php next_posts_link( __( 'Próximos →', 'giftmedtema' ) ); ?></div>
			</div>
		<?php else : ?>
			<p class="gm-card__text"><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'giftmedtema' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
