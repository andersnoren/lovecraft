<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_setup' ) ) {

	function lovecraft_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Add post formats
		add_theme_support( 'post-formats', array( 'aside' ) );
		
		// Title tag
		add_theme_support( 'title-tag' );
		
		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 629;
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size ( 88, 88, true );
		
		add_image_size( 'post-image', 900, 9999 );
		add_image_size( 'post-image-cover', 1280, 9999 );
			
		// Custom header
		$args = array(
			'width'         => 1280,
			'height'        => 444,
			'default-image' => get_template_directory_uri() . '/images/header.jpg',
			'uploads'       => true,
			'header-text'  	=> false
			
		);
		add_theme_support( 'custom-header', $args );
			
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type' 		=> 'click',
			'container'	=> 'posts',
			'footer' 	=> false,
		) );
		
		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'lovecraft' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'lovecraft', get_template_directory() . '/languages' );
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
	}
	add_action( 'after_setup_theme', 'lovecraft_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_load_javascript_files' ) ) {

	function lovecraft_load_javascript_files() {
		if ( ! is_admin() ) {		
			wp_register_script( 'lovecraft_doubletap', get_template_directory_uri() . '/js/doubletaptogo.js', '', true );

			wp_enqueue_script( 'lovecraft_global', get_template_directory_uri() . '/js/global.js', array( 'jquery', 'lovecraft_doubletap' ), '', true );

			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'lovecraft_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_load_style' ) ) {

	function lovecraft_load_style() {
		if ( ! is_admin() ) {
			wp_register_style( 'lovecraft_googlefonts', '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic' );
			wp_register_style( 'lovecraft_genericons', get_template_directory_uri() . '/genericons/genericons.css' );
			wp_enqueue_style( 'lovecraft_style', get_stylesheet_uri(), array( 'lovecraft_googlefonts', 'lovecraft_genericons' ) );
		}
	}
	add_action( 'wp_enqueue_scripts', 'lovecraft_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_add_editor_styles' ) ) {

	function lovecraft_add_editor_styles() {
		add_editor_style( 'lovecraft-editor-styles.css' );
		$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
		add_editor_style( str_replace( ', ', '%2C', $font_url ) );
	}
	add_action( 'init', 'lovecraft_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   REGISTER WIDGET AREAS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_sidebar_registration' ) ) {

	function lovecraft_sidebar_registration() {
		
		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'lovecraft' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer One', 'lovecraft' ),
			'id' 			=> 'footer-one',
			'description' 	=> __( 'Widgets in this area will be shown in the left footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Two', 'lovecraft' ),
			'id' 			=> 'footer-two',
			'description' 	=> __( 'Widgets in this area will be shown in the middle footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Three', 'lovecraft' ),
			'id' 			=> 'footer-three',
			'description' 	=> __( 'Widgets in this area will be shown in the right footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div><div class="clear"></div></div>'
		) );

	}
	add_action( 'widgets_init', 'lovecraft_sidebar_registration' ); 

}


/* ---------------------------------------------------------------------------------------------
   ADD THEME WIDGETS
   --------------------------------------------------------------------------------------------- */


require_once( get_template_directory() . '/widgets/flickr-widget.php' );
require_once( get_template_directory() . '/widgets/recent-comments.php' );
require_once( get_template_directory() . '/widgets/recent-posts.php' );


/* ---------------------------------------------------------------------------------------------
   DELIST DEFAULT WIDGETS REPLACE BY THEME ONES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_unregister_default_widgets' ) ) {
 
	function lovecraft_unregister_default_widgets() {
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
	}
	add_action( 'widgets_init', 'lovecraft_unregister_default_widgets', 11 );

}


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_html_js_class' ) ) {

	function lovecraft_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'lovecraft_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ARCHIVE NAVIGATION FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_archive_navigation' ) ) {

	function lovecraft_archive_navigation() {
		
		global $wp_query;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		
		if ( $wp_query->max_num_pages > 1 ) : ?>
					
			<div class="archive-navigation">
				
				<div class="fleft">
					
					<p><?php printf( __( 'Page %s of %s', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></p>
					
				</div>
				
				<div class="fright">
					
					<?php if ( get_previous_posts_link() ) : ?>
					
						<p>
						
							<?php echo get_previous_posts_link( '&larr; ' . __( 'Previous', 'lovecraft' ) ); ?>
						
						</p>
					
					<?php endif; ?>
					
					<?php if ( get_next_posts_link() ) : ?>
					
						<p>
						
							<?php echo get_next_posts_link( __( 'Next', 'lovecraft' ) . ' &rarr;' ); ?>
							
						</p>
					
					<?php endif; ?>
				
				</div>
				
				<div class="clear"></div>
							
			</div><!-- .archive-nav -->
							
		<?php endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM READ MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_modify_read_more_link' ) ) {

	function lovecraft_modify_read_more_link() {
		return '<p><a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'lovecraft' ) . '</a></p>';
	}
	add_filter( 'the_content_more_link', 'lovecraft_modify_read_more_link' );

}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_body_classes' ) ) {
 
	function lovecraft_body_classes( $classes ){
	
		// Has post thumbnail
		if ( is_single() && has_post_thumbnail() ){
			$classes[] = 'has-featured-image';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'lovecraft_body_classes' );

}


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_get_comment_excerpt' ) ) {
	
	function lovecraft_get_comment_excerpt( $comment_ID = 0, $num_words = 20 ) {
		$comment = get_comment( $comment_ID );
		$comment_text = strip_tags( $comment->comment_content );
		$blah = explode( ' ', $comment_text );
		if ( count( $blah ) > $num_words ) {
			$k = $num_words;
			$use_dotdotdot = 1;
		} else {
			$k = count( $blah );
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ( $i = 0; $i < $k; $i++ ) {
			$excerpt .= $blah[$i] . ' ';
		}
		$excerpt .= ( $use_dotdotdot ) ? '...' : '';
		return apply_filters( 'get_comment_excerpt', $excerpt );
	}

}


/* ---------------------------------------------------------------------------------------------
   ADMIN CSS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_admin_area_style' ) ) {

	function lovecraft_admin_area_style() { 
	echo '
	<style type="text/css">
		
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}
		
		</style>';
	}
	add_action( 'admin_head', 'lovecraft_admin_area_style' );

}


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'lovecraft_comment' ) ) {

	function lovecraft_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'lovecraft' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'lovecraft' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
				
				<?php echo get_avatar( $comment, 160 ); ?>
				
				<?php if ( $comment->user_id === $post->post_author ) : ?>
						
					<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php _e( 'Post author', 'lovecraft' ); ?>">
					
						<div class="genericon genericon-user"></div>
						
					</a>
				
				<?php endif; ?>
				
				<div class="comment-inner">
				
					<div class="comment-header">
												
						<h4><?php echo get_comment_author_link(); ?></h4>
					
					</div><!-- .comment-header -->
					
					<div class="comment-content post-content">
				
						<?php comment_text(); ?>
						
					</div><!-- .comment-content -->
					
					<div class="comment-meta">
						
						<div class="fleft">
							<div class="genericon genericon-day"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php printf( _x( '%s at %s', 'Variables: comment date, comment time', 'lovecraft' ), get_comment_date(), get_comment_time() ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							<?php edit_comment_link( __( 'Edit', 'lovecraft' ), '<div class="genericon genericon-edit"></div>', '' ); ?>
						</div>
						
						<?php if ( 0 == $comment->comment_approved ) : ?>
					
							<div class="comment-awaiting-moderation fright">
								<div class="genericon genericon-show"></div><?php _e( 'Your comment is awaiting moderation.', 'lovecraft' ); ?>
							</div>
							
						<?php else : 

							comment_reply_link( array( 
								'reply_text' 	=>  	__( 'Reply', 'lovecraft' ),
								'depth'			=> 		$depth, 
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<div class="fright"><div class="genericon genericon-reply"></div>',
								'after'			=>		'</div>'
								) 
							); 
							
						endif; ?>
						
						<div class="clear"></div>
						
					</div><!-- .comment-meta -->
									
				</div><!-- .comment-inner -->
											
			</div><!-- .comment-## -->
					
		<?php
			break;
		endswitch;
	}
}


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER SETTINGS
   --------------------------------------------------------------------------------------------- */


class lovecraft_customize {

   public static function lovecraft_register ( $wp_customize ) {
   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'lovecraft_options', 
         array(
            'title' 		=> __( 'Options for Lovecraft', 'lovecraft' ), //Visible title of section
            'priority' 		=> 35, //Determines what order this appears in
            'capability' 	=> 'edit_theme_options', //Capability needed to tweak
            'description' 	=> __( 'Allows you to customize theme settings for Lovecraft.', 'lovecraft' ), //Descriptive tooltip
         ) 
      );
      
      $wp_customize->add_section( 'lovecraft_logo_section' , array(
		    'title'       => __( 'Logo', 'lovecraft' ),
		    'priority'    => 40,
		    'description' => __( 'Upload a logo to replace the default site title in the header.', 'lovecraft' ),
	  ) );
      
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' 			=> '#CA2017', //Default setting/value to save
            'type' 				=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' 		=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      		'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );
	  
	  $wp_customize->add_setting( 'lovecraft_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
      
      
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'lovecraft_accent_color', //Set a unique ID for the control
         array(
            'label' 	=> __( 'Accent Color', 'lovecraft' ), //Admin-visible name of the control
            'section' 	=> 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' 	=> 'accent_color', //Which setting to load and manipulate (serialized is okay)
            'priority' 	=> 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lovecraft_logo', array(
		    'label'    => __( 'Logo', 'lovecraft' ),
		    'section'  => 'lovecraft_logo_section',
		    'settings' => 'lovecraft_logo',
	  ) ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
   }

   public static function lovecraft_header_output() {
      ?>
      
	      <!-- Customizer CSS --> 
	      
	      <style type="text/css">
	           <?php self::lovecraft_generate_css( 'body a', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( 'body a:hover', 'color', 'accent_color' ); ?>

	           <?php self::lovecraft_generate_css( '.blog-title a:hover', 'color', 'accent_color' ); ?>	           
	           <?php self::lovecraft_generate_css( '.main-menu li:hover > a', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.main-menu > .menu-item-has-children > a:after', 'border-top-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.main-menu > .menu-item-has-children > a:hover:after', 'border-top-color', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.sticky-post', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.sticky-post:after', 'border-right-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.sticky-post:after', 'border-left-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-meta a', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-meta a:hover', 'border-bottom-color', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.post-content a', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-content a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-content blockquote:after', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.post-content .page-links a:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-tags a:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-tags a:hover:before', 'border-right-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.post-navigation h4 a:hover', 'color', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.comments-title-link a', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.comments .pingbacks li a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.bypostauthor .comment-author-icon', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.form-submit #submit:hover', 'background-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.comments-nav a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.pingbacks-title', 'border-bottom-color', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.archive-navigation a:hover', 'color', 'accent_color' ); ?>
				
			   <?php self::lovecraft_generate_css( '.widget-title', 'border-bottom-color', 'accent_color' ); ?>	           
	           <?php self::lovecraft_generate_css( '.widget-content .textwidget a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget_archive li a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget_categories li a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget_meta li a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget_nav_menu li a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '#wp-calendar thead th', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '#wp-calendar tfoot a:hover', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget .tagcloud a:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.widget .tagcloud a:hover:before', 'border-right-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.footer .widget .tagcloud a:hover', 'background', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.footer .widget .tagcloud a:hover:before', 'border-right-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.search-button:hover .genericon', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.wrapper .search-button:hover .genericon', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.footer .search-button:hover .genericon', 'color', 'accent_color' ); ?>
	           
	           <?php self::lovecraft_generate_css( '.credits .sep', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.credits p a:hover', 'color', 'accent_color' ); ?>

	           <?php self::lovecraft_generate_css( '.nav-toggle.active .bar', 'background-color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.search-toggle.active .genericon', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.mobile-menu .current-menu-item:before', 'color', 'accent_color' ); ?>
	           <?php self::lovecraft_generate_css( '.mobile-menu .current_page_item:before', 'color', 'accent_color' ); ?>	           

	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      <?php
   }
   
   public static function lovecraft_live_preview() {
      wp_enqueue_script( 
           'lovecraft-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

   public static function lovecraft_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'lovecraft_customize' , 'lovecraft_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'lovecraft_customize' , 'lovecraft_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'lovecraft_customize' , 'lovecraft_live_preview' ) );

?>