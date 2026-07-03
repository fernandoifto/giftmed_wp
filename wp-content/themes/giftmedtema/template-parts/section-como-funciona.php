<?php
/**
 * Seção Como Funciona — loop de cards do processo.
 *
 * @package GiftMedTema
 */

$cards_query = giftmedtema_get_cards_query( 'processo' );
?>
<section id="como-funciona" class="py-24 bg-white border-y border-slate-100">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-3xl mx-auto mb-16">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Fluxo do Medicamento', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Processo simples, seguro e transparente', 'giftmedtema' ); ?></h2>
		</div>

		<?php if ( $cards_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-5 gap-6">
				<?php
				while ( $cards_query->have_posts() ) :
					$cards_query->the_post();
					$step        = (int) get_post_meta( get_the_ID(), '_giftmed_step', true );
					$is_last     = 5 === $step;
					$badge_class = $is_last ? 'bg-slate-800' : 'bg-teal-600';
					?>
					<div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center space-y-2">
						<div class="w-10 h-10 <?php echo esc_attr( $badge_class ); ?> text-white font-bold rounded-xl flex items-center justify-center mx-auto shadow-md">
							<?php echo esc_html( $step ?: '•' ); ?>
						</div>
						<h4 class="font-bold text-slate-900 text-xs"><?php the_title(); ?></h4>
						<div class="text-[11px] text-slate-500 leading-relaxed"><?php the_content(); ?></div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</section>
