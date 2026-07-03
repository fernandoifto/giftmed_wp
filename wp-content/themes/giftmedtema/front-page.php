<?php
/**
 * Template da página inicial.
 *
 * @package GiftMedTema
 */

get_header();
?>

<?php get_template_part( 'template-parts/section', 'hero' ); ?>
<?php get_template_part( 'template-parts/section', 'desafio' ); ?>
<?php get_template_part( 'template-parts/section', 'solucao' ); ?>
<?php get_template_part( 'template-parts/section', 'como-funciona' ); ?>
<?php get_template_part( 'template-parts/section', 'funcionalidades' ); ?>
<?php get_template_part( 'template-parts/section', 'impacto' ); ?>
<?php get_template_part( 'template-parts/section', 'noticias' ); ?>
<?php get_template_part( 'template-parts/section', 'contato' ); ?>

<?php
get_footer();
