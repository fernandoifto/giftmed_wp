<?php
/**
 * Seed de notícias (somente com GIFTMED_SEED_NOTICIAS=1).
 * Preferir: wp giftmedtema seed-noticias
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Garante que um termo de categoria exista e retorna o ID.
 *
 * @param string $name Nome.
 * @param string $slug Slug.
 * @param int    $parent ID do pai.
 * @return int
 */
function giftmedtema_ensure_category( $name, $slug, $parent = 0 ) {
	$existing = term_exists( $slug, 'category' );

	if ( $existing ) {
		return (int) ( is_array( $existing ) ? $existing['term_id'] : $existing );
	}

	$created = wp_insert_term(
		$name,
		'category',
		array(
			'slug'   => $slug,
			'parent' => (int) $parent,
		)
	);

	if ( is_wp_error( $created ) ) {
		return 0;
	}

	return (int) $created['term_id'];
}

/**
 * Anexa uma imagem do tema como imagem destacada do post.
 *
 * @param string $relative_path Caminho relativo dentro do tema.
 * @param int    $post_id      ID do post.
 * @param string $title        Título do anexo.
 * @return int ID do anexo ou 0.
 */
function giftmedtema_attach_theme_image( $relative_path, $post_id, $title ) {
	$source = get_template_directory() . '/' . ltrim( $relative_path, '/' );
	if ( ! file_exists( $source ) || ! is_readable( $source ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$upload_dir = wp_upload_dir();
	if ( ! empty( $upload_dir['error'] ) ) {
		return 0;
	}

	if ( ! wp_mkdir_p( $upload_dir['path'] ) ) {
		return 0;
	}

	$filename = wp_unique_filename( $upload_dir['path'], basename( $source ) );
	$dest     = trailingslashit( $upload_dir['path'] ) . $filename;

	if ( ! @copy( $source, $dest ) ) {
		return 0;
	}

	$filetype   = wp_check_filetype( $filename, null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => sanitize_text_field( $title ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $dest, $post_id );
	if ( ! $attach_id || is_wp_error( $attach_id ) ) {
		return 0;
	}

	$metadata = wp_generate_attachment_metadata( $attach_id, $dest );
	wp_update_attachment_metadata( $attach_id, $metadata );
	set_post_thumbnail( $post_id, $attach_id );

	return (int) $attach_id;
}

/**
 * Baixa uma imagem remota e define como imagem destacada do post.
 *
 * @param string $url     URL pública da imagem.
 * @param int    $post_id ID do post.
 * @param string $title   Título do anexo.
 * @return int ID do anexo ou 0.
 */
function giftmedtema_attach_remote_image( $url, $post_id, $title ) {
	if ( empty( $url ) || ! $post_id ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp_file = download_url( esc_url_raw( $url ), 30 );
	if ( is_wp_error( $tmp_file ) ) {
		return 0;
	}

	$filetype = wp_check_filetype( basename( parse_url( $url, PHP_URL_PATH ) ), null );
	if ( empty( $filetype['type'] ) ) {
		$filetype = wp_check_filetype( $tmp_file );
	}

	if ( empty( $filetype['type'] ) ) {
		$filetype = array(
			'ext'  => 'jpg',
			'type' => 'image/jpeg',
		);
	}

	$upload_dir = wp_upload_dir();
	if ( ! empty( $upload_dir['error'] ) || ! wp_mkdir_p( $upload_dir['path'] ) ) {
		@unlink( $tmp_file );
		return 0;
	}

	$filename = wp_unique_filename( $upload_dir['path'], sanitize_file_name( $title ) . '.' . $filetype['ext'] );
	$dest     = trailingslashit( $upload_dir['path'] ) . $filename;

	if ( ! @copy( $tmp_file, $dest ) ) {
		@unlink( $tmp_file );
		return 0;
	}

	@unlink( $tmp_file );

	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => sanitize_text_field( $title ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $dest, $post_id );
	if ( ! $attach_id || is_wp_error( $attach_id ) ) {
		return 0;
	}

	$metadata = wp_generate_attachment_metadata( $attach_id, $dest );
	wp_update_attachment_metadata( $attach_id, $metadata );
	set_post_thumbnail( $post_id, (int) $attach_id );

	return (int) $attach_id;
}

/**
 * Anexa imagem destacada a partir de URL remota ou arquivo do tema.
 *
 * @param array<string, string> $post    Dados do post.
 * @param int                   $post_id ID do post.
 */
function giftmedtema_attach_noticia_image( $post, $post_id ) {
	if ( ! empty( $post['image_url'] ) ) {
		$attached = giftmedtema_attach_remote_image( $post['image_url'], $post_id, $post['title'] );
		if ( $attached ) {
			return;
		}
	}

	if ( ! empty( $post['image'] ) ) {
		giftmedtema_attach_theme_image( $post['image'], $post_id, $post['title'] );
	}
}

/**
 * Remove posts publicados da categoria Notícias.
 */
function giftmedtema_delete_noticias_posts() {
	$query = new WP_Query(
		array(
			'post_type'              => 'post',
			'post_status'            => 'any',
			'category_name'          => 'noticias',
			'posts_per_page'         => -1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	foreach ( $query->posts as $post_id ) {
		wp_delete_post( (int) $post_id, true );
	}
}

/**
 * Dados dos posts fictícios de notícias.
 *
 * @return array<int, array<string, string>>
 */
function giftmedtema_get_noticias_seed_posts() {
	return array(
		array(
			'title'   => 'Nova Aurora adota GiftMed em três unidades básicas de saúde',
			'excerpt' => 'Município fictício do interior passa a registrar doações, triagens e entregas em tempo real, ampliando o acesso a medicamentos essenciais.',
			'content' => "O município de Nova Aurora, no interior do estado, iniciou a operação da GiftMed em três unidades básicas de saúde. A plataforma passa a registrar doações, triagens e entregas em tempo real.\n\nSegundo a secretaria municipal, a expectativa é ampliar o acesso a medicamentos essenciais e reduzir o descarte irregular de fármacos ainda válidos.\n\nA implantação contou com capacitação de farmacêuticos locais e integração com pontos de coleta comunitários.",
			'date'    => '2026-06-28 09:30:00',
			'topic'     => 'saude',
			'image_url' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'Campanha Remédio Solidário mobiliza 12 mil unidades em sete dias',
			'excerpt' => 'Ação comunitária fictícia reuniu cidadãos, farmácias parceiras e voluntários em um fluxo totalmente rastreado pela plataforma GiftMed.',
			'content' => "A campanha Remédio Solidário, realizada em parceria com organizações locais, mobilizou mais de 12 mil unidades de medicamentos em apenas sete dias.\n\nTodas as doações foram cadastradas na GiftMed, passando por triagem farmacêutica antes da redistribuição às farmácias solidárias participantes.\n\nOrganizadores destacaram a transparência do processo e a facilidade de acompanhamento digital por gestores e doadores.",
			'date'    => '2026-06-14 11:00:00',
			'topic'     => 'sustentabilidade',
			'image_url' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'Universidade Vale Verde testa triagem digital com estudantes de farmácia',
			'excerpt' => 'Projeto-piloto fictício utiliza a GiftMed para simular o fluxo completo de doação, inspeção técnica e registro sanitário.',
			'content' => "A Universidade Vale Verde iniciou um projeto-piloto que utiliza a GiftMed para simular o fluxo completo de doação, inspeção técnica e registro sanitário.\n\nEstudantes de farmácia participam da triagem supervisionada, registrando laudos e condições de armazenamento diretamente na plataforma.\n\nA iniciativa busca formar profissionais alinhados às boas práticas de farmácias solidárias e rastreabilidade de medicamentos.",
			'date'    => '2026-05-30 14:15:00',
			'topic'     => 'pesquisa',
			'image_url' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'Painel de indicadores aponta queda de 38% no descarte inadequado',
			'excerpt' => 'Dados simulados de um consórcio intermunicipal mostram redução no descarte incorreto após adoção de coleta orientada e destinação segura.',
			'content' => "Um consórcio intermunicipal fictício divulgou indicadores do primeiro semestre após a adoção da GiftMed. O painel aponta queda de 38% no descarte inadequado de medicamentos.\n\nGestores atribuem o resultado à combinação de coleta orientada, triagem técnica e destinação ambientalmente segura dos produtos inaptos.\n\nOs municípios participantes passaram a monitorar o fluxo em tempo real por meio de relatórios automatizados.",
			'date'    => '2026-05-17 08:45:00',
			'topic'     => 'meio-ambiente',
			'image_url' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'GiftMed recebe atualização com alertas inteligentes de validade',
			'excerpt' => 'Nova versão fictícia da plataforma envia avisos automáticos sobre lotes próximos do vencimento, evitando perdas no estoque solidário.',
			'content' => "A equipe GiftMed lançou uma atualização com alertas inteligentes de validade. O sistema passa a notificar gestores e farmacêuticos sobre lotes próximos do vencimento.\n\nA funcionalidade reduz perdas no estoque solidário e prioriza a redistribuição de medicamentos com prazo mais curto.\n\nOs alertas podem ser configurados por unidade, perfil de usuário e criticidade do item.",
			'date'    => '2026-05-03 16:20:00',
			'topic'     => 'tecnologia',
			'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'Hospital São Lucas integra doações hospitalares ao estoque solidário',
			'excerpt' => 'Unidade fictícia passa a encaminhar excedentes não utilizados para triagem e redistribuição com rastreabilidade completa.',
			'content' => "O Hospital São Lucas, instituição fictícia parceira do projeto, passou a integrar doações hospitalares ao estoque solidário municipal.\n\nExcedentes não utilizados são encaminhados para triagem e, quando aprovados, redistribuídos com rastreabilidade completa na GiftMed.\n\nA parceria reforça a economia circular em saúde e evita o descarte prematuro de insumos em condições adequadas.",
			'date'    => '2026-04-19 10:00:00',
			'topic'     => 'saude',
			'image_url' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=640&h=360&fit=crop&q=80',
		),
		array(
			'title'   => 'Secretaria Estadual destaca GiftMed como referência em tecnologia social',
			'excerpt' => 'Relatório institucional fictício cita a plataforma como modelo de integração entre cidadãos, profissionais e gestores públicos.',
			'content' => "Um relatório institucional fictício da Secretaria Estadual de Saúde destacou a GiftMed como referência em tecnologia social aplicada a farmácias solidárias.\n\nO documento cita a integração entre cidadãos, profissionais de saúde e gestores públicos como diferencial do modelo.\n\nA publicação recomenda a expansão do uso de plataformas rastreáveis para reduzir desperdício e ampliar o acesso a tratamentos essenciais.",
			'date'    => '2026-04-05 13:40:00',
			'topic'     => 'pesquisa',
			'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=640&h=360&fit=crop&q=80',
		),
	);
}

/**
 * Cria categorias e posts fictícios de notícias.
 */
function giftmedtema_seed_noticias_posts() {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$noticias_id = giftmedtema_ensure_category( __( 'Notícias', 'giftmedtema' ), 'noticias' );
	if ( ! $noticias_id ) {
		return;
	}

	$topics = array(
		'sustentabilidade' => __( 'Sustentabilidade', 'giftmedtema' ),
		'saude'            => __( 'Saúde', 'giftmedtema' ),
		'meio-ambiente'    => __( 'Meio Ambiente', 'giftmedtema' ),
		'tecnologia'       => __( 'Tecnologia', 'giftmedtema' ),
		'pesquisa'         => __( 'Pesquisa', 'giftmedtema' ),
	);

	$topic_ids = array();
	foreach ( $topics as $slug => $name ) {
		$topic_ids[ $slug ] = giftmedtema_ensure_category( $name, $slug, $noticias_id );
	}

	foreach ( giftmedtema_get_noticias_seed_posts() as $post ) {
		$term_ids = array_filter(
			array(
				$noticias_id,
				isset( $topic_ids[ $post['topic'] ] ) ? $topic_ids[ $post['topic'] ] : 0,
			)
		);

		$post_id = wp_insert_post(
			array(
				'post_type'    => 'post',
				'post_status'  => 'publish',
				'post_title'   => $post['title'],
				'post_excerpt' => $post['excerpt'],
				'post_content' => $post['content'],
				'post_date'    => $post['date'],
				'post_author'  => 1,
			),
			true
		);

		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}

		wp_set_post_terms( $post_id, $term_ids, 'category' );
		giftmedtema_attach_noticia_image( $post, $post_id );
	}
}

/**
 * Hook de seed automático (dev). Preferir WP-CLI.
 */
function giftmedtema_maybe_seed_noticias() {
	if ( ! giftmedtema_should_seed_noticias() ) {
		return;
	}

	if ( get_option( 'giftmedtema_noticias_seeded_v5' ) ) {
		return;
	}

	giftmedtema_delete_noticias_posts();
	giftmedtema_seed_noticias_posts();

	update_option( 'giftmedtema_noticias_seeded_v5', 1, false );
	delete_option( 'giftmedtema_noticias_seeded_v4' );
	delete_option( 'giftmedtema_noticias_seeded_v1' );
}
add_action( 'init', 'giftmedtema_maybe_seed_noticias', 30 );

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	/**
	 * Recria posts fictícios de notícias.
	 *
	 * ## EXAMPLES
	 *
	 *     wp giftmedtema seed-noticias
	 *     wp giftmedtema seed-noticias --force
	 *
	 * @when after_wp_load
	 */
	WP_CLI::add_command(
		'giftmedtema seed-noticias',
		function ( $args, $assoc_args ) {
			$force = isset( $assoc_args['force'] );
			if ( $force ) {
				delete_option( 'giftmedtema_noticias_seeded_v5' );
			}
			giftmedtema_delete_noticias_posts();
			giftmedtema_seed_noticias_posts();
			update_option( 'giftmedtema_noticias_seeded_v5', 1, false );
			WP_CLI::success( 'Notícias fictícias recriadas.' );
		}
	);
}
