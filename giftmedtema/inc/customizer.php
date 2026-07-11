<?php
/**
 * Customizer — hero, parceiros e contatos.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitiza checkbox do Customizer.
 *
 * @param mixed $value Valor.
 * @return bool
 */
function giftmedtema_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Registra opções do Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function giftmedtema_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'giftmedtema_panel',
		array(
			'title'    => __( 'GiftMed Conteúdo', 'giftmedtema' ),
			'priority' => 30,
		)
	);

	/* ---- Topbar / Hero ---- */
	$wp_customize->add_section(
		'giftmedtema_hero',
		array(
			'title' => __( 'Hero / Topbar', 'giftmedtema' ),
			'panel' => 'giftmedtema_panel',
		)
	);

	$hero_fields = array(
		'topbar_text'     => array(
			'label'   => __( 'Texto da topbar', 'giftmedtema' ),
			'default' => __( 'CONECTANDO SAÚDE E SOLIDARIEDADE — Conheça o nosso Sistema de Doação de Medicamentos', 'giftmedtema' ),
			'type'    => 'textarea',
		),
		'hero_badge'      => array(
			'label'   => __( 'Badge do hero', 'giftmedtema' ),
			'default' => __( 'Plataforma de Saúde Sustentável', 'giftmedtema' ),
			'type'    => 'text',
		),
		'hero_title'      => array(
			'label'   => __( 'Título (linha 1)', 'giftmedtema' ),
			'default' => __( 'Tecnologia Social para', 'giftmedtema' ),
			'type'    => 'text',
		),
		'hero_title_accent' => array(
			'label'   => __( 'Título (destaque)', 'giftmedtema' ),
			'default' => __( 'Farmácia Solidária', 'giftmedtema' ),
			'type'    => 'text',
		),
		'hero_lead'       => array(
			'label'   => __( 'Texto de apoio', 'giftmedtema' ),
			'default' => __( 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.', 'giftmedtema' ),
			'type'    => 'textarea',
		),
		'hero_cta_primary' => array(
			'label'   => __( 'CTA principal', 'giftmedtema' ),
			'default' => __( 'Solicitar Demonstração', 'giftmedtema' ),
			'type'    => 'text',
		),
		'hero_cta_secondary' => array(
			'label'   => __( 'CTA secundário', 'giftmedtema' ),
			'default' => __( 'Conhecer a Plataforma', 'giftmedtema' ),
			'type'    => 'text',
		),
		'hero_bullets'    => array(
			'label'   => __( 'Bullets (um por linha)', 'giftmedtema' ),
			'default' => "Acesso ampliado a essenciais\nRedução do descarte químico\nEconomia para a Gestão Pública\nGestão 100% Rastreável",
			'type'    => 'textarea',
		),
	);

	foreach ( $hero_fields as $key => $field ) {
		giftmedtema_customize_add_field( $wp_customize, 'giftmedtema_hero', $key, $field );
	}

	giftmedtema_customize_register_home_sections( $wp_customize );

	/* ---- Contato / redes ---- */
	$wp_customize->add_section(
		'giftmedtema_contato',
		array(
			'title' => __( 'Contato e redes', 'giftmedtema' ),
			'panel' => 'giftmedtema_panel',
		)
	);

	$contact_fields = array(
		'contato_eyebrow' => array(
			'label'   => __( 'Eyebrow da seção', 'giftmedtema' ),
			'default' => __( 'Fale Conosco', 'giftmedtema' ),
			'type'    => 'text',
		),
		'contato_title'   => array(
			'label'   => __( 'Título da seção', 'giftmedtema' ),
			'default' => __( 'Vamos conversar sobre a GiftMed', 'giftmedtema' ),
			'type'    => 'text',
		),
		'contato_lead'    => array(
			'label'   => __( 'Texto de apoio', 'giftmedtema' ),
			'default' => __( 'Fale com a equipe responsável ou solicite uma demonstração da plataforma para o seu município ou instituição.', 'giftmedtema' ),
			'type'    => 'textarea',
		),
		'contato_form_badge' => array(
			'label'   => __( 'Badge do formulário', 'giftmedtema' ),
			'default' => __( 'Demonstração', 'giftmedtema' ),
			'type'    => 'text',
		),
		'contato_form_title' => array(
			'label'   => __( 'Título do formulário', 'giftmedtema' ),
			'default' => __( 'Agende uma apresentação', 'giftmedtema' ),
			'type'    => 'text',
		),
		'contato_form_text' => array(
			'label'   => __( 'Texto do formulário', 'giftmedtema' ),
			'default' => __( 'Preencha os dados e nossa equipe retorna o contato.', 'giftmedtema' ),
			'type'    => 'textarea',
		),
		'contato_form_button' => array(
			'label'   => __( 'Botão do formulário', 'giftmedtema' ),
			'default' => __( 'Agendar apresentação', 'giftmedtema' ),
			'type'    => 'text',
		),
		'email_contato'   => array(
			'label'   => __( 'E-mail Direção & Parcerias', 'giftmedtema' ),
			'default' => 'contato@giftmed.org',
			'type'    => 'email',
		),
		'email_mkt'       => array(
			'label'   => __( 'E-mail Marketing', 'giftmedtema' ),
			'default' => 'mkt@giftmed.org',
			'type'    => 'email',
		),
		'instagram_url'   => array(
			'label'   => __( 'URL Instagram', 'giftmedtema' ),
			'default' => 'https://www.instagram.com/giftmed4/',
			'type'    => 'url',
		),
		'instagram_handle'=> array(
			'label'   => __( 'Handle Instagram', 'giftmedtema' ),
			'default' => '@giftmed4',
			'type'    => 'text',
		),
		'youtube_url'     => array(
			'label'   => __( 'URL YouTube', 'giftmedtema' ),
			'default' => 'https://www.youtube.com/@giftmed4',
			'type'    => 'url',
		),
		'tiktok_url'      => array(
			'label'   => __( 'URL TikTok', 'giftmedtema' ),
			'default' => 'https://www.tiktok.com/@giftmed4',
			'type'    => 'url',
		),
	);

	foreach ( $contact_fields as $key => $field ) {
		giftmedtema_customize_add_field( $wp_customize, 'giftmedtema_contato', $key, $field );
	}

	/* ---- Parceiros ---- */
	$wp_customize->add_section(
		'giftmedtema_parceiros',
		array(
			'title' => __( 'Parceiros', 'giftmedtema' ),
			'panel' => 'giftmedtema_panel',
		)
	);

	$wp_customize->add_setting(
		'giftmedtema_parceiros_eyebrow',
		array(
			'default'           => __( 'Rede de apoio', 'giftmedtema' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'giftmedtema_parceiros_eyebrow',
		array(
			'label'   => __( 'Eyebrow', 'giftmedtema' ),
			'section' => 'giftmedtema_parceiros',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'giftmedtema_parceiros_title',
		array(
			'default'           => __( 'Instituições que apoiam a GiftMed', 'giftmedtema' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'giftmedtema_parceiros_title',
		array(
			'label'   => __( 'Título', 'giftmedtema' ),
			'section' => 'giftmedtema_parceiros',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'giftmedtema_parceiros_text',
		array(
			'default'           => __( 'O projeto GiftMed é fomentado com recursos do projeto O CDR Médio Norte Tocantins Edital nº 02/2024 — FAPT/SEPLAN, no âmbito da Rede DESER, e conta com parceiros públicos e acadêmicos comprometidos com saúde solidária e descarte consciente.', 'giftmedtema' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'giftmedtema_parceiros_text',
		array(
			'label'   => __( 'Texto introdutório', 'giftmedtema' ),
			'section' => 'giftmedtema_parceiros',
			'type'    => 'textarea',
		)
	);

	foreach ( giftmedtema_default_parceiros() as $parceiro ) {
		$slug = $parceiro['slug'];

		$wp_customize->add_setting(
			'giftmedtema_parceiro_' . $slug . '_show',
			array(
				'default'           => true,
				'sanitize_callback' => 'giftmedtema_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'giftmedtema_parceiro_' . $slug . '_show',
			array(
				'label'   => sprintf( /* translators: %s: partner name */ __( 'Exibir %s', 'giftmedtema' ), $parceiro['name'] ),
				'section' => 'giftmedtema_parceiros',
				'type'    => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'giftmedtema_parceiro_' . $slug . '_name',
			array(
				'default'           => $parceiro['name'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'giftmedtema_parceiro_' . $slug . '_name',
			array(
				'label'   => sprintf( /* translators: %s: partner slug */ __( 'Nome (%s)', 'giftmedtema' ), $slug ),
				'section' => 'giftmedtema_parceiros',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'giftmedtema_parceiro_' . $slug . '_tag',
			array(
				'default'           => $parceiro['tag'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'giftmedtema_parceiro_' . $slug . '_tag',
			array(
				'label'   => sprintf( /* translators: %s: partner slug */ __( 'Tag (%s)', 'giftmedtema' ), $slug ),
				'section' => 'giftmedtema_parceiros',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'giftmedtema_parceiro_' . $slug . '_image',
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'giftmedtema_parceiro_' . $slug . '_image',
				array(
					'label'     => sprintf( /* translators: %s: partner slug */ __( 'Logo (%s)', 'giftmedtema' ), $slug ),
					'section'   => 'giftmedtema_parceiros',
					'mime_type' => 'image',
				)
			)
		);
	}
}
add_action( 'customize_register', 'giftmedtema_customize_register' );

/**
 * Adiciona setting + control no Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 * @param string               $section     ID da seção.
 * @param string               $key         Chave sem prefixo.
 * @param array                $field       label, default, type.
 */
function giftmedtema_customize_add_field( $wp_customize, $section, $key, $field ) {
	$type = isset( $field['type'] ) ? $field['type'] : 'text';
	$cb   = 'sanitize_text_field';
	if ( 'textarea' === $type ) {
		$cb = 'sanitize_textarea_field';
	} elseif ( 'email' === $type ) {
		$cb   = 'sanitize_email';
		$type = 'text';
	} elseif ( 'url' === $type ) {
		$cb   = 'esc_url_raw';
		$type = 'text';
	}

	$wp_customize->add_setting(
		'giftmedtema_' . $key,
		array(
			'default'           => $field['default'],
			'sanitize_callback' => $cb,
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'giftmedtema_' . $key,
		array(
			'label'   => $field['label'],
			'section' => $section,
			'type'    => $type,
		)
	);
}

/**
 * Seções textuais da home no Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function giftmedtema_customize_register_home_sections( $wp_customize ) {
	$sections = array(
		'giftmedtema_solucao' => array(
			'title'  => __( 'A Solução', 'giftmedtema' ),
			'fields' => array(
				'solucao_eyebrow'       => array( 'label' => __( 'Eyebrow', 'giftmedtema' ), 'default' => __( 'Inovação Digital', 'giftmedtema' ), 'type' => 'text' ),
				'solucao_title'         => array( 'label' => __( 'Título (antes do destaque)', 'giftmedtema' ), 'default' => __( 'O que é a', 'giftmedtema' ), 'type' => 'text' ),
				'solucao_title_accent'  => array( 'label' => __( 'Título (destaque)', 'giftmedtema' ), 'default' => 'GiftMed', 'type' => 'text' ),
				'solucao_lead'          => array( 'label' => __( 'Texto principal (use &lt;strong&gt; se quiser negrito)', 'giftmedtema' ), 'default' => __( 'A GiftMed é uma <strong>Tecnologia Social digital</strong> voltada à gestão de Farmácias Solidárias de Medicamentos. A plataforma organiza e automatiza todo o fluxo seguro, desde o cadastro da doação até a triagem técnica e entrega final.', 'giftmedtema' ), 'type' => 'textarea' ),
				'solucao_network_title' => array( 'label' => __( 'Título do bloco colaborativo', 'giftmedtema' ), 'default' => __( 'Ambiente Colaborativo Unificado', 'giftmedtema' ), 'type' => 'text' ),
				'solucao_network_text'  => array( 'label' => __( 'Texto do bloco colaborativo', 'giftmedtema' ), 'default' => __( 'Integração inteligente entre cidadãos, farmacêuticos, hospitais, unidades de saúde, universidades, organizações sociais e gestores públicos.', 'giftmedtema' ), 'type' => 'textarea' ),
				'solucao_chips'         => array( 'label' => __( 'Públicos (um por linha)', 'giftmedtema' ), 'default' => "Cidadãos\nFarmacêuticos\nHospitais\nUnidades de Saúde\nUniversidades\nOrganizações Sociais\nGestores Públicos", 'type' => 'textarea' ),
			),
		),
		'giftmedtema_desafio' => array(
			'title'  => __( 'O Desafio', 'giftmedtema' ),
			'fields' => array(
				'desafio_eyebrow' => array( 'label' => __( 'Eyebrow', 'giftmedtema' ), 'default' => __( 'O Desafio', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_title'   => array( 'label' => __( 'Título', 'giftmedtema' ), 'default' => __( 'Medicamentos sem uso, vidas sem acesso', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_lead'    => array( 'label' => __( 'Texto de apoio', 'giftmedtema' ), 'default' => __( 'O descarte incorreto, o cenário crítico da saúde pública e a falta de acesso a tratamentos formam um mesmo problema — e a GiftMed nasceu para resolvê-lo de ponta a ponta.', 'giftmedtema' ), 'type' => 'textarea' ),
				'desafio_support_title' => array( 'label' => __( 'Título das dimensões', 'giftmedtema' ), 'default' => __( 'Dimensões do problema', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card1_label' => array( 'label' => __( 'Card 1 — rótulo', 'giftmedtema' ), 'default' => __( 'Atenção', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card1_title' => array( 'label' => __( 'Card 1 — título', 'giftmedtema' ), 'default' => __( 'Riscos do Descarte Incorreto', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card1_text'  => array( 'label' => __( 'Card 1 — resumo', 'giftmedtema' ), 'default' => __( 'Princípios ativos no lixo comum contaminam solo e água, aumentam intoxicações acidentais e desequilibram ecossistemas.', 'giftmedtema' ), 'type' => 'textarea' ),
				'desafio_card1_points'=> array( 'label' => __( 'Card 1 — pontos (Título|Descrição por linha)', 'giftmedtema' ), 'default' => "Contaminação da Água|Rios, lagos e lençóis freáticos podem ser afetados.\nRiscos à Saúde|Consumo acidental pode causar intoxicações.\nImpacto Ambiental|Resíduos farmacêuticos afetam fauna e flora.", 'type' => 'textarea' ),
				'desafio_card2_label' => array( 'label' => __( 'Card 2 — rótulo', 'giftmedtema' ), 'default' => __( 'Contexto', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card2_title' => array( 'label' => __( 'Card 2 — título', 'giftmedtema' ), 'default' => __( 'Cenário Crítico', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card2_text'  => array( 'label' => __( 'Card 2 — resumo', 'giftmedtema' ), 'default' => __( 'Milhões de medicamentos são descartados de forma inadequada todos os anos, enquanto recursos públicos e privados se perdem sem gerar cuidado.', 'giftmedtema' ), 'type' => 'textarea' ),
				'desafio_card2_list'  => array( 'label' => __( 'Card 2 — lista (um por linha)', 'giftmedtema' ), 'default' => "Desperdício financeiro em larga escala\nSobrecarga assistencial no SUS\nFalta de rastreabilidade nas doações", 'type' => 'textarea' ),
				'desafio_card3_label' => array( 'label' => __( 'Card 3 — rótulo', 'giftmedtema' ), 'default' => __( 'Missão', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card3_title' => array( 'label' => __( 'Card 3 — título', 'giftmedtema' ), 'default' => __( 'O Problema que Queremos Resolver', 'giftmedtema' ), 'type' => 'text' ),
				'desafio_card3_text'  => array( 'label' => __( 'Card 3 — resumo', 'giftmedtema' ), 'default' => __( 'Conectar medicamentos sem uso a quem precisa, com segurança sanitária, rastreabilidade e impacto social mensurável.', 'giftmedtema' ), 'type' => 'textarea' ),
				'desafio_card3_list'  => array( 'label' => __( 'Card 3 — lista (um por linha)', 'giftmedtema' ), 'default' => "Acesso contínuo a tratamentos essenciais\nRedistribuição segura e auditável\nEconomia circular na saúde pública", 'type' => 'textarea' ),
			),
		),
		'giftmedtema_fluxo' => array(
			'title'  => __( 'Como Funciona', 'giftmedtema' ),
			'fields' => array(
				'fluxo_eyebrow' => array( 'label' => __( 'Eyebrow', 'giftmedtema' ), 'default' => __( 'Fluxo do Medicamento', 'giftmedtema' ), 'type' => 'text' ),
				'fluxo_title'   => array( 'label' => __( 'Título', 'giftmedtema' ), 'default' => __( 'Processo simples, seguro e transparente', 'giftmedtema' ), 'type' => 'text' ),
				'fluxo_lead'    => array( 'label' => __( 'Texto de apoio', 'giftmedtema' ), 'default' => __( 'Do cadastro da doação à entrega final, cada etapa é registrada e monitorada digitalmente.', 'giftmedtema' ), 'type' => 'textarea' ),
			),
		),
		'giftmedtema_recursos' => array(
			'title'  => __( 'Recursos', 'giftmedtema' ),
			'fields' => array(
				'recursos_eyebrow' => array( 'label' => __( 'Eyebrow', 'giftmedtema' ), 'default' => __( 'Recursos Técnicos', 'giftmedtema' ), 'type' => 'text' ),
				'recursos_title'   => array( 'label' => __( 'Título', 'giftmedtema' ), 'default' => __( 'Módulos que fortalecem a governança', 'giftmedtema' ), 'type' => 'text' ),
				'recursos_lead'    => array( 'label' => __( 'Texto de apoio', 'giftmedtema' ), 'default' => __( 'Ferramentas integradas para operar a Farmácia Solidária com segurança, rastreabilidade e indicadores claros para a gestão pública.', 'giftmedtema' ), 'type' => 'textarea' ),
			),
		),
		'giftmedtema_impacto' => array(
			'title'  => __( 'Impacto', 'giftmedtema' ),
			'fields' => array(
				'impacto_eyebrow' => array( 'label' => __( 'Eyebrow', 'giftmedtema' ), 'default' => __( 'Retorno Social', 'giftmedtema' ), 'type' => 'text' ),
				'impacto_title'   => array( 'label' => __( 'Título', 'giftmedtema' ), 'default' => __( 'Resultados que transformam vidas', 'giftmedtema' ), 'type' => 'text' ),
				'impacto_lead'    => array( 'label' => __( 'Texto de apoio', 'giftmedtema' ), 'default' => __( 'A GiftMed gera valor em três frentes — social, ambiental e econômica — com uma operação digital segura e rastreável.', 'giftmedtema' ), 'type' => 'textarea' ),
				'impacto_diff_eyebrow' => array( 'label' => __( 'Diferenciais — eyebrow', 'giftmedtema' ), 'default' => __( 'Diferenciais', 'giftmedtema' ), 'type' => 'text' ),
				'impacto_diff_title'   => array( 'label' => __( 'Diferenciais — título', 'giftmedtema' ), 'default' => __( 'Por que a GiftMed é diferente?', 'giftmedtema' ), 'type' => 'text' ),
			),
		),
	);

	foreach ( $sections as $section_id => $section ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title' => $section['title'],
				'panel' => 'giftmedtema_panel',
			)
		);
		foreach ( $section['fields'] as $key => $field ) {
			giftmedtema_customize_add_field( $wp_customize, $section_id, $key, $field );
		}
	}
}

/**
 * Bullets do hero a partir do Customizer.
 *
 * @return string[]
 */
function giftmedtema_get_hero_bullets() {
	return giftmedtema_lines(
		giftmedtema_mod(
			'hero_bullets',
			"Acesso ampliado a essenciais\nRedução do descarte químico\nEconomia para a Gestão Pública\nGestão 100% Rastreável"
		)
	);
}

/**
 * Pontos "Título|Descrição" do Customizer.
 *
 * @param string $raw Texto.
 * @return array<int, array{0:string,1:string}>
 */
function giftmedtema_pipe_lines( $raw ) {
	$out = array();
	foreach ( giftmedtema_lines( $raw ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$out[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
	return $out;
}
