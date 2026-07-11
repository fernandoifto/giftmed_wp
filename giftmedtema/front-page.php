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
				<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Inovação Digital', 'giftmedtema' ); ?></span>
				<h2 class="gm-title">
					<?php esc_html_e( 'O que é a', 'giftmedtema' ); ?>
					<span class="gm-title-gradient"><?php esc_html_e( 'GiftMed', 'giftmedtema' ); ?>?</span>
				</h2>
				<p class="gm-solucao__lead">
					<?php
					echo wp_kses(
						__( 'A GiftMed é uma <strong>Tecnologia Social digital</strong> voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' ),
						array( 'strong' => array() )
					);
					?>
				</p>

				<div class="gm-solucao__network">
					<strong><?php esc_html_e( 'Ambiente Colaborativo Unificado', 'giftmedtema' ); ?></strong>
					<p><?php esc_html_e( 'Integração inteligente entre cidadãos, farmacêuticos, hospitais, unidades de saúde, universidades, organizações sociais e gestores públicos.', 'giftmedtema' ); ?></p>
					<ul class="gm-solucao__chips" aria-label="<?php esc_attr_e( 'Públicos integrados', 'giftmedtema' ); ?>">
						<?php
						$solucao_chips = array(
							__( 'Cidadãos', 'giftmedtema' ),
							__( 'Farmacêuticos', 'giftmedtema' ),
							__( 'Hospitais', 'giftmedtema' ),
							__( 'Unidades de Saúde', 'giftmedtema' ),
							__( 'Universidades', 'giftmedtema' ),
							__( 'Organizações Sociais', 'giftmedtema' ),
							__( 'Gestores Públicos', 'giftmedtema' ),
						);
						foreach ( $solucao_chips as $chip ) :
							?>
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
			<span class="gm-eyebrow gm-eyebrow--terra"><?php esc_html_e( 'O Desafio', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Medicamentos sem uso, vidas sem acesso', 'giftmedtema' ); ?></h2>
			<p><?php esc_html_e( 'O descarte incorreto, o cenário crítico da saúde pública e a falta de acesso a tratamentos formam um mesmo problema — e a GiftMed nasceu para resolvê-lo de ponta a ponta.', 'giftmedtema' ); ?></p>
		</div>

		<div class="gm-topics">
			<article class="gm-topic-card gm-topic-card--risk reveal reveal-delay-1">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">⚠️</span>
					<div>
						<p class="gm-topic-card__label"><?php esc_html_e( 'Atenção', 'giftmedtema' ); ?></p>
						<h3><?php esc_html_e( 'Riscos do Descarte Incorreto', 'giftmedtema' ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php esc_html_e( 'Princípios ativos no lixo comum contaminam solo e água, aumentam intoxicações acidentais e desequilibram ecossistemas.', 'giftmedtema' ); ?>
				</p>
				<ul class="gm-topic-card__points">
					<li>
						<span class="gm-topic-card__point-icon">
							<img src="<?php echo esc_url( $img_agua ); ?>" alt="" width="44" height="44" loading="lazy">
						</span>
						<div>
							<strong><?php esc_html_e( 'Contaminação da Água', 'giftmedtema' ); ?></strong>
							<span><?php esc_html_e( 'Rios, lagos e lençóis freáticos podem ser afetados.', 'giftmedtema' ); ?></span>
						</div>
					</li>
					<li>
						<span class="gm-topic-card__point-icon">
							<img src="<?php echo esc_url( $img_saude ); ?>" alt="" width="44" height="44" loading="lazy">
						</span>
						<div>
							<strong><?php esc_html_e( 'Riscos à Saúde', 'giftmedtema' ); ?></strong>
							<span><?php esc_html_e( 'Consumo acidental pode causar intoxicações.', 'giftmedtema' ); ?></span>
						</div>
					</li>
					<li>
						<span class="gm-topic-card__point-icon">
							<img src="<?php echo esc_url( $img_ambiente ); ?>" alt="" width="44" height="44" loading="lazy">
						</span>
						<div>
							<strong><?php esc_html_e( 'Impacto Ambiental', 'giftmedtema' ); ?></strong>
							<span><?php esc_html_e( 'Resíduos farmacêuticos afetam fauna e flora.', 'giftmedtema' ); ?></span>
						</div>
					</li>
				</ul>
			</article>

			<article class="gm-topic-card gm-topic-card--scenario reveal reveal-delay-2">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">📉</span>
					<div>
						<p class="gm-topic-card__label"><?php esc_html_e( 'Contexto', 'giftmedtema' ); ?></p>
						<h3><?php esc_html_e( 'Cenário Crítico', 'giftmedtema' ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php esc_html_e( 'Milhões de medicamentos são descartados de forma inadequada todos os anos, enquanto recursos públicos e privados se perdem sem gerar cuidado.', 'giftmedtema' ); ?>
				</p>
				<ul class="gm-topic-card__list">
					<li><?php esc_html_e( 'Desperdício financeiro em larga escala', 'giftmedtema' ); ?></li>
					<li><?php esc_html_e( 'Sobrecarga assistencial no SUS', 'giftmedtema' ); ?></li>
					<li><?php esc_html_e( 'Falta de rastreabilidade nas doações', 'giftmedtema' ); ?></li>
				</ul>
			</article>

			<article class="gm-topic-card gm-topic-card--problem reveal reveal-delay-3">
				<header class="gm-topic-card__head">
					<span class="gm-topic-card__icon" aria-hidden="true">🎯</span>
					<div>
						<p class="gm-topic-card__label"><?php esc_html_e( 'Missão', 'giftmedtema' ); ?></p>
						<h3><?php esc_html_e( 'O Problema que Queremos Resolver', 'giftmedtema' ); ?></h3>
					</div>
				</header>
				<p class="gm-topic-card__summary">
					<?php esc_html_e( 'Conectar medicamentos sem uso a quem precisa, com segurança sanitária, rastreabilidade e impacto social mensurável.', 'giftmedtema' ); ?>
				</p>
				<ul class="gm-topic-card__list">
					<li><?php esc_html_e( 'Acesso contínuo a tratamentos essenciais', 'giftmedtema' ); ?></li>
					<li><?php esc_html_e( 'Redistribuição segura e auditável', 'giftmedtema' ); ?></li>
					<li><?php esc_html_e( 'Economia circular na saúde pública', 'giftmedtema' ); ?></li>
				</ul>
			</article>
		</div>

		<div class="gm-topics__support">
			<div class="gm-topics__support-head reveal">
				<span class="gm-topics__support-line" aria-hidden="true"></span>
				<h3 class="gm-topics__support-title"><?php esc_html_e( 'Dimensões do problema', 'giftmedtema' ); ?></h3>
				<span class="gm-topics__support-line" aria-hidden="true"></span>
			</div>
			<div class="gm-grid-4">
				<?php
				$desafio_query = giftmedtema_query_by_category( 'desafio' );
				if ( $desafio_query->have_posts() ) :
					$i = 0;
					while ( $desafio_query->have_posts() ) :
						$desafio_query->the_post();
						$icone = giftmedtema_meta( get_the_ID(), 'icone', '💊' );
						++$i;
						?>
						<article class="gm-card gm-dim-card reveal reveal-delay-<?php echo esc_attr( (string) min( $i, 4 ) ); ?>">
							<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $icone ); ?></div>
							<h3 class="gm-card__title"><?php the_title(); ?></h3>
							<div class="gm-card__text"><?php the_excerpt(); ?></div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					$desafio_fallback = array(
						array( '💰', __( 'Desperdício Financeiro', 'giftmedtema' ), __( 'Perda de recursos com remédios que vencem sem utilização nas residências.', 'giftmedtema' ) ),
						array( '🌱', __( 'Impactos Ambientais', 'giftmedtema' ), __( 'Riscos severos decorrentes do descarte inadequado de componentes químicos.', 'giftmedtema' ) ),
						array( '🏥', __( 'Sobrecarga do SUS', 'giftmedtema' ), __( 'Aumento da pressão assistencial por descontinuidade de tratamentos primários.', 'giftmedtema' ) ),
						array( '💊', __( 'Redução do Acesso', 'giftmedtema' ), __( 'Dificuldade de fornecimento de medicação contínua para populações isoladas.', 'giftmedtema' ) ),
					);
					foreach ( $desafio_fallback as $i => $card ) :
						?>
						<article class="gm-card gm-dim-card reveal reveal-delay-<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
							<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $card[0] ); ?></div>
							<h3 class="gm-card__title"><?php echo esc_html( $card[1] ); ?></h3>
							<p class="gm-card__text"><?php echo esc_html( $card[2] ); ?></p>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section id="como-funciona" class="gm-section gm-flow-section">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Fluxo do Medicamento', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Processo simples, seguro e transparente', 'giftmedtema' ); ?></h2>
			<p><?php esc_html_e( 'Do cadastro da doação à entrega final, cada etapa é registrada e monitorada digitalmente.', 'giftmedtema' ); ?></p>
		</div>

		<?php
		$flow_icons = array( '📦', '🩺', '🔗', '💊', '♻️' );
		$fluxo_query = giftmedtema_query_by_category( 'como-funciona' );
		$flow_items  = array();

		if ( $fluxo_query->have_posts() ) :
			$step = 0;
			while ( $fluxo_query->have_posts() ) :
				$fluxo_query->the_post();
				$title = preg_replace( '/^\s*\d+[\.\):\-–—]?\s*/u', '', get_the_title() );
				$flow_items[] = array(
					'title' => $title ? $title : get_the_title(),
					'text'  => get_the_excerpt(),
					'icon'  => $flow_icons[ $step ] ?? '●',
					'alt'   => ( 4 === $step ),
				);
				++$step;
			endwhile;
			wp_reset_postdata();
		else :
			$flow_items = array(
				array(
					'title' => __( 'Doação', 'giftmedtema' ),
					'text'  => __( 'O cidadão realiza a entrega ou o cadastro dos medicamentos disponíveis.', 'giftmedtema' ),
					'icon'  => '📦',
					'alt'   => false,
				),
				array(
					'title' => __( 'Triagem', 'giftmedtema' ),
					'text'  => __( 'Profissionais habilitados analisam a integridade, validade e condições sanitárias.', 'giftmedtema' ),
					'icon'  => '🩺',
					'alt'   => false,
				),
				array(
					'title' => __( 'Rastreio', 'giftmedtema' ),
					'text'  => __( 'Todas as etapas operacionais são monitoradas digitalmente.', 'giftmedtema' ),
					'icon'  => '🔗',
					'alt'   => false,
				),
				array(
					'title' => __( 'Redistribuição', 'giftmedtema' ),
					'text'  => __( 'Medicamentos aprovados são ofertados via Farmácias Solidárias.', 'giftmedtema' ),
					'icon'  => '💊',
					'alt'   => false,
				),
				array(
					'title' => __( 'Descarte', 'giftmedtema' ),
					'text'  => __( 'Produtos inaptos recebem destinação final ambientalmente segura.', 'giftmedtema' ),
					'icon'  => '♻️',
					'alt'   => true,
				),
			);
		endif;
		?>

		<ul class="gm-flow reveal">
			<?php foreach ( $flow_items as $i => $item ) : ?>
				<li class="gm-flow__item<?php echo ! empty( $item['alt'] ) ? ' gm-flow__item--alt' : ''; ?> reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 5 ) ); ?>">
					<article class="gm-flow__card">
						<span class="gm-flow__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
						<h3 class="gm-flow__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="gm-flow__text"><?php echo esc_html( wp_strip_all_tags( $item['text'] ) ); ?></p>
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
				<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Recursos Técnicos', 'giftmedtema' ); ?></span>
				<h2 class="gm-title"><?php esc_html_e( 'Módulos que fortalecem a governança', 'giftmedtema' ); ?></h2>
			</div>
			<p class="gm-recursos__lead">
				<?php esc_html_e( 'Ferramentas integradas para operar a Farmácia Solidária com segurança, rastreabilidade e indicadores claros para a gestão pública.', 'giftmedtema' ); ?>
			</p>
		</div>

		<?php
		$recursos_query = giftmedtema_query_by_category( 'funcionalidades' );
		$recursos_items = array();
		$recursos_icons = array( '📦', '🩺', '🔗', '📊', '🖥️', '🔒' );

		if ( $recursos_query->have_posts() ) :
			$i = 0;
			while ( $recursos_query->have_posts() ) :
				$recursos_query->the_post();
				$recursos_items[] = array(
					'icon'  => giftmedtema_meta( get_the_ID(), 'icone', $recursos_icons[ $i ] ?? '📦' ),
					'title' => get_the_title(),
					'text'  => wp_strip_all_tags( get_the_excerpt() ),
				);
				++$i;
			endwhile;
			wp_reset_postdata();
		else :
			$recursos_items = array(
				array(
					'icon'  => '📦',
					'title' => __( 'Gestão de Estoque Solidário', 'giftmedtema' ),
					'text'  => __( 'Controle completo de lotes e validades vigentes para segurança de entrega.', 'giftmedtema' ),
				),
				array(
					'icon'  => '🩺',
					'title' => __( 'Triagem Farmacêutica Digital', 'giftmedtema' ),
					'text'  => __( 'Registro técnico imediato das inspeções e laudos de adequação sanitária.', 'giftmedtema' ),
				),
				array(
					'icon'  => '🔗',
					'title' => __( 'Rastreabilidade Completa', 'giftmedtema' ),
					'text'  => __( 'Mapeamento em tempo real de todo o ciclo percorrido pelo medicamento.', 'giftmedtema' ),
				),
				array(
					'icon'  => '📊',
					'title' => __( 'Indicadores de Impacto', 'giftmedtema' ),
					'text'  => __( 'Métricas de monitoramento social, ambiental e econômico unificadas.', 'giftmedtema' ),
				),
				array(
					'icon'  => '🖥️',
					'title' => __( 'Painéis Gerenciais', 'giftmedtema' ),
					'text'  => __( 'Informações estratégicas e relatórios automatizados para tomadas de decisão.', 'giftmedtema' ),
				),
				array(
					'icon'  => '🔒',
					'title' => __( 'Segurança e Conformidade', 'giftmedtema' ),
					'text'  => __( 'Hospedagem em nuvem de alta segurança com adequação integral à LGPD.', 'giftmedtema' ),
				),
			);
		endif;
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
			<span class="gm-eyebrow gm-eyebrow--light"><?php esc_html_e( 'Retorno Social', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Resultados que transformam vidas', 'giftmedtema' ); ?></h2>
			<p class="gm-impacto__lead">
				<?php esc_html_e( 'A GiftMed gera valor em três frentes — social, ambiental e econômica — com uma operação digital segura e rastreável.', 'giftmedtema' ); ?>
			</p>
		</header>

		<div class="gm-impacto__metrics">
			<article class="gm-impacto__metric reveal reveal-delay-1">
				<span class="gm-impacto__icon" aria-hidden="true">🤝</span>
				<h3><?php esc_html_e( 'Impacto Social', 'giftmedtema' ); ?></h3>
				<p><?php esc_html_e( 'Ampliação do acesso a tratamentos e suporte direto a populações em vulnerabilidade.', 'giftmedtema' ); ?></p>
			</article>
			<article class="gm-impacto__metric reveal reveal-delay-2">
				<span class="gm-impacto__icon" aria-hidden="true">🌱</span>
				<h3><?php esc_html_e( 'Impacto Ambiental', 'giftmedtema' ); ?></h3>
				<p><?php esc_html_e( 'Redução expressiva do descarte inadequado e fomento à economia circular de insumos.', 'giftmedtema' ); ?></p>
			</article>
			<article class="gm-impacto__metric reveal reveal-delay-3">
				<span class="gm-impacto__icon" aria-hidden="true">💰</span>
				<h3><?php esc_html_e( 'Impacto Econômico', 'giftmedtema' ); ?></h3>
				<p><?php esc_html_e( 'Economia real de recursos financeiros e otimização dos orçamentos públicos de saúde.', 'giftmedtema' ); ?></p>
			</article>
		</div>

		<div class="gm-impacto__diff reveal">
			<div class="gm-impacto__diff-head">
				<span class="gm-eyebrow gm-eyebrow--light"><?php esc_html_e( 'Diferenciais', 'giftmedtema' ); ?></span>
				<h3><?php esc_html_e( 'Por que a GiftMed é diferente?', 'giftmedtema' ); ?></h3>
			</div>

			<div class="gm-impacto__diff-grid">
				<?php
				$diferenciais = array(
					array( '🎯', __( 'Foco em Farmácias Solidárias', 'giftmedtema' ), __( 'Solução especializada com orientação técnica para o ciclo solidário de medicamentos.', 'giftmedtema' ) ),
					array( '☁️', __( 'Operação em nuvem', 'giftmedtema' ), __( 'Gestão integrada de ponta a ponta, acessível e centralizada.', 'giftmedtema' ) ),
					array( '🔗', __( 'Rastreabilidade total', 'giftmedtema' ), __( 'Histórico completo dos lotes em todas as etapas do processo.', 'giftmedtema' ) ),
					array( '📈', __( 'Escalável para municípios', 'giftmedtema' ), __( 'Infraestrutura preparada para cidades de qualquer porte.', 'giftmedtema' ) ),
					array( '🛡️', __( 'Conformidade e LGPD', 'giftmedtema' ), __( 'Adequação às diretrizes sanitárias vigentes e proteção de dados.', 'giftmedtema' ) ),
				);
				foreach ( $diferenciais as $i => $item ) :
					?>
					<article class="gm-impacto__diff-card reveal reveal-delay-<?php echo esc_attr( (string) min( $i + 1, 5 ) ); ?>">
						<span class="gm-impacto__diff-icon" aria-hidden="true"><?php echo esc_html( $item[0] ); ?></span>
						<strong><?php echo esc_html( $item[1] ); ?></strong>
						<p><?php echo esc_html( $item[2] ); ?></p>
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
