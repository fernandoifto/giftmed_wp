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
		$wp_customize->add_setting(
			'giftmedtema_' . $key,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'giftmedtema_' . $key,
			array(
				'label'   => $field['label'],
				'section' => 'giftmedtema_hero',
				'type'    => $field['type'],
			)
		);
	}

	/* ---- Contato / redes ---- */
	$wp_customize->add_section(
		'giftmedtema_contato',
		array(
			'title' => __( 'Contato e redes', 'giftmedtema' ),
			'panel' => 'giftmedtema_panel',
		)
	);

	$contact_fields = array(
		'email_contato'   => array(
			'label'   => __( 'E-mail Direção & Parcerias', 'giftmedtema' ),
			'default' => 'contato@giftmed.org',
			'cb'      => 'sanitize_email',
		),
		'email_mkt'       => array(
			'label'   => __( 'E-mail Marketing', 'giftmedtema' ),
			'default' => 'mkt@giftmed.org',
			'cb'      => 'sanitize_email',
		),
		'instagram_url'   => array(
			'label'   => __( 'URL Instagram', 'giftmedtema' ),
			'default' => 'https://www.instagram.com/giftmed4/',
			'cb'      => 'esc_url_raw',
		),
		'instagram_handle'=> array(
			'label'   => __( 'Handle Instagram', 'giftmedtema' ),
			'default' => '@giftmed4',
			'cb'      => 'sanitize_text_field',
		),
		'youtube_url'     => array(
			'label'   => __( 'URL YouTube', 'giftmedtema' ),
			'default' => 'https://www.youtube.com/@giftmed4',
			'cb'      => 'esc_url_raw',
		),
		'tiktok_url'      => array(
			'label'   => __( 'URL TikTok', 'giftmedtema' ),
			'default' => 'https://www.tiktok.com/@giftmed4',
			'cb'      => 'esc_url_raw',
		),
	);

	foreach ( $contact_fields as $key => $field ) {
		$wp_customize->add_setting(
			'giftmedtema_' . $key,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $field['cb'],
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'giftmedtema_' . $key,
			array(
				'label'   => $field['label'],
				'section' => 'giftmedtema_contato',
				'type'    => 'text',
			)
		);
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
 * Bullets do hero a partir do Customizer.
 *
 * @return string[]
 */
function giftmedtema_get_hero_bullets() {
	$raw = giftmedtema_mod(
		'hero_bullets',
		"Acesso ampliado a essenciais\nRedução do descarte químico\nEconomia para a Gestão Pública\nGestão 100% Rastreável"
	);

	$lines = preg_split( '/\r\n|\r|\n/', (string) $raw );
	$out   = array();
	foreach ( (array) $lines as $line ) {
		$line = trim( $line );
		if ( '' !== $line ) {
			$out[] = $line;
		}
	}

	return $out;
}
