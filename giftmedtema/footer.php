<?php
/**
 * Rodapé do tema.
 *
 * @package GiftMedTema
 */
?>

<section id="contato" class="gm-section gm-contact-section" aria-labelledby="gm-contact-title">
	<div class="gm-container">
		<div class="gm-contact-panel reveal">
			<div class="gm-contact-panel__info">
				<span class="gm-eyebrow gm-eyebrow--light"><?php esc_html_e( 'Fale Conosco', 'giftmedtema' ); ?></span>
				<h2 id="gm-contact-title" class="gm-title">
					<?php esc_html_e( 'Vamos conversar sobre a GiftMed', 'giftmedtema' ); ?>
				</h2>
				<p class="gm-contact-panel__lead">
					<?php esc_html_e( 'Fale com a equipe responsável ou solicite uma demonstração da plataforma para o seu município ou instituição.', 'giftmedtema' ); ?>
				</p>

				<div class="gm-contact-panel__channels">
					<a class="gm-contact-panel__channel" href="mailto:contato@giftmed.org">
						<span class="gm-contact-panel__icon" aria-hidden="true">💼</span>
						<span>
							<small><?php esc_html_e( 'Direção Geral & Parcerias', 'giftmedtema' ); ?></small>
							<strong>contato@giftmed.org</strong>
						</span>
					</a>
					<a class="gm-contact-panel__channel" href="mailto:mkt@giftmed.org">
						<span class="gm-contact-panel__icon gm-contact-panel__icon--alt" aria-hidden="true">📣</span>
						<span>
							<small><?php esc_html_e( 'Marketing & Relacionamento', 'giftmedtema' ); ?></small>
							<strong>mkt@giftmed.org</strong>
						</span>
					</a>
					<a
						class="gm-contact-panel__channel"
						href="https://www.instagram.com/giftmed4/"
						target="_blank"
						rel="noopener noreferrer"
					>
						<span class="gm-contact-panel__icon gm-contact-panel__icon--social" aria-hidden="true">📷</span>
						<span>
							<small><?php esc_html_e( 'Instagram oficial', 'giftmedtema' ); ?></small>
							<strong>@giftmed4</strong>
						</span>
					</a>
				</div>
			</div>

			<div class="gm-contact-panel__form-wrap reveal reveal-delay-2">
				<div class="gm-contact-form">
					<div class="gm-contact-form__head">
						<span class="gm-contact-form__badge"><?php esc_html_e( 'Demonstração', 'giftmedtema' ); ?></span>
						<h3><?php esc_html_e( 'Agende uma apresentação', 'giftmedtema' ); ?></h3>
						<p><?php esc_html_e( 'Preencha os dados e nossa equipe retorna o contato.', 'giftmedtema' ); ?></p>
					</div>

					<?php if ( isset( $_GET['demo'] ) && 'ok' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
						<p class="gm-alert gm-alert--ok"><?php esc_html_e( 'Solicitação enviada com sucesso!', 'giftmedtema' ); ?></p>
					<?php elseif ( isset( $_GET['demo'] ) && 'erro' === $_GET['demo'] ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
						<p class="gm-alert gm-alert--err"><?php esc_html_e( 'Não foi possível enviar. Verifique os campos e tente novamente.', 'giftmedtema' ); ?></p>
					<?php endif; ?>

					<form class="gm-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<input type="hidden" name="action" value="giftmed_demo">
						<?php wp_nonce_field( 'giftmed_demo', 'giftmed_demo_nonce' ); ?>

						<div class="gm-form__row">
							<label class="gm-form__field">
								<span><?php esc_html_e( 'Nome', 'giftmedtema' ); ?></span>
								<input type="text" name="nome" required autocomplete="name" placeholder="<?php esc_attr_e( 'Seu nome completo', 'giftmedtema' ); ?>">
							</label>
							<label class="gm-form__field">
								<span><?php esc_html_e( 'Município ou Órgão', 'giftmedtema' ); ?></span>
								<input type="text" name="orgao" required autocomplete="organization" placeholder="<?php esc_attr_e( 'Instituição que representa', 'giftmedtema' ); ?>">
							</label>
						</div>

						<label class="gm-form__field">
							<span><?php esc_html_e( 'E-mail corporativo', 'giftmedtema' ); ?></span>
							<input type="email" name="email" required autocomplete="email" placeholder="<?php esc_attr_e( 'nome@orgao.gov.br', 'giftmedtema' ); ?>">
						</label>

						<button type="submit" class="gm-btn gm-btn--accent gm-btn--block">
							<?php esc_html_e( 'Agendar apresentação', 'giftmedtema' ); ?>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<footer class="gm-footer">
	<div class="gm-footer__glow" aria-hidden="true"></div>
	<div class="gm-container">
		<div class="gm-footer__cta">
			<div>
				<span class="gm-footer__cta-label"><?php esc_html_e( 'Acompanhe a GiftMed', 'giftmedtema' ); ?></span>
				<p><?php esc_html_e( 'Novidades, histórias de impacto e conteúdos sobre saúde solidária nas nossas redes.', 'giftmedtema' ); ?></p>
			</div>
			<div class="gm-footer__socials" role="list">
				<?php
				$social_networks = array(
					array(
						'label' => 'Instagram',
						'url'   => 'https://www.instagram.com/giftmed4/',
						'class' => 'gm-footer__social--instagram',
						'icon'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8A3.6 3.6 0 0 0 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6A3.6 3.6 0 0 0 16.4 4H7.6m9.65 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/></svg>',
					),
					array(
						'label' => 'YouTube',
						'url'   => 'https://www.youtube.com/@giftmed4',
						'class' => 'gm-footer__social--youtube',
						'icon'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31.5 31.5 0 0 0 0 12a31.5 31.5 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.5 31.5 0 0 0 24 12a31.5 31.5 0 0 0-.5-5.8ZM9.8 15.5v-7l6.2 3.5-6.2 3.5Z"/></svg>',
					),
					array(
						'label' => 'TikTok',
						'url'   => 'https://www.tiktok.com/@giftmed4',
						'class' => 'gm-footer__social--tiktok',
						'icon'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M16.6 5.8A4.7 4.7 0 0 1 14.9 2h-3.2v13.1a2.6 2.6 0 1 1-1.8-2.5V9.3a5.8 5.8 0 1 0 5 5.7V9.4a7.8 7.8 0 0 0 4.5 1.4V7.6a4.7 4.7 0 0 1-2.8-1.8Z"/></svg>',
					),
				);
				foreach ( $social_networks as $network ) :
					?>
					<a
						class="gm-footer__social <?php echo esc_attr( $network['class'] ); ?>"
						href="<?php echo esc_url( $network['url'] ); ?>"
						target="_blank"
						rel="noopener noreferrer"
						role="listitem"
						aria-label="<?php echo esc_attr( sprintf( /* translators: %s: social network name */ __( 'GiftMed no %s', 'giftmedtema' ), $network['label'] ) ); ?>"
					>
						<span class="gm-footer__social-icon">
							<?php echo $network['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG markup. ?>
						</span>
						<span class="gm-footer__social-meta">
							<small><?php echo esc_html( $network['label'] ); ?></small>
							<strong>@giftmed4</strong>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="gm-footer__top">
			<div class="gm-footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gm-footer__logo">
					<img
						src="<?php echo esc_url( giftmedtema_asset( 'assets/img/giftmedquadrado.png' ) ); ?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
						width="72"
						height="72"
						loading="lazy"
						decoding="async"
					>
				</a>
				<p class="gm-footer__tagline">
					<?php esc_html_e( 'Conectando Saúde e Solidariedade por meio de tecnologia social para Farmácias Solidárias.', 'giftmedtema' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="gm-footer__demo">
					<?php esc_html_e( 'Solicitar demonstração', 'giftmedtema' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>

			<nav class="gm-footer__col" aria-label="<?php esc_attr_e( 'Navegação do site', 'giftmedtema' ); ?>">
				<strong><?php esc_html_e( 'Navegação', 'giftmedtema' ); ?></strong>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/#desafio' ) ); ?>"><?php esc_html_e( 'O Desafio', 'giftmedtema' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#solucao' ) ); ?>"><?php esc_html_e( 'A Solução', 'giftmedtema' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#como-funciona' ) ); ?>"><?php esc_html_e( 'Como Funciona', 'giftmedtema' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#funcionalidades' ) ); ?>"><?php esc_html_e( 'Recursos', 'giftmedtema' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#impacto' ) ); ?>"><?php esc_html_e( 'Impacto', 'giftmedtema' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#equipe' ) ); ?>"><?php esc_html_e( 'Equipe', 'giftmedtema' ); ?></a></li>
				</ul>
			</nav>

			<nav class="gm-footer__col" aria-label="<?php esc_attr_e( 'Contato', 'giftmedtema' ); ?>">
				<strong><?php esc_html_e( 'Contato', 'giftmedtema' ); ?></strong>
				<ul>
					<li>
						<a href="mailto:contato@giftmed.org">
							<span><?php esc_html_e( 'Direção & Parcerias', 'giftmedtema' ); ?></span>
							<strong>contato@giftmed.org</strong>
						</a>
					</li>
					<li>
						<a href="mailto:mkt@giftmed.org">
							<span><?php esc_html_e( 'Marketing', 'giftmedtema' ); ?></span>
							<strong>mkt@giftmed.org</strong>
						</a>
					</li>
				</ul>
			</nav>
		</div>

		<div class="gm-footer__bottom">
			<p class="gm-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'Todos os direitos reservados.', 'giftmedtema' ); ?>
			</p>
			<p class="gm-footer__slogan">
				“<?php esc_html_e( 'Seu remédio pode curar mais do que você imagina.', 'giftmedtema' ); ?>”
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
