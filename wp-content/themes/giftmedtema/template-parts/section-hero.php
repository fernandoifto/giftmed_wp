<?php
/**
 * Seção Hero.
 *
 * @package GiftMedTema
 */

$hero_benefits = array(
	__( 'Acesso ampliado a essenciais', 'giftmedtema' ),
	__( 'Redução do descarte químico', 'giftmedtema' ),
	__( 'Economia para a Gestão Pública', 'giftmedtema' ),
	__( 'Gestão 100% Rastreável', 'giftmedtema' ),
);

$hero_image = giftmedtema_mod( 'giftmed_hero_image', giftmedtema_asset( 'img/giftmedretangular.png' ) );
?>
<section id="hero" class="relative pt-12 pb-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

			<div class="lg:col-span-7 space-y-6 text-center lg:text-left">
				<div class="inline-flex items-center space-x-2 bg-teal-50 border border-teal-100 text-teal-800 px-4 py-2 rounded-xl text-xs font-bold tracking-wide uppercase shadow-sm">
					<span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
					<span><?php echo esc_html( giftmedtema_mod( 'giftmed_hero_badge', 'Plataforma de Saúde Sustentável' ) ); ?></span>
				</div>
				<h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-none">
					<?php
					$hero_title = giftmedtema_mod( 'giftmed_hero_title', 'Tecnologia Social para Farmácia Solidária' );
					$title_parts  = explode( ' para ', $hero_title, 2 );
					if ( count( $title_parts ) === 2 ) {
						echo esc_html( $title_parts[0] . ' para ' );
						echo '<br><span class="text-gradient-teal">' . esc_html( $title_parts[1] ) . '</span>';
					} else {
						echo esc_html( $hero_title );
					}
					?>
				</h1>
				<p class="text-lg text-slate-600 font-medium leading-relaxed max-w-2xl">
					<?php echo esc_html( giftmedtema_mod( 'giftmed_hero_description', 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.' ) ); ?>
				</p>

				<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm font-bold text-slate-700 pt-2 text-left">
					<?php foreach ( $hero_benefits as $benefit ) : ?>
						<div class="flex items-center space-x-3 p-3 bg-white rounded-xl border border-slate-100 shadow-sm">
							<span class="flex items-center justify-center w-6 h-6 bg-teal-100 text-teal-700 rounded-lg text-xs">✓</span>
							<span><?php echo esc_html( $benefit ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
					<a href="#contato" class="w-full sm:w-auto text-center bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-xl shadow-xl shadow-orange-500/30 transition transform hover:-translate-y-1">
						<?php esc_html_e( 'Solicitar Demonstração', 'giftmedtema' ); ?>
					</a>
					<a href="#solucao" class="w-full sm:w-auto text-center bg-white hover:bg-slate-50 text-slate-700 font-bold px-8 py-4 rounded-xl border border-slate-200 shadow-sm transition">
						<?php esc_html_e( 'Conhecer a Plataforma', 'giftmedtema' ); ?>
					</a>
				</div>
			</div>

			<div class="lg:col-span-5 flex justify-center relative">
				<div class="relative bg-white border border-slate-100 rounded-2xl p-4 shadow-2xl max-w-sm w-full group glow-teal transition-all">
					<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( giftmedtema_mod( 'giftmed_hero_image_label', 'Dr. GiftMed - Vem coisa boa por aí' ) ); ?>" class="w-full h-auto rounded-xl object-contain">
					<div class="absolute bottom-6 left-6 right-6 bg-slate-900/90 backdrop-blur-md p-4 rounded-xl border border-white/10 text-white">
						<p class="text-xs font-black text-orange-400 uppercase tracking-widest"><?php esc_html_e( 'Identidade Oficial', 'giftmedtema' ); ?></p>
						<h4 class="text-sm font-bold mt-1"><?php echo esc_html( giftmedtema_mod( 'giftmed_hero_image_label', 'Dr. GiftMed — Lançamento da Solução' ) ); ?></h4>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
