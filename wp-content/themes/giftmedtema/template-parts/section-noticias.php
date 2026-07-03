<?php
/**
 * Seção Notícias — loop de posts da categoria noticias.
 *
 * @package GiftMedTema
 */

$noticias_query = giftmedtema_get_noticias_query( 3 );

if ( ! $noticias_query->have_posts() ) {
	return;
}
?>
<section id="noticias" class="py-24 bg-slate-50 border-y border-slate-100">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-2xl mx-auto mb-16">
			<span class="text-orange-500 font-extrabold text-xs uppercase tracking-widest bg-orange-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Atualizações', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Notícias e novidades', 'giftmedtema' ); ?></h2>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php
			while ( $noticias_query->have_posts() ) :
				$noticias_query->the_post();
				?>
				<article <?php post_class( 'bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
							<?php the_post_thumbnail( 'giftmed-noticia', array( 'class' => 'w-full h-full object-cover' ) ); ?>
						</a>
					<?php endif; ?>
					<div class="p-6 space-y-3">
						<time class="text-[10px] font-bold uppercase tracking-wider text-teal-600" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
						<h3 class="font-bold text-slate-900 text-sm leading-snug">
							<a href="<?php the_permalink(); ?>" class="hover:text-teal-600 transition"><?php the_title(); ?></a>
						</h3>
						<div class="text-xs text-slate-500 leading-relaxed">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="inline-block text-xs font-bold text-teal-600 hover:text-teal-700">
							<?php esc_html_e( 'Ler mais →', 'giftmedtema' ); ?>
						</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
