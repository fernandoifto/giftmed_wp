<?php
/**
 * Template fallback do tema.
 *
 * @package GiftMedTema
 */

get_header();
?>

<main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mb-12 pb-12 border-b border-slate-100' ); ?>>
				<h1 class="text-3xl font-black text-slate-900 mb-4">
					<a href="<?php the_permalink(); ?>" class="hover:text-teal-600 transition-colors"><?php the_title(); ?></a>
				</h1>
				<div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<div class="flex justify-between text-sm font-bold text-teal-700">
			<div><?php previous_posts_link( __( '← Anteriores', 'giftmedtema' ) ); ?></div>
			<div><?php next_posts_link( __( 'Próximos →', 'giftmedtema' ) ); ?></div>
		</div>
	<?php else : ?>
		<p class="text-slate-600"><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'giftmedtema' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
