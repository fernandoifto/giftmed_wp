<?php
/**
 * GiftMed Tema — funções do tema.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URI de um asset do tema.
 *
 * @param string $path Caminho relativo dentro do tema.
 * @return string
 */
function giftmedtema_asset( $path = '' ) {
	return get_template_directory_uri() . ( $path ? '/' . ltrim( $path, '/' ) : '' );
}

/**
 * Configuração do tema.
 */
function giftmedtema_setup() {
	load_theme_textdomain( 'giftmedtema', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 80,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'giftmedtema' ),
			'footer'  => __( 'Menu Rodapé', 'giftmedtema' ),
		)
	);

	add_image_size( 'giftmed-noticia', 640, 360, true );
}
add_action( 'after_setup_theme', 'giftmedtema_setup' );

/**
 * Enfileira estilos e scripts.
 */
function giftmedtema_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'giftmedtema-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'giftmedtema-style',
		get_stylesheet_uri(),
		array( 'giftmedtema-fonts' ),
		$version
	);

	wp_enqueue_style(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/css/theme.css' ),
		array( 'giftmedtema-style' ),
		$version
	);

	wp_enqueue_script(
		'giftmedtema-theme',
		giftmedtema_asset( 'assets/js/theme.js' ),
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'giftmedtema_scripts' );

/**
 * Classes dos links do menu principal.
 *
 * @param array $atts Atributos do link.
 * @return array
 */
function giftmedtema_nav_link_attributes( $atts ) {
	$atts['class'] = 'gm-nav-link';
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'giftmedtema_nav_link_attributes' );

/**
 * Menu de fallback (âncoras da home) quando nenhum menu está atribuído.
 *
 * @param array $args Argumentos do wp_nav_menu.
 */
function giftmedtema_fallback_menu( $args ) {
	$items = array(
		'#noticias'        => __( 'Notícias', 'giftmedtema' ),
		'#solucao'         => __( 'A Solução', 'giftmedtema' ),
		'#desafio'         => __( 'O Desafio', 'giftmedtema' ),
		'#como-funciona'   => __( 'Como Funciona', 'giftmedtema' ),
		'#funcionalidades' => __( 'Recursos', 'giftmedtema' ),
		'#impacto'         => __( 'Impacto', 'giftmedtema' ),
	);

	$menu_class = isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : '';
	echo '<ul class="' . $menu_class . '">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s" class="gm-nav-link">%s</a></li>',
			esc_url( home_url( '/' ) . $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Trecho curto para cards da home.
 *
 * @return int
 */
function giftmedtema_excerpt_length() {
	return 28;
}
add_filter( 'excerpt_length', 'giftmedtema_excerpt_length' );

/**
 * Remove reticências padrão do excerpt.
 *
 * @return string
 */
function giftmedtema_excerpt_more() {
	return '';
}
add_filter( 'excerpt_more', 'giftmedtema_excerpt_more' );

/**
 * Meta auxiliar de um post (cargo, ícone, etc.).
 *
 * @param int    $post_id ID do post.
 * @param string $key     Chave do meta.
 * @param string $default Valor padrão.
 * @return string
 */
function giftmedtema_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( '' !== $value && false !== $value ) ? (string) $value : $default;
}

/**
 * Query de posts por slug de categoria.
 *
 * @param string $category_slug Slug da categoria.
 * @param int    $posts_per_page Quantidade.
 * @return WP_Query
 */
function giftmedtema_query_by_category( $category_slug, $posts_per_page = -1 ) {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => true,
			'orderby'             => 'menu_order date',
			'order'               => 'ASC',
			'category_name'       => $category_slug,
		)
	);
}

/**
 * URL do arquivo com todas as notícias.
 *
 * @return string
 */
function giftmedtema_get_noticias_archive_url() {
	$category = get_category_by_slug( 'noticias' );

	if ( $category instanceof WP_Term ) {
		return get_category_link( $category->term_id );
	}

	return home_url( '/' );
}

/**
 * Consulta posts reais da categoria Notícias (mais recentes primeiro).
 *
 * @param int $count Quantidade de posts.
 * @return WP_Query
 */
function giftmedtema_get_noticias_query( $count = 5 ) {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $count,
			'ignore_sticky_posts' => true,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'category_name'       => 'noticias',
			'no_found_rows'       => true,
		)
	);
}

/**
 * Rótulo de categoria exibido no card (prioriza tema, não a categoria-pai Notícias).
 *
 * @param int $post_id ID do post.
 * @return string
 */
function giftmedtema_get_noticia_category_label( $post_id ) {
	$categories = get_the_category( $post_id );

	foreach ( $categories as $category ) {
		if ( ! in_array( $category->slug, array( 'noticias', 'uncategorized' ), true ) ) {
			return $category->name;
		}
	}

	return ! empty( $categories ) ? $categories[0]->name : __( 'Notícias', 'giftmedtema' );
}

/**
 * Retorna itens de notícia a partir de posts reais do WordPress.
 *
 * @param int $count Quantidade de itens.
 * @return array<int, array<string, string>>
 */
function giftmedtema_get_noticias_items( $count = 5 ) {
	$query = giftmedtema_get_noticias_query( $count );
	$items = array();

	if ( ! $query->have_posts() ) {
		return $items;
	}

	while ( $query->have_posts() ) {
		$query->the_post();

		$image = get_the_post_thumbnail_url( get_the_ID(), 'giftmed-noticia' );
		if ( ! $image ) {
			$image = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
		}

		$excerpt = get_the_excerpt();
		if ( '' === trim( wp_strip_all_tags( $excerpt ) ) ) {
			$excerpt = wp_trim_words( wp_strip_all_tags( get_the_content( null, false ) ), 28, '…' );
		} else {
			$excerpt = wp_trim_words( $excerpt, 28, '…' );
		}

		$items[] = array(
			'title'    => get_the_title(),
			'excerpt'  => $excerpt,
			'date'     => get_the_date( 'Y-m-d' ),
			'category' => giftmedtema_get_noticia_category_label( get_the_ID() ),
			'image'    => $image ? $image : giftmedtema_asset( 'assets/img/giftmedquadrado.png' ),
			'url'      => get_permalink(),
		);
	}

	wp_reset_postdata();

	return $items;
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
 * Indica se o seed automático de notícias está habilitado.
 *
 * Só roda quando GIFTMED_SEED_NOTICIAS=1 (variável de ambiente).
 * Nunca ative em produção.
 *
 * @return bool
 */
function giftmedtema_should_seed_noticias() {
	$flag = getenv( 'GIFTMED_SEED_NOTICIAS' );

	return '1' === $flag || 'true' === strtolower( (string) $flag );
}

/**
 * Recria posts fictícios de notícias (remove os atuais e insere novos).
 *
 * Executado apenas com GIFTMED_SEED_NOTICIAS=1 no ambiente.
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

/**
 * Renderiza um card de notícia reutilizável.
 *
 * @param array<string, string> $item    Dados da notícia.
 * @param int                   $delay   Índice de animação (1–5).
 * @param string                $variant Variante: featured|card.
 */
function giftmedtema_render_noticia_card( $item, $delay = 1, $variant = 'card' ) {
	$delay    = max( 1, min( (int) $delay, 5 ) );
	$allowed  = array( 'featured', 'card', 'archive' );
	$variant  = in_array( $variant, $allowed, true ) ? $variant : 'card';
	$detailed = in_array( $variant, array( 'featured', 'archive' ), true );

	$date_display = date_i18n( get_option( 'date_format' ), strtotime( $item['date'] ) );
	$classes      = 'gm-news-item gm-news-item--' . $variant . ' reveal reveal-delay-' . $delay;
	$img_w        = 'featured' === $variant ? 640 : 480;
	$img_h        = 'featured' === $variant ? 360 : 270;
	?>
	<article class="<?php echo esc_attr( $classes ); ?>"<?php echo 'card' === $variant ? ' role="listitem"' : ''; ?>>
		<a href="<?php echo esc_url( $item['url'] ); ?>" class="gm-news-item__media" tabindex="-1" aria-hidden="true">
			<img
				src="<?php echo esc_url( $item['image'] ); ?>"
				alt=""
				loading="lazy"
				width="<?php echo esc_attr( (string) $img_w ); ?>"
				height="<?php echo esc_attr( (string) $img_h ); ?>"
			>
		</a>
		<div class="gm-news-item__body">
			<div class="gm-news-meta">
				<span class="gm-news-category"><?php echo esc_html( $item['category'] ); ?></span>
				<time datetime="<?php echo esc_attr( $item['date'] ); ?>"><?php echo esc_html( $date_display ); ?></time>
			</div>
			<h3 class="gm-news-item__title">
				<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
			</h3>
			<?php if ( $detailed ) : ?>
				<p class="gm-news-item__excerpt"><?php echo esc_html( $item['excerpt'] ); ?></p>
				<a href="<?php echo esc_url( $item['url'] ); ?>" class="gm-news-item__link">
					<span><?php esc_html_e( 'Leia mais', 'giftmedtema' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
			<?php endif; ?>
		</div>
	</article>
	<?php
}

/**
 * Processa o formulário de demonstração.
 */
function giftmedtema_handle_demo_request() {
	if ( ! isset( $_POST['giftmed_demo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_demo_nonce'] ) ), 'giftmed_demo' ) ) {
		wp_safe_redirect( home_url( '/#contato' ) );
		exit;
	}

	$name     = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$orgao    = isset( $_POST['orgao'] ) ? sanitize_text_field( wp_unslash( $_POST['orgao'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$redirect = home_url( '/#contato' );

	if ( $name && $orgao && is_email( $email ) ) {
		$subject = sprintf( '[GiftMed] Solicitação de demo — %s', $name );
		$body    = sprintf(
			"Nome: %s\nÓrgão/Município: %s\nE-mail: %s\n",
			$name,
			$orgao,
			$email
		);
		wp_mail( get_option( 'admin_email' ), $subject, $body );
		$redirect = add_query_arg( 'demo', 'ok', $redirect );
	} else {
		$redirect = add_query_arg( 'demo', 'erro', $redirect );
	}

	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_nopriv_giftmed_demo', 'giftmedtema_handle_demo_request' );
add_action( 'admin_post_giftmed_demo', 'giftmedtema_handle_demo_request' );
