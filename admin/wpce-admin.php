<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @author     audrasjb <audrasjb@gmail.com>
 * @since      1.0
 *
 * @package    wpce
 * @subpackage wpce/admin
 */

/**
 *
 * Plugin options in appearance section
 *
 */

// Enqueue styles
add_action( 'admin_enqueue_scripts', 'enqueue_styles_wpce_admin' );
function enqueue_styles_wpce_admin() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'wpce-admin-styles', plugin_dir_url( __FILE__ ) . 'css/wpce-admin.css', array(), '', 'all' );
	add_editor_style( plugin_dir_url( __FILE__ ) . 'css/wpce-admin-editor.css' );
}
	
// Enqueue scripts
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_wpce_admin' );
function enqueue_scripts_wpce_admin() {
	wp_enqueue_script( 'wpce-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/wpce-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
}	

add_action( 'admin_menu', 'wpce_add_admin_menu' );


function wpce_add_admin_menu(  ) { 

	add_options_page( __('WP Community events settings', 'wp-community-events'), __('Community Events shortcode generator', 'wp-community-events'), 'manage_options', 'wp-community-events', 'wpce_options_page' );
}


function wpce_options_page(  ) { 
	?>
	<div class="wrap">
		<h1><?php echo __('WP Community Events shortcode generator', 'wp-community-events'); ?></h1>
		<p><?php echo __('Manage <em>WP Community Events</em> settings below and generate map shortcodes.', 'wp-community-events'); ?></p>
		<form action="#wpce_shortcode" method="post">
			<?php
			// Get datas
			if ( isset($_POST['wpce_localisation']) ) :
				echo $wpce_localisation = sanitize_text_field($_POST['wpce_localisation']);
			else : $wpce_localisation = 'world';
			endif;

			if ( isset($_POST['wpce_highlighthostingcountries']) ) :
				echo $wpce_highlighthostingcountries = sanitize_text_field($_POST['wpce_highlighthostingcountries']);
			else : $wpce_highlighthostingcountries = 'yes';
			endif;

			if ( isset($_POST['wpce_wordcamp_icon_type']) ) :
				echo $wpce_wordcamp_icon_type = sanitize_text_field($_POST['wpce_wordcamp_icon_type']);
			else : $wpce_wordcamp_icon_type = 'marker';
			endif;

			if ( isset($_POST['wpce_wordcamp_icon_color']) ) :
				echo $wpce_wordcamp_icon_color = sanitize_text_field($_POST['wpce_wordcamp_icon_color']);
			else : $wpce_wordcamp_icon_color = '#e55400';
			endif;

			if ( isset($_POST['wpce_meetup_icon_type']) ) :
				echo $wpce_meetup_icon_type = sanitize_text_field($_POST['wpce_meetup_icon_type']);
			else : $wpce_meetup_icon_type = 'marker';
			endif;

			if ( isset($_POST['wpce_meetup_icon_color']) ) :
				echo $wpce_meetup_icon_color = sanitize_text_field($_POST['wpce_meetup_icon_color']);
			else : $wpce_meetup_icon_color = '#005fef';
			endif;
			?>
			<h2><?php echo __('General map settings', 'wp-community-events'); ?></h2>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wpce_localisation"><?php echo __('Focus / localisation', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_localisation" id="wpce_localisation">
								<option value="world" <?php selected( $wpce_localisation, 'world' ); ?>><?php echo __('Worldwide', 'wp-community-events'); ?></option>
								<option value="europe" <?php selected( $wpce_localisation, 'europe' ); ?>><?php echo __('Europe', 'wp-community-events'); ?></option>
								<option value="northamerica" <?php selected( $wpce_localisation, 'northamerica' ); ?>><?php echo __('North America', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_highlighthostingcountries"><?php echo __('Highlight hosting countries', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_highlighthostingcountries" id="wpce_highlighthostingcountries">
								<option value="yes" <?php selected( $wpce_highlighthostingcountries, 'yes' ); ?>><?php echo __('Yes', 'wp-community-events'); ?></option>
								<option value="no" <?php selected( $wpce_highlighthostingcountries, 'no' ); ?>><?php echo __('No', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<h2><?php echo __('WordCamps &amp; Meetups markers settings', 'wp-community-events'); ?></h2>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wpce_wordcamp_icon_type"><?php echo __('WordCamps marker icon type', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_wordcamp_icon_type" id="wpce_wordcamp_icon_type">
								<option value="marker" <?php selected( $wpce_wordcamp_icon_type, 'marker' ); ?>><?php echo __('Marker', 'wp-community-events'); ?></option>
								<option value="logo" <?php selected( $wpce_wordcamp_icon_type, 'logo' ); ?>><?php echo __('WordPress logo', 'wp-community-events'); ?></option>
								<option value="heart" <?php selected( $wpce_wordcamp_icon_type, 'heart' ); ?>><?php echo __('Heart', 'wp-community-events'); ?></option>
								<option value="megaphone" <?php selected( $wpce_wordcamp_icon_type, 'megaphone' ); ?>><?php echo __('Megaphone', 'wp-community-events'); ?></option>
								<option value="comment" <?php selected( $wpce_wordcamp_icon_type, 'comment' ); ?>><?php echo __('Comment bubble', 'wp-community-events'); ?></option>
								<option value="carrot" <?php selected( $wpce_wordcamp_icon_type, 'carrot' ); ?>><?php echo __('Carrot', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_wordcamp_icon_color"><?php echo __('WordCamps marker icon color', 'wp-community-events'); ?></label></th>
						<td>
							<input type="text" class="wpce-colorpicker" name="wpce_wordcamp_icon_color" id="wpce_wordcamp_icon_color" value="<?php echo $wpce_wordcamp_icon_color; ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_meetup_icon_type"><?php echo __('Meetups marker icon type', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_meetup_icon_type" id="wpce_meetup_icon_type">
								<option value="marker" <?php selected( $wpce_meetup_icon_type, 'marker' ); ?>><?php echo __('Marker', 'wp-community-events'); ?></option>
								<option value="logo" <?php selected( $wpce_meetup_icon_type, 'logo' ); ?>><?php echo __('WordPress logo', 'wp-community-events'); ?></option>
								<option value="heart" <?php selected( $wpce_meetup_icon_type, 'heart' ); ?>><?php echo __('Heart', 'wp-community-events'); ?></option>
								<option value="megaphone" <?php selected( $wpce_meetup_icon_type, 'megaphone' ); ?>><?php echo __('Megaphone', 'wp-community-events'); ?></option>
								<option value="comment" <?php selected( $wpce_meetup_icon_type, 'comment' ); ?>><?php echo __('Comment bubble', 'wp-community-events'); ?></option>
								<option value="carrot" <?php selected( $wpce_meetup_icon_type, 'carrot' ); ?>><?php echo __('Carrot', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_meetup_icon_color"><?php echo __('Meetups marker icon color', 'wp-community-events'); ?></label></th>
						<td>
							<input type="text" class="wpce-colorpicker" name="wpce_meetup_icon_color" id="wpce_meetup_icon_color" value="<?php echo $wpce_meetup_icon_color; ?>" />
						</td>
					</tr>
				</tbody>
			</table>
			<p><input type="submit" class="button-primary" value="<?php echo __('Generate Shortcode', 'wpce-community-events'); ?>" /></p>
		</form>
		<p><?php echo __('You can insert the following shortcode into any type of page, post, widget…', 'wp-community-events'); ?></p>
		<p>
			<textarea id="wpce_shortcode" name="wpce_shortcode" cols="100" rows="10"><?php echo '[wpce localisation="' . $wpce_localisation . '" countries="' . $wpce_highlighthostingcountries . '" wc-icon="' . $wpce_wordcamp_icon_type . '" wc-color="' . $wpce_wordcamp_icon_color . '" mt-icon="' . $wpce_meetup_icon_type . '" mt-color="' . $wpce_meetup_icon_color . '"]'; ?></textarea>
		</p>
	</div>
	<?php		
}