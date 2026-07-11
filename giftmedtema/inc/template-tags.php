<?php
/**
 * Template tags.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renderiza um card de notícia.
 *
 * @param array<string, string> $item    Dados da notícia.
 * @param int                   $delay   Índice de animação (1–5).
 * @param string                $variant Variante: featured|card|archive.
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
 * Parceiros padrão (arquivos do tema).
 *
 * @return array<int, array<string, string>>
 */
function giftmedtema_default_parceiros() {
	return array(
		array(
			'slug' => 'fapt',
			'file' => 'fapt-1.png',
			'name' => 'FAPT',
			'tag'  => __( 'Fomento', 'giftmedtema' ),
		),
		array(
			'slug' => 'rede-deser',
			'file' => 'rede-deser.png',
			'name' => 'Rede DESER',
			'tag'  => __( 'Fomento', 'giftmedtema' ),
		),
		array(
			'slug' => 'govestado',
			'file' => 'govestado.png',
			'name' => 'Governo do Tocantins',
			'tag'  => __( 'Público', 'giftmedtema' ),
		),
		array(
			'slug' => 'araguaina',
			'file' => 'araguaina.png',
			'name' => 'Prefeitura de Araguaína',
			'tag'  => __( 'Público', 'giftmedtema' ),
		),
		array(
			'slug' => 'sus',
			'file' => 'sus.png',
			'name' => 'SUS',
			'tag'  => __( 'Público', 'giftmedtema' ),
		),
		array(
			'slug' => 'ifto',
			'file' => 'ifto.png',
			'name' => 'IFTO',
			'tag'  => __( 'Acadêmico', 'giftmedtema' ),
		),
		array(
			'slug' => 'utfpr',
			'file' => 'utfpr.png',
			'name' => 'UTFPR',
			'tag'  => __( 'Acadêmico', 'giftmedtema' ),
		),
		array(
			'slug' => 'ppgep',
			'file' => 'ppgep.png',
			'name' => 'PPGEP',
			'tag'  => __( 'Acadêmico', 'giftmedtema' ),
		),
	);
}

/**
 * Lista de parceiros (Customizer + defaults).
 *
 * @return array<int, array<string, string>>
 */
function giftmedtema_get_parceiros() {
	$base_uri = giftmedtema_asset( 'assets/img/parceiros' );
	$items    = array();

	foreach ( giftmedtema_default_parceiros() as $parceiro ) {
		$slug    = $parceiro['slug'];
		$visible = giftmedtema_mod( 'parceiro_' . $slug . '_show', true );
		if ( ! $visible ) {
			continue;
		}

		$name = giftmedtema_mod( 'parceiro_' . $slug . '_name', $parceiro['name'] );
		$tag  = giftmedtema_mod( 'parceiro_' . $slug . '_tag', $parceiro['tag'] );
		$img  = (int) giftmedtema_mod( 'parceiro_' . $slug . '_image', 0 );

		if ( $img ) {
			$src = wp_get_attachment_image_url( $img, 'medium' );
		} else {
			$src = $base_uri . '/' . $parceiro['file'];
		}

		$items[] = array(
			'name' => $name,
			'tag'  => $tag,
			'src'  => $src ? $src : $base_uri . '/' . $parceiro['file'],
		);
	}

	return $items;
}
