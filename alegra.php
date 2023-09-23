<?php

/*
 * @package           Alegra for Woocomerce
 * @wordpress-plugin
 * Plugin Name:       Alegra facturacion
 * Plugin URI:        https://alexmonroy.com/plugins/alegra/
 * Description:       Crea tus facturas desde woocommerce.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Alex Monroy
 * Author URI:        https://alexmonroy.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://alexmonroy.com/alegra/
 * Text Domain:       alegra
 * Domain Path:       /languages
 */

 define('ALG_DOMAIN', 'alegra');
 define('PLG_ALG_NAME', plugin_basename(__FILE__) );

 register_activation_hook(
	__FILE__,
	'alegra_activate'
);

function alegra_activate() {
    error_log('Plugin activated!');
}

register_deactivation_hook(
	__FILE__,
	'alegra_deactivate'
);

function alegra_deactivate() {
    error_log('Plugin deactivate!');
}

add_action( 'admin_menu', 'alegra_options_page' );
function alegra_options_page() {
    add_menu_page(
        'Alegra',
        'Alegra',
        'manage_options',
        'alegra',
        'alegra_options_page_html',
        // plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
		'',
        5
    );
}

function alegra_options_page_html() {
	require_once __DIR__ . '/admin/view.php';
}

add_filter( 'plugin_action_links_' . PLG_ALG_NAME, 'alegra_settings_links', 1 );

function alegra_settings_links( $links ) {
	$setting_link = '<a href="admin.php?page=alegra">Setting</a>';
	array_push( $links, $setting_link );
	return $links;
}