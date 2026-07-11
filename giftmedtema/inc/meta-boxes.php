<?php
/**
 * Metaboxes do tema (ícone das seções).
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Categorias usadas como seções da home.
 *
 * @return string[]
 */
function giftmedtema_home_section_slugs() {
	return array( 'desafio', 'como-funciona', 'funcionalidades', 'impacto', 'diferenciais' );
}

/**
 * Registra metabox de ícone.
 */
function giftmedtema_add_icone_metabox() {
	add_meta_box(
		'giftmedtema_icone',
		__( 'Ícone da seção (emoji)', 'giftmedtema' ),
		'giftmedtema_render_icone_metabox',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'giftmedtema_add_icone_metabox' );

/**
 * Renderiza o campo ícone.
 *
 * @param WP_Post $post Post.
 */
function giftmedtema_render_icone_metabox( $post ) {
	wp_nonce_field( 'giftmedtema_save_icone', 'giftmedtema_icone_nonce' );
	$value = get_post_meta( $post->ID, 'icone', true );
	?>
	<p>
		<label for="giftmedtema_icone_field"><?php esc_html_e( 'Emoji ou símbolo exibido no card da home.', 'giftmedtema' ); ?></label>
	</p>
	<input
		type="text"
		id="giftmedtema_icone_field"
		name="giftmedtema_icone"
		value="<?php echo esc_attr( (string) $value ); ?>"
		class="widefat"
		placeholder="📦"
	>
	<p class="description">
		<?php esc_html_e( 'Usado nas categorias: Desafio, Como Funciona, Funcionalidades, Impacto e Diferenciais.', 'giftmedtema' ); ?>
	</p>
	<?php
}

/**
 * Salva o meta ícone.
 *
 * @param int $post_id ID do post.
 */
function giftmedtema_save_icone_metabox( $post_id ) {
	if ( ! isset( $_POST['giftmedtema_icone_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['giftmedtema_icone_nonce'] ) ), 'giftmedtema_save_icone' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['giftmedtema_icone'] ) ) {
		update_post_meta( $post_id, 'icone', sanitize_text_field( wp_unslash( $_POST['giftmedtema_icone'] ) ) );
	}
}
add_action( 'save_post_post', 'giftmedtema_save_icone_metabox' );

/**
 * Cards de uma categoria da home, com fallback.
 *
 * @param string               $slug     Slug da categoria.
 * @param array<int, array>    $fallback Itens padrão.
 * @return array<int, array<string, string>>
 */
function giftmedtema_get_section_cards( $slug, $fallback = array() ) {
	$query = giftmedtema_query_by_category( $slug );
	$items = array();

	if ( $query->have_posts() ) {
		$i = 0;
		while ( $query->have_posts() ) {
			$query->the_post();
			$title = get_the_title();
			if ( 'como-funciona' === $slug ) {
				$clean = preg_replace( '/^\s*\d+[\.\):\-–—]?\s*/u', '', $title );
				$title = $clean ? $clean : $title;
			}
			$items[] = array(
				'icon'  => giftmedtema_meta( get_the_ID(), 'icone', $fallback[ $i ]['icon'] ?? '●' ),
				'title' => $title,
				'text'  => wp_strip_all_tags( get_the_excerpt() ),
			);
			++$i;
		}
		wp_reset_postdata();
		return $items;
	}

	return $fallback;
}
