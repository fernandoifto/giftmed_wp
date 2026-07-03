<?php
/**
 * Template padrão — fallback para posts e páginas internas.
 *
 * @package GiftMedTema
 */

get_header();
?>

<section class="py-24">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'bg-white border border-slate-100 rounded-2xl p-8 shadow-sm space-y-4' ); ?>>
					<header>
						<h1 class="text-3xl font-black text-slate-900"><?php the_title(); ?></h1>
						<?php if ( 'post' === get_post_type() ) : ?>
							<time class="text-xs font-bold uppercase tracking-wider text-teal-600" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						<?php endif; ?>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="rounded-xl overflow-hidden">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="prose prose-slate max-w-none text-slate-600">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<p class="text-center text-slate-500"><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'giftmedtema' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
