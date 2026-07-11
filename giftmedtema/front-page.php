<?php
/**
 * Página inicial — redesign moderno GiftMed.
 *
 * @package GiftMedTema
 */

get_header();

$theme_img    = giftmedtema_asset( 'assets/img' );
$img_agua     = $theme_img . '/agua.png';
$img_saude    = $theme_img . '/saude.png';
$img_ambiente = $theme_img . '/ambiente.png';
$noticias     = giftmedtema_get_noticias_items( 5 );
$noticias_url = giftmedtema_get_noticias_archive_url();
$platform_bullets = giftmedtema_get_hero_bullets();
$solucao_chips    = giftmedtema_lines(
	giftmedtema_mod(
		'solucao_chips',
		"Cidadãos\nFarmacêuticos\nHospitais\nUnidades de Saúde\nUniversidades\nOrganizações Sociais\nGestores Públicos"
	)
);
$desafio_points = giftmedtema_pipe_lines(
	giftmedtema_mod(
		'desafio_card1_points',
		"Contaminação da Água|Rios, lagos e lençóis freáticos podem ser afetados.\nRiscos à Saúde|Consumo acidental pode causar intoxicações.\nImpacto Ambiental|Resíduos farmacêuticos afetam fauna e flora."
	)
);
$desafio_point_imgs = array( $img_agua, $img_saude, $img_ambiente );
?>

<section id="hero" class="gm-hero gm-hero--news" aria-labelledby="noticias-heading">
	<div class="gm-container">
		<aside id="noticias" class="gm-hero__news reveal" aria-labelledby="noticias-heading">
			<header class="gm-hero__news-head">
				<div class="gm-hero__news-head-text">
					<p class="gm-hero__news-label">
						<span class="gm-hero__news-live" aria-hidden="true"></span>
						<?php esc_html_e( 'Atualizações', 'giftmedtema' ); ?>
					</p>
					<h2 id="noticias-heading" class="gm-hero__news-title"><?php esc_html_e( 'Notícias', 'giftmedtema' ); ?></h2>
				</div>
			</header>

			<?php if ( ! empty( $noticias ) ) : ?>
				<div class="gm-news-panel">
					<?php giftmedtema_render_noticia_card( $noticias[0], 1, 'featured' ); ?>

					<?php if ( count( $noticias ) > 1 ) : ?>
						<div class="gm-news-feed" role="list">
							<?php
							foreach ( array_slice( $noticias, 1, 4 ) as $index => $item ) {
								giftmedtema_render_noticia_card( $item, $index + 2, 'card' );
							}
							?>
						</div>
					<?php endif; ?>

					<a href="<?php echo esc_url( $noticias_url ); ?>" class="gm-hero__news-more">
						<span><?php esc_html_e( 'Mais notícias', 'giftmedtema' ); ?></span>
						<span aria-hidden="true">→</span>
					</a>
				</div>
			<?php else : ?>
				<p class="gm-hero__news-empty">
					<?php esc_html_e( 'Nenhuma notícia publicada. Cadastre posts na categoria Notícias pelo painel.', 'giftmedtema' ); ?>
				</p>
			<?php endif; ?>
		</aside>
	</div>
</section>

<section id="solucao" class="gm-section gm-section--soft gm-solucao" aria-labelledby="gm-platform-title">
	<div class="gm-container">
		<div class="gm-solucao__grid">
			<div class="gm-solucao__platform reveal" id="plataforma">
				<div class="gm-hero__badge">
					<span class="gm-hero__badge-dot" aria-hidden="true"></span>
					<span><?php echo esc_html( giftmedtema_mod( 'hero_badge', __( 'Plataforma de Saúde Sustentável', 'giftmedtema' ) ) ); ?></span>
				</div>

				<h1 id="gm-platform-title" class="gm-hero__title">
					<?php echo esc_html( giftmedtema_mod( 'hero_title', __( 'Tecnologia Social para', 'giftmedtema' ) ) ); ?>
					<br><span class="gm-hero__title-accent"><?php echo esc_html( giftmedtema_mod( 'hero_title_accent', __( 'Farmácia Solidária', 'giftmedtema' ) ) ); ?></span>
				</h1>

				<p class="gm-hero__lead">
					<?php echo esc_html( giftmedtema_mod( 'hero_lead', __( 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.', 'giftmedtema' ) ) ); ?>
				</p>

				<div class="gm-hero__bullets">
					<?php foreach ( $platform_bullets as $i => $bullet ) : ?>
						<div class="gm-hero__bullet reveal reveal-delay-<?php echo esc_attr( (string) ( ( $i % 4 ) + 1 ) ); ?>">
							<span class="gm-hero__check" aria-hidden="true">✓</span>
							<span><?php echo esc_html( $bullet ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="gm-hero__actions">
					<a href="#contato" class="gm-btn gm-hero__btn-primary"><?php echo esc_html( giftmedtema_mod( 'hero_cta_primary', __( 'Solicitar Demonstração', 'giftmedtema' ) ) ); ?></a>
					<a href="#como-funciona" class="gm-btn gm-hero__btn-secondary"><?php echo esc_html( giftmedtema_mod( 'hero_cta_secondary', __( 'Conhecer a Plataforma', 'giftmedtema' ) ) ); ?></a>
				</div>
			</div>

			<div class="gm-solucao__intro reveal reveal-delay-2">
				<span class="gm-eyebrow gm-eyebrow--navy"><?php echo esc_html( giftmedtema_mod( 'solucao_eyebrow', __( 'Inovação Digital', 'giftmedtema' ) ) ); ?></span>
				<h2 class="gm-title">
					<?php echo esc_html( giftmedtema_mod( 'solucao_title', __( 'O que é a', 'giftmedtema' ) ) ); ?>
					<span class="gm-title-gradient"><?php echo esc_html( giftmedtema_mod( 'solucao_title_accent', 'GiftMed' ) ); ?>?</span>
				</h2>
				<p class="gm-solucao__lead">
					<?php
					echo wp_kses(
						giftmedtema_mod(
							'solucao_lead',
							__( 'A GiftMed é uma <strong>Tecnologia Social digital</strong> voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' )
						),
						array( 'strong' => array() )
					);
					?>
				</p>

				<div class="gm-solucao__network">
					<strong><?php echo esc_html( giftmedtema_mod( 'solucao_network_title', __( 'Ambiente Colaborativo Unificado', 'giftmedtema' ) ) ); ?></strong>
					<p><?php echo esc_html( giftmedtema_mod( 'solucao_network_text', __( 'Integração inteligente entre cidadãos, farmacêuticos, hospitais, unidades de saúde, universidades, organizações sociais e gestores públicos.', 'giftmedtema' ) ) ); ?></p>
					<ul class="gm-solucao__chips" aria-label="<?php esc_attr_e( 'Públicos integrados', 'giftmedtema' ); ?>">
						<?php foreach ( $solucao_chips as $chip ) : ?>
							<li><?php echo esc_html( $chip ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="desafio" class="gm-section gm-desafio-section">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow gm-eyebrow--terra"><?php echo esc_html( giftmedtema_mod( 'desafio_eyebrow', __( 'O Desafio', 'giftmedtema' ) ) ); ?></span>
			<h2 class="gm-title"><?php echo esc_html( giftmedtema_mod( 'desafio_title', __( 'Medicamentos sem uso, vidas sem acesso', 'giftmedtema' ) ) ); ?></h2>
			<p><?php echo esc_html( giftmedtema_mod( 'desafio_lead', __( 'O descarte incorreto, o cenário crítico da saúde pública e a falta de acesso a tratamentos formam um mesmo problema — e a GiftMed nasceu para resolvê-lo de ponta a ponta.', 'giftmedtema' ) ) ); ?></p>
		</div>

		<div class="gm-topics">
			<article class="gm-topic-card gm-topic-card--risk reveal reveal-delay-1">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">⚠️</span>
					<div>
						<p class="gm-topic-card__label"><?php echo esc_html( giftmedtema_mod( 'desafio_card1_label', __( 'Atenção', 'giftmedtema' ) ) ); ?></p>
						<h3><?php echo esc_html( giftmedtema_mod( 'desafio_card1_title', __( 'Riscos do Descarte Incorreto', 'giftmedtema' ) ) ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php echo esc_html( giftmedtema_mod( 'desafio_card1_text', __( 'Princípios ativos no lixo comum contaminam solo e água, aumentam intoxicações acidentais e desequilibram ecossistemas.', 'giftmedtema' ) ) ); ?>
				</p>
				<ul class="gm-topic-card__points">
					<?php foreach ( $desafio_points as $pi => $point ) : ?>
						<li>
							<span class="gm-topic-card__point-icon">
								<img src="<?php echo esc_url( $desafio_point_imgs[ $pi ] ?? $img_agua ); ?>" alt="" width="44" height="44" loading="lazy">
							</span>
							<div>
								<strong><?php echo esc_html( $point[0] ); ?></strong>
								<span><?php echo esc_html( $point[1] ); ?></span>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</article>

			<article class="gm-topic-card gm-topic-card--scenario reveal reveal-delay-2">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">📉</span>
					<div>
						<p class="gm-topic-card__label"><?php echo esc_html( giftmedtema_mod( 'desafio_card2_label', __( 'Contexto', 'giftmedtema' ) ) ); ?></p>
						<h3><?php echo esc_html( giftmedtema_mod( 'desafio_card2_title', __( 'Cenário Crítico', 'giftmedtema' ) ) ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php echo esc_html( giftmedtema_mod( 'desafio_card2_text', __( 'Milhões de medicamentos são descartados de forma inadequada todos os anos, enquanto recursos públicos e privados se perdem sem gerar cuidado.', 'giftmedtema' ) ) ); ?>
				</p>
				<ul class="gm-topic-card__list">
					<?php foreach ( giftmedtema_lines( giftmedtema_mod( 'desafio_card2_list', "Desperdício financeiro em larga escala\nSobrecarga assistencial no SUS\nFalta de rastreabilidade nas doações" ) ) as $line ) : ?>
						<li><?php echo esc_html( $line ); ?></li>
					<?php endforeach; ?>
				</ul>
			</article>

			<article class="gm-topic-card gm-topic-card--problem reveal reveal-delay-3">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">🎯</span>
					<div>
						<p class="gm-topic-card__label"><?php echo esc_html( giftmedtema_mod( 'desafio_card3_label', __( 'Missão', 'giftmedtema' ) ) ); ?></p>
						<h3><?php echo esc_html( giftmedtema_mod( 'desafio_card3_title', __( 'O Problema que Queremos Resolver', 'giftmedtema' ) ) ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php echo esc_html( giftmedtema_mod( 'desafio_card3_text', __( 'Conectar medicamentos sem uso a quem precisa, com segurança sanitária, rastreabilidade e impacto social mensurável.', 'giftmedtema' ) ) ); ?>
				</p>
				<ul class="gm-topic-card__list">
					<?php foreach ( giftmedtema_lines( giftmedtema_mod( 'desafio_card3_list', "Acesso contínuo a tratamentos essenciais\nRedistribuição segura e auditável\nEconomia circular na saúde pública" ) ) as $line ) : ?>
						<li><?php echo esc_html( $line ); ?></li>
					<?php endforeach; ?>
				</ul>
			</article>
		</div>

		<div class="gm-topics__support">
			<div class="gm-topics__support-head reveal">
				<span class="gm-topics__support-line" aria-hidden="true"></span>
				<h3 class="gm-topics__support-title"><?php echo esc_html( giftmedtema_mod( 'desafio_support_title', __( 'Dimensões do problema', 'giftmedtema' ) ) ); ?></h3>
				<span class="gm-topics__support-line" aria-hidden="true"></span>
			</div>
			<div class="gm-grid-4">
				<?php
				$desafio_cards = giftmedtema_get_section_cards(
					'desafio',
					array(
						array( 'icon' => '💰', 'title' => __( 'Desperdício Financeiro', 'giftmedtema' ), 'text' => __( 'Perda de recursos com remédios que vencem sem utilização nas residências.', 'giftmedtema' ) ),
						array( 'icon' => '🌱', 'title' => __( 'Impactos Ambientais', 'giftmedtema' ), 'text' => __( 'Riscos severos decorrentes do descarte inadequado de componentes químicos.', 'giftmedtema' ) ),
						array( 'icon' => '🏥', 'title' => __( 'Sobrecarga do SUS', 'giftmedtema' ), 'text' => __( 'Aumento da pressão assistencial por descontinuidade de tratamentos primários.', 'giftmedtema' ) ),
						array( 'icon' => '💊', 'title' => __( 'Redução do Acesso', 'giftmedtema' ), 'text' => __( 'Dificuldade de fornecimento de medicação contínua para populações isoladas.', 'giftmedtema' ) ),
					)
				);
				foreach ( $desafio_cards as $i => $card ) :
					?>
					<article class="gm-card gm-dim-card reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 4 ) ); ?>">
						<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $card['icon'] ); ?></div>
						<h3 class="gm-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="gm-card__text"><?php echo esc_html( $card['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section id="como-funciona" class="gm-section gm-flow-section">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow gm-eyebrow--navy"><?php echo esc_html( giftmedtema_mod( 'fluxo_eyebrow', __( 'Fluxo do Medicamento', 'giftmedtema' ) ) ); ?></span>
			<h2 class="gm-title"><?php echo esc_html( giftmedtema_mod( 'fluxo_title', __( 'Processo simples, seguro e transparente', 'giftmedtema' ) ) ); ?></h2>
			<p><?php echo esc_html( giftmedtema_mod( 'fluxo_lead', __( 'Do cadastro da doação à entrega final, cada etapa é registrada e monitorada digitalmente.', 'giftmedtema' ) ) ); ?></p>
		</div>

		<?php
		$flow_items = giftmedtema_get_section_cards(
			'como-funciona',
			array(
				array( 'icon' => '📦', 'title' => __( 'Doação', 'giftmedtema' ), 'text' => __( 'O cidadão realiza a entrega ou o cadastro dos medicamentos disponíveis.', 'giftmedtema' ) ),
				array( 'icon' => '🩺', 'title' => __( 'Triagem', 'giftmedtema' ), 'text' => __( 'Profissionais habilitados analisam a integridade, validade e condições sanitárias.', 'giftmedtema' ) ),
				array( 'icon' => '🔗', 'title' => __( 'Rastreio', 'giftmedtema' ), 'text' => __( 'Todas as etapas operacionais são monitoradas digitalmente.', 'giftmedtema' ) ),
				array( 'icon' => '💊', 'title' => __( 'Redistribuição', 'giftmedtema' ), 'text' => __( 'Medicamentos aprovados são ofertados via Farmácias Solidárias.', 'giftmedtema' ) ),
				array( 'icon' => '♻️', 'title' => __( 'Descarte', 'giftmedtema' ), 'text' => __( 'Produtos inaptos recebem destinação final ambientalmente segura.', 'giftmedtema' ) ),
			)
		);
		?>

		<ul class="gm-flow reveal">
			<?php foreach ( $flow_items as $i => $item ) : ?>
				<li class="gm-flow__item<?php echo ( 4 === $i ) ? ' gm-flow__item--alt' : ''; ?> reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 5 ) ); ?>">
					<article class="gm-flow__card">
						<span class="gm-flow__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
						<h3 class="gm-flow__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="gm-flow__text"><?php echo esc_html( $item['text'] ); ?></p>
					</article>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section id="funcionalidades" class="gm-section gm-recursos-section">
	<div class="gm-container">
		<div class="gm-recursos__intro reveal">
			<div>
				<span class="gm-eyebrow gm-eyebrow--navy"><?php echo esc_html( giftmedtema_mod( 'recursos_eyebrow', __( 'Recursos Técnicos', 'giftmedtema' ) ) ); ?></span>
				<h2 class="gm-title"><?php echo esc_html( giftmedtema_mod( 'recursos_title', __( 'Módulos que fortalecem a governança', 'giftmedtema' ) ) ); ?></h2>
			</div>
			<p class="gm-recursos__lead">
				<?php echo esc_html( giftmedtema_mod( 'recursos_lead', __( 'Ferramentas integradas para operar a Farmácia Solidária com segurança, rastreabilidade e indicadores claros para a gestão pública.', 'giftmedtema' ) ) ); ?>
			</p>
		</div>

		<?php
		$recursos_items = giftmedtema_get_section_cards(
			'funcionalidades',
			array(
				array( 'icon' => '📦', 'title' => __( 'Gestão de Estoque Solidário', 'giftmedtema' ), 'text' => __( 'Controle completo de lotes e validades vigentes para segurança de entrega.', 'giftmedtema' ) ),
				array( 'icon' => '🩺', 'title' => __( 'Triagem Farmacêutica Digital', 'giftmedtema' ), 'text' => __( 'Registro técnico imediato das inspeções e laudos de adequação sanitária.', 'giftmedtema' ) ),
				array( 'icon' => '🔗', 'title' => __( 'Rastreabilidade Completa', 'giftmedtema' ), 'text' => __( 'Mapeamento em tempo real de todo o ciclo percorrido pelo medicamento.', 'giftmedtema' ) ),
				array( 'icon' => '📊', 'title' => __( 'Indicadores de Impacto', 'giftmedtema' ), 'text' => __( 'Métricas de monitoramento social, ambiental e econômico unificadas.', 'giftmedtema' ) ),
				array( 'icon' => '🖥️', 'title' => __( 'Painéis Gerenciais', 'giftmedtema' ), 'text' => __( 'Informações estratégicas e relatórios automatizados para tomadas de decisão.', 'giftmedtema' ) ),
				array( 'icon' => '🔒', 'title' => __( 'Segurança e Conformidade', 'giftmedtema' ), 'text' => __( 'Hospedagem em nuvem de alta segurança com adequação integral à LGPD.', 'giftmedtema' ) ),
			)
		);
		?>

		<div class="gm-recursos">
			<?php foreach ( $recursos_items as $i => $recurso ) : ?>
				<article class="gm-recursos__card gm-recursos__card--<?php echo esc_attr( (string) ( ( $i % 3 ) + 1 ) ); ?> reveal reveal-delay-<?php echo esc_attr( (string) ( ( $i % 3 ) + 1 ) ); ?>">
					<span class="gm-recursos__icon" aria-hidden="true"><?php echo esc_html( $recurso['icon'] ); ?></span>
					<h3 class="gm-recursos__title"><?php echo esc_html( $recurso['title'] ); ?></h3>
					<p class="gm-recursos__text"><?php echo esc_html( $recurso['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section id="impacto" class="gm-section gm-impacto-section">
	<div class="gm-container">
		<header class="gm-impacto__head reveal">
			<span class="gm-eyebrow gm-eyebrow--light"><?php echo esc_html( giftmedtema_mod( 'impacto_eyebrow', __( 'Retorno Social', 'giftmedtema' ) ) ); ?></span>
			<h2 class="gm-title"><?php echo esc_html( giftmedtema_mod( 'impacto_title', __( 'Resultados que transformam vidas', 'giftmedtema' ) ) ); ?></h2>
			<p class="gm-impacto__lead">
				<?php echo esc_html( giftmedtema_mod( 'impacto_lead', __( 'A GiftMed gera valor em três frentes — social, ambiental e econômica — com uma operação digital segura e rastreável.', 'giftmedtema' ) ) ); ?>
			</p>
		</header>

		<div class="gm-impacto__metrics">
			<?php
			$impacto_items = giftmedtema_get_section_cards(
				'impacto',
				array(
					array( 'icon' => '🤝', 'title' => __( 'Impacto Social', 'giftmedtema' ), 'text' => __( 'Ampliação do acesso a tratamentos e suporte direto a populações em vulnerabilidade.', 'giftmedtema' ) ),
					array( 'icon' => '🌱', 'title' => __( 'Impacto Ambiental', 'giftmedtema' ), 'text' => __( 'Redução expressiva do descarte inadequado e fomento à economia circular de insumos.', 'giftmedtema' ) ),
					array( 'icon' => '💰', 'title' => __( 'Impacto Econômico', 'giftmedtema' ), 'text' => __( 'Economia real de recursos financeiros e otimização dos orçamentos públicos de saúde.', 'giftmedtema' ) ),
				)
			);
			foreach ( $impacto_items as $i => $metric ) :
				?>
				<article class="gm-impacto__metric reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 3 ) ); ?>">
					<span class="gm-impacto__icon" aria-hidden="true"><?php echo esc_html( $metric['icon'] ); ?></span>
					<h3><?php echo esc_html( $metric['title'] ); ?></h3>
					<p><?php echo esc_html( $metric['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="gm-impacto__diff reveal">
			<div class="gm-impacto__diff-head">
				<span class="gm-eyebrow gm-eyebrow--light"><?php echo esc_html( giftmedtema_mod( 'impacto_diff_eyebrow', __( 'Diferenciais', 'giftmedtema' ) ) ); ?></span>
				<h3><?php echo esc_html( giftmedtema_mod( 'impacto_diff_title', __( 'Por que a GiftMed é diferente?', 'giftmedtema' ) ) ); ?></h3>
			</div>

			<div class="gm-impacto__diff-grid">
				<?php
				$diferenciais = giftmedtema_get_section_cards(
					'diferenciais',
					array(
						array( 'icon' => '🎯', 'title' => __( 'Foco em Farmácias Solidárias', 'giftmedtema' ), 'text' => __( 'Solução especializada com orientação técnica para o ciclo solidário de medicamentos.', 'giftmedtema' ) ),
						array( 'icon' => '☁️', 'title' => __( 'Operação em nuvem', 'giftmedtema' ), 'text' => __( 'Gestão integrada de ponta a ponta, acessível e centralizada.', 'giftmedtema' ) ),
						array( 'icon' => '🔗', 'title' => __( 'Rastreabilidade total', 'giftmedtema' ), 'text' => __( 'Histórico completo dos lotes em todas as etapas do processo.', 'giftmedtema' ) ),
						array( 'icon' => '📈', 'title' => __( 'Escalável para municípios', 'giftmedtema' ), 'text' => __( 'Infraestrutura preparada para cidades de qualquer porte.', 'giftmedtema' ) ),
						array( 'icon' => '🛡️', 'title' => __( 'Conformidade e LGPD', 'giftmedtema' ), 'text' => __( 'Adequação às diretrizes sanitárias vigentes e proteção de dados.', 'giftmedtema' ) ),
					)
				);
				foreach ( $diferenciais as $i => $item ) :
					?>
					<article class="gm-impacto__diff-card reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 5 ) ); ?>">
						<span class="gm-impacto__diff-icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
						<strong><?php echo esc_html( $item['title'] ); ?></strong>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php $parceiros = giftmedtema_get_parceiros(); ?>

<section id="parceiros" class="gm-section gm-parceiros-section" aria-labelledby="gm-parceiros-title">
	<div class="gm-container">
		<header class="gm-parceiros__head reveal">
			<span class="gm-eyebrow gm-eyebrow--navy"><?php echo esc_html( giftmedtema_mod( 'parceiros_eyebrow', __( 'Rede de apoio', 'giftmedtema' ) ) ); ?></span>
			<h2 id="gm-parceiros-title" class="gm-title">
				<?php echo esc_html( giftmedtema_mod( 'parceiros_title', __( 'Instituições que apoiam a GiftMed', 'giftmedtema' ) ) ); ?>
			</h2>
			<p class="gm-parceiros__text">
				<?php echo esc_html( giftmedtema_mod( 'parceiros_text', __( 'O projeto GiftMed é fomentado com recursos do projeto O CDR Médio Norte Tocantins Edital nº 02/2024 — FAPT/SEPLAN, no âmbito da Rede DESER, e conta com parceiros públicos e acadêmicos comprometidos com saúde solidária e descarte consciente.', 'giftmedtema' ) ) ); ?>
			</p>
		</header>

		<div class="gm-parceiros__strip reveal reveal-delay-2" role="list">
			<?php foreach ( $parceiros as $parceiro ) : ?>
				<figure class="gm-parceiros__item" role="listitem" title="<?php echo esc_attr( $parceiro['name'] . ' — ' . $parceiro['tag'] ); ?>">
					<img
						src="<?php echo esc_url( $parceiro['src'] ); ?>"
						alt="<?php echo esc_attr( $parceiro['name'] ); ?>"
						loading="lazy"
						decoding="async"
					>
				</figure>
			<?php endforeach; ?>
		</div>

		<ul class="gm-parceiros__legend reveal reveal-delay-3">
			<li><span class="gm-parceiros__dot gm-parceiros__dot--fomento"></span><?php esc_html_e( 'Fomento', 'giftmedtema' ); ?></li>
			<li><span class="gm-parceiros__dot gm-parceiros__dot--publico"></span><?php esc_html_e( 'Parceiros públicos', 'giftmedtema' ); ?></li>
			<li><span class="gm-parceiros__dot gm-parceiros__dot--academico"></span><?php esc_html_e( 'Parceiros acadêmicos', 'giftmedtema' ); ?></li>
		</ul>
	</div>
</section>

<?php
get_footer();
