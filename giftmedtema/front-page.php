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
?>

<section id="hero" class="gm-hero" aria-labelledby="gm-hero-title">
	<div class="gm-container gm-hero__grid">
		<div class="gm-hero__content reveal">
			<div class="gm-hero__badge">
				<span class="gm-hero__badge-dot" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Plataforma de Saúde Sustentável', 'giftmedtema' ); ?></span>
			</div>

			<h1 id="gm-hero-title" class="gm-hero__title">
				<?php esc_html_e( 'Tecnologia Social para', 'giftmedtema' ); ?>
				<br><span class="gm-hero__title-accent"><?php esc_html_e( 'Farmácia Solidária', 'giftmedtema' ); ?></span>
			</h1>

			<p class="gm-hero__lead">
				<?php esc_html_e( 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.', 'giftmedtema' ); ?>
			</p>

			<div class="gm-hero__bullets">
				<?php
				$hero_bullets = array(
					__( 'Acesso ampliado a essenciais', 'giftmedtema' ),
					__( 'Redução do descarte químico', 'giftmedtema' ),
					__( 'Economia para a Gestão Pública', 'giftmedtema' ),
					__( 'Gestão 100% Rastreável', 'giftmedtema' ),
				);
				foreach ( $hero_bullets as $i => $bullet ) :
					?>
					<div class="gm-hero__bullet reveal reveal-delay-<?php echo esc_attr( (string) ( ( $i % 4 ) + 1 ) ); ?>">
						<span class="gm-hero__check" aria-hidden="true">✓</span>
						<span><?php echo esc_html( $bullet ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="gm-hero__actions">
				<a href="#contato" class="gm-btn gm-hero__btn-primary"><?php esc_html_e( 'Solicitar Demonstração', 'giftmedtema' ); ?></a>
				<a href="#solucao" class="gm-btn gm-hero__btn-secondary"><?php esc_html_e( 'Conhecer a Plataforma', 'giftmedtema' ); ?></a>
			</div>
		</div>

		<div class="gm-hero__visual reveal reveal-delay-2">
			<aside class="gm-risk-card" aria-labelledby="gm-risk-title">
				<p class="gm-risk-card__label"><?php esc_html_e( 'Atenção', 'giftmedtema' ); ?></p>
				<h2 id="gm-risk-title" class="gm-risk-card__title">
					<?php esc_html_e( 'Riscos do Descarte Incorreto', 'giftmedtema' ); ?>
				</h2>

				<ul class="gm-risk-card__list">
					<li class="gm-risk-card__item">
						<span class="gm-risk-card__icon">
							<img src="<?php echo esc_url( $img_agua ); ?>" alt="" width="40" height="40">
						</span>
						<div class="gm-risk-card__body">
							<strong><?php esc_html_e( 'Contaminação da Água', 'giftmedtema' ); ?></strong>
							<p><?php esc_html_e( 'Rios, lagos e lençóis freáticos podem ser contaminados, afetando ecossistemas e a água potável.', 'giftmedtema' ); ?></p>
						</div>
					</li>
					<li class="gm-risk-card__item">
						<span class="gm-risk-card__icon">
							<img src="<?php echo esc_url( $img_saude ); ?>" alt="" width="40" height="40">
						</span>
						<div class="gm-risk-card__body">
							<strong><?php esc_html_e( 'Riscos à Saúde', 'giftmedtema' ); ?></strong>
							<p><?php esc_html_e( 'Consumo acidental ou contato com substâncias ativas pode causar intoxicações e outros problemas.', 'giftmedtema' ); ?></p>
						</div>
					</li>
					<li class="gm-risk-card__item">
						<span class="gm-risk-card__icon">
							<img src="<?php echo esc_url( $img_ambiente ); ?>" alt="" width="40" height="40">
						</span>
						<div class="gm-risk-card__body">
							<strong><?php esc_html_e( 'Impacto Ambiental', 'giftmedtema' ); ?></strong>
							<p><?php esc_html_e( 'Resíduos farmacêuticos afetam fauna, flora e desequilibram ecossistemas inteiros.', 'giftmedtema' ); ?></p>
						</div>
					</li>
				</ul>
			</aside>
		</div>
	</div>
</section>

<section id="desafio" class="gm-section gm-section--white">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow gm-eyebrow--terra"><?php esc_html_e( 'Cenário Crítico', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'O problema que queremos resolver', 'giftmedtema' ); ?></h2>
			<p><?php esc_html_e( 'Milhões de medicamentos são descartados de forma incorreta anualmente, agredindo o meio ambiente, enquanto milhares de cidadãos vulneráveis enfrentam dificuldades para acessar tratamentos essenciais.', 'giftmedtema' ); ?></p>
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
					<article class="gm-card reveal reveal-delay-<?php echo esc_attr( (string) min( $i, 4 ) ); ?>">
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
					<article class="gm-card reveal reveal-delay-<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
						<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $card[0] ); ?></div>
						<h3 class="gm-card__title"><?php echo esc_html( $card[1] ); ?></h3>
						<p class="gm-card__text"><?php echo esc_html( $card[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section id="solucao" class="gm-section gm-section--soft">
	<div class="gm-container gm-split">
		<div class="gm-split__text reveal">
			<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Inovação Digital', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'O que é a GiftMed?', 'giftmedtema' ); ?></h2>
			<p>
				<?php
				echo wp_kses(
					__( 'A GiftMed é uma <strong>Tecnologia Social digital</strong> voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' ),
					array( 'strong' => array() )
				);
				?>
			</p>
			<div class="gm-callout">
				<div>
					<strong><?php esc_html_e( 'Ambiente Colaborativo Unificado', 'giftmedtema' ); ?></strong>
					<p><?php esc_html_e( 'Integração inteligente entre Cidadãos, Farmacêuticos, Hospitais, Unidades de Saúde, Universidades, Organizações Sociais e Gestores Públicos.', 'giftmedtema' ); ?></p>
				</div>
			</div>
		</div>

		<div class="gm-quote reveal reveal-delay-2">
			<span class="gm-quote__label"><?php esc_html_e( 'Slogan Oficial', 'giftmedtema' ); ?></span>
			<h3><?php esc_html_e( '"Seu remédio pode curar mais do que você imagina."', 'giftmedtema' ); ?></h3>
			<p><?php esc_html_e( 'Conectando Saúde e Solidariedade de forma automatizada e com total rastreabilidade.', 'giftmedtema' ); ?></p>
			<div class="gm-quote__foot">
				<span>@giftmed4</span>
				<a href="https://www.instagram.com/giftmed4/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Acessar o Instagram →', 'giftmedtema' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section id="como-funciona" class="gm-section gm-section--white">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow"><?php esc_html_e( 'Fluxo do Medicamento', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Processo simples, seguro e transparente', 'giftmedtema' ); ?></h2>
		</div>

		<div class="gm-steps">
			<?php
			$fluxo_query = giftmedtema_query_by_category( 'como-funciona' );
			if ( $fluxo_query->have_posts() ) :
				$step = 1;
				while ( $fluxo_query->have_posts() ) :
					$fluxo_query->the_post();
					$num_class = ( 5 === $step ) ? 'gm-step__num gm-step__num--alt' : 'gm-step__num';
					?>
					<article class="gm-step reveal reveal-delay-<?php echo esc_attr( (string) min( $step, 5 ) ); ?>">
						<div class="<?php echo esc_attr( $num_class ); ?>"><?php echo esc_html( (string) $step ); ?></div>
						<h3 class="gm-step__title"><?php the_title(); ?></h3>
						<div class="gm-step__text"><?php the_excerpt(); ?></div>
					</article>
					<?php
					++$step;
				endwhile;
				wp_reset_postdata();
			else :
				$fluxo_fallback = array(
					array( '1', false, __( '1. Doação', 'giftmedtema' ), __( 'O cidadão realiza a entrega ou o cadastro dos medicamentos disponíveis.', 'giftmedtema' ) ),
					array( '2', false, __( '2. Triagem', 'giftmedtema' ), __( 'Profissionais habilitados analisam a integridade, validade e condições sanitárias.', 'giftmedtema' ) ),
					array( '3', false, __( '3. Rastreio', 'giftmedtema' ), __( 'Todas as etapas operacionais são monitoradas digitalmente.', 'giftmedtema' ) ),
					array( '4', false, __( '4. Redistribuição', 'giftmedtema' ), __( 'Medicamentos aprovados são ofertados via Farmácias Solidárias.', 'giftmedtema' ) ),
					array( '5', true, __( '5. Descarte', 'giftmedtema' ), __( 'Produtos inaptos recebem destinação final ambientalmente segura.', 'giftmedtema' ) ),
				);
				foreach ( $fluxo_fallback as $i => $step_card ) :
					$num_class = $step_card[1] ? 'gm-step__num gm-step__num--alt' : 'gm-step__num';
					?>
					<article class="gm-step reveal reveal-delay-<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
						<div class="<?php echo esc_attr( $num_class ); ?>"><?php echo esc_html( $step_card[0] ); ?></div>
						<h3 class="gm-step__title"><?php echo esc_html( $step_card[2] ); ?></h3>
						<p class="gm-step__text"><?php echo esc_html( $step_card[3] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section id="funcionalidades" class="gm-section gm-section--soft">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Recursos Técnicos', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Módulos que fortalecem a governança', 'giftmedtema' ); ?></h2>
		</div>

		<div class="gm-grid-3">
			<?php
			$recursos_query = giftmedtema_query_by_category( 'funcionalidades' );
			if ( $recursos_query->have_posts() ) :
				$i = 0;
				while ( $recursos_query->have_posts() ) :
					$recursos_query->the_post();
					$icone = giftmedtema_meta( get_the_ID(), 'icone', '📦' );
					++$i;
					?>
					<article class="gm-card reveal reveal-delay-<?php echo esc_attr( (string) min( ( ( $i - 1 ) % 3 ) + 1, 3 ) ); ?>">
						<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $icone ); ?></div>
						<h3 class="gm-card__title"><?php the_title(); ?></h3>
						<div class="gm-card__text"><?php the_excerpt(); ?></div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$recursos_fallback = array(
					array( '📦', __( 'Gestão de Estoque Solidário', 'giftmedtema' ), __( 'Controle completo de lotes e validades vigentes para segurança de entrega.', 'giftmedtema' ) ),
					array( '🩺', __( 'Triagem Farmacêutica Digital', 'giftmedtema' ), __( 'Registro técnico imediato das inspeções e laudos de adequação sanitária.', 'giftmedtema' ) ),
					array( '🔗', __( 'Rastreabilidade Completa', 'giftmedtema' ), __( 'Mapeamento em tempo real de todo o ciclo percorrido pelo medicamento.', 'giftmedtema' ) ),
					array( '📊', __( 'Indicadores de Impacto', 'giftmedtema' ), __( 'Métricas de monitoramento social, ambiental e econômico unificadas.', 'giftmedtema' ) ),
					array( '🖥️', __( 'Painéis Gerenciais', 'giftmedtema' ), __( 'Informações estratégicas e relatórios automatizados para tomadas de decisão.', 'giftmedtema' ) ),
					array( '🔒', __( 'Segurança e Conformidade', 'giftmedtema' ), __( 'Hospedagem em nuvem de alta segurança com adequação integral à LGPD.', 'giftmedtema' ) ),
				);
				foreach ( $recursos_fallback as $i => $recurso ) :
					?>
					<article class="gm-card reveal reveal-delay-<?php echo esc_attr( (string) ( ( $i % 3 ) + 1 ) ); ?>">
						<div class="gm-card__icon" aria-hidden="true"><?php echo esc_html( $recurso[0] ); ?></div>
						<h3 class="gm-card__title"><?php echo esc_html( $recurso[1] ); ?></h3>
						<p class="gm-card__text"><?php echo esc_html( $recurso[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section id="impacto" class="gm-section gm-section--dark">
	<div class="gm-container gm-impact">
		<div class="reveal">
			<span class="gm-eyebrow gm-eyebrow--light"><?php esc_html_e( 'Retorno Social', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Resultados que transformam vidas', 'giftmedtema' ); ?></h2>
			<div class="gm-impact-list">
				<div class="gm-impact-item">
					<h5><?php esc_html_e( 'Impacto Social', 'giftmedtema' ); ?></h5>
					<p><?php esc_html_e( 'Ampliação do acesso a tratamentos e suporte direto a populações em vulnerabilidade.', 'giftmedtema' ); ?></p>
				</div>
				<div class="gm-impact-item">
					<h5><?php esc_html_e( 'Impacto Ambiental', 'giftmedtema' ); ?></h5>
					<p><?php esc_html_e( 'Redução expressiva do descarte inadequado e fomento à economia circular de insumos.', 'giftmedtema' ); ?></p>
				</div>
				<div class="gm-impact-item">
					<h5><?php esc_html_e( 'Impacto Econômico', 'giftmedtema' ); ?></h5>
					<p><?php esc_html_e( 'Economia real de recursos financeiros e otimização dos orçamentos públicos de saúde.', 'giftmedtema' ); ?></p>
				</div>
			</div>
		</div>

		<div class="reveal reveal-delay-2">
			<span class="gm-eyebrow gm-eyebrow--light"><?php esc_html_e( 'Diferenciais', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Por que a GiftMed é diferente?', 'giftmedtema' ); ?></h2>
			<ul class="gm-checklist">
				<li><?php esc_html_e( 'Solução especializada com foco técnico em Farmácias Solidárias.', 'giftmedtema' ); ?></li>
				<li><?php esc_html_e( 'Gestão operacional integrada de ponta a ponta em nuvem.', 'giftmedtema' ); ?></li>
				<li><?php esc_html_e( 'Rastreabilidade blindada e histórico completo dos lotes.', 'giftmedtema' ); ?></li>
				<li><?php esc_html_e( 'Infraestrutura perfeitamente escalável para municípios de qualquer porte.', 'giftmedtema' ); ?></li>
				<li><?php esc_html_e( 'Conformidade imediata com diretrizes sanitárias vigentes e LGPD.', 'giftmedtema' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<section class="gm-mvp">
	<div class="gm-mvp__box reveal">
		<span class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Status do Projeto', 'giftmedtema' ); ?></span>
		<h3><?php esc_html_e( 'Solução em estágio de MVP (Produto Mínimo Viável)', 'giftmedtema' ); ?></h3>
		<p><?php esc_html_e( 'Desenvolvida sob metodologias ágeis, a plataforma possui todas as suas funcionalidades essenciais operacionais prontas para implementação prática em secretarias e órgãos de saúde.', 'giftmedtema' ); ?></p>
	</div>
</section>

<section id="equipe" class="gm-section gm-section--white">
	<div class="gm-container">
		<div class="gm-section__head reveal">
			<span class="gm-eyebrow"><?php esc_html_e( 'Membros do Projeto', 'giftmedtema' ); ?></span>
			<h2 class="gm-title"><?php esc_html_e( 'Conheça a equipe da GiftMed', 'giftmedtema' ); ?></h2>
		</div>

		<div class="gm-team">
			<?php
			$equipe_query = giftmedtema_query_by_category( 'equipe' );
			if ( $equipe_query->have_posts() ) :
				$i = 0;
				while ( $equipe_query->have_posts() ) :
					$equipe_query->the_post();
					$cargo       = giftmedtema_meta( get_the_ID(), 'cargo', '' );
					$borda_meta  = giftmedtema_meta( get_the_ID(), 'borda', '' );
					$photo_class = 'gm-member__photo';
					if ( false !== strpos( $borda_meta, 'orange' ) || false !== strpos( $borda_meta, 'terra' ) ) {
						$photo_class .= ' gm-member__photo--terra';
					} elseif ( false !== strpos( $borda_meta, 'teal' ) || false !== strpos( $borda_meta, 'navy' ) ) {
						$photo_class .= ' gm-member__photo--navy';
					}
					++$i;
					?>
					<article class="gm-card gm-member reveal reveal-delay-<?php echo esc_attr( (string) min( $i, 4 ) ); ?>">
						<div class="<?php echo esc_attr( $photo_class ); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php
								the_post_thumbnail(
									'giftmed-team',
									array(
										'alt' => the_title_attribute( array( 'echo' => false ) ),
									)
								);
								?>
							<?php else : ?>
								<span class="gm-member__initial"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
							<?php endif; ?>
						</div>
						<h3 class="gm-member__name"><?php the_title(); ?></h3>
						<?php if ( $cargo ) : ?>
							<p class="gm-member__role"><?php echo esc_html( $cargo ); ?></p>
						<?php endif; ?>
						<div class="gm-member__bio"><?php the_excerpt(); ?></div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$equipe_fallback = array(
					array( __( "Mateus Dall'Agnol", 'giftmedtema' ), __( 'Chief Information Officer (CIO)', 'giftmedtema' ), __( 'Responsável pela estratégia, gestão da inovação, estruturação do modelo de negócio e articulação institucional.', 'giftmedtema' ), 'navy' ),
					array( __( 'Gelson André Schneider', 'giftmedtema' ), __( 'Programador Sênior', 'giftmedtema' ), __( 'Responsável pelo desenvolvimento de sistemas, arquitetura tecnológica e evolução das funcionalidades da plataforma.', 'giftmedtema' ), '' ),
					array( __( 'Fernando de Souza Arantes', 'giftmedtema' ), __( 'Programador Sênior', 'giftmedtema' ), __( 'Atua no desenvolvimento, integração de módulos complexos, arquitetura de banco de dados e escalabilidade.', 'giftmedtema' ), '' ),
					array( __( 'Roberta Feitosa Silveira', 'giftmedtema' ), __( 'Farmacêutica Responsável', 'giftmedtema' ), __( 'Responsável pela validação técnica de todos os processos farmacêuticos, conformidade sanitária e segurança operacional.', 'giftmedtema' ), 'terra' ),
				);
				foreach ( $equipe_fallback as $i => $membro ) :
					$photo_class = 'gm-member__photo';
					if ( 'terra' === $membro[3] ) {
						$photo_class .= ' gm-member__photo--terra';
					} elseif ( 'navy' === $membro[3] ) {
						$photo_class .= ' gm-member__photo--navy';
					}
					?>
					<article class="gm-card gm-member reveal reveal-delay-<?php echo esc_attr( (string) ( $i + 1 ) ); ?>">
						<div class="<?php echo esc_attr( $photo_class ); ?>">
							<span class="gm-member__initial"><?php echo esc_html( mb_substr( $membro[0], 0, 1 ) ); ?></span>
						</div>
						<h3 class="gm-member__name"><?php echo esc_html( $membro[0] ); ?></h3>
						<p class="gm-member__role"><?php echo esc_html( $membro[1] ); ?></p>
						<p class="gm-member__bio"><?php echo esc_html( $membro[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
