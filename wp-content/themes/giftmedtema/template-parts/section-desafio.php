<?php
/**
 * Seção O Desafio — loop de cards.
 *
 * @package GiftMedTema
 */

$cards_query = giftmedtema_get_cards_query( 'desafio' );
?>
<section id="desafio" class="py-24 bg-white border-y border-slate-100">
	<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
		<span class="text-orange-500 font-extrabold text-xs uppercase tracking-widest bg-orange-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Cenário Crítico', 'giftmedtema' ); ?></span>
		<h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 mb-4 tracking-tight"><?php esc_html_e( 'O problema que queremos resolver', 'giftmedtema' ); ?></h2>
		<p class="text-slate-600 leading-relaxed mb-16 max-w-2xl mx-auto font-medium">
			<?php esc_html_e( 'Milhões de medicamentos são descartados de forma incorreta anualmente, agredindo o meio ambiente, enquanto milhares de cidadãos vulneráveis enfrentam dificuldades para acessar tratamentos essenciais.', 'giftmedtema' ); ?>
		</p>

		<?php if ( $cards_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">
				<?php
				while ( $cards_query->have_posts() ) :
					$cards_query->the_post();
					$icon = get_post_meta( get_the_ID(), '_giftmed_icon', true );
					?>
					<div class="p-6 bg-slate-50 border border-slate-200/60 rounded-2xl">
						<div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-xl"><?php echo esc_html( $icon ?: '💊' ); ?></div>
						<h4 class="font-bold text-slate-900 mt-4 text-sm"><?php the_title(); ?></h4>
						<div class="text-xs text-slate-500 mt-2 leading-relaxed"><?php the_content(); ?></div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</section>
