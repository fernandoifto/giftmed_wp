<?php
/**
 * Seção Contato.
 *
 * @package GiftMedTema
 */

$contact_general   = giftmedtema_mod( 'giftmed_contact_general', 'contato@giftmed.org' );
$contact_marketing = giftmedtema_mod( 'giftmed_contact_marketing', 'mkt@giftmed.org' );
?>
<section id="contato" class="bg-gradient-to-br from-slate-950 to-teal-950 text-white py-24 border-t border-slate-800">
	<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

			<div class="lg:col-span-5 space-y-6">
				<h3 class="text-2xl font-black tracking-tight"><?php esc_html_e( 'Canais Oficiais de Atendimento', 'giftmedtema' ); ?></h3>
				<p class="text-slate-400 text-xs leading-relaxed">
					<?php esc_html_e( 'Entre em contato diretamente com o setor responsável para agilizarmos a resposta à sua solicitação.', 'giftmedtema' ); ?>
				</p>

				<div class="space-y-3 pt-2 text-left">
					<div class="p-4 bg-white/5 border border-white/10 rounded-xl flex items-center space-x-3">
						<span class="text-lg">💼</span>
						<div>
							<span class="block text-[10px] font-extrabold uppercase text-orange-400 tracking-wider"><?php esc_html_e( 'Direção Geral & Parcerias', 'giftmedtema' ); ?></span>
							<a href="mailto:<?php echo esc_attr( $contact_general ); ?>" class="text-sm font-bold text-teal-300 hover:underline"><?php echo esc_html( $contact_general ); ?></a>
						</div>
					</div>
					<div class="p-4 bg-white/5 border border-white/10 rounded-xl flex items-center space-x-3">
						<span class="text-lg">📣</span>
						<div>
							<span class="block text-[10px] font-extrabold uppercase text-teal-400 tracking-wider"><?php esc_html_e( 'Marketing & Relacionamento', 'giftmedtema' ); ?></span>
							<a href="mailto:<?php echo esc_attr( $contact_marketing ); ?>" class="text-sm font-bold text-teal-300 hover:underline"><?php echo esc_html( $contact_marketing ); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="lg:col-span-7 bg-white text-slate-900 p-8 rounded-3xl shadow-2xl space-y-4">
				<h4 class="font-black text-lg tracking-tight"><?php esc_html_e( 'Solicitar demonstração da plataforma', 'giftmedtema' ); ?></h4>
				<form id="giftmed-demo-form" class="space-y-3">
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
						<input type="text" required placeholder="<?php esc_attr_e( 'Seu Nome', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
						<input type="text" required placeholder="<?php esc_attr_e( 'Município ou Órgão', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
					</div>
					<input type="email" required placeholder="<?php esc_attr_e( 'Seu e-mail corporativo', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
					<button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold py-3.5 rounded-xl text-xs uppercase tracking-wider transition-transform active:scale-[0.98]">
						<?php esc_html_e( 'Agendar Apresentação', 'giftmedtema' ); ?>
					</button>
				</form>
			</div>

		</div>
	</div>
</section>
