<?php
/**
 * Rodapé do tema.
 *
 * @package GiftMedTema
 */
?>

<section id="contato" class="gm-contact">
	<div class="gm-container gm-contact__grid">
		<div class="reveal">
			<h3><?php esc_html_e( 'Canais Oficiais de Atendimento', 'giftmedtema' ); ?></h3>
			<p class="gm-contact__intro">
				<?php esc_html_e( 'Entre em contato diretamente com o setor responsável para agilizarmos a resposta à sua solicitação.', 'giftmedtema' ); ?>
			</p>

			<div class="gm-contact-channels">
				<div class="gm-channel">
					<span aria-hidden="true">💼</span>
					<div>
						<small><?php esc_html_e( 'Direção Geral & Parcerias', 'giftmedtema' ); ?></small>
						<a href="mailto:contato@giftmed.org">contato@giftmed.org</a>
					</div>
				</div>
				<div class="gm-channel">
					<span aria-hidden="true">📣</span>
					<div>
						<small><?php esc_html_e( 'Marketing & Relacionamento', 'giftmedtema' ); ?></small>
						<a href="mailto:mkt@giftmed.org">mkt@giftmed.org</a>
					</div>
				</div>
			</div>
		</div>

		<div class="gm-form-card reveal reveal-delay-2">
			<h4><?php esc_html_e( 'Solicitar demonstração da plataforma', 'giftmedtema' ); ?></h4>

			<?php if ( isset( $_GET['demo'] ) && 'ok' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
				<p class="gm-alert gm-alert--ok"><?php esc_html_e( 'Solicitação enviada com sucesso!', 'giftmedtema' ); ?></p>
			<?php elseif ( isset( $_GET['demo'] ) && 'erro' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
				<p class="gm-alert gm-alert--err"><?php esc_html_e( 'Não foi possível enviar. Verifique os campos e tente novamente.', 'giftmedtema' ); ?></p>
			<?php endif; ?>

			<form class="gm-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="giftmed_demo">
				<?php wp_nonce_field( 'giftmed_demo', 'giftmed_demo_nonce' ); ?>
				<div class="gm-form__row">
					<input type="text" name="nome" required placeholder="<?php esc_attr_e( 'Seu Nome', 'giftmedtema' ); ?>">
					<input type="text" name="orgao" required placeholder="<?php esc_attr_e( 'Município ou Órgão', 'giftmedtema' ); ?>">
				</div>
				<input type="email" name="email" required placeholder="<?php esc_attr_e( 'Seu e-mail corporativo', 'giftmedtema' ); ?>">
				<button type="submit" class="gm-btn gm-btn--primary gm-btn--block">
					<?php esc_html_e( 'Agendar Apresentação', 'giftmedtema' ); ?>
				</button>
			</form>
		</div>
	</div>
</section>

<footer class="gm-footer">
	<div class="gm-footer__links">
		<a href="https://www.instagram.com/giftmed4/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Instagram Oficial', 'giftmedtema' ); ?></a>
		<a href="mailto:contato@giftmed.org"><?php esc_html_e( 'Direção', 'giftmedtema' ); ?></a>
		<a href="mailto:mkt@giftmed.org"><?php esc_html_e( 'Marketing', 'giftmedtema' ); ?></a>
	</div>
	<p class="gm-footer__brand"><?php bloginfo( 'name' ); ?> — <?php bloginfo( 'description' ); ?></p>
	<p class="gm-footer__copy">
		&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
		<?php esc_html_e( 'Todos os direitos reservados.', 'giftmedtema' ); ?>
	</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
