<?php
/**
 * Rodapé do tema.
 *
 * @package GiftMedTema
 */
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
						<span class="text-lg" aria-hidden="true">💼</span>
						<div>
							<span class="block text-[10px] font-extrabold uppercase text-orange-400 tracking-wider"><?php esc_html_e( 'Direção Geral & Parcerias', 'giftmedtema' ); ?></span>
							<a href="mailto:contato@giftmed.org" class="text-sm font-bold text-teal-300 hover:underline">contato@giftmed.org</a>
						</div>
					</div>
					<div class="p-4 bg-white/5 border border-white/10 rounded-xl flex items-center space-x-3">
						<span class="text-lg" aria-hidden="true">📣</span>
						<div>
							<span class="block text-[10px] font-extrabold uppercase text-teal-400 tracking-wider"><?php esc_html_e( 'Marketing & Relacionamento', 'giftmedtema' ); ?></span>
							<a href="mailto:mkt@giftmed.org" class="text-sm font-bold text-teal-300 hover:underline">mkt@giftmed.org</a>
						</div>
					</div>
				</div>
			</div>

			<div class="lg:col-span-7 bg-white text-slate-900 p-8 rounded-3xl shadow-2xl space-y-4">
				<h4 class="font-black text-lg tracking-tight"><?php esc_html_e( 'Solicitar demonstração da plataforma', 'giftmedtema' ); ?></h4>

				<?php if ( isset( $_GET['demo'] ) && 'ok' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
					<p class="text-sm font-bold text-teal-700 bg-teal-50 border border-teal-100 rounded-xl px-4 py-3">
						<?php esc_html_e( 'Solicitação enviada com sucesso!', 'giftmedtema' ); ?>
					</p>
				<?php elseif ( isset( $_GET['demo'] ) && 'erro' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
					<p class="text-sm font-bold text-orange-700 bg-orange-50 border border-orange-100 rounded-xl px-4 py-3">
						<?php esc_html_e( 'Não foi possível enviar. Verifique os campos e tente novamente.', 'giftmedtema' ); ?>
					</p>
				<?php endif; ?>

				<form class="space-y-3" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="giftmed_demo">
					<?php wp_nonce_field( 'giftmed_demo', 'giftmed_demo_nonce' ); ?>
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
						<input type="text" name="nome" required placeholder="<?php esc_attr_e( 'Seu Nome', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
						<input type="text" name="orgao" required placeholder="<?php esc_attr_e( 'Município ou Órgão', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
					</div>
					<input type="email" name="email" required placeholder="<?php esc_attr_e( 'Seu e-mail corporativo', 'giftmedtema' ); ?>" class="w-full text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
					<button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold py-3.5 rounded-xl text-xs uppercase tracking-wider transition-transform active:scale-[0.98]">
						<?php esc_html_e( 'Agendar Apresentação', 'giftmedtema' ); ?>
					</button>
				</form>
			</div>

		</div>
	</div>
</section>

<footer class="bg-slate-950 text-slate-500 text-[11px] py-12 border-t border-slate-900 text-center space-y-4">
	<div class="flex justify-center space-x-6 text-xs font-bold text-slate-400">
		<a href="https://www.instagram.com/giftmed4/" target="_blank" rel="noopener noreferrer" class="hover:text-orange-400 transition"><?php esc_html_e( 'Instagram Oficial', 'giftmedtema' ); ?></a>
		<a href="mailto:contato@giftmed.org" class="hover:text-teal-400 transition"><?php esc_html_e( 'Direção', 'giftmedtema' ); ?></a>
		<a href="mailto:mkt@giftmed.org" class="hover:text-teal-400 transition"><?php esc_html_e( 'Marketing', 'giftmedtema' ); ?></a>
	</div>
	<p class="font-bold text-slate-400"><?php bloginfo( 'name' ); ?> — <?php bloginfo( 'description' ); ?></p>
	<p class="text-[10px] text-slate-600">
		&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
		<?php esc_html_e( 'Todos os direitos reservados.', 'giftmedtema' ); ?>
	</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
