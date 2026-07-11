<?php
/**
 * Template 404.
 *
 * @package GiftMedTema
 */

get_header();
?>

<main class="gm-section gm-section--soft" id="conteudo">
	<div class="gm-container" style="max-width:40rem;text-align:center;padding:4rem 1rem;">
		<p class="gm-eyebrow gm-eyebrow--navy"><?php esc_html_e( 'Erro 404', 'giftmedtema' ); ?></p>
		<h1 class="gm-title"><?php esc_html_e( 'Página não encontrada', 'giftmedtema' ); ?></h1>
		<p class="gm-card__text" style="margin:1rem 0 2rem;">
			<?php esc_html_e( 'O endereço que você tentou acessar não existe ou foi movido.', 'giftmedtema' ); ?>
		</p>
		<a class="gm-btn gm-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Voltar para a página inicial', 'giftmedtema' ); ?>
		</a>
	</div>
</main>

<?php
get_footer();
