<?php
/**
 * GiftMed Tema — functions and definitions.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GIFTMEDTEMA_VERSION', '1.0.0' );

/**
 * Retorna a URL de um asset dentro da pasta assets do tema.
 *
 * @param string $path Caminho relativo dentro de assets/.
 */
function giftmedtema_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Configuração inicial do tema.
 */
function giftmedtema_setup() {
	load_theme_textdomain( 'giftmedtema', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_image_size( 'giftmed-equipe', 192, 192, true );
	add_image_size( 'giftmed-noticia', 640, 360, true );
	add_image_size( 'giftmed-parceiro', 200, 100, false );

	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'giftmedtema' ),
			'footer'  => __( 'Menu do Rodapé', 'giftmedtema' ),
		)
	);
}
add_action( 'after_setup_theme', 'giftmedtema_setup' );

/**
 * Enfileira estilos e scripts.
 */
function giftmedtema_enqueue_assets() {
	wp_enqueue_style(
		'giftmedtema-google-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_script(
		'giftmedtema-tailwind',
		'https://cdn.tailwindcss.com',
		array(),
		null,
		false
	);

	wp_enqueue_style(
		'giftmedtema-style',
		get_stylesheet_uri(),
		array( 'giftmedtema-google-fonts' ),
		GIFTMEDTEMA_VERSION
	);

	wp_enqueue_style(
		'giftmedtema-theme',
		giftmedtema_asset( 'css/theme.css' ),
		array( 'giftmedtema-style' ),
		GIFTMEDTEMA_VERSION
	);

	wp_enqueue_script(
		'giftmedtema-theme',
		giftmedtema_asset( 'js/theme.js' ),
		array(),
		GIFTMEDTEMA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'giftmedtema_enqueue_assets' );

/**
 * Classes dos links do menu principal.
 */
function giftmedtema_nav_link_attributes( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['class'] = 'hover:text-teal-600 transition-colors';
	}

	if ( isset( $args->theme_location ) && 'footer' === $args->theme_location ) {
		$atts['class'] = 'hover:text-orange-400 transition';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'giftmedtema_nav_link_attributes', 10, 3 );

/**
 * Menu padrão quando nenhum menu foi atribuído no painel.
 */
function giftmedtema_fallback_menu() {
	$links = array(
		'#desafio'        => __( 'O Desafio', 'giftmedtema' ),
		'#solucao'        => __( 'A Solução', 'giftmedtema' ),
		'#como-funciona'  => __( 'Como Funciona', 'giftmedtema' ),
		'#funcionalidades'=> __( 'Recursos', 'giftmedtema' ),
		'#impacto'        => __( 'Impacto', 'giftmedtema' ),
	);

	echo '<nav class="hidden lg:flex giftmed-primary-nav space-x-8 text-sm font-bold text-slate-600" aria-label="' . esc_attr__( 'Menu principal', 'giftmedtema' ) . '">';
	echo '<ul class="menu">';

	foreach ( $links as $url => $label ) {
		printf(
			'<li><a href="%s" class="hover:text-teal-600 transition-colors">%s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}

	echo '</ul></nav>';
}

/**
 * Retorna valor do Customizer com fallback.
 *
 * @param string $key     Chave do theme_mod.
 * @param string $default Valor padrão.
 */
function giftmedtema_mod( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	return is_string( $value ) ? $value : $default;
}

/**
 * Customizer — textos editáveis da página inicial.
 */
function giftmedtema_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'giftmedtema_home',
		array(
			'title'    => __( 'GiftMed — Página Inicial', 'giftmedtema' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'giftmed_banner_text'      => 'CONECTANDO SAÚDE E SOLIDARIEDADE — CONHEÇA O NOSSO MVP OPERACIONAL',
		'giftmed_hero_badge'       => 'Plataforma de Saúde Sustentável',
		'giftmed_hero_title'       => 'Tecnologia Social para Farmácia Solidária',
		'giftmed_hero_description' => 'Transformando medicamentos sem uso em acesso à saúde para quem precisa. Conectamos cidadãos, profissionais, hospitais e gestores públicos em uma rede totalmente rastreável.',
		'giftmed_hero_image'       => giftmedtema_asset( 'img/giftmedretangular.png' ),
		'giftmed_header_logo'      => giftmedtema_asset( 'img/giftmedretangular.png' ),
		'giftmed_hero_image_label' => 'Dr. GiftMed — Lançamento da Solução',
		'giftmed_instagram_url'    => 'https://www.instagram.com/giftmed4/',
		'giftmed_contact_general'  => 'contato@giftmed.org',
		'giftmed_contact_marketing'=> 'mkt@giftmed.org',
		'giftmed_slogan'           => 'Seu remédio pode curar mais do que você imagina.',
	);

	foreach ( $fields as $id => $default ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $default,
				'sanitize_callback' => ( str_contains( $id, 'url' ) || str_contains( $id, 'image' ) )
					? 'esc_url_raw'
					: 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'   => ucwords( str_replace( array( 'giftmed_', '_' ), array( '', ' ' ), $id ) ),
				'section' => 'giftmedtema_home',
				'type'    => ( str_contains( $id, 'description' ) || str_contains( $id, 'slogan' ) ) ? 'textarea' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'giftmedtema_customize_register' );

/**
 * Registra Custom Post Types.
 */
function giftmedtema_register_post_types() {
	register_post_type(
		'equipe',
		array(
			'labels'       => array(
				'name'          => __( 'Equipe', 'giftmedtema' ),
				'singular_name' => __( 'Membro da Equipe', 'giftmedtema' ),
				'add_new_item'  => __( 'Adicionar Membro', 'giftmedtema' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-groups',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
		)
	);

	register_post_type(
		'giftmed_card',
		array(
			'labels'       => array(
				'name'          => __( 'Cards da Home', 'giftmedtema' ),
				'singular_name' => __( 'Card', 'giftmedtema' ),
				'add_new_item'  => __( 'Adicionar Card', 'giftmedtema' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-grid-view',
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'  => false,
		)
	);

	register_post_type(
		'parceiro',
		array(
			'labels'       => array(
				'name'          => __( 'Parceiros', 'giftmedtema' ),
				'singular_name' => __( 'Parceiro', 'giftmedtema' ),
				'add_new_item'  => __( 'Adicionar Parceiro', 'giftmedtema' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-networking',
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
		)
	);
}
add_action( 'init', 'giftmedtema_register_post_types' );

/**
 * Taxonomia para organizar cards por seção da home.
 */
function giftmedtema_register_taxonomies() {
	register_taxonomy(
		'giftmed_secao',
		'giftmed_card',
		array(
			'labels'       => array(
				'name'          => __( 'Seções', 'giftmedtema' ),
				'singular_name' => __( 'Seção', 'giftmedtema' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'rewrite'      => false,
		)
	);

	register_taxonomy(
		'giftmed_tipo_parceiro',
		'parceiro',
		array(
			'labels'       => array(
				'name'          => __( 'Tipo de Parceiro', 'giftmedtema' ),
				'singular_name' => __( 'Tipo de Parceiro', 'giftmedtema' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'rewrite'      => false,
		)
	);
}
add_action( 'init', 'giftmedtema_register_taxonomies' );

/**
 * Meta boxes para equipe e cards.
 */
function giftmedtema_add_meta_boxes() {
	add_meta_box(
		'giftmed_equipe_meta',
		__( 'Dados do Membro', 'giftmedtema' ),
		'giftmedtema_render_equipe_meta_box',
		'equipe',
		'normal',
		'high'
	);

	add_meta_box(
		'giftmed_card_meta',
		__( 'Dados do Card', 'giftmedtema' ),
		'giftmedtema_render_card_meta_box',
		'giftmed_card',
		'normal',
		'high'
	);

	add_meta_box(
		'giftmed_parceiro_meta',
		__( 'Dados do Parceiro', 'giftmedtema' ),
		'giftmedtema_render_parceiro_meta_box',
		'parceiro',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'giftmedtema_add_meta_boxes' );

/**
 * Renderiza meta box da equipe.
 *
 * @param WP_Post $post Post atual.
 */
function giftmedtema_render_equipe_meta_box( $post ) {
	wp_nonce_field( 'giftmed_equipe_meta', 'giftmed_equipe_nonce' );

	$cargo  = get_post_meta( $post->ID, '_giftmed_cargo', true );
	$border = get_post_meta( $post->ID, '_giftmed_border', true );
	?>
	<p>
		<label for="giftmed_cargo"><strong><?php esc_html_e( 'Cargo', 'giftmedtema' ); ?></strong></label><br>
		<input type="text" class="widefat" id="giftmed_cargo" name="giftmed_cargo" value="<?php echo esc_attr( $cargo ); ?>">
	</p>
	<p>
		<label for="giftmed_border"><strong><?php esc_html_e( 'Cor da borda (classe Tailwind)', 'giftmedtema' ); ?></strong></label><br>
		<input type="text" class="widefat" id="giftmed_border" name="giftmed_border" value="<?php echo esc_attr( $border ?: 'border-teal-500' ); ?>" placeholder="border-teal-500">
	</p>
	<p class="description"><?php esc_html_e( 'Use a imagem destacada para a foto do membro. O conteúdo do editor será a biografia.', 'giftmedtema' ); ?></p>
	<?php
}

/**
 * Renderiza meta box dos cards.
 *
 * @param WP_Post $post Post atual.
 */
function giftmedtema_render_card_meta_box( $post ) {
	wp_nonce_field( 'giftmed_card_meta', 'giftmed_card_nonce' );

	$icon = get_post_meta( $post->ID, '_giftmed_icon', true );
	$step = get_post_meta( $post->ID, '_giftmed_step', true );
	?>
	<p>
		<label for="giftmed_icon"><strong><?php esc_html_e( 'Ícone (emoji)', 'giftmedtema' ); ?></strong></label><br>
		<input type="text" class="widefat" id="giftmed_icon" name="giftmed_icon" value="<?php echo esc_attr( $icon ); ?>" placeholder="💊">
	</p>
	<p>
		<label for="giftmed_step"><strong><?php esc_html_e( 'Número do passo (seção Como Funciona)', 'giftmedtema' ); ?></strong></label><br>
		<input type="number" class="small-text" id="giftmed_step" name="giftmed_step" value="<?php echo esc_attr( $step ); ?>" min="1" max="9">
	</p>
	<p class="description"><?php esc_html_e( 'Atribua uma Seção (desafio, processo, funcionalidade) na barra lateral. O título é o cabeçalho e o conteúdo é a descrição.', 'giftmedtema' ); ?></p>
	<?php
}

/**
 * Renderiza meta box do parceiro.
 *
 * @param WP_Post $post Post atual.
 */
function giftmedtema_render_parceiro_meta_box( $post ) {
	wp_nonce_field( 'giftmed_parceiro_meta', 'giftmed_parceiro_nonce' );

	$url       = get_post_meta( $post->ID, '_giftmed_url', true );
	$logo_file = get_post_meta( $post->ID, '_giftmed_logo_file', true );
	?>
	<p>
		<label for="giftmed_url"><strong><?php esc_html_e( 'Site do parceiro (opcional)', 'giftmedtema' ); ?></strong></label><br>
		<input type="url" class="widefat" id="giftmed_url" name="giftmed_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://">
	</p>
	<p>
		<label for="giftmed_logo_file"><strong><?php esc_html_e( 'Arquivo do logo (fallback)', 'giftmedtema' ); ?></strong></label><br>
		<input type="text" class="widefat" id="giftmed_logo_file" name="giftmed_logo_file" value="<?php echo esc_attr( $logo_file ); ?>" placeholder="utfpr.png">
	</p>
	<p class="description"><?php esc_html_e( 'Use a imagem destacada como logo principal. O campo de arquivo é usado apenas se não houver imagem destacada.', 'giftmedtema' ); ?></p>
	<?php
}

/**
 * Salva meta dados da equipe e dos cards.
 *
 * @param int $post_id ID do post.
 */
function giftmedtema_save_meta_boxes( $post_id ) {
	if ( isset( $_POST['giftmed_equipe_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_equipe_nonce'] ) ), 'giftmed_equipe_meta' ) ) {
		if ( isset( $_POST['giftmed_cargo'] ) ) {
			update_post_meta( $post_id, '_giftmed_cargo', sanitize_text_field( wp_unslash( $_POST['giftmed_cargo'] ) ) );
		}
		if ( isset( $_POST['giftmed_border'] ) ) {
			update_post_meta( $post_id, '_giftmed_border', sanitize_text_field( wp_unslash( $_POST['giftmed_border'] ) ) );
		}
	}

	if ( isset( $_POST['giftmed_card_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_card_nonce'] ) ), 'giftmed_card_meta' ) ) {
		if ( isset( $_POST['giftmed_icon'] ) ) {
			update_post_meta( $post_id, '_giftmed_icon', sanitize_text_field( wp_unslash( $_POST['giftmed_icon'] ) ) );
		}
		if ( isset( $_POST['giftmed_step'] ) ) {
			update_post_meta( $post_id, '_giftmed_step', absint( $_POST['giftmed_step'] ) );
		}
	}

	if ( isset( $_POST['giftmed_parceiro_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmed_parceiro_nonce'] ) ), 'giftmed_parceiro_meta' ) ) {
		if ( isset( $_POST['giftmed_url'] ) ) {
			update_post_meta( $post_id, '_giftmed_url', esc_url_raw( wp_unslash( $_POST['giftmed_url'] ) ) );
		}
		if ( isset( $_POST['giftmed_logo_file'] ) ) {
			update_post_meta( $post_id, '_giftmed_logo_file', sanitize_file_name( wp_unslash( $_POST['giftmed_logo_file'] ) ) );
		}
	}
}
add_action( 'save_post', 'giftmedtema_save_meta_boxes' );

/**
 * Retorna a URL do logo de um parceiro.
 *
 * @param int $post_id ID do parceiro.
 */
function giftmedtema_get_parceiro_logo_url( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'giftmed-parceiro' );
	}

	$logo_file = get_post_meta( $post_id, '_giftmed_logo_file', true );
	if ( $logo_file ) {
		return giftmedtema_asset( 'img/parceiros/' . $logo_file );
	}

	return '';
}

/**
 * Consulta parceiros por tipo.
 *
 * @param string $tipo Slug: fomentadoras, publicos ou academico.
 * @return WP_Query
 */
function giftmedtema_get_parceiros_query( $tipo = '' ) {
	$args = array(
		'post_type'      => 'parceiro',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);

	if ( $tipo ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'giftmed_tipo_parceiro',
				'field'    => 'slug',
				'terms'    => $tipo,
			),
		);
	}

	return new WP_Query( $args );
}

/**
 * Renderiza o grid de logos de parceiros.
 *
 * @param WP_Query $query Consulta de parceiros.
 */
function giftmedtema_render_parceiros_grid( $query ) {
	if ( ! $query->have_posts() ) {
		return;
	}
	?>
	<div class="flex flex-wrap justify-center gap-6">
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();

			$logo_url = giftmedtema_get_parceiro_logo_url( get_the_ID() );
			if ( ! $logo_url ) {
				continue;
			}

			$partner_url = get_post_meta( get_the_ID(), '_giftmed_url', true );
			?>
			<div class="giftmed-parceiro-item flex items-center justify-center p-4 bg-slate-50 border border-slate-100 rounded-2xl h-24 sm:h-28 w-[calc(50%-0.75rem)] sm:w-[calc(33.333%-1rem)] lg:w-[calc(25%-1.125rem)] max-w-[220px]">
				<?php if ( $partner_url ) : ?>
					<a href="<?php echo esc_url( $partner_url ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-full h-full" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php the_title_attribute(); ?>" class="giftmed-parceiro-logo max-h-14 sm:max-h-16 w-auto object-contain" loading="lazy">
					</a>
				<?php else : ?>
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php the_title_attribute(); ?>" class="giftmed-parceiro-logo max-h-14 sm:max-h-16 w-auto object-contain" loading="lazy">
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
	<?php
	wp_reset_postdata();
}

/**
 * Consulta cards de uma seção da home.
 *
 * @param string $slug Slug da taxonomia giftmed_secao.
 * @return WP_Query
 */
function giftmedtema_get_cards_query( $slug ) {
	return new WP_Query(
		array(
			'post_type'      => 'giftmed_card',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'tax_query'      => array(
				array(
					'taxonomy' => 'giftmed_secao',
					'field'    => 'slug',
					'terms'    => $slug,
				),
			),
		)
	);
}

/**
 * Consulta notícias da home.
 *
 * @param int $count Quantidade de posts.
 * @return WP_Query
 */
function giftmedtema_get_noticias_query( $count = 3 ) {
	return new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'category_name'  => 'noticias',
		)
	);
}

/**
 * Cria conteúdo inicial ao ativar o tema.
 */
function giftmedtema_seed_content() {
	if ( get_option( 'giftmedtema_seeded' ) ) {
		return;
	}

	$existing_cards = wp_count_posts( 'giftmed_card' );
	if ( $existing_cards && (int) $existing_cards->publish > 0 ) {
		update_option( 'giftmedtema_seeded', 1 );
		return;
	}

	$secoes = array(
		'desafio'        => __( 'Desafio', 'giftmedtema' ),
		'processo'       => __( 'Processo', 'giftmedtema' ),
		'funcionalidade' => __( 'Funcionalidade', 'giftmedtema' ),
	);

	foreach ( $secoes as $slug => $name ) {
		if ( ! term_exists( $slug, 'giftmed_secao' ) ) {
			wp_insert_term( $name, 'giftmed_secao', array( 'slug' => $slug ) );
		}
	}

	if ( ! term_exists( 'noticias' ) ) {
		wp_insert_term( __( 'Notícias', 'giftmedtema' ), 'category', array( 'slug' => 'noticias' ) );
	}

	$cards = array(
		array( 'secao' => 'desafio', 'icon' => '💰', 'title' => 'Desperdício Financeiro', 'content' => 'Perda de recursos com remédios que vencem sem utilização nas residências.' ),
		array( 'secao' => 'desafio', 'icon' => '🌱', 'title' => 'Impactos Ambientais', 'content' => 'Riscos severos decorrentes do descarte inadequado de componentes químicos.' ),
		array( 'secao' => 'desafio', 'icon' => '🏥', 'title' => 'Sobrecarga do SUS', 'content' => 'Aumento da pressão assistencial por descontinuidade de tratamentos primários.' ),
		array( 'secao' => 'desafio', 'icon' => '💊', 'title' => 'Redução do Acesso', 'content' => 'Dificuldade de fornecimento de medicação contínua para populações isoladas.' ),
		array( 'secao' => 'processo', 'step' => 1, 'title' => '1. Doação', 'content' => 'O cidadão realiza a entrega ou o cadastro dos medicamentos disponíveis.' ),
		array( 'secao' => 'processo', 'step' => 2, 'title' => '2. Triagem', 'content' => 'Profissionais habilitados analisam a integridade, validade e condições sanitárias.' ),
		array( 'secao' => 'processo', 'step' => 3, 'title' => '3. Rastreio', 'content' => 'Todas as etapas operacionais são monitoradas digitalmente.' ),
		array( 'secao' => 'processo', 'step' => 4, 'title' => '4. Redistribuição', 'content' => 'Medicamentos aprovados são ofertados via Farmácias Solidárias.' ),
		array( 'secao' => 'processo', 'step' => 5, 'title' => '5. Descarte', 'content' => 'Produtos inaptos recebem destinação final ambientalmente segura.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '📦', 'title' => 'Gestão de Estoque Solidário', 'content' => 'Controle completo de lotes e validades vigentes para segurança de entrega.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '🩺', 'title' => 'Triagem Farmacêutica Digital', 'content' => 'Registro técnico imediato das inspeções e laudos de adequação sanitária.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '🔗', 'title' => 'Rastreabilidade Completa', 'content' => 'Mapeamento em tempo real de todo o ciclo percorrido pelo medicamento.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '📊', 'title' => 'Indicadores de Impacto', 'content' => 'Métricas de monitoramento social, ambiental e econômico unificadas.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '🖥️', 'title' => 'Painéis Gerenciais', 'content' => 'Informações estratégicas e relatórios automatizados para tomadas de decisão.' ),
		array( 'secao' => 'funcionalidade', 'icon' => '🔒', 'title' => 'Segurança e Conformidade', 'content' => 'Hospedagem em nuvem de alta segurança com adequação integral à LGPD.' ),
	);

	$order = 0;
	foreach ( $cards as $card ) {
		++$order;
		$post_id = wp_insert_post(
			array(
				'post_type'    => 'giftmed_card',
				'post_title'   => $card['title'],
				'post_content' => $card['content'],
				'post_status'  => 'publish',
				'menu_order'   => $order,
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			wp_set_object_terms( $post_id, $card['secao'], 'giftmed_secao' );
			if ( ! empty( $card['icon'] ) ) {
				update_post_meta( $post_id, '_giftmed_icon', $card['icon'] );
			}
			if ( ! empty( $card['step'] ) ) {
				update_post_meta( $post_id, '_giftmed_step', (int) $card['step'] );
			}
		}
	}

	$equipe = array(
		array(
			'name'    => "Mateus Dall'Agnol",
			'cargo'   => 'Chief Information Officer (CIO)',
			'content' => 'Responsável pela estratégia, gestão da inovação, estruturação do modelo de negócio e articulação institucional.',
			'border'  => 'border-teal-500',
		),
		array(
			'name'    => 'Gelson André Schneider',
			'cargo'   => 'Programador Sênior',
			'content' => 'Responsável pelo desenvolvimento de sistemas, arquitetura tecnológica e evolução das funcionalidades da plataforma.',
			'border'  => 'border-slate-300',
		),
		array(
			'name'    => 'Fernando de Souza Arantes',
			'cargo'   => 'Programador Sênior',
			'content' => 'Atua no desenvolvimento, integração de módulos complexos, arquitetura de banco de dados e escalabilidade.',
			'border'  => 'border-slate-300',
		),
		array(
			'name'    => 'Roberta Feitosa Silveira',
			'cargo'   => 'Farmacêutica Responsável',
			'content' => 'Responsável pela validação técnica de todos os processos farmacêuticos, conformidade sanitária e segurança operacional.',
			'border'  => 'border-orange-400',
		),
	);

	$order = 0;
	foreach ( $equipe as $membro ) {
		++$order;
		$post_id = wp_insert_post(
			array(
				'post_type'    => 'equipe',
				'post_title'   => $membro['name'],
				'post_content' => $membro['content'],
				'post_status'  => 'publish',
				'menu_order'   => $order,
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_giftmed_cargo', $membro['cargo'] );
			update_post_meta( $post_id, '_giftmed_border', $membro['border'] );
		}
	}

	update_option( 'giftmedtema_seeded', 1 );
}
add_action( 'after_switch_theme', 'giftmedtema_seed_content' );

/**
 * Cria parceiros iniciais (executado uma vez).
 */
function giftmedtema_maybe_seed_parceiros() {
	if ( get_option( 'giftmedtema_parceiros_seeded' ) ) {
		return;
	}

	$existing = wp_count_posts( 'parceiro' );
	if ( $existing && (int) $existing->publish > 0 ) {
		update_option( 'giftmedtema_parceiros_seeded', 1 );
		return;
	}

	$parceiros = array(
		array( 'title' => 'FAPT', 'logo' => 'fapt-1.png', 'tipo' => 'fomentadoras' ),
		array( 'title' => 'Rede DESER', 'logo' => 'rede-deser.png', 'tipo' => 'fomentadoras' ),
		array( 'title' => 'SUS', 'logo' => 'sus.png', 'tipo' => 'publicos' ),
		array( 'title' => 'Prefeitura de Araguaína', 'logo' => 'araguaina.png', 'tipo' => 'publicos' ),
		array( 'title' => 'Governo do Estado', 'logo' => 'govestado.png', 'tipo' => 'publicos' ),
		array( 'title' => 'UTFPR', 'logo' => 'utfpr.png', 'tipo' => 'academico' ),
		array( 'title' => 'IFTO', 'logo' => 'ifto.png', 'tipo' => 'academico' ),
		array( 'title' => 'PPGEP', 'logo' => 'ppgep.png', 'tipo' => 'academico' ),
	);

	$tipos = array(
		'fomentadoras' => __( 'Instituições Fomentadoras', 'giftmedtema' ),
		'publicos'     => __( 'Parceiros Públicos', 'giftmedtema' ),
		'academico'    => __( 'Parceiros Acadêmicos', 'giftmedtema' ),
	);

	foreach ( $tipos as $slug => $name ) {
		if ( ! term_exists( $slug, 'giftmed_tipo_parceiro' ) ) {
			wp_insert_term( $name, 'giftmed_tipo_parceiro', array( 'slug' => $slug ) );
		}
	}

	$order = 0;
	foreach ( $parceiros as $parceiro ) {
		++$order;
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'parceiro',
				'post_title'  => $parceiro['title'],
				'post_status' => 'publish',
				'menu_order'  => $order,
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_giftmed_logo_file', $parceiro['logo'] );
			wp_set_object_terms( $post_id, $parceiro['tipo'], 'giftmed_tipo_parceiro' );
		}
	}

	update_option( 'giftmedtema_parceiros_seeded', 1 );
}
add_action( 'init', 'giftmedtema_maybe_seed_parceiros', 25 );

/**
 * Atribui tipos aos parceiros já existentes (migração única).
 */
function giftmedtema_migrate_parceiros_tipos() {
	if ( get_option( 'giftmedtema_parceiros_tipos_v2' ) ) {
		return;
	}

	$tipos = array(
		'fomentadoras' => __( 'Instituições Fomentadoras', 'giftmedtema' ),
		'publicos'     => __( 'Parceiros Públicos', 'giftmedtema' ),
		'academico'    => __( 'Parceiros Acadêmicos', 'giftmedtema' ),
	);

	foreach ( $tipos as $slug => $name ) {
		if ( ! term_exists( $slug, 'giftmed_tipo_parceiro' ) ) {
			wp_insert_term( $name, 'giftmed_tipo_parceiro', array( 'slug' => $slug ) );
		}
	}

	$map = array(
		'fapt-1.png'     => 'fomentadoras',
		'rede-deser.png' => 'fomentadoras',
		'sus.png'        => 'publicos',
		'araguaina.png'  => 'publicos',
		'govestado.png'  => 'publicos',
		'utfpr.png'      => 'academico',
		'ifto.png'       => 'academico',
		'ppgep.png'      => 'academico',
	);

	$parceiros = get_posts(
		array(
			'post_type'      => 'parceiro',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);

	foreach ( $parceiros as $post_id ) {
		$logo = get_post_meta( $post_id, '_giftmed_logo_file', true );
		if ( $logo && isset( $map[ $logo ] ) ) {
			wp_set_object_terms( $post_id, $map[ $logo ], 'giftmed_tipo_parceiro' );
		}
	}

	update_option( 'giftmedtema_parceiros_tipos_v2', 1 );
}
add_action( 'init', 'giftmedtema_migrate_parceiros_tipos', 26 );
