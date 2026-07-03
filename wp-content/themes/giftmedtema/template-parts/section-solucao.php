<?php
/**
 * Seção A Solução.
 *
 * @package GiftMedTema
 */
?>
<section id="solucao" class="py-24 relative">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

			<div class="lg:col-span-6 space-y-6">
				<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Inovação Digital', 'giftmedtema' ); ?></span>
				<h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight"><?php esc_html_e( 'O que é a GiftMed?', 'giftmedtema' ); ?></h2>
				<p class="text-slate-600 leading-relaxed font-medium">
					<?php esc_html_e( 'A GiftMed é uma Tecnologia Social digital voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' ); ?>
				</p>

				<div class="border-l-4 border-teal-500 pl-4 py-1 bg-white shadow-sm rounded-r-xl pr-4 border border-slate-100">
					<span class="text-xs uppercase font-extrabold text-teal-800 tracking-wide block"><?php esc_html_e( 'Ambiente Colaborativo Unificado:', 'giftmedtema' ); ?></span>
					<p class="text-xs text-slate-600 mt-1 leading-relaxed">
						<?php esc_html_e( 'Integração inteligente entre Cidadãos, Farmacêuticos, Hospitais, Unidades de Saúde, Universidades, Organizações Sociais e Gestores Públicos.', 'giftmedtema' ); ?>
					</p>
				</div>
			</div>

			<div class="lg:col-span-6">
				<div class="bg-gradient-to-br from-slate-900 to-teal-950 text-white p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
					<div class="bg-teal-500 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-md inline-block mb-6"><?php esc_html_e( 'Slogan Oficial', 'giftmedtema' ); ?></div>
					<h3 class="text-2xl sm:text-3xl font-extrabold leading-tight tracking-tight text-teal-100">
						"<?php echo esc_html( giftmedtema_mod( 'giftmed_slogan', 'Seu remédio pode curar mais do que você imagina.' ) ); ?>"
					</h3>
					<p class="text-sm text-slate-300 leading-relaxed mt-4 font-light">
						<?php esc_html_e( 'Conectando Saúde e Solidariedade de forma automatizada e com total rastreabilidade.', 'giftmedtema' ); ?>
					</p>
					<div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-between text-xs font-bold text-teal-400">
						<span class="tracking-widest uppercase">@giftmed4</span>
						<a href="<?php echo esc_url( giftmedtema_mod( 'giftmed_instagram_url', 'https://www.instagram.com/giftmed4/' ) ); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-orange-400 transition flex items-center gap-1"><?php esc_html_e( 'Acessar o Instagram →', 'giftmedtema' ); ?></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
