</main>

<?php get_template_part( 'template-parts/section', 'parceiros' ); ?>

<footer class="bg-slate-950 text-slate-500 text-[11px] py-12 border-t border-slate-900 text-center space-y-4">
	<div class="flex justify-center space-x-6 text-xs font-bold text-slate-400">
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'flex justify-center space-x-6 text-xs font-bold text-slate-400',
					'depth'          => 1,
				)
			);
		} else {
			?>
			<a href="<?php echo esc_url( giftmedtema_mod( 'giftmed_instagram_url', 'https://www.instagram.com/giftmed4/' ) ); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-orange-400 transition"><?php esc_html_e( 'Instagram Oficial', 'giftmedtema' ); ?></a>
			<a href="mailto:<?php echo esc_attr( giftmedtema_mod( 'giftmed_contact_general', 'contato@giftmed.org' ) ); ?>" class="hover:text-teal-400 transition"><?php esc_html_e( 'Direção', 'giftmedtema' ); ?></a>
			<a href="mailto:<?php echo esc_attr( giftmedtema_mod( 'giftmed_contact_marketing', 'mkt@giftmed.org' ) ); ?>" class="hover:text-teal-400 transition"><?php esc_html_e( 'Marketing', 'giftmedtema' ); ?></a>
			<?php
		}
		?>
	</div>
	<p class="font-bold text-slate-400"><?php esc_html_e( 'GiftMed — Conectando Saúde e Solidariedade', 'giftmedtema' ); ?></p>
	<p class="text-[10px] text-slate-600">
		&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> GiftMed. <?php esc_html_e( 'Todos os direitos reservados.', 'giftmedtema' ); ?>
	</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
