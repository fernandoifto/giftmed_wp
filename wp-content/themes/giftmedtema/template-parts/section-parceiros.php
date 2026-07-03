<?php
/**
 * Seção de parceiros — exibida acima do rodapé.
 *
 * @package GiftMedTema
 */

$grupos = array(
	'fomentadoras' => array(
		'label' => __( 'Instituições Fomentadoras', 'giftmedtema' ),
		'class' => 'text-orange-500',
	),
	'publicos'     => array(
		'label' => __( 'Parceiros Públicos', 'giftmedtema' ),
		'class' => 'text-teal-600',
	),
	'academico'    => array(
		'label' => __( 'Parceiros Acadêmicos', 'giftmedtema' ),
		'class' => 'text-slate-700',
	),
);

$queries = array();
$has_any = false;

foreach ( $grupos as $slug => $grupo ) {
	$queries[ $slug ] = giftmedtema_get_parceiros_query( $slug );
	if ( $queries[ $slug ]->have_posts() ) {
		$has_any = true;
	}
}

if ( ! $has_any ) {
	return;
}
?>
<section id="parceiros" class="bg-white border-t border-slate-100 py-16" aria-label="<?php esc_attr_e( 'Parceiros institucionais', 'giftmedtema' ); ?>">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="text-center mb-12">
			<span class="text-teal-600 font-extrabold text-xs uppercase tracking-widest bg-teal-50 px-3 py-1 rounded-full">
				<?php esc_html_e( 'Rede de Apoio', 'giftmedtema' ); ?>
			</span>
			<h2 class="text-2xl font-black text-slate-900 mt-3 tracking-tight">
				<?php esc_html_e( 'Nossos Parceiros', 'giftmedtema' ); ?>
			</h2>
			<p class="text-sm text-slate-500 mt-2 max-w-xl mx-auto">
				<?php esc_html_e( 'Instituições que apoiam e fortalecem a missão da GiftMed.', 'giftmedtema' ); ?>
			</p>
		</div>

		<?php
		$group_index = 0;
		$group_count = count( array_filter( $queries, static function ( $query ) {
			return $query->have_posts();
		} ) );

		foreach ( $grupos as $slug => $grupo ) :
			if ( ! $queries[ $slug ]->have_posts() ) {
				continue;
			}
			++$group_index;
			?>
			<div class="<?php echo $group_index < $group_count ? 'mb-14' : ''; ?>">
				<h3 class="text-center text-sm font-extrabold uppercase tracking-widest <?php echo esc_attr( $grupo['class'] ); ?> mb-8">
					<?php echo esc_html( $grupo['label'] ); ?>
				</h3>
				<?php giftmedtema_render_parceiros_grid( $queries[ $slug ] ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
