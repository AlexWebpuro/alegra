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

use Alex\Alegra\Init;

defined( 'ABSPATH') or die("Hey, what are you doing here? You silly human!");

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php') ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if(  class_exists( 'Alex\\Alegra\\Init') ) {
	\Alex\Alegra\Init::register_services();
}