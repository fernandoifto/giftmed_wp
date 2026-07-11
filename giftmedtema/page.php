<?php
/**
 * Template de página.
 *
 * @package GiftMedTema
 */

get_header();
?>

<main class="gm-section gm-section--soft" id="conteudo">
	<div class="gm-container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article <?php post_class( 'gm-card reveal is-visible' ); ?>>
					<header class="gm-single__header">
						<h1 class="gm-title"><?php the_title(); ?></h1>
					</header>
					<div class="gm-prose">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
