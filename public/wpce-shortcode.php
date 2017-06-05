<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    wpce
 * @subpackage wpce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    wpce
 * @subpackage wpce/public
 * @author     audrasjb <audrasjb@gmail.com>
 */

	function wpce_get_wordcamps() {
		// Get transient if exists
		$transient = get_transient('who_get_wordcamps');
		
		// Do the job for WordCamps
		if ( ! empty($transient) ) :
			$upcoming_wordcamps = json_decode($transient, true);
		else : 
			$api_url = 'https://central.wordcamp.org/wp-json/wp/v2/wordcamps?per_page=100&status=wcpt-scheduled&order=desc';
			$request_args = array( 'sslverify' => false, 'timeout' => 10 );
			$api_response = ( function_exists('vip_safe_wp_remote_get') ? vip_safe_wp_remote_get($api_url, $request_args) : wp_remote_get($api_url, $request_args) );

			if ( $api_response && ! is_wp_error($api_response) ) :
				$upcoming_wordcamps = json_decode($api_response['body'], true);
				set_transient('who_get_wordcamps', wp_json_encode($upcoming_wordcamps), DAY_IN_SECONDS);
			endif;
		endif;	
		return $upcoming_wordcamps;			
	}

	function wpce_get_meetups() {
		$transient = get_transient('who_get_meetups');
		if ( ! empty($transient) ) :
			$upcoming_meetups = json_decode($transient, true);
		else : 
			$api_url = 'https://api.meetup.com/2/events?member_id=72560962&key=%s&sign=true&key=295843635479575435b64e3f5e654f';
			$request_args = array( 'sslverify' => false, 'timeout' => 10 );
			$api_response = ( function_exists('vip_safe_wp_remote_get') ? vip_safe_wp_remote_get($api_url, $request_args) : wp_remote_get($api_url, $request_args) );

			if ( $api_response && ! is_wp_error($api_response) ) :
				$upcoming_meetups = json_decode($api_response['body'], true);
				set_transient('who_get_meetups', wp_json_encode($upcoming_meetups), DAY_IN_SECONDS);
			endif;
		endif;	
		return $upcoming_meetups;			
	}


	function wpce_shortcode_init() {
		
		function wpce_shortcode_display( $atts ) {

	 		// Styles and scripts inclusion
	 		wp_enqueue_script( 'wpce-ammap', plugin_dir_url( __FILE__ ) . 'js/ammap.js', array( 'jquery' ), '', false );
	 		wp_enqueue_script( 'wpce-worldlow', plugin_dir_url( __FILE__ ) . 'js/worldLow.js', array( 'jquery' ), '', false );
	 		wp_enqueue_script( 'wpce-public', plugin_dir_url( __FILE__ ) . 'js/wpce-public.js', array( 'jquery' ), '', false );

	 		// Get shortcode attributes
	 		$atts = shortcode_atts(
				array(
					'localisation' => 'world',
					'countries' => 'yes',
					'wc-icon' => 'marker',
					'wc-color' => '#e55400',
					'mt-icon' => 'marker',
					'mt-color' => '#e55400',
				),
				$atts,
				'wpce'
			);
			$focused_localisation = $atts['localisation'];
			$display_countries = $atts['countries'];
			$wordcamp_marker = $atts['wc-icon'];
			$wordcamp_marker_color = $atts['wc-color'];
			$meetup_marker = $atts['wc-icon'];
			$meetup_marker_color = $atts['wc-color'];
			
			// Init HTML rendering
			$html = '';

			// Marker images		
			$wordcamp_marker_image = plugin_dir_url( __FILE__ ) . 'images/wordcamp_marker.svg';
			$meetup_marker_image =  plugin_dir_url( __FILE__ ) . 'images/meetup_marker.svg';
			
			// Get upcoming WordCamps
			$upcoming_wordcamps = wpce_get_wordcamps();

			// Init JS array for markers
			$html .= '<script>var markers = new Array();</script>';

			// Init JS array for WordCamps
			if ( $upcoming_wordcamps ) :
				$html .= '<script>';
				foreach ( $upcoming_wordcamps as $key => $value ) : 
					$eventID = $value['id'];
					if ( $value['Start Date (YYYY-mm-dd)'] ) :
						$dateStart = date( get_option('date_format'), $value['Start Date (YYYY-mm-dd)'] );
					else : 
						continue;
					endif;
					if ( $value['End Date (YYYY-mm-dd)'] ) : 
						$dateEnd = date( get_option('date_format'), $value['End Date (YYYY-mm-dd)'] );
					else : 
						continue;
					endif;
					$title = $value['title']['rendered'];
					$location = $value['Location'];
					$url = $value['URL'];
					$twitterAccount = $value['Twitter'];
					$twitterHashtag = $value['WordCamp Hashtag'];
					$anticipatedAttendees = $value['Number of Anticipated Attendees'];
					$lat = $value['_venue_coordinates']['latitude'];
					$lng = $value['_venue_coordinates']['longitude'];
					$city = $value['_venue_city'];
					$usaState = $value['_venue_state'];
					$countryCode = $value['_venue_country_code'];
					$countryName = $value['_venue_country_name'];
					$array_country_codes[] = strtoupper($countryCode);
					$html .= '
					markers.push({
						"id": ' . json_encode($eventID) . ',
						"title": ' . json_encode($title) . ',
						"selectable": true,
						"latitude": ' . $lat . ',
						"longitude": ' . $lng . ',
						"imageURL": "' . $wordcamp_marker_image . '",
						"zoomLevel": 6,
						"scale": 4
					});
					';
				endforeach;
				$html .= '</script>';
			endif;

			// Get upcoming Meetups
			$upcoming_meetups = wpce_get_meetups();

			// Init JS array for Meetups
			if ( $upcoming_meetups ) :
				$html .= '<script>';
				foreach ( $upcoming_meetups['results'] as $key => $value ) : 
					if (!empty($value['venue'])) :
						$eventID = $value['id'];
						if ( $value['time'] ) :
							$dateStart = date( get_option('date_format'), intval($value['time'])/1000 );
						else : 
							continue;
						endif;
						$dateEnd = '';
						$title = $value['group']['name'];
						$location = $value['venue']['city'];
						$url = $value['event_url'];
						$twitterAccount = '';
						$twitterHashtag = '';
						$anticipatedAttendees = '';
						$lat = $value['venue']['lat'];
						$lng = $value['venue']['lon'];
						$city = $value['venue']['city'];
						$usaState = '';
						$countryCode = $value['venue']['country'];
						$countryName = $value['venue']['localized_country_name'];
						$array_country_codes[] = strtoupper($countryCode);
						//echo '<li>UTC offset : '.$value['utc_offset'].'</li>';
						$html .= '
						markers.push({
							"id": ' . json_encode($eventID) . ',
							"title": ' . json_encode($title) . ',
							"selectable": true,
							"latitude": ' . $lat . ',
							"longitude": ' . $lng . ',
							"imageURL": "' . $meetup_marker_image . '",
							"zoomLevel": 6,
							"scale": 4
						});
						';
					endif;
				endforeach;
				$html .= '</script>';
			endif;

			// Get countries list and selected focus
			$html .= '<script>';

			// Selected focus
			$html .= 'var mapFocus = "' . $focused_localisation . '";';

			// Countries list
			$array_unique_country_codes = array_unique($array_country_codes);
			if ($array_unique_country_codes) :
				$html .= 'var countries = new Array();';
				foreach ($array_unique_country_codes as $country) :
					$html .= '
						countries.push({
							"id": "' . strip_tags($country) . '",
							"color": "#B89E97"
						});
					';
				endforeach;
			endif;			
			
			$html .= '</script>';

			// Map container
			$html .= '<div id="wpce_map" class="wpce_map" style="height:600px;"></div>';
			
			// Send HTML datas
			return $html;
		}
	
		add_shortcode( 'wpce', 'wpce_shortcode_display' );
	
	}
	add_action('init', 'wpce_shortcode_init');