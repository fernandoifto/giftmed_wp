<?php
/**
 * Cabeçalho do tema.
 *
 * @package GiftMedTema
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-mesh text-slate-800 antialiased scroll-smooth' ); ?>>
<?php wp_body_open(); ?>

<div class="bg-gradient-to-r from-teal-600 via-teal-500 to-orange-500 text-white text-xs font-bold py-2 px-4 text-center tracking-wide">
	🚀 <?php esc_html_e( 'CONECTANDO SAÚDE E SOLIDARIEDADE — CONHEÇA O NOSSO MVP OPERACIONAL', 'giftmedtema' ); ?>
</div>

<header class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 shadow-sm">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center space-x-3">
				<div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-teal-600/30">＋</div>
				<div class="flex flex-col">
					<span class="text-2xl font-black text-slate-900 tracking-tight leading-none">Gift<span class="text-teal-600">Med</span></span>
					<span class="text-[9px] text-slate-400 uppercase font-extrabold tracking-widest mt-1"><?php esc_html_e( 'Tecnologia Social', 'giftmedtema' ); ?></span>
				</div>
			</a>
		<?php endif; ?>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => 'nav',
				'container_class'=> '',
				'menu_class'     => 'hidden lg:flex space-x-8 text-sm font-bold text-slate-600',
				'fallback_cb'    => 'giftmedtema_fallback_menu',
				'depth'          => 1,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			)
		);
		?>

		<div class="flex items-center space-x-4">
			<a href="https://www.instagram.com/giftmed4/" target="_blank" rel="noopener noreferrer" class="p-2 bg-slate-100 text-slate-600 hover:bg-orange-100 hover:text-orange-600 rounded-xl transition" title="<?php esc_attr_e( 'Siga no Instagram', 'giftmedtema' ); ?>">
				<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
			</a>
			<a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-3 rounded-xl font-bold text-sm shadow-md shadow-teal-600/20 transition-all">
				<?php esc_html_e( 'Solicitar Demo', 'giftmedtema' ); ?>
			</a>
		</div>
	</div>
</header>
