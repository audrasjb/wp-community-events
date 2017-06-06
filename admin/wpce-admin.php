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
	//add_editor_style( plugin_dir_url( __FILE__ ) . 'css/wpce-admin-editor.css' );
}
	
// Enqueue scripts
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_wpce_admin' );
function enqueue_scripts_wpce_admin() {
	wp_enqueue_script( 'wpce-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/wpce-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
}	

add_action( 'admin_menu', 'wpce_add_admin_menu' );
function wpce_add_admin_menu(  ) { 
	add_options_page( __('WP Community Events settings', 'wp-community-events'), __('WP Community Events shortcode generator', 'wp-community-events'), 'manage_options', 'wp-community-events', 'wpce_options_page' );
}

add_action( 'admin_init', 'wpce_settings_init' );
function wpce_settings_init() { 

	register_setting( 'wpcePage', 'wpce_settings' );

	add_settings_section(
		'wpce_section', 
		__( 'Meetup.com API', 'wp-community-events' ), 
		'wpce_settings_section_callback', 
		'wpcePage'
	);

	add_settings_field( 
		'wpce_field_meetup_api', 
		__( 'Meetup.com API Key', 'wp-community-events' ), 
		'wpce_field_meetup_api_render', 
		'wpcePage', 
		'wpce_section' 
	);
}

function wpce_settings_section_callback(  ) { 
	echo '<p>' . __( 'Meetup.com events needs a personnal API Key to work. <a href="https://secure.meetup.com/meetup_api/key/" target="_blank" title="This links will open a new window">You can get an API Key in few seconds here</a> (you have to get a free meetup.com account to generate it).', 'wp-community-events' ) . '</p>';
}

function wpce_field_meetup_api_render(  ) { 
	$options = get_option( 'wpce_settings' );
	if (isset($options['wpce_meetup_api_key'])) {
		$option_meetup_api_key = $options['wpce_meetup_api_key'];
	} else {
		$option_meetup_api_key = '';		
	}
	?>
	<input type="text" name="wpce_settings[wpce_meetup_api_key]" value="<?php echo $option_meetup_api_key; ?>" class="regular-text" />
	<?php
}


function wpce_options_page() { 
	?>
	<div class="wrap">
		
		<h1><?php echo __('WP Community Events', 'wp-community-events'); ?></h1>
		
		<p><?php echo __('Manage <em>WP Community Events</em> settings below and generate map shortcodes.', 'wp-community-events'); ?></p>

		<form action='options.php' method='post'>
		
			<?php
			settings_fields( 'wpcePage' );
			do_settings_sections( 'wpcePage' );
			submit_button();
			?>
		
		</form>

		<hr />
		
		<form action="#wpce_shortcode" method="post">
			<?php
			// Get datas
			if (
				isset($_POST['wpce_localisation']) && 
				isset($_POST['wpce_map_height']) && 
				isset($_POST['wpce_highlight_hosting_countries']) && 
				isset($_POST['wpce_wordcamp_bool']) &&
				isset($_POST['wpce_wordcamp_icon_type']) && 
				isset($_POST['wpce_wordcamp_icon_color']) && 
				isset($_POST['wpce_meetup_bool']) &&
				isset($_POST['wpce_meetup_icon_type']) && 
				isset($_POST['wpce_meetup_icon_color']) 
				) :
				?>
				<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
					<p><strong><?php echo __('Meetup.com API key saved', 'wp-community-events'); ?></strong></p>
					<button type="button" class="notice-dismiss">
						<span class="screen-reader-text"><?php echo __('Dismiss this message', 'wp-community-events'); ?></span>
					</button>
				</div>
				<?php
			endif;
			
			if ( isset($_POST['wpce_localisation']) ) :
				$wpce_localisation = sanitize_text_field($_POST['wpce_localisation']);
			else : $wpce_localisation = 'world';
			endif;

			if ( isset($_POST['wpce_map_height']) ) :
				$wpce_map_height = sanitize_text_field($_POST['wpce_map_height']);
			else : $wpce_map_height = '500';
			endif;

			if ( isset($_POST['wpce_highlight_hosting_countries']) ) :
				$wpce_highlight_hosting_countries = sanitize_text_field($_POST['wpce_highlight_hosting_countries']);
			else : $wpce_highlight_hosting_countries = 1;
			endif;
			
			if ( isset($_POST['wpce_highlight_hosting_countries_color']) ) :
				$wpce_highlight_hosting_countries_color = sanitize_text_field($_POST['wpce_highlight_hosting_countries_color']);
			else : $wpce_highlight_hosting_countries_color = '#B89E97';
			endif;
			
			if ( isset($_POST['wpce_wordcamp_bool']) ) :
				$wpce_wordcamp_bool = sanitize_text_field($_POST['wpce_wordcamp_bool']);
			else : $wpce_wordcamp_bool = 1;
			endif;

			if ( isset($_POST['wpce_wordcamp_icon_type']) ) :
				$wpce_wordcamp_icon_type = sanitize_text_field($_POST['wpce_wordcamp_icon_type']);
			else : $wpce_wordcamp_icon_type = 'marker';
			endif;

			if ( isset($_POST['wpce_wordcamp_icon_color']) ) :
				$wpce_wordcamp_icon_color = sanitize_text_field($_POST['wpce_wordcamp_icon_color']);
			else : $wpce_wordcamp_icon_color = '#e55400';
			endif;

			if ( isset($_POST['wpce_meetup_bool']) ) :
				$wpce_meetup_bool = sanitize_text_field($_POST['wpce_meetup_bool']);
			else : $wpce_meetup_bool = 1;
			endif;

			if ( isset($_POST['wpce_meetup_icon_type']) ) :
				$wpce_meetup_icon_type = sanitize_text_field($_POST['wpce_meetup_icon_type']);
			else : $wpce_meetup_icon_type = 'marker';
			endif;

			if ( isset($_POST['wpce_meetup_icon_color']) ) :
				$wpce_meetup_icon_color = sanitize_text_field($_POST['wpce_meetup_icon_color']);
			else : $wpce_meetup_icon_color = '#005fef';
			endif;
			?>
										
			<h2><?php echo __('Shortcode generator', 'wp-community-events'); ?></h2>
			<p><?php echo __('Please note: shortcode settings are not saved. This is only a onte-time shortcode generator.', 'wp-community-events'); ?></p>
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
						<th scope="row"><label for="wpce_map_height"><?php echo __('Map height', 'wp-community-events'); ?></label></th>
						<td>
							<input type="text" name="wpce_map_height" id="wpce_map_height" value="<?php echo $wpce_map_height; ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_highlight_hosting_countries"><?php echo __('Highlight hosting countries', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_highlight_hosting_countries" id="wpce_highlight_hosting_countries">
								<option value="1" <?php selected( $wpce_wordcamp_bool, 1 ); ?>><?php echo __('Yes, please', 'wp-community-events'); ?></option>
								<option value="0" <?php selected( $wpce_wordcamp_bool, 0 ); ?>><?php echo __('No, thanks', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpce_highlight_hosting_countries_color"><?php echo __('Highlighted countries color', 'wp-community-events'); ?></label></th>
						<td>
							<input type="text" class="wpce-colorpicker" name="wpce_highlight_hosting_countries_color" id="wpce_highlight_hosting_countries_color" value="<?php echo $wpce_highlight_hosting_countries_color; ?>" />
						</td>
					</tr>
				</tbody>
			</table>
			<h2><?php echo __('WordCamps &amp; Meetups markers settings', 'wp-community-events'); ?></h2>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wpce_wordcamp_bool"><?php echo __('Display WordCamps', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_wordcamp_bool" id="wpce_wordcamp_bool">
								<option value="1" <?php selected( $wpce_wordcamp_bool, 1 ); ?>><?php echo __('Yes, please', 'wp-community-events'); ?></option>
								<option value="0" <?php selected( $wpce_wordcamp_bool, 0 ); ?>><?php echo __('No, thanks', 'wp-community-events'); ?></option>
							</select>
						</td>
					</tr>
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
						<th scope="row"><label for="wpce_meetup_bool"><?php echo __('Display Meetups', 'wp-community-events'); ?></label></th>
						<td>
							<select name="wpce_meetup_bool" id="wpce_meetup_bool">
								<option value="1" <?php selected( $wpce_meetup_bool, 1 ); ?>><?php echo __('Yes, please', 'wp-community-events'); ?></option>
								<option value="0" <?php selected( $wpce_meetup_bool, 0 ); ?>><?php echo __('No, thanks', 'wp-community-events'); ?></option>
							</select>
							<p class="description">Note that you will need a valid meetup.com API key.</p>
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
			<textarea id="wpce_shortcode" name="wpce_shortcode" cols="100" rows="10"><?php echo '[wpce localisation="' . $wpce_localisation . '" height="' . $wpce_map_height . '" countries="' . $wpce_highlight_hosting_countries . '" countries-color="' . $wpce_highlight_hosting_countries_color . '" wc-display="' . $wpce_wordcamp_bool . '" wc-icon="' . $wpce_wordcamp_icon_type . '" wc-color="' . $wpce_wordcamp_icon_color . '" mt-display="' . $wpce_meetup_bool . '" mt-icon="' . $wpce_meetup_icon_type . '" mt-color="' . $wpce_meetup_icon_color . '"]'; ?></textarea>
		</p>
	</div>
	<?php		
}