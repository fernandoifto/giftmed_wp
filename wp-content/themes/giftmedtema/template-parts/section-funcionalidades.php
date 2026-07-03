<?php
/**
 * Seção Funcionalidades — loop de cards.
 *
 * @package GiftMedTema
 */

$cards_query = giftmedtema_get_cards_query( 'funcionalidade' );
?>
<section id="funcionalidades" class="py-24">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-2xl mx-auto mb-16">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Recursos Técnicos', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Módulos que fortalecem a governança', 'giftmedtema' ); ?></h2>
		</div>

		<?php if ( $cards_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				while ( $cards_query->have_posts() ) :
					$cards_query->the_post();
					$icon = get_post_meta( get_the_ID(), '_giftmed_icon', true );
					?>
					<div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-2">
						<span class="text-xl block"><?php echo esc_html( $icon ?: '📦' ); ?></span>
						<h4 class="font-bold text-slate-900 text-sm"><?php the_title(); ?></h4>
						<div class="text-xs text-slate-500 leading-relaxed"><?php the_content(); ?></div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</section>
