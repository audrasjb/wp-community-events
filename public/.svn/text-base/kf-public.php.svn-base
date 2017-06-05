<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @author     audrasjb <audrasjb@gmail.com>
 * @since      1.0.0
 *
 * @package    kf
 * @subpackage kf/public
 */

	add_action( 'wp_footer', 'kf_show_it', 200 );
	function kf_show_it() {
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
							if (jQuery(this).parent(".keyfigure_bloc").hasClass("keyfigure_bloc_type_number")) {
								' . $textPositionJS_Size . '
								keyFigures.push(0);
								' . $textPositionJS_Order . '
								var counterFinalValue = jQuery(this).text();
								jQuery(this).attr("data-value", counterFinalValue);
								jQuery(this).css("width", jQuery(this).width()+"px");
							}
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
	}
