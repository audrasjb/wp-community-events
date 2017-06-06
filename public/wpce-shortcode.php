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
		$upcoming_wordcamps = array();
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
		$upcoming_meetups = array();
		// Get meetupdotcom api key
		$options = get_option( 'wpce_settings' );
		if (isset($options['wpce_meetup_api_key'])) :
			$option_meetup_api_key = $options['wpce_meetup_api_key'];
			$transient = get_transient('who_get_meetups');
			if ( ! empty($transient) ) :
				$upcoming_meetups = json_decode($transient, true);
			else : 
				$api_url = 'https://api.meetup.com/2/events?member_id=72560962&key=%s&sign=true&key=' . $option_meetup_api_key;
				$request_args = array( 'sslverify' => false, 'timeout' => 10 );
				$api_response = ( function_exists('vip_safe_wp_remote_get') ? vip_safe_wp_remote_get($api_url, $request_args) : wp_remote_get($api_url, $request_args) );

				if ( $api_response && ! is_wp_error($api_response) ) :
					$upcoming_meetups = json_decode($api_response['body'], true);
					set_transient('who_get_meetups', wp_json_encode($upcoming_meetups), DAY_IN_SECONDS);
				endif;
			endif;	
		endif;
		return $upcoming_meetups;			
	}


	function wpce_shortcode_init() {
		
		function wpce_shortcode_display( $atts ) {

	 		// Styles and scripts inclusion
	 		wp_enqueue_style( 'wpce-public', plugin_dir_url( __FILE__ ) . 'css/wpce-public.css', array(), '', 'all' );
	 		wp_enqueue_script( 'wpce-ammap', plugin_dir_url( __FILE__ ) . 'js/ammap.js', array( 'jquery' ), '', false );
	 		wp_enqueue_script( 'wpce-worldlow', plugin_dir_url( __FILE__ ) . 'js/worldLow.js', array( 'jquery' ), '', false );
	 		wp_enqueue_script( 'wpce-public', plugin_dir_url( __FILE__ ) . 'js/wpce-public.js', array( 'jquery' ), '', false );

	 		// Get shortcode attributes
	 		$atts = shortcode_atts(
				array(
					'localisation' => 'world',
					'height' => '500',
					'countries' => 1,
					'countries-color' => '#B89E97',
					'wc-display' => 1,
					'wc-icon' => 'marker',
					'wc-color' => '#e55400',
					'mt-display' => 1,
					'mt-icon' => 'marker',
					'mt-color' => '#e55400',
				),
				$atts,
				'wpce'
			);
			
			$focused_localisation = $atts['localisation'];
			
			$wpce_map_height = $atts['height'];
			
			$display_countries = $atts['countries'];
			$countries_color = $atts['countries-color'];
			if ($display_countries && $countries_color) :
				$wpce_countries_color = $countries_color;
			else : 
				$wpce_countries_color = '#D8D8D8';
			endif;
			
			// SVG paths for dashicons
			$display_wordcamps = $atts['wc-display'];
			$wordcamp_marker = $atts['wc-icon'];
			$wordcamp_marker_color = $atts['wc-color'];
			if ($wordcamp_marker == 'marker') : 
				$wordcamp_marker_svg_path = 'M10 2q-1.63 0-3.010 0.805t-2.185 2.185-0.805 3.010q0 1.42 0.7 2.665t1.83 2.225q0.040 0.030 0.235 0.195t0.295 0.255 0.3 0.275 0.345 0.33 0.33 0.355 0.345 0.42q1.33 1.74 1.62 2.71 0.29-0.97 1.62-2.71 0.16-0.21 0.345-0.42t0.33-0.355 0.345-0.33 0.3-0.275 0.295-0.255 0.235-0.195q1.13-0.98 1.83-2.225t0.7-2.665q0-1.63-0.805-3.010t-2.185-2.185-3.010-0.805zM10 4.56q1.42 0 2.43 1.010t1.010 2.43-1.010 2.43-2.43 1.010-2.43-1.010-1.010-2.43 1.010-2.43 2.43-1.010z';
			elseif ($wordcamp_marker == 'logo') : 
				$wordcamp_marker_svg_path = 'M20 10q0-1.63-0.505-3.155t-1.43-2.755-2.155-2.155-2.755-1.43-3.155-0.505-3.155 0.505-2.755 1.43-2.155 2.155-1.43 2.755-0.505 3.155 0.505 3.155 1.43 2.755 2.155 2.155 2.755 1.43 3.155 0.505 3.155-0.505 2.755-1.43 2.155-2.155 1.43-2.755 0.505-3.155zM10 1.010q1.83 0 3.495 0.71t2.87 1.915 1.915 2.87 0.71 3.495-0.71 3.495-1.915 2.87-2.87 1.915-3.495 0.71-3.495-0.71-2.87-1.915-1.915-2.87-0.71-3.495 0.71-3.495 1.915-2.87 2.87-1.915 3.495-0.71zM8.010 14.82l-3.050-8.21 1.050-0.080q0.2-0.020 0.27-0.275t-0.025-0.49-0.305-0.225q-1.29 0.1-2.13 0.1-0.33 0-0.52-0.010 1.1-1.66 2.87-2.63t3.83-0.97q1.54 0 2.935 0.55t2.475 1.54q-0.52-0.070-0.985 0.305t-0.465 1.115q0 0.29 0.115 0.615t0.225 0.525 0.37 0.61q0.050 0.080 0.080 0.13 0.5 0.87 0.5 2.21 0 0.6-0.315 1.72t-0.635 1.94l-0.32 0.82-2.71-7.5q0.21-0.010 0.4-0.050t0.27-0.080l0.080-0.030q0.2-0.020 0.275-0.295t-0.025-0.535-0.3-0.25q-1.3 0.11-2.14 0.11-0.35 0-0.875-0.030l-0.875-0.050-0.36-0.030q-0.2-0.010-0.3 0.255t-0.025 0.54 0.275 0.285l0.84 0.080 1.12 3.040zM14.030 16.97l2.61-6.97q0.030-0.070 0.070-0.195t0.15-0.535 0.155-0.82 0.080-1.050-0.065-1.21q0.94 1.7 0.94 3.81 0 2.19-1.065 4.050t-2.875 2.92zM2.68 6.77l3.82 10.48q-2.020-0.99-3.245-2.945t-1.225-4.305q0-1.79 0.65-3.23zM10.13 11.3l2.29 6.25q-1.17 0.42-2.42 0.42-1.030 0-2.060-0.3z';
			elseif ($wordcamp_marker == 'heart') : 
				$wordcamp_marker_svg_path = 'M10 17.12q2.4-1.010 4.205-2.655t2.835-3.555q0.97-1.83 1.065-3.49t-0.745-2.76q-1.44-1.81-3.73-1.74-0.99 0.030-1.94 0.425t-1.69 1.035q-0.74-0.64-1.69-1.035t-1.94-0.425q-2.29-0.070-3.73 1.74-0.84 1.1-0.745 2.76t1.085 3.49q1.010 1.91 2.815 3.555t4.205 2.655z';
			elseif ($wordcamp_marker == 'megaphone') : 
				$wordcamp_marker_svg_path = 'M18.15 5.94q0.66 2.33-0.020 4.48-0.31 0.96-0.915 1.605t-1.385 0.875q-0.16 0.060-0.4 0.060-0.060 0.020-0.18 0.020-0.060 0.020-0.22 0.020h-6.8l2.22 5.5q0.030 0.18-0.14 0.34-0.13 0.16-0.34 0.16h-3.020q-0.21 0-0.34-0.16-0.17-0.17-0.14-0.34l-1-5.5h-1.22l-0.020-0.020q-0.37 0.040-0.78-0.125t-0.76-0.495q-0.81-0.78-1.060-1.88-0.33-1.1-0.020-2.2 0.27-0.94 1.060-1.3l0.020-0.020 9-5.4q0.2-0.12 0.24-0.16 0.090-0.060 0.24-0.12 0.19-0.1 0.5-0.18 0.77-0.22 1.62 0.045t1.6 0.935q0.76 0.68 1.355 1.68t0.905 2.18zM15.57 11.92h-0.020q0.58-0.14 1.040-0.7 0.86-1.040 0.86-3.040 0-0.92-0.28-1.98-0.5-1.99-1.78-3.24-0.58-0.56-1.23-0.8t-1.23-0.080q-1.22 0.33-1.7 2-0.48 1.56 0.060 3.72 0.59 2.12 1.8 3.24 1.26 1.19 2.48 0.88zM13.030 4.84q0.3-0.060 0.62 0.040 0.66 0.28 1.020 1 0.42 0.84 0.42 1.78 0 0.44-0.12 0.8-0.3 0.81-0.86 0.94-0.26 0.080-0.575-0.035t-0.565-0.365q-0.58-0.58-0.78-1.5-0.24-0.83 0.020-1.72 0.1-0.35 0.33-0.605t0.49-0.335z';
			elseif ($wordcamp_marker == 'comment') : 
				$wordcamp_marker_svg_path = 'M5 2h9q0.82 0 1.41 0.59t0.59 1.41v7q0 0.82-0.59 1.41t-1.41 0.59h-2l-5 5v-5h-2q-0.82 0-1.41-0.59t-0.59-1.41v-7q0-0.82 0.59-1.41t1.41-0.59z';
			elseif ($wordcamp_marker == 'carrot') : 
				$wordcamp_marker_svg_path = 'M2 18.43q0.28 0.27 0.94 0.185t1.54-0.38 1.945-0.815 2.15-1.13 2.15-1.315 1.945-1.365 1.54-1.295 0.93-1.095q0.36-0.6 0.235-1.375t-0.58-1.55-1.175-1.515q0.32-0.21 0.665-0.21t0.645 0.175 0.625 0.415 0.61 0.505 0.595 0.46 0.58 0.265 0.57-0.080q0.46-0.24 0.685-0.855t0.015-1.065q-0.12-0.26-0.365-0.455t-0.475-0.305-0.64-0.2-0.63-0.12-0.7-0.075-0.61-0.055q0.36-0.090 0.8-0.275t0.92-0.47 0.805-0.685 0.335-0.82q0.030-0.69-0.665-1.315t-1.385-0.545q-0.25 0.030-0.47 0.14t-0.4 0.325-0.315 0.41-0.275 0.53-0.22 0.525-0.205 0.565-0.175 0.505q-0.16-2.23-0.98-2.95-0.55-0.43-1.060-0.38t-0.88 0.465-0.38 0.965q-0.010 0.31 0.19 0.625t0.49 0.56 0.605 0.545 0.53 0.57 0.27 0.635-0.165 0.735q-0.78-0.6-1.575-0.965t-1.555-0.44-1.33 0.265q-0.7 0.45-1.63 1.69 1.68 1.78 3.090 2.72 0.15 0.11 0.185 0.29t-0.075 0.33q-0.1 0.16-0.285 0.195t-0.335-0.075q-1.38-0.94-3.1-2.71-0.71 1.050-1.34 2.23 1.57 1.58 2.79 2.41 0.15 0.11 0.18 0.29t-0.070 0.33q-0.1 0.16-0.285 0.195t-0.345-0.075q-1.17-0.8-2.71-2.32-1.43 2.82-2.12 5.24t-0.050 2.99z';
			else :
				$wordcamp_marker_svg_path = 'M10 2q-1.63 0-3.010 0.805t-2.185 2.185-0.805 3.010q0 1.42 0.7 2.665t1.83 2.225q0.040 0.030 0.235 0.195t0.295 0.255 0.3 0.275 0.345 0.33 0.33 0.355 0.345 0.42q1.33 1.74 1.62 2.71 0.29-0.97 1.62-2.71 0.16-0.21 0.345-0.42t0.33-0.355 0.345-0.33 0.3-0.275 0.295-0.255 0.235-0.195q1.13-0.98 1.83-2.225t0.7-2.665q0-1.63-0.805-3.010t-2.185-2.185-3.010-0.805zM10 4.56q1.42 0 2.43 1.010t1.010 2.43-1.010 2.43-2.43 1.010-2.43-1.010-1.010-2.43 1.010-2.43 2.43-1.010z';
			endif;
			
			
			$display_meetups = $atts['mt-display'];
			$meetup_marker = $atts['mt-icon'];
			$meetup_marker_color = $atts['mt-color'];
			
			if ($meetup_marker == 'marker') : 
				$meetup_marker_svg_path = 'M10 2q-1.63 0-3.010 0.805t-2.185 2.185-0.805 3.010q0 1.42 0.7 2.665t1.83 2.225q0.040 0.030 0.235 0.195t0.295 0.255 0.3 0.275 0.345 0.33 0.33 0.355 0.345 0.42q1.33 1.74 1.62 2.71 0.29-0.97 1.62-2.71 0.16-0.21 0.345-0.42t0.33-0.355 0.345-0.33 0.3-0.275 0.295-0.255 0.235-0.195q1.13-0.98 1.83-2.225t0.7-2.665q0-1.63-0.805-3.010t-2.185-2.185-3.010-0.805zM10 4.56q1.42 0 2.43 1.010t1.010 2.43-1.010 2.43-2.43 1.010-2.43-1.010-1.010-2.43 1.010-2.43 2.43-1.010z';
			elseif ($meetup_marker == 'logo') : 
				$meetup_marker_svg_path = 'M20 10q0-1.63-0.505-3.155t-1.43-2.755-2.155-2.155-2.755-1.43-3.155-0.505-3.155 0.505-2.755 1.43-2.155 2.155-1.43 2.755-0.505 3.155 0.505 3.155 1.43 2.755 2.155 2.155 2.755 1.43 3.155 0.505 3.155-0.505 2.755-1.43 2.155-2.155 1.43-2.755 0.505-3.155zM10 1.010q1.83 0 3.495 0.71t2.87 1.915 1.915 2.87 0.71 3.495-0.71 3.495-1.915 2.87-2.87 1.915-3.495 0.71-3.495-0.71-2.87-1.915-1.915-2.87-0.71-3.495 0.71-3.495 1.915-2.87 2.87-1.915 3.495-0.71zM8.010 14.82l-3.050-8.21 1.050-0.080q0.2-0.020 0.27-0.275t-0.025-0.49-0.305-0.225q-1.29 0.1-2.13 0.1-0.33 0-0.52-0.010 1.1-1.66 2.87-2.63t3.83-0.97q1.54 0 2.935 0.55t2.475 1.54q-0.52-0.070-0.985 0.305t-0.465 1.115q0 0.29 0.115 0.615t0.225 0.525 0.37 0.61q0.050 0.080 0.080 0.13 0.5 0.87 0.5 2.21 0 0.6-0.315 1.72t-0.635 1.94l-0.32 0.82-2.71-7.5q0.21-0.010 0.4-0.050t0.27-0.080l0.080-0.030q0.2-0.020 0.275-0.295t-0.025-0.535-0.3-0.25q-1.3 0.11-2.14 0.11-0.35 0-0.875-0.030l-0.875-0.050-0.36-0.030q-0.2-0.010-0.3 0.255t-0.025 0.54 0.275 0.285l0.84 0.080 1.12 3.040zM14.030 16.97l2.61-6.97q0.030-0.070 0.070-0.195t0.15-0.535 0.155-0.82 0.080-1.050-0.065-1.21q0.94 1.7 0.94 3.81 0 2.19-1.065 4.050t-2.875 2.92zM2.68 6.77l3.82 10.48q-2.020-0.99-3.245-2.945t-1.225-4.305q0-1.79 0.65-3.23zM10.13 11.3l2.29 6.25q-1.17 0.42-2.42 0.42-1.030 0-2.060-0.3z';
			elseif ($meetup_marker == 'heart') : 
				$meetup_marker_svg_path = 'M10 17.12q2.4-1.010 4.205-2.655t2.835-3.555q0.97-1.83 1.065-3.49t-0.745-2.76q-1.44-1.81-3.73-1.74-0.99 0.030-1.94 0.425t-1.69 1.035q-0.74-0.64-1.69-1.035t-1.94-0.425q-2.29-0.070-3.73 1.74-0.84 1.1-0.745 2.76t1.085 3.49q1.010 1.91 2.815 3.555t4.205 2.655z';
			elseif ($meetup_marker == 'megaphone') : 
				$meetup_marker_svg_path = 'M18.15 5.94q0.66 2.33-0.020 4.48-0.31 0.96-0.915 1.605t-1.385 0.875q-0.16 0.060-0.4 0.060-0.060 0.020-0.18 0.020-0.060 0.020-0.22 0.020h-6.8l2.22 5.5q0.030 0.18-0.14 0.34-0.13 0.16-0.34 0.16h-3.020q-0.21 0-0.34-0.16-0.17-0.17-0.14-0.34l-1-5.5h-1.22l-0.020-0.020q-0.37 0.040-0.78-0.125t-0.76-0.495q-0.81-0.78-1.060-1.88-0.33-1.1-0.020-2.2 0.27-0.94 1.060-1.3l0.020-0.020 9-5.4q0.2-0.12 0.24-0.16 0.090-0.060 0.24-0.12 0.19-0.1 0.5-0.18 0.77-0.22 1.62 0.045t1.6 0.935q0.76 0.68 1.355 1.68t0.905 2.18zM15.57 11.92h-0.020q0.58-0.14 1.040-0.7 0.86-1.040 0.86-3.040 0-0.92-0.28-1.98-0.5-1.99-1.78-3.24-0.58-0.56-1.23-0.8t-1.23-0.080q-1.22 0.33-1.7 2-0.48 1.56 0.060 3.72 0.59 2.12 1.8 3.24 1.26 1.19 2.48 0.88zM13.030 4.84q0.3-0.060 0.62 0.040 0.66 0.28 1.020 1 0.42 0.84 0.42 1.78 0 0.44-0.12 0.8-0.3 0.81-0.86 0.94-0.26 0.080-0.575-0.035t-0.565-0.365q-0.58-0.58-0.78-1.5-0.24-0.83 0.020-1.72 0.1-0.35 0.33-0.605t0.49-0.335z';
			elseif ($meetup_marker == 'comment') : 
				$meetup_marker_svg_path = 'M5 2h9q0.82 0 1.41 0.59t0.59 1.41v7q0 0.82-0.59 1.41t-1.41 0.59h-2l-5 5v-5h-2q-0.82 0-1.41-0.59t-0.59-1.41v-7q0-0.82 0.59-1.41t1.41-0.59z';
			elseif ($meetup_marker == 'carrot') : 
				$meetup_marker_svg_path = 'M2 18.43q0.28 0.27 0.94 0.185t1.54-0.38 1.945-0.815 2.15-1.13 2.15-1.315 1.945-1.365 1.54-1.295 0.93-1.095q0.36-0.6 0.235-1.375t-0.58-1.55-1.175-1.515q0.32-0.21 0.665-0.21t0.645 0.175 0.625 0.415 0.61 0.505 0.595 0.46 0.58 0.265 0.57-0.080q0.46-0.24 0.685-0.855t0.015-1.065q-0.12-0.26-0.365-0.455t-0.475-0.305-0.64-0.2-0.63-0.12-0.7-0.075-0.61-0.055q0.36-0.090 0.8-0.275t0.92-0.47 0.805-0.685 0.335-0.82q0.030-0.69-0.665-1.315t-1.385-0.545q-0.25 0.030-0.47 0.14t-0.4 0.325-0.315 0.41-0.275 0.53-0.22 0.525-0.205 0.565-0.175 0.505q-0.16-2.23-0.98-2.95-0.55-0.43-1.060-0.38t-0.88 0.465-0.38 0.965q-0.010 0.31 0.19 0.625t0.49 0.56 0.605 0.545 0.53 0.57 0.27 0.635-0.165 0.735q-0.78-0.6-1.575-0.965t-1.555-0.44-1.33 0.265q-0.7 0.45-1.63 1.69 1.68 1.78 3.090 2.72 0.15 0.11 0.185 0.29t-0.075 0.33q-0.1 0.16-0.285 0.195t-0.335-0.075q-1.38-0.94-3.1-2.71-0.71 1.050-1.34 2.23 1.57 1.58 2.79 2.41 0.15 0.11 0.18 0.29t-0.070 0.33q-0.1 0.16-0.285 0.195t-0.345-0.075q-1.17-0.8-2.71-2.32-1.43 2.82-2.12 5.24t-0.050 2.99z';
			else :
				$meetup_marker_svg_path = 'M10 2q-1.63 0-3.010 0.805t-2.185 2.185-0.805 3.010q0 1.42 0.7 2.665t1.83 2.225q0.040 0.030 0.235 0.195t0.295 0.255 0.3 0.275 0.345 0.33 0.33 0.355 0.345 0.42q1.33 1.74 1.62 2.71 0.29-0.97 1.62-2.71 0.16-0.21 0.345-0.42t0.33-0.355 0.345-0.33 0.3-0.275 0.295-0.255 0.235-0.195q1.13-0.98 1.83-2.225t0.7-2.665q0-1.63-0.805-3.010t-2.185-2.185-3.010-0.805zM10 4.56q1.42 0 2.43 1.010t1.010 2.43-1.010 2.43-2.43 1.010-2.43-1.010-1.010-2.43 1.010-2.43 2.43-1.010z';
			endif;
			
			// Init HTML rendering
			$html = '';

			// Marker images		
			$wordcamp_marker_image = plugin_dir_url( __FILE__ ) . 'images/wordcamp_marker.svg';
			$meetup_marker_image =  plugin_dir_url( __FILE__ ) . 'images/meetup_marker.svg';
			
			// Get upcoming WordCamps
			$upcoming_wordcamps = wpce_get_wordcamps();

			// Init JS array for markers
			$html .= '<script>var markers = new Array();</script>';

			// Get upcoming Meetups
			$upcoming_meetups = wpce_get_meetups();

			// Init JS array for Meetups
			if ( $upcoming_meetups && $display_meetups ) :
				$count_meetups = 0;
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
						$titleAndDate = $title . ' – ' . $dateStart;
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
							"title": ' . json_encode($titleAndDate) . ',
							"eventURL": ' . json_encode($url) . ',
							"selectable": true,
							"latitude": ' . $lat . ',
							"longitude": ' . $lng . ',
							"svgPath": "' . $meetup_marker_svg_path . '",
							"scale": 1,
							"color": "' . $meetup_marker_color . '",
							"zoomLevel": 6,
						});
						';
					endif;
					$count_meetups++;
				endforeach;
				$html .= '</script>';
			endif;

			// Init JS array for WordCamps
			if ( $upcoming_wordcamps && $display_wordcamps ) :
				$count_wordcamps = 0;
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
					$titleAndDate = $title . ' – ' . $dateStart;
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
						"title": ' . json_encode($titleAndDate) . ',
						"eventURL": ' . json_encode($url) . ',
						"selectable": true,
						"latitude": ' . $lat . ',
						"longitude": ' . $lng . ',
						"svgPath": "' . $wordcamp_marker_svg_path . '",
						"scale": 1,
						"color": "' . $wordcamp_marker_color . '",
						"zoomLevel": 6,
					});
					';
					$count_wordcamps++;
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
							"color": "' . $wpce_countries_color . '"
						});
					';
				endforeach;
			endif;			
			
			// Legend datas
			if ($display_wordcamps && $display_meetups) :
				$html .= '
				var mapLegendDatas = [
					{
						"title": "WordCamps (' . $count_wordcamps . ')",
						"color": "' . $wordcamp_marker_color . '"
					}, {
						"title": "Meetups (' . $count_meetups . ')",
						"color": "' . $meetup_marker_color . '"
					}
				]
				';
			elseif ($display_wordcamps) :
				$html .= '
				var mapLegendDatas = [
					{
						"title": "WordCamps (' . $count_wordcamps . ')",
						"color": "' . $wordcamp_marker_color . '"
					}
				]
				';
			elseif ($display_meetups) :
				$html .= '
				var mapLegendDatas = [
					{
						"title": "Meetups (' . $count_meetups . ')",
						"color": "' . $meetup_marker_color . '"
					}
				]
				';
			endif;

			$html .= '</script>';

			// Map container
			$html .= '<div class="wpce_map_wrapper"><div id="wpce_map" class="wpce_map" style="height:'.$wpce_map_height.'px;"></div><div class="wpce_event_infos"><a href="#" class="wpce_event_link" target="_blank" title="This link will open a new window"><span class="wpce_event_name"></span> [➚]</a></div></div>';
			
			// Send HTML datas
			return $html;
		}
	
		add_shortcode( 'wpce', 'wpce_shortcode_display' );
	
	}
	add_action('init', 'wpce_shortcode_init');