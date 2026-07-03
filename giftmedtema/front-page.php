<?php
/**
 * Página inicial — layout baseado em index2.html.
 *
 * @package GiftMedTema
 */

get_header();

$theme_img = giftmedtema_asset( 'assets/img' );
$hero_img  = $theme_img . '/giftmedquadrado.png';
?>

<section id="hero" class="relative pt-12 pb-24 overflow-hidden">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

			<div class="lg:col-span-7 space-y-6 text-center lg:text-left">
				<div class="inline-flex items-center space-x-2 bg-teal-50 border border-teal-100 text-teal-800 px-4 py-2 rounded-xl text-xs font-bold tracking-wide uppercase shadow-sm">
					<span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
					<span><?php esc_html_e( 'Plataforma de Saúde Sustentável', 'giftmedtema' ); ?></span>
				</div>
				<h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-none">
					<?php esc_html_e( 'Tecnologia Social para', 'giftmedtema' ); ?>
					<br><span class="text-gradient-teal"><?php esc_html_e( 'Farmácia Solidária', 'giftmedtema' ); ?></span>
				</h1>
				<p class="text-lg text-slate-600 font-medium leading-relaxed max-w-2xl">
					<?php esc_html_e( 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.', 'giftmedtema' ); ?>
				</p>

				<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm font-bold text-slate-700 pt-2 text-left">
					<?php
					$hero_bullets = array(
						__( 'Acesso ampliado a essenciais', 'giftmedtema' ),
						__( 'Redução do descarte químico', 'giftmedtema' ),
						__( 'Economia para a Gestão Pública', 'giftmedtema' ),
						__( 'Gestão 100% Rastreável', 'giftmedtema' ),
					);
					foreach ( $hero_bullets as $bullet ) :
						?>
						<div class="flex items-center space-x-3 p-3 bg-white rounded-xl border border-slate-100 shadow-sm">
							<span class="flex items-center justify-center w-6 h-6 bg-teal-100 text-teal-700 rounded-lg text-xs">✓</span>
							<span><?php echo esc_html( $bullet ); ?></span>
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
					<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php esc_attr_e( 'Dr. GiftMed - Vem coisa boa por aí', 'giftmedtema' ); ?>" class="w-full h-auto rounded-xl object-contain">
					<div class="absolute bottom-6 left-6 right-6 bg-slate-900/90 backdrop-blur-md p-4 rounded-xl border border-white/10 text-white">
						<p class="text-xs font-black text-orange-400 uppercase tracking-widest"><?php esc_html_e( 'Identidade Oficial', 'giftmedtema' ); ?></p>
						<h4 class="text-sm font-bold mt-1"><?php esc_html_e( 'Dr. GiftMed — Lançamento da Solução', 'giftmedtema' ); ?></h4>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<section id="desafio" class="py-24 bg-white border-y border-slate-100">
	<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
		<span class="text-orange-500 font-extrabold text-xs uppercase tracking-widest bg-orange-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Cenário Crítico', 'giftmedtema' ); ?></span>
		<h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 mb-4 tracking-tight"><?php esc_html_e( 'O problema que queremos resolver', 'giftmedtema' ); ?></h2>
		<p class="text-slate-600 leading-relaxed mb-16 max-w-2xl mx-auto font-medium">
			<?php esc_html_e( 'Milhões de medicamentos são descartados de forma incorreta anualmente, agredindo o meio ambiente, enquanto milhares de cidadãos vulneráveis enfrentam dificuldades para acessar tratamentos essenciais.', 'giftmedtema' ); ?>
		</p>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">
			<?php
			$desafio_query = giftmedtema_query_by_category( 'desafio' );
			if ( $desafio_query->have_posts() ) :
				while ( $desafio_query->have_posts() ) :
					$desafio_query->the_post();
					$icone = giftmedtema_meta( get_the_ID(), 'icone', '💊' );
					?>
					<div class="p-6 bg-slate-50 border border-slate-200/60 rounded-2xl">
						<div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-xl"><?php echo esc_html( $icone ); ?></div>
						<h4 class="font-bold text-slate-900 mt-4 text-sm"><?php the_title(); ?></h4>
						<div class="text-xs text-slate-500 mt-2 leading-relaxed"><?php the_excerpt(); ?></div>
					</div>
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
				foreach ( $desafio_fallback as $card ) :
					?>
					<div class="p-6 bg-slate-50 border border-slate-200/60 rounded-2xl">
						<div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-xl"><?php echo esc_html( $card[0] ); ?></div>
						<h4 class="font-bold text-slate-900 mt-4 text-sm"><?php echo esc_html( $card[1] ); ?></h4>
						<p class="text-xs text-slate-500 mt-2 leading-relaxed"><?php echo esc_html( $card[2] ); ?></p>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section id="solucao" class="py-24 relative">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

			<div class="lg:col-span-6 space-y-6">
				<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Inovação Digital', 'giftmedtema' ); ?></span>
				<h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight"><?php esc_html_e( 'O que é a GiftMed?', 'giftmedtema' ); ?></h2>
				<p class="text-slate-600 leading-relaxed font-medium">
					<?php
					echo wp_kses(
						__( 'A GiftMed é uma <strong>Tecnologia Social digital</strong> voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' ),
						array( 'strong' => array() )
					);
					?>
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
						<?php esc_html_e( '"Seu remédio pode curar mais do que você imagina."', 'giftmedtema' ); ?>
					</h3>
					<p class="text-sm text-slate-300 leading-relaxed mt-4 font-light">
						<?php esc_html_e( 'Conectando Saúde e Solidariedade de forma automatizada e com total rastreabilidade.', 'giftmedtema' ); ?>
					</p>
					<div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-between text-xs font-bold text-teal-400">
						<span class="tracking-widest uppercase">@giftmed4</span>
						<a href="https://www.instagram.com/giftmed4/" target="_blank" rel="noopener noreferrer" class="hover:text-orange-400 transition flex items-center gap-1"><?php esc_html_e( 'Acessar o Instagram →', 'giftmedtema' ); ?></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<section id="como-funciona" class="py-24 bg-white border-y border-slate-100">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-3xl mx-auto mb-16">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Fluxo do Medicamento', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Processo simples, seguro e transparente', 'giftmedtema' ); ?></h2>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-5 gap-6">
			<?php
			$fluxo_query = giftmedtema_query_by_category( 'como-funciona' );
			if ( $fluxo_query->have_posts() ) :
				$step = 1;
				while ( $fluxo_query->have_posts() ) :
					$fluxo_query->the_post();
					$badge_class = ( 5 === $step ) ? 'bg-slate-800' : 'bg-teal-600';
					?>
					<div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center space-y-2">
						<div class="w-10 h-10 <?php echo esc_attr( $badge_class ); ?> text-white font-bold rounded-xl flex items-center justify-center mx-auto shadow-md"><?php echo esc_html( (string) $step ); ?></div>
						<h4 class="font-bold text-slate-900 text-xs"><?php the_title(); ?></h4>
						<div class="text-[11px] text-slate-500 leading-relaxed"><?php the_excerpt(); ?></div>
					</div>
					<?php
					++$step;
				endwhile;
				wp_reset_postdata();
			else :
				$fluxo_fallback = array(
					array( '1', 'bg-teal-600', __( '1. Doação', 'giftmedtema' ), __( 'O cidadão realiza a entrega ou o cadastro dos medicamentos disponíveis.', 'giftmedtema' ) ),
					array( '2', 'bg-teal-600', __( '2. Triagem', 'giftmedtema' ), __( 'Profissionais habilitados analisam a integridade, validade e condições sanitárias.', 'giftmedtema' ) ),
					array( '3', 'bg-teal-600', __( '3. Rastreio', 'giftmedtema' ), __( 'Todas as etapas operacionais são monitoradas digitalmente.', 'giftmedtema' ) ),
					array( '4', 'bg-teal-600', __( '4. Redistribuição', 'giftmedtema' ), __( 'Medicamentos aprovados são ofertados via Farmácias Solidárias.', 'giftmedtema' ) ),
					array( '5', 'bg-slate-800', __( '5. Descarte', 'giftmedtema' ), __( 'Produtos inaptos recebem destinação final ambientalmente segura.', 'giftmedtema' ) ),
				);
				foreach ( $fluxo_fallback as $step_card ) :
					?>
					<div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center space-y-2">
						<div class="w-10 h-10 <?php echo esc_attr( $step_card[1] ); ?> text-white font-bold rounded-xl flex items-center justify-center mx-auto shadow-md"><?php echo esc_html( $step_card[0] ); ?></div>
						<h4 class="font-bold text-slate-900 text-xs"><?php echo esc_html( $step_card[2] ); ?></h4>
						<p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html( $step_card[3] ); ?></p>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section id="funcionalidades" class="py-24">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-2xl mx-auto mb-16">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Recursos Técnicos', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Módulos que fortalecem a governança', 'giftmedtema' ); ?></h2>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php
			$recursos_query = giftmedtema_query_by_category( 'funcionalidades' );
			if ( $recursos_query->have_posts() ) :
				while ( $recursos_query->have_posts() ) :
					$recursos_query->the_post();
					$icone = giftmedtema_meta( get_the_ID(), 'icone', '📦' );
					?>
					<div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-2">
						<span class="text-xl block"><?php echo esc_html( $icone ); ?></span>
						<h4 class="font-bold text-slate-900 text-sm"><?php the_title(); ?></h4>
						<div class="text-xs text-slate-500 leading-relaxed"><?php the_excerpt(); ?></div>
					</div>
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
				foreach ( $recursos_fallback as $recurso ) :
					?>
					<div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-2">
						<span class="text-xl block"><?php echo esc_html( $recurso[0] ); ?></span>
						<h4 class="font-bold text-slate-900 text-sm"><?php echo esc_html( $recurso[1] ); ?></h4>
						<p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html( $recurso[2] ); ?></p>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section id="impacto" class="py-24 bg-slate-900 text-white">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16">

		<div class="space-y-6">
			<span class="text-orange-400 font-extrabold text-xs uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full"><?php esc_html_e( 'Retorno Social', 'giftmedtema' ); ?></span>
			<h3 class="text-3xl font-black"><?php esc_html_e( 'Resultados que transformam vidas', 'giftmedtema' ); ?></h3>
			<div class="space-y-3">
				<div class="p-4 bg-white/5 rounded-xl">
					<h5 class="text-teal-400 font-bold text-xs"><?php esc_html_e( 'Impacto Social', 'giftmedtema' ); ?></h5>
					<p class="text-xs text-slate-300 mt-1"><?php esc_html_e( 'Ampliação do acesso a tratamentos e suporte direto a populações em vulnerabilidade.', 'giftmedtema' ); ?></p>
				</div>
				<div class="p-4 bg-white/5 rounded-xl">
					<h5 class="text-teal-400 font-bold text-xs"><?php esc_html_e( 'Impacto Ambiental', 'giftmedtema' ); ?></h5>
					<p class="text-xs text-slate-300 mt-1"><?php esc_html_e( 'Redução expressiva do descarte inadequado e fomento à economia circular de insumos.', 'giftmedtema' ); ?></p>
				</div>
				<div class="p-4 bg-white/5 rounded-xl">
					<h5 class="text-teal-400 font-bold text-xs"><?php esc_html_e( 'Impacto Econômico', 'giftmedtema' ); ?></h5>
					<p class="text-xs text-slate-300 mt-1"><?php esc_html_e( 'Economia real de recursos financeiros e otimização dos orçamentos públicos de saúde.', 'giftmedtema' ); ?></p>
				</div>
			</div>
		</div>

		<div class="space-y-6">
			<span class="text-teal-400 font-extrabold text-xs uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full"><?php esc_html_e( 'Diferenciais', 'giftmedtema' ); ?></span>
			<h3 class="text-3xl font-black"><?php esc_html_e( 'Por que a GiftMed é diferente?', 'giftmedtema' ); ?></h3>
			<ul class="space-y-3 text-xs text-slate-300 font-medium">
				<li>✓ <?php esc_html_e( 'Solução especializada com foco técnico em Farmácias Solidárias.', 'giftmedtema' ); ?></li>
				<li>✓ <?php esc_html_e( 'Gestão operacional integrada de ponta a ponta em nuvem.', 'giftmedtema' ); ?></li>
				<li>✓ <?php esc_html_e( 'Rastreabilidade blindada e histórico completo dos lotes.', 'giftmedtema' ); ?></li>
				<li>✓ <?php esc_html_e( 'Infraestrutura perfeitamente escalável para municípios de qualquer porte.', 'giftmedtema' ); ?></li>
				<li>✓ <?php esc_html_e( 'Conformidade imediata com diretrizes sanitárias vigentes e LGPD.', 'giftmedtema' ); ?></li>
			</ul>
		</div>

	</div>
</section>

<section class="py-12 bg-teal-50 border-y border-teal-100 text-center max-w-4xl mx-auto my-12 rounded-2xl p-6">
	<span class="bg-teal-600 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-md"><?php esc_html_e( 'Status do Projeto', 'giftmedtema' ); ?></span>
	<h3 class="text-xl font-black text-slate-900 mt-2"><?php esc_html_e( 'Solução em estágio de MVP (Produto Mínimo Viável)', 'giftmedtema' ); ?></h3>
	<p class="text-xs text-slate-600 mt-1 max-w-2xl mx-auto leading-relaxed">
		<?php esc_html_e( 'Desenvolvida sob metodologias ágeis, a plataforma possui todas as suas funcionalidades essenciais operacionais prontas para implementação prática em secretarias e órgãos de saúde.', 'giftmedtema' ); ?>
	</p>
</section>

<section id="equipe" class="py-24 bg-white">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center max-w-2xl mx-auto mb-16">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full"><?php esc_html_e( 'Membros do Projeto', 'giftmedtema' ); ?></span>
			<h2 class="text-3xl font-black text-slate-900 mt-3"><?php esc_html_e( 'Conheça a equipe da GiftMed', 'giftmedtema' ); ?></h2>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
			<?php
			$equipe_query = giftmedtema_query_by_category( 'equipe' );
			if ( $equipe_query->have_posts() ) :
				while ( $equipe_query->have_posts() ) :
					$equipe_query->the_post();
					$cargo        = giftmedtema_meta( get_the_ID(), 'cargo', '' );
					$border_class = giftmedtema_meta( get_the_ID(), 'borda', 'border-slate-300' );
					?>
					<div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center space-y-4">
						<div class="w-24 h-24 rounded-full mx-auto overflow-hidden border-2 <?php echo esc_attr( $border_class ); ?> bg-white p-1">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php
								the_post_thumbnail(
									'giftmed-team',
									array(
										'class' => 'w-full h-full object-cover object-top rounded-full',
										'alt'   => the_title_attribute( array( 'echo' => false ) ),
									)
								);
								?>
							<?php else : ?>
								<div class="w-full h-full rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-black text-2xl">
									<?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?>
								</div>
							<?php endif; ?>
						</div>
						<div>
							<h4 class="font-extrabold text-slate-900 text-sm"><?php the_title(); ?></h4>
							<?php if ( $cargo ) : ?>
								<p class="text-xs text-teal-600 font-bold uppercase tracking-wider"><?php echo esc_html( $cargo ); ?></p>
							<?php endif; ?>
						</div>
						<div class="text-xs text-slate-500 leading-relaxed"><?php the_excerpt(); ?></div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$equipe_fallback = array(
					array( __( "Mateus Dall'Agnol", 'giftmedtema' ), __( 'Chief Information Officer (CIO)', 'giftmedtema' ), __( 'Responsável pela estratégia, gestão da inovação, estruturação do modelo de negócio e articulação institucional.', 'giftmedtema' ), 'border-teal-500' ),
					array( __( 'Gelson André Schneider', 'giftmedtema' ), __( 'Programador Sênior', 'giftmedtema' ), __( 'Responsável pelo desenvolvimento de sistemas, arquitetura tecnológica e evolução das funcionalidades da plataforma.', 'giftmedtema' ), 'border-slate-300' ),
					array( __( 'Fernando de Souza Arantes', 'giftmedtema' ), __( 'Programador Sênior', 'giftmedtema' ), __( 'Atua no desenvolvimento, integração de módulos complexos, arquitetura de banco de dados e escalabilidade.', 'giftmedtema' ), 'border-slate-300' ),
					array( __( 'Roberta Feitosa Silveira', 'giftmedtema' ), __( 'Farmacêutica Responsável', 'giftmedtema' ), __( 'Responsável pela validação técnica de todos os processos farmacêuticos, conformidade sanitária e segurança operacional.', 'giftmedtema' ), 'border-orange-400' ),
				);
				foreach ( $equipe_fallback as $membro ) :
					?>
					<div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center space-y-4">
						<div class="w-24 h-24 rounded-full mx-auto overflow-hidden border-2 <?php echo esc_attr( $membro[3] ); ?> bg-white p-1">
							<div class="w-full h-full rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-black text-2xl">
								<?php echo esc_html( mb_substr( $membro[0], 0, 1 ) ); ?>
							</div>
						</div>
						<div>
							<h4 class="font-extrabold text-slate-900 text-sm"><?php echo esc_html( $membro[0] ); ?></h4>
							<p class="text-xs text-teal-600 font-bold uppercase tracking-wider"><?php echo esc_html( $membro[1] ); ?></p>
						</div>
						<p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html( $membro[2] ); ?></p>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php
get_footer();
