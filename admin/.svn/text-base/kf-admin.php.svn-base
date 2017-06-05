<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @author     audrasjb <audrasjb@gmail.com>
 * @since      1.0
 *
 * @package    kf
 * @subpackage kf/admin
 */

/**
 *
 * Plugin options in appearance section
 *
 */

// Enqueue styles
add_action( 'admin_enqueue_scripts', 'enqueue_styles_key_figures_admin' );
function enqueue_styles_key_figures_admin() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'kf-admin-styles', plugin_dir_url( __FILE__ ) . 'css/kf-admin.css', array(), '', 'all' );
	add_editor_style( plugin_dir_url( __FILE__ ) . 'css/kf-admin-editor.css' );
}
	
// Enqueue scripts
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_key_figures_admin' );
function enqueue_scripts_key_figures_admin() {
	wp_enqueue_script( 'kf-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/kf-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
}	

add_action( 'admin_menu', 'kf_add_admin_menu' );
add_action( 'admin_init', 'kf_settings_init' );


function kf_add_admin_menu(  ) { 

	add_options_page( __('Key Figures settings', 'key-figures'), __('Key figures', 'key-figures'), 'manage_options', 'key-figures', 'kf_options_page' );

}


function kf_settings_init(  ) { 

	register_setting( 'key_figures_page', 'kf_settings' );

	// Figures section
	add_settings_section(
		'kf_key_figures_page_section_figures', 
		__( 'Figures settings', 'key-figures' ), 
		'kf_settings_section_figures_callback', 
		'key_figures_page'
	);

	// Default figure color
	add_settings_field( 
		'kf_field_figure_default_color', 
		__( 'Figures color', 'key-figures' ), 
		'kf_field_figure_default_color_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_figures' 
	);

	// Default figure size
	add_settings_field( 
		'kf_field_figure_default_size', 
		__( 'Figures size', 'key-figures' ), 
		'kf_field_figure_default_size_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_figures' 
	);

	// Default figure animation
	add_settings_field( 
		'kf_field_figure_default_animation', 
		__( 'Figures animation type', 'key-figures' ), 
		'kf_field_figure_default_animation_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_figures' 
	);

	// Default figure size
	add_settings_field( 
		'kf_field_figure_default_animation_duration', 
		__( 'Animation duration', 'key-figures' ), 
		'kf_field_figure_default_animation_duration_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_figures' 
	);
	
	// Text section
	add_settings_section(
		'kf_key_figures_page_section_text', 
		__( 'Text settings', 'key-figures' ), 
		'kf_settings_section_text_callback', 
		'key_figures_page'
	);

	// Default text position
	add_settings_field( 
		'kf_field_text_default_position', 
		__( 'Text position', 'key-figures' ), 
		'kf_field_text_default_position_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_text' 
	);

	// Default text color
	add_settings_field( 
		'kf_field_text_default_color', 
		__( 'Text color', 'key-figures' ), 
		'kf_field_text_default_color_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_text' 
	);

	// Default text size
	add_settings_field( 
		'kf_field_text_default_size', 
		__( 'Text size', 'key-figures' ), 
		'kf_field_text_default_size_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_text' 
	);

	// Box section
	add_settings_section(
		'kf_key_figures_page_section_box', 
		__( 'Box settings', 'key-figures' ), 
		'kf_settings_section_box_callback', 
		'key_figures_page'
	);

	// Default background color
	add_settings_field( 
		'kf_field_box_default_bgcolor', 
		__( 'Background color', 'key-figures' ), 
		'kf_field_box_default_bgcolor_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

	// Default width
	add_settings_field( 
		'kf_field_box_default_width', 
		__( 'Width', 'key-figures' ), 
		'kf_field_box_default_width_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

	// Default floating behaviour
	add_settings_field( 
		'kf_field_box_default_align', 
		__( 'Box alignment', 'key-figures' ), 
		'kf_field_box_default_align_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

	// Default border settings
	add_settings_field( 
		'kf_field_box_default_border', 
		__( 'Border color', 'key-figures' ), 
		'kf_field_box_default_border_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

	// Default border radius settings
	add_settings_field( 
		'kf_field_box_default_border_radius', 
		__( 'Border radius', 'key-figures' ), 
		'kf_field_box_default_border_radius_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

	// Default box padding
	add_settings_field( 
		'kf_field_box_default_padding', 
		__( 'Padding', 'key-figures' ), 
		'kf_field_box_default_padding_render', 
		'key_figures_page', 
		'kf_key_figures_page_section_box' 
	);

}


function kf_field_figure_default_color_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_color'])) {
		$optionFigureDefaultColor = $options['kf_field_figure_default_color'];
	} else {
		$optionFigureDefaultColor = '';		
	}
	?>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_figure_default_color]" value="<?php echo $optionFigureDefaultColor; ?>" />
	<?php
}


function kf_field_figure_default_size_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_size'])) {
		$optionFigureDefaultSize = $options['kf_field_figure_default_size'];
	} else {
		$optionFigureDefaultSize = '';		
	}
	?>
	<input type="number" class="small-text" name="kf_settings[kf_field_figure_default_size]" value="<?php echo $optionFigureDefaultSize; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<?php
}


function kf_field_figure_default_animation_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_animation'])) {
		$optionFigureAnimationDefault = $options['kf_field_figure_default_animation'];
	} else {
		$optionFigureAnimationDefault = 'none';		
	}
	?>
	<select name='kf_settings[kf_field_figure_default_animation]'>
		<option value="none" <?php selected( $optionFigureAnimationDefault, 'none' ); ?>><?php echo __('No animation', 'key-figures'); ?></option>
		<option value="counter" <?php selected( $optionFigureAnimationDefault, 'counter' ); ?>><?php echo __('Counter', 'key-figures'); ?></option>
		<option value="fadein" <?php selected( $optionFigureAnimationDefault, 'fadein' ); ?>><?php echo __('Fade in', 'key-figures'); ?></option>
	</select>
	<span class="description"><?php echo __('Please note that counting animation only works with numbers. Use "." separator for floating numbers.', 'key-figures'); ?></span>
<?php
}


function kf_field_figure_default_animation_duration_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_animation_duration'])) {
		$optionFigureDefaultAnimationDuration = $options['kf_field_figure_default_animation_duration'];
	} else {
		$optionFigureDefaultAnimationDuration = '1500';		
	}
	?>
	<input type="number" class="small-text" name="kf_settings[kf_field_figure_default_animation_duration]" value="<?php echo $optionFigureDefaultAnimationDuration; ?>" />
	<span class="description"><?php echo __('If you selected an animation type below, you can choose it’s duration in milliseconds (1 second = 1000 milliseconds)', 'key-figures'); ?></span>
	<?php
}


function kf_field_text_default_position_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_text_default_position'])) {
		$optionTextPositionDefault = $options['kf_field_text_default_position'];
	} else {
		$optionTextPositionDefault = 'right';		
	}
	?>
	<select name='kf_settings[kf_field_text_default_position]'>
		<option value="top" <?php selected( $optionTextPositionDefault, 'top' ); ?>><?php echo __('Top', 'key-figures'); ?></option>
		<option value="right" <?php selected( $optionTextPositionDefault, 'right' ); ?>><?php echo __('Right', 'key-figures'); ?></option>
		<option value="bottom" <?php selected( $optionTextPositionDefault, 'bottom' ); ?>><?php echo __('Bottom', 'key-figures'); ?></option>
		<option value="left" <?php selected( $optionTextPositionDefault, 'left' ); ?>><?php echo __('Left', 'key-figures'); ?></option>
	</select>
<?php
}


function kf_field_text_default_color_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_text_default_color'])) {
		$optionTextDefaultColor = $options['kf_field_text_default_color'];
	} else {
		$optionTextDefaultColor = '';		
	}
	?>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_text_default_color]" value="<?php echo $optionTextDefaultColor; ?>" />
	<?php
}


function kf_field_text_default_size_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_text_default_size'])) {
		$optionTextDefaultSize = $options['kf_field_text_default_size'];
	} else {
		$optionTextDefaultSize = '';		
	}
	?>
	<input type="number" class="small-text" name="kf_settings[kf_field_text_default_size]" value="<?php echo $optionTextDefaultSize; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<?php
}

function kf_field_box_default_bgcolor_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_bgcolor'])) {
		$optionBoxDefaultBgColor = $options['kf_field_box_default_bgcolor'];
	} else {
		$optionBoxDefaultBgColor = '';		
	}
	?>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_box_default_bgcolor]" value="<?php echo $optionBoxDefaultBgColor; ?>" />
	<?php
}

function kf_field_box_default_width_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_width'])) {
		$optionBoxDefaultWidth = $options['kf_field_box_default_width'];
	} else {
		$optionBoxDefaultWidth = 'auto';		
	}
	?>
	<select name='kf_settings[kf_field_box_default_width]'>
		<option value="auto" <?php selected( $optionBoxDefaultWidth, 'auto' ); ?>><?php echo __('Auto (fit to content – recommended in most cases)', 'key-figures'); ?></option>
		<option value="25%" <?php selected( $optionBoxDefaultWidth, '25%' ); ?>><?php echo __('25% of parent container', 'key-figures'); ?></option>
		<option value="33%" <?php selected( $optionBoxDefaultWidth, '33%' ); ?>><?php echo __('33% of parent container', 'key-figures'); ?></option>
		<option value="50%" <?php selected( $optionBoxDefaultWidth, '50%' ); ?>><?php echo __('50% of parent container', 'key-figures'); ?></option>
		<option value="75%" <?php selected( $optionBoxDefaultWidth, '75%' ); ?>><?php echo __('75% of parent container', 'key-figures'); ?></option>
		<option value="100%" <?php selected( $optionBoxDefaultWidth, '100%' ); ?>><?php echo __('100% of parent container', 'key-figures'); ?></option>
	</select>
	<p><span class="description"><?php echo __('Note: percents are relative to the container width. Please note that if you select <em>100% of parent container</em>, you should set paddings to <code>0</code> to prevent container overstepping.', 'key-figures'); ?></span></p>
<?php
}

function kf_field_box_default_align_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_align'])) {
		$optionBoxDefaultAlign = $options['kf_field_box_default_align'];
	} else {
		$optionBoxDefaultAlign = 'left';		
	}
	?>
	<select name='kf_settings[kf_field_box_default_align]'>
		<option value="left" <?php selected( $optionBoxDefaultAlign, 'left' ); ?>><?php echo __('Left and cleared', 'key-figures'); ?></option>
		<option value="right" <?php selected( $optionBoxDefaultAlign, 'right' ); ?>><?php echo __('Right and cleared', 'key-figures'); ?></option>
		<option value="center" <?php selected( $optionBoxDefaultAlign, 'center' ); ?>><?php echo __('Center', 'key-figures'); ?></option>
		<option value="floatleft" <?php selected( $optionBoxDefaultAlign, 'floatleft' ); ?>><?php echo __('Floating on the left', 'key-figures'); ?></option>
		<option value="floatright" <?php selected( $optionBoxDefaultAlign, 'floatright' ); ?>><?php echo __('Floating on the right', 'key-figures'); ?></option>
	</select>
<?php
}

function kf_field_box_default_border_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_border_top_color'])) {
		$optionBoxDefaultBorderTopColor = $options['kf_field_box_default_border_top_color'];
	} else {
		$optionBoxDefaultBorderTopColor = '';		
	}
	if (isset($options['kf_field_box_default_border_top_thickness'])) {
		$optionBoxDefaultBorderTopThickness = $options['kf_field_box_default_border_top_thickness'];
	} else {
		$optionBoxDefaultBorderTopThickness = '';		
	}
	if (isset($options['kf_field_box_default_border_right_color'])) {
		$optionBoxDefaultBorderRightColor = $options['kf_field_box_default_border_right_color'];
	} else {
		$optionBoxDefaultBorderRightColor = '';		
	}
	if (isset($options['kf_field_box_default_border_right_thickness'])) {
		$optionBoxDefaultBorderRightThickness = $options['kf_field_box_default_border_right_thickness'];
	} else {
		$optionBoxDefaultBorderRightThickness = '';		
	}
	if (isset($options['kf_field_box_default_border_bottom_color'])) {
		$optionBoxDefaultBorderBottomColor = $options['kf_field_box_default_border_bottom_color'];
	} else {
		$optionBoxDefaultBorderBottomColor = '';		
	}
	if (isset($options['kf_field_box_default_border_bottom_thickness'])) {
		$optionBoxDefaultBorderBottomThickness = $options['kf_field_box_default_border_bottom_thickness'];
	} else {
		$optionBoxDefaultBorderBottomThickness = '';		
	}
	if (isset($options['kf_field_box_default_border_left_color'])) {
		$optionBoxDefaultBorderLeftColor = $options['kf_field_box_default_border_left_color'];
	} else {
		$optionBoxDefaultBorderLeftColor = '';		
	}
	if (isset($options['kf_field_box_default_border_left_thickness'])) {
		$optionBoxDefaultBorderLeftThickness = $options['kf_field_box_default_border_left_thickness'];
	} else {
		$optionBoxDefaultBorderLeftThickness = '';		
	}
	?>
	<span class="description" style="display:inline-block;width: 60px;position: relative;top: -8px;"><?php echo __('Top:', 'key-figures'); ?> </span>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_box_default_border_top_color]" value="<?php echo $optionBoxDefaultBorderTopColor; ?>" />
	<span class="description" style="display:inline-block;padding-left: 2em;position: relative;top: -8px;"><?php echo __('Thickness:', 'key-figures'); ?> </span>
	<input type="number" style="position:relative;top:-8px;" class="small-text" name="kf_settings[kf_field_box_default_border_top_thickness]" value="<?php echo $optionBoxDefaultBorderTopThickness; ?>" />
	<span class="description" style="position:relative;top:-8px;"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<br />

	<span class="description" style="display:inline-block;width: 60px;position: relative;top: -8px;"><?php echo __('Right:', 'key-figures'); ?> </span>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_box_default_border_right_color]" value="<?php echo $optionBoxDefaultBorderRightColor; ?>" />
	<span class="description" style="display:inline-block;padding-left: 2em;position: relative;top: -8px;"><?php echo __('Thickness:', 'key-figures'); ?> </span>
	<input type="number" style="position:relative;top:-8px;" class="small-text" name="kf_settings[kf_field_box_default_border_right_thickness]" value="<?php echo $optionBoxDefaultBorderRightThickness; ?>" />
	<span class="description" style="position:relative;top:-8px;"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<br />

	<span class="description" style="display:inline-block;width: 60px;position: relative;top: -8px;"><?php echo __('Bottom:', 'key-figures'); ?> </span>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_box_default_border_bottom_color]" value="<?php echo $optionBoxDefaultBorderBottomColor; ?>" />
	<span class="description" style="display:inline-block;padding-left: 2em;position: relative;top: -8px;"><?php echo __('Thickness:', 'key-figures'); ?> </span>
	<input type="number" style="position:relative;top:-8px;" class="small-text" name="kf_settings[kf_field_box_default_border_bottom_thickness]" value="<?php echo $optionBoxDefaultBorderBottomThickness; ?>" />
	<span class="description" style="position:relative;top:-8px;"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<br />

	<span class="description" style="display:inline-block;width: 60px;position: relative;top: -8px;"><?php echo __('Left:', 'key-figures'); ?> </span>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_box_default_border_left_color]" value="<?php echo $optionBoxDefaultBorderLeftColor; ?>" />
	<span class="description" style="display:inline-block;padding-left: 2em;position: relative;top: -8px;"><?php echo __('Thickness:', 'key-figures'); ?> </span>
	<input type="number" style="position:relative;top:-8px;" class="small-text" name="kf_settings[kf_field_box_default_border_left_thickness]" value="<?php echo $optionBoxDefaultBorderLeftThickness; ?>" />
	<span class="description" style="position:relative;top:-8px;"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<?php
}

function kf_field_box_default_border_radius_render(  ) {
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_radius_topleft'])) {
		$optionBoxDefaultRadiusTopLeft = $options['kf_field_box_default_radius_topleft'];
	} else {
		$optionBoxDefaultRadiusTopLeft = '';		
	}
	if (isset($options['kf_field_box_default_radius_topright'])) {
		$optionBoxDefaultRadiusTopRight = $options['kf_field_box_default_radius_topright'];
	} else {
		$optionBoxDefaultRadiusTopRight = '';		
	}
	if (isset($options['kf_field_box_default_radius_bottomright'])) {
		$optionBoxDefaultRadiusBottomRight = $options['kf_field_box_default_radius_bottomright'];
	} else {
		$optionBoxDefaultRadiusBottomRight = '';		
	}
	if (isset($options['kf_field_box_default_radius_bottomleft'])) {
		$optionBoxDefaultRadiusBottomLeft = $options['kf_field_box_default_radius_bottomleft'];
	} else {
		$optionBoxDefaultRadiusBottomLeft = '';		
	}
	?>
	<span class="description" style="display:inline-block;width: 100px;"><?php echo __('Top left:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_radius_topleft]" value="<?php echo $optionBoxDefaultRadiusTopLeft; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 100px;"><?php echo __('Top Right:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_radius_topright]" value="<?php echo $optionBoxDefaultRadiusTopRight; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 100px;"><?php echo __('Bottom right:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_radius_bottomright]" value="<?php echo $optionBoxDefaultRadiusBottomRight; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 100px;"><?php echo __('Bottom left:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_radius_bottomleft]" value="<?php echo $optionBoxDefaultRadiusBottomLeft; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />
	<br />
	<span class="description"><?php echo __('Note: the border-radius property works even better if there is no border but a background color is needed to see it in action. If you want a perfect circle, you need to set equal width and height sizes (select "fit width to content" and "fit width to height" options below for better rendering).', 'key-figures'); ?></span>
	<?php
}

function kf_field_box_default_padding_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_box_default_padding_top'])) {
		$optionBoxDefaultPaddingTop = $options['kf_field_box_default_padding_top'];
	} else {
		$optionBoxDefaultPaddingTop = '';		
	}
	if (isset($options['kf_field_box_default_padding_right'])) {
		$optionBoxDefaultPaddingRight = $options['kf_field_box_default_padding_right'];
	} else {
		$optionBoxDefaultPaddingRight = '';		
	}
	if (isset($options['kf_field_box_default_padding_bottom'])) {
		$optionBoxDefaultPaddingBottom = $options['kf_field_box_default_padding_bottom'];
	} else {
		$optionBoxDefaultPaddingBottom = '';		
	}
	if (isset($options['kf_field_box_default_padding_left'])) {
		$optionBoxDefaultPaddingLeft = $options['kf_field_box_default_padding_left'];
	} else {
		$optionBoxDefaultPaddingLeft = '';		
	}
	?>
	<span class="description" style="display:inline-block;width: 60px;"><?php echo __('Top:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_padding_top]" value="<?php echo $optionBoxDefaultPaddingTop; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 60px;"><?php echo __('Right:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_padding_right]" value="<?php echo $optionBoxDefaultPaddingRight; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 60px;"><?php echo __('Bottom:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_padding_bottom]" value="<?php echo $optionBoxDefaultPaddingBottom; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />

	<span class="description" style="display:inline-block;width: 60px;"><?php echo __('Left:', 'key-figures'); ?> </span>
	<input type="number" class="small-text" name="kf_settings[kf_field_box_default_padding_left]" value="<?php echo $optionBoxDefaultPaddingLeft; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span><br />
	<br />
	<span class="description"><?php echo __('Note: paddings are spaces between the box and it’s content.', 'key-figures'); ?></span>
	<?php
}


function kf_settings_section_callback(  ) { 
	echo '<hr />';
}

function kf_settings_section_figures_callback(  ) { 
	echo '<hr />';
}

function kf_settings_section_text_callback(  ) { 
	echo '<hr />';
}

function kf_settings_section_box_callback(  ) { 
	echo '<hr />';
}


function kf_options_page(  ) { 

	?>
	<div class="wrap">
		<h1><?php echo __('Key figures settings', 'key-figures'); ?></h1>
		<p><?php echo __('Manage <em>key figures</em> settings below.', 'key-figures'); ?></p>

		<form action='options.php' method='post'>
		
		<?php
		settings_fields( 'key_figures_page' );
		do_settings_sections( 'key_figures_page' );
		
		echo '<hr />';
		
		submit_button();
		?>
		
		</form>
		
		<hr />
		
<?php
		if ( get_option( 'kf_settings' ) ) {
			$kfSettings = get_option( 'kf_settings' );
			
			if (isset($kfSettings['kf_field_figure_default_color'])) :
				$optionFigureDefaultColor = $kfSettings['kf_field_figure_default_color'];
				if ($optionFigureDefaultColor) : 
					$optionFigureColor = $optionFigureDefaultColor;
				else : 
					$optionFigureColor = "#333";				
				endif;
			else : 
				$optionFigureColor = "#333";				
			endif;
			
			if (isset($kfSettings['kf_field_figure_default_size'])) :
				$optionFigureDefaultSize = $kfSettings['kf_field_figure_default_size'];
				if ($optionFigureDefaultSize) : 
					$optionFigureSize = $optionFigureDefaultSize;
				else : 
					$optionFigureSize = "50";				
				endif;
			else:
				$optionFigureSize = "50";				
			endif;
			
			if (isset($kfSettings['kf_field_figure_default_animation'])) :
				$optionFigureAnimationDefault = $kfSettings['kf_field_figure_default_animation'];
				if ($optionFigureAnimationDefault) : 
					$optionFigureAnimation = $optionFigureAnimationDefault;
					else : 
					$optionFigureAnimation = "none";				
				endif; 
			else : 
				$optionFigureAnimation = "none";				
			endif;

			if (isset($kfSettings['kf_field_figure_default_animation_duration'])) :
				$optionFigureAnimationDurationDefault = $kfSettings['kf_field_figure_default_animation_duration'];
				if ($optionFigureAnimationDurationDefault) : 
					$optionFigureAnimationDuration = $optionFigureAnimationDurationDefault;
					else : 
					$optionFigureAnimationDuration = "1500";				
				endif; 
			else : 
				$optionFigureAnimationDuration = "1500";				
			endif;

			if (isset($kfSettings['kf_field_text_default_position'])) :
				$optionTextDefaultPosition = $kfSettings['kf_field_text_default_position'];
				if ($optionTextDefaultPosition) : 
					$optionTextPosition = $optionTextDefaultPosition;
				else : 
					$optionTextPosition = "right";				
				endif; 
			else : 
				$optionTextPosition = "right";				
			endif;
			
			if (isset($kfSettings['kf_field_text_default_color'])) :
				$optionTextDefaultColor = $kfSettings['kf_field_text_default_color'];
				if ($optionFigureDefaultColor) : 
					$optionTextColor = $optionTextDefaultColor;
				else : 
					$optionTextColor = "#333";				
				endif; 
			else : 
				$optionTextColor = "#333";				
			endif;
			
			if (isset($kfSettings['kf_field_text_default_size'])) :
				$optionTextDefaultSize = $kfSettings['kf_field_text_default_size'];
				if ($optionFigureDefaultSize) : 
					$optionTextSize = $optionTextDefaultSize;
				else : 
					$optionTextSize = "18";				
				endif; 
			else : 
				$optionTextSize = "18";				
			endif;

			if (isset($kfSettings['kf_field_box_default_bgcolor'])) :
				$optionBoxDefaultBgColor = $kfSettings['kf_field_box_default_bgcolor'];
				if ($optionBoxDefaultBgColor) : 
					$optionBoxBgColor = $optionBoxDefaultBgColor;
				else : 
					$optionBoxBgColor = "#fff";				
				endif; 
			else : 
				$optionBoxBgColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_width'])) :
				$optionBoxDefaultWidth = $kfSettings['kf_field_box_default_width'];
				if ($optionBoxDefaultWidth) : 
					$optionBoxtWidth = $optionBoxDefaultWidth;
				else : 
					$optionBoxtWidth = "auto";				
				endif; 
			else : 
				$optionBoxtWidth = "auto";				
			endif;

			if (isset($kfSettings['kf_field_box_default_align'])) :
				$optionBoxDefaultAlign = $kfSettings['kf_field_box_default_align'];
				if ($optionBoxDefaultAlign) : 
					$optionBoxAlign = $optionBoxDefaultAlign;
				else : 
					$optionBoxAlign = "left";				
				endif; 
			else : 
				$optionBoxAlign = "left";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_top_color'])) :
				$optionBoxDefaultBorderTopColor = $kfSettings['kf_field_box_default_border_top_color'];
				if ($optionBoxDefaultBorderTopColor) : 
					$optionBoxBorderTopColor = $optionBoxDefaultBorderTopColor;
				else : 
					$optionBoxBorderTopColor = "#fff";				
				endif; 
			else : 
				$optionBoxBorderTopColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_right_color'])) :
				$optionBoxDefaultBorderRightColor = $kfSettings['kf_field_box_default_border_right_color'];
				if ($optionBoxDefaultBorderRightColor) : 
					$optionBoxBorderRightColor = $optionBoxDefaultBorderRightColor;
				else : 
					$optionBoxBorderRightColor = "#fff";				
				endif; 
			else : 
				$optionBoxBorderRightColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_bottom_color'])) :
				$optionBoxDefaultBorderBottomColor = $kfSettings['kf_field_box_default_border_bottom_color'];
				if ($optionBoxDefaultBorderBottomColor) : 
					$optionBoxBorderBottomColor = $optionBoxDefaultBorderBottomColor;
				else : 
					$optionBoxBorderBottomColor = "#fff";				
				endif; 
			else : 
				$optionBoxBorderBottomColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_left_color'])) :
				$optionBoxDefaultBorderLeftColor = $kfSettings['kf_field_box_default_border_left_color'];
				if ($optionBoxDefaultBorderLeftColor) : 
					$optionBoxBorderLeftColor = $optionBoxDefaultBorderLeftColor;
				else : 
					$optionBoxBorderLeftColor = "#fff";				
				endif; 
			else : 
				$optionBoxBorderLeftColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_top_thickness'])) :
				$optionBoxDefaultBorderTopThickness = $kfSettings['kf_field_box_default_border_top_thickness'];
				if ($optionBoxDefaultBorderTopThickness) : 
					$optionBoxBorderTopThickness = $optionBoxDefaultBorderTopThickness . 'px';
				else : 
					$optionBoxBorderTopThickness = "0px";				
				endif; 
			else : 
				$optionBoxBorderTopThickness = "0px";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_right_thickness'])) :
				$optionBoxDefaultBorderRightThickness = $kfSettings['kf_field_box_default_border_right_thickness'];
				if ($optionBoxDefaultBorderRightThickness) : 
					$optionBoxBorderRightThickness = $optionBoxDefaultBorderRightThickness . 'px';
				else : 
					$optionBoxBorderRightThickness = "0px";				
				endif; 
			else : 
				$optionBoxBorderRightThickness = "0px";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_bottom_thickness'])) :
				$optionBoxDefaultBorderBottomThickness = $kfSettings['kf_field_box_default_border_bottom_thickness'];
				if ($optionBoxDefaultBorderBottomThickness) : 
					$optionBoxBorderBottomThickness = $optionBoxDefaultBorderBottomThickness . 'px';
				else : 
					$optionBoxBorderBottomThickness = "0px";				
				endif; 
			else : 
				$optionBoxBorderBottomThickness = "0px";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_left_thickness'])) :
				$optionBoxDefaultBorderLeftThickness = $kfSettings['kf_field_box_default_border_left_thickness'];
				if ($optionBoxDefaultBorderLeftThickness) : 
					$optionBoxBorderLeftThickness = $optionBoxDefaultBorderLeftThickness . 'px';
				else : 
					$optionBoxBorderLeftThickness = "0px";				
				endif; 
			else : 
				$optionBoxBorderLeftThickness = "0px";				
			endif;

			if (isset($kfSettings['kf_field_box_default_radius_topleft'])) :
				$optionBoxDefaultRadiusTopLeft = $kfSettings['kf_field_box_default_radius_topleft'];
				if ($optionBoxDefaultRadiusTopLeft) : 
					$optionBoxRadiusTopLeft = $optionBoxDefaultRadiusTopLeft . 'px';
				else : 
					$optionBoxRadiusTopLeft = "0";				
				endif; 
			else : 
				$optionBoxRadiusTopLeft = "0";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_radius_topright'])) :
				$optionBoxDefaultRadiusTopRight = $kfSettings['kf_field_box_default_radius_topright'];
				if ($optionBoxDefaultRadiusTopRight) : 
					$optionBoxRadiusTopRight = $optionBoxDefaultRadiusTopRight . 'px';
				else : 
					$optionBoxRadiusTopRight = "0";				
				endif; 
			else : 
				$optionBoxRadiusTopRight = "0";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_radius_bottomright'])) :
				$optionBoxDefaultRadiusBottomRight = $kfSettings['kf_field_box_default_radius_bottomright'];
				if ($optionBoxDefaultRadiusBottomRight) : 
					$optionBoxRadiusBottomRight = $optionBoxDefaultRadiusBottomRight . 'px';
				else : 
					$optionBoxRadiusBottomRight = "0";				
				endif; 
			else : 
				$optionBoxRadiusBottomRight = "0";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_radius_bottomleft'])) :
				$optionBoxDefaultRadiusBottomLeft = $kfSettings['kf_field_box_default_radius_bottomleft'];
				if ($optionBoxDefaultRadiusBottomLeft) : 
					$optionBoxRadiusBottomLeft = $optionBoxDefaultRadiusBottomLeft . 'px';
				else : 
					$optionBoxRadiusBottomLeft = "0";				
				endif; 
			else : 
				$optionBoxRadiusBottomLeft = "0";				
			endif;

			if (isset($kfSettings['kf_field_box_default_padding_top'])) :
				$optionBoxDefaultPaddingTop = $kfSettings['kf_field_box_default_padding_top'];
				if ($optionBoxDefaultPaddingTop) : 
					$optionBoxPaddingTop = $optionBoxDefaultPaddingTop . 'px';
				else : 
					$optionBoxPaddingTop = "5px";				
				endif; 
			else : 
				$optionBoxPaddingTop = "5px";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_padding_right'])) :
				$optionBoxDefaultPaddingRight = $kfSettings['kf_field_box_default_padding_right'];
				if ($optionBoxDefaultPaddingRight) : 
					$optionBoxPaddingRight = $optionBoxDefaultPaddingRight . 'px';
				else : 
					$optionBoxPaddingRight = "10px";				
				endif; 
			else : 
				$optionBoxPaddingRight = "10px";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_padding_bottom'])) :
				$optionBoxDefaultPaddingBottom = $kfSettings['kf_field_box_default_padding_bottom'];
				if ($optionBoxDefaultPaddingBottom) : 
					$optionBoxPaddingBottom = $optionBoxDefaultPaddingBottom . 'px';
				else : 
					$optionBoxPaddingBottom = "5px";				
				endif; 
			else : 
				$optionBoxPaddingBottom = "5px";				
			endif;
			
			if (isset($kfSettings['kf_field_box_default_padding_left'])) :
				$optionBoxDefaultPaddingLeft = $kfSettings['kf_field_box_default_padding_left'];
				if ($optionBoxDefaultPaddingLeft) : 
					$optionBoxPaddingLeft = $optionBoxDefaultPaddingLeft . 'px';
				else : 
					$optionBoxPaddingLeft = "10px";				
				endif; 
			else : 
				$optionBoxPaddingLeft = "10px";				
			endif;

			// Text Position and corresponding CSS/JS
			if ($optionTextPosition == 'top') :
				$textPositionCSS_Block = 'display:inline-block; text-align:center';
				$textPositionCSS_Figure = 'display:block';
				$textPositionCSS_Text = 'display:block';
				$textPositionJS_Order = 'var KFelements = jQuery(this).parent(); var KFordered = KFelements.children("span"); KFelements.append(KFordered.get().reverse());';
				$textPositionJS_Size = '';
			elseif ($optionTextPosition == 'right') :
				$textPositionCSS_Block = 'display:table';
				$textPositionCSS_Figure = 'display:table-cell';
				$textPositionCSS_Text = 'display:table-cell; vertical-align: middle; padding-left: 1em';
				$textPositionJS_Order = '';
				$textPositionJS_Size = 'jQuery(this).css("width", jQuery(this).width());';
			elseif ($optionTextPosition == 'bottom') :
				$textPositionCSS_Block = 'display:inline-block; text-align:center';
				$textPositionCSS_Figure = 'display:block';
				$textPositionCSS_Text = 'display:block';
				$textPositionJS_Order = '';
				$textPositionJS_Size = '';
			elseif ($optionTextPosition == 'left') :
				$textPositionCSS_Block = 'display:table';
				$textPositionCSS_Figure = 'display:table-cell';
				$textPositionCSS_Text = 'display:table-cell; vertical-align: middle; padding-right: 1em';
				$textPositionJS_Order = 'var KFelements = jQuery(this).parent(); var KFordered = KFelements.children("span"); KFelements.append(KFordered.get().reverse());';
				$textPositionJS_Size = 'jQuery(this).css("width", jQuery(this).width());';
			endif;
			
			// Alignement and corresponding CSS
			if ($optionBoxAlign == 'left') :
				$alignCSS = '';
			elseif ($optionBoxAlign == 'right') : 
				$alignCSS = 'position:absolute;right:0';			
			elseif ($optionBoxAlign == 'center') :
				$alignCSS = 'display:inline-block;margin-left:50%;transform:translateX(-50%);';
			elseif ($optionBoxAlign == 'floatleft') : 
				$alignCSS = 'margin-right:2em;float:left';
			elseif ($optionBoxAlign == 'floatright') : 
				$alignCSS = 'margin-left:2em;float:right';
			endif;
			
			echo '<style>';
			echo '
			/**
			* Key Figures stylesheet
			*/
			.keyfigure_bloc {
				' . $textPositionCSS_Block . ';
				padding-top: ' . $optionBoxPaddingTop . ';
				padding-right: ' . $optionBoxPaddingRight . ';
				padding-bottom: ' . $optionBoxPaddingBottom . ';
				padding-left: ' . $optionBoxPaddingLeft . ';
				margin: 0;
				' . $alignCSS . ';
				background-color: ' . $optionBoxBgColor . ';
				border-top: ' . $optionBoxBorderTopThickness . ' solid ' . $optionBoxBorderTopColor . ';
				border-right: ' . $optionBoxBorderRightThickness . ' solid ' . $optionBoxBorderRightColor . ';
				border-bottom: ' . $optionBoxBorderBottomThickness . ' solid ' . $optionBoxBorderBottomColor . ';
				border-left: ' . $optionBoxBorderLeftThickness . ' solid ' . $optionBoxBorderLeftColor . ';
				border-top-left-radius: ' . $optionBoxRadiusTopLeft . ';
				border-top-right-radius: ' . $optionBoxRadiusTopRight . ';
				border-bottom-right-radius: ' . $optionBoxRadiusBottomRight . ';
				border-bottom-left-radius: ' . $optionBoxRadiusBottomLeft . ';
				width: ' . $optionBoxtWidth . ';
			}
			.keyfigure_bloc_figure {
				' . $textPositionCSS_Figure . ';
				vertical-align: middle;
				font-size: ' . $optionFigureSize . 'px;
				color: ' . $optionFigureColor . ';
			}
			.keyfigure_bloc_text {
				' . $textPositionCSS_Text . ';
				font-size: ' . $optionTextSize . 'px;
				color: ' . $optionTextColor . ';
			}
			';
			echo '</style>';
			if (isset($kfSettings['kf_field_figure_default_animation']) && $kfSettings['kf_field_figure_default_animation'] != 'none') :
				if ($optionFigureAnimation == "counter") :
				echo '
				<script>
				jQuery(window).load(function() {
					var keyFigures = new Array();
					jQuery(".keyfigure_bloc_figure").each(function() {
						' . $textPositionJS_Size . '
						keyFigures.push(0);
						' . $textPositionJS_Order . '
						var counterFinalValue = jQuery(this).text();
						jQuery(this).attr("data-value", counterFinalValue);
						jQuery(this).css("width", jQuery(this).width()+"px");
					});
					jQuery(window).scroll(function() {
						var i = 0;
						jQuery(".keyfigure_bloc_figure").each(function() {
							var oTop = jQuery(this).offset().top - window.innerHeight;
							if (keyFigures[i] == 0 && jQuery(window).scrollTop() > oTop) {
								var counter = jQuery(this);
								countTo = counter.children(this).attr("data-value");
								jQuery({
									countNum: 0
								}).animate({
									countNum: parseFloat(counter.text())
								}, {
									duration: ' . $optionFigureAnimationDuration . ',
									easing: "swing",
									step: function() {
										counter.text(Math.floor(this.countNum));
									},
									complete: function() {
										counter.text(this.countNum);
									}
								});
								keyFigures[i] = 1;
							}
							i++;
						});
					});
				});
				</script>
				';
				elseif ($optionFigureAnimation == 'fadein') :
				echo '
				<script>
				jQuery(window).load(function() {
					var keyFigures = new Array();
					jQuery(".keyfigure_bloc_figure").each(function() {
						jQuery(this).parent().hide();
						keyFigures.push(0);
					});
					jQuery(window).scroll(function() {
						var i = 0;
						jQuery(".keyfigure_bloc_figure").each(function() {
							var oTop = jQuery(this).offset().top - window.innerHeight;
							if (keyFigures[i] == 0 && jQuery(window).scrollTop() > oTop) {
								jQuery(this).parent().fadeIn(' . $optionFigureAnimationDuration . ');
								keyFigures[i] = 1;
							}
							i++;
						});
					});
				});
				</script>
				';
				endif ;		
			endif;
		}
	
?>
		<h2><?php echo __('Preview', 'key-figures'); ?></h2>
		<div style="background:#fff;padding:30px;">
			<p>Sed aliquet eleifend ipsum quis bibendum. Proin faucibus, dui id lobortis ullamcorper, est ligula vehicula lectus, vel fringilla elit nibh eget orci. Vestibulum eu odio eu elit aliquet mollis. Integer nec ligula et metus cursus elementum. Mauris posuere vestibulum placerat. Nunc ac elit mattis, facilisis ex et, rhoncus nisi.</p>
			<p>Nullam at diam laoreet, porttitor orci at, hendrerit justo. Morbi imperdiet ex eget vehicula fringilla. Phasellus ac ullamcorper risus. Quisque sed massa ante. Vivamus condimentum quam sed tempus fermentum. Sed in porttitor orci, id semper ex. Curabitur ultrices placerat metus id feugiat. Integer scelerisque quam a mauris pretium, nec pellentesque velit malesuada. Integer in interdum arcu. </p>
			<p>
				<span style="line-height:1.5em;" class="keyfigure_bloc" data-animation="none" data-figure="22">
					<span style="line-height:1.5em;" class="keyfigure_bloc_figure" data-value="22">22</span>
					<span style="line-height:1.5em;" class="keyfigure_bloc_text">october</span>
				</span>
			</p>
			<p>Sed aliquet eleifend ipsum quis bibendum. Proin faucibus, dui id lobortis ullamcorper, est ligula vehicula lectus, vel fringilla elit nibh eget orci. Vestibulum eu odio eu elit aliquet mollis. Integer nec ligula et metus cursus elementum. Mauris posuere vestibulum placerat. Nunc ac elit mattis, facilisis ex et, rhoncus nisi.</p>
			<p>Nullam at diam laoreet, porttitor orci at, hendrerit justo. Morbi imperdiet ex eget vehicula fringilla. Phasellus ac ullamcorper risus. Quisque sed massa ante. Vivamus condimentum quam sed tempus fermentum. Sed in porttitor orci, id semper ex. Curabitur ultrices placerat metus id feugiat. Integer scelerisque quam a mauris pretium, nec pellentesque velit malesuada. Integer in interdum arcu.</p>
		</div>
	</div>
	<?php

}

/**
 *
 * Plugin button in WordPress visual editor
 *
 */

class TinyMCE_KF {
	/**
	* Plugin constructor.
	*/
	function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array(  $this, 'setup_tinymce_kf' ) );
		}
	}
	/**
	* Check if the current user can edit Posts or Pages, and is using the Visual Editor
	* If so, add some filters
	*/
	function setup_tinymce_kf() {
		// Check if the logged in WordPress User can edit Posts or Pages
		// If not, don't register
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        	return;
		}

		// Check if the logged in WordPress User has the Visual Editor enabled
		// If not, don't register
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		// Setup filters
		add_action( 'plugins_loaded', 'load_languages_tinymce_kf' );
		add_action( 'before_wp_tiny_mce', array( &$this, 'translate_tinymce_kf' ) );
		add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_kf' ) );
		add_filter( 'mce_buttons_2', array( &$this, 'add_tinymce_kf_toolbar_button' ) );		
	}	

	/**
	* Adds the plugin to the TinyMCE / Visual Editor instance
	*	
	* @param array $plugin_array Array of registered TinyMCE Plugins
	* @return array Modified array of registered TinyMCE Plugins
	*/
	function add_tinymce_kf( $plugin_array ) {
		$plugin_array['tinymce_kf_class'] = plugin_dir_url( __FILE__ ) . 'js/tinymce-kf-class.js';
		return $plugin_array;
	}

	/**
	* Plugin's internationalization 
	*	
	* First load translation files
	* Then add translation strings to a javascript variable
	*/
	function load_languages_tinymce_kf() {
	    load_plugin_textdomain( 'key-figures', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
	// Adding i18n tinymce strings
	function translate_tinymce_kf() {
		if (isset($options['kf_field_figure_default_animation'])) {
			$optionFigureAnimationDefault = $options['kf_field_figure_default_animation'];
		} else {
			$optionFigureAnimationDefault = 'none';		
		}
		$translations = json_encode(
			array( 
				'kf_modal_title' 	=> __('Key figure', 'key-figures'),
				'kf_add_button' 	=> __('Key figure', 'key-figures'),
				'kf_delete_button' 	=> __('Delete figure', 'key-figures'),
				'kf_type_label' 	=> __('Type', 'key-figures'),
				'kf_type_help' 		=> __('Define your figure type (it’s allowed to use text instead of numbers, but let me know here please)', 'key-figures'),
				'kf_type_number' 	=> __('Number', 'key-figures'),
				'kf_type_text' 		=> __('Text', 'key-figures'),
				'kf_figure_label' 	=> __('Figure', 'key-figures'),
				'kf_figure_help' 	=> __('For floating number, please only use dots, e.g: "3.14"', 'key-figures'),
				'kf_text_label' 	=> __('Text', 'key-figures'),
				'kf_text_help' 		=> __('Enter text', 'key-figures'),
			)
		);
		echo '<script>var kfTranslations = ' . $translations . ';</script>';
	}

	/**
	* Adds a button to the TinyMCE / Visual Editor which the user can click
	* to insert the kf node tag.
	*
	* @param array $buttons Array of registered TinyMCE Buttons
	* @return array Modified array of registered TinyMCE Buttons
	*/
	function add_tinymce_kf_toolbar_button( $buttons ) {
		array_push( $buttons, 'tinymce_kf_class' );
		return $buttons;
	}
}
$TinyMCE_kf = new TinyMCE_KF;