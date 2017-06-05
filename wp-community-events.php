<?php

/**
 * @link              https://jeanbaptisteaudras.com/portfolio/wp-community-events/
 * @since             1.0
 * @package           WP Community Events
 *
 * @wordpress-plugin
 * Plugin Name:       WP Community Events
 * Plugin URI:        https://jeanbaptisteaudras.com/portfolio/extension-wordpress-chiffre-cles/
 * Description:       Display WordPress official community WordCamps & Meetups on beautiful vector maps.
 * Version:           1.0
 * Author:            Jean-Baptiste Audras, WordPress projects manager @ Whodunit
 * Author URI:        http://jeanbaptisteaudras.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       key-figures
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * i18n
 */
load_plugin_textdomain( 'wp-community-events', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

/**
 * Admin
 */
if (is_admin()) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/wpce-admin.php';
}
/**
 * Public
 */
require_once plugin_dir_path( __FILE__ ) . 'public/wpce-public.php';
