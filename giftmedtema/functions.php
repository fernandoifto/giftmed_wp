<?php
/**
 * GiftMed Tema — bootstrap.
 *
 * @package GiftMedTema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GIFTMEDTEMA_DIR', get_template_directory() );
define( 'GIFTMEDTEMA_URI', get_template_directory_uri() );

require_once GIFTMEDTEMA_DIR . '/inc/helpers.php';
require_once GIFTMEDTEMA_DIR . '/inc/setup.php';
require_once GIFTMEDTEMA_DIR . '/inc/assets.php';
require_once GIFTMEDTEMA_DIR . '/inc/noticias.php';
require_once GIFTMEDTEMA_DIR . '/inc/template-tags.php';
require_once GIFTMEDTEMA_DIR . '/inc/meta-boxes.php';
require_once GIFTMEDTEMA_DIR . '/inc/forms.php';
require_once GIFTMEDTEMA_DIR . '/inc/customizer.php';
require_once GIFTMEDTEMA_DIR . '/inc/seed.php';
