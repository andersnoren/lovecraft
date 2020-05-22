<?php


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */

if ( ! class_exists( 'Lovecraft_Customize' ) ) : 
	class Lovecraft_Customize {

		public static function register( $wp_customize ) {

			// Add the theme options section
			$wp_customize->add_section( 'lovecraft_options', array(
				'title' 		=> __( 'Options for Lovecraft', 'lovecraft' ),
				'priority' 		=> 35,
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Allows you to customize theme settings for Lovecraft.', 'lovecraft' ),
			) );

			// Show sidebar on mobile setting
			$wp_customize->add_setting( 'lovecraft_show_sidebar_on_mobile', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'lovecraft_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'lovecraft_show_sidebar_on_mobile', array(
				'type' 			=> 'checkbox',
				'section' 		=> 'lovecraft_options',
				'label' 		=> __( 'Show Sidebar on Mobile', 'lovecraft' ),
				'description' 	=> __( 'Check to display the sidebar on mobile. It is hidden on mobile by default.', 'lovecraft' ),
			) );

			// Accent color setting
			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#CA2017',
				'type' 				=> 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lovecraft_accent_color', array(
				'label' 	=> __( 'Accent Color', 'lovecraft' ),
				'section' 	=> 'colors',
				'settings' 	=> 'accent_color',
				'priority' 	=> 10,
			) ) );

			// Only display the Customizer section for the lovecraft_logo setting if it already has a value.
			// This means that site owners with existing logos can remove them, but new site owners can't add them.
			// Since v2.0.0, the core custom_logo setting (in the Site Identity Customizer panel) should be used instead.
			if ( get_theme_mod( 'lovecraft_logo' ) ) {

				// Add the logo options section
				$wp_customize->add_section( 'lovecraft_logo_section' , array(
					'title'       => __( 'Logo', 'lovecraft' ),
					'priority'    => 40,
					'description' => __( 'Upload a logo to replace the default site title in the header.', 'lovecraft' ),
				) );

				// Custom logo setting
				$wp_customize->add_setting( 'lovecraft_logo', array(
					'sanitize_callback' => 'esc_url_raw',
				) );

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lovecraft_logo', array(
					'label'    => __( 'Logo', 'lovecraft' ),
					'section'  => 'lovecraft_logo_section',
					'settings' => 'lovecraft_logo',
				) ) );

			}

			// SANITATION

			// Sanitize boolean for checkbox
			function lovecraft_sanitize_checkbox( $checked ) {
				return ( ( isset( $checked ) && true == $checked ) ? true : false );
			}
		}

		public static function header_output() {

			$accent_default = '#CA2017';
			$accent = get_theme_mod( 'accent_color', $accent_default );

			// Only output if the color selected differs from the default.
			if ( ! $accent || $accent == $accent_default ) return;

			echo '<!-- Customizer CSS -->';
			echo '<style type="text/css">';

			self::generate_css( 'a', 'color', $accent );

			self::generate_css( '.blog-title a:hover', 'color', $accent );
			self::generate_css( '.main-menu li:hover > a, .main-menu li.focus > a', 'color', $accent );
			self::generate_css( '.main-menu > .menu-item-has-children > a:after', 'border-top-color', $accent );

			self::generate_css( 'blockquote:after', 'color', $accent );
			self::generate_css( 'button:hover, .button:hover, .faux-button:hover, .wp-block-button__link:hover, :root .wp-block-file__button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover', 'background-color', $accent );
			self::generate_css( '.is-style-outline .wp-block-button__link:hover, .wp-block-button__link.is-style-outline:hover', 'color', $accent );

			self::generate_css( ':root .has-accent-color', 'color', $accent );
			self::generate_css( ':root .has-accent-background-color', 'background-color', $accent );

			self::generate_css( '.post-tags a:hover', 'background-color', $accent );
			self::generate_css( '.post-tags a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.post-content .page-links a:hover', 'background-color', $accent );
			self::generate_css( '.post-navigation h4 a:hover', 'color', $accent );

			self::generate_css( '.comments-title-link a', 'color', $accent );
			self::generate_css( '.comments .pingbacks li a:hover', 'color', $accent );
			self::generate_css( '.comment-header h4 a:hover', 'color', $accent );
			self::generate_css( '.bypostauthor .comment-author-icon', 'background-color', $accent );
			self::generate_css( '.form-submit #submit:hover', 'background-color', $accent );
			self::generate_css( '.comments-nav a:hover', 'color', $accent );
			self::generate_css( '.pingbacks-title', 'border-bottom-color', $accent );

			self::generate_css( '.archive-navigation a:hover', 'color', $accent );

			self::generate_css( '.widget-title', 'border-bottom-color', $accent );
			self::generate_css( '.widget-content .textwidget a:hover', 'color', $accent );
			self::generate_css( '.widget_archive li a:hover', 'color', $accent );
			self::generate_css( '.widget_categories li a:hover', 'color', $accent );
			self::generate_css( '.widget_meta li a:hover', 'color', $accent );
			self::generate_css( '.widget_nav_menu li a:hover', 'color', $accent );
			self::generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', $accent );
			self::generate_css( '#wp-calendar thead th', 'color', $accent );
			self::generate_css( '#wp-calendar tfoot a:hover', 'color', $accent );
			self::generate_css( '.widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.widget .tagcloud a:hover:before', 'border-right-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover', 'background-color', $accent );
			self::generate_css( '.footer .widget .tagcloud a:hover:before', 'border-right-color', $accent );

			self::generate_css( '.credits .sep', 'color', $accent );
			self::generate_css( '.credits a:hover', 'color', $accent );

			self::generate_css( '.nav-toggle.active .bar', 'background-color', $accent );
			self::generate_css( '.search-toggle.active .genericon', 'color', $accent );
			self::generate_css( '.mobile-menu .current-menu-item:before', 'color', $accent );
			self::generate_css( '.mobile-menu .current_page_item:before', 'color', $accent );

			echo '</style>';
			echo '<!--/Customizer CSS-->';
		}

		public static function generate_css( $selector, $style, $value, $prefix = '', $postfix = '', $echo = true ) {
			$return = '';
			if ( $value ) {
				$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix . $value . $postfix );
				if ( $echo ) echo $return;
			}
			return $return;
		}
	}

	// Setup the Theme Customizer settings and controls...
	add_action( 'customize_register' , array( 'Lovecraft_Customize', 'register' ) );

	// Output custom CSS to live site
	add_action( 'wp_head' , array( 'Lovecraft_Customize', 'header_output' ) );

endif;