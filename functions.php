<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_setup' ) ) :
	function lovecraft_setup() {

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Add post formats
		add_theme_support( 'post-formats', array( 'aside' ) );

		// Title tag
		add_theme_support( 'title-tag' );

		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 629;
		}

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 88, 88, true );

		add_image_size( 'post-image', 900, 9999 );
		add_image_size( 'post-image-cover', 1280, 9999 );

		// Custom header
		add_theme_support( 'custom-header', array(
			'width'         => 1280,
			'height'        => 444,
			'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
			'uploads'       => true,
			'header-text'  	=> false,
		) );

		// Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		) );

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

	}
	add_action( 'after_setup_theme', 'lovecraft_setup' );
endif;


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Customizer class
require get_template_directory() . '/inc/classes/class-lovecraft-customize.php';

// Recent comments widget
require get_template_directory() . '/inc/widgets/recent-comments.php';

// Recent posts widget
require get_template_directory() . '/inc/widgets/recent-posts.php';


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_load_javascript_files' ) ) :
	function lovecraft_load_javascript_files() {

		$theme_version = wp_get_theme( 'lovecraft' )->get( 'Version' );

		wp_register_script( 'lovecraft_doubletap', get_template_directory_uri() . '/assets/js/doubletaptogo.min.js', $theme_version, true );

		wp_enqueue_script( 'lovecraft_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'lovecraft_doubletap' ), $theme_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
			wp_enqueue_script( 'comment-reply' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'lovecraft_load_javascript_files' );
endif;


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_load_style' ) ) :
	function lovecraft_load_style() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'lovecraft' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'lovecraft' ) ) {
			wp_register_style( 'lovecraft_googlefonts', '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic' );
			$dependencies[] = 'lovecraft_googlefonts';
		}

		wp_register_style( 'lovecraft_genericons', get_template_directory_uri() . '/assets/css/genericons.min.css' );
		$dependencies[] = 'lovecraft_genericons';

		wp_enqueue_style( 'lovecraft_style', get_stylesheet_uri(), $dependencies, $theme_version );

	}
	add_action( 'wp_enqueue_scripts', 'lovecraft_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_add_editor_styles' ) ) :
	function lovecraft_add_editor_styles() {

		add_editor_style( 'lovecraft-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'lovecraft' ) ) {
			$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

	}
	add_action( 'init', 'lovecraft_add_editor_styles' );
endif;


/* ---------------------------------------------------------------------------------------------
   REGISTER WIDGET AREAS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_sidebar_registration' ) ) :
	function lovecraft_sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'lovecraft' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer One', 'lovecraft' ),
			'id' 			=> 'footer-one',
			'description' 	=> __( 'Widgets in this area will be shown in the left footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Two', 'lovecraft' ),
			'id' 			=> 'footer-two',
			'description' 	=> __( 'Widgets in this area will be shown in the middle footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Three', 'lovecraft' ),
			'id' 			=> 'footer-three',
			'description' 	=> __( 'Widgets in this area will be shown in the right footer column.', 'lovecraft' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

	}
	add_action( 'widgets_init', 'lovecraft_sidebar_registration' );
endif;


/* ---------------------------------------------------------------------------------------------
   DELIST DEFAULT WIDGETS REPLACE BY THEME ONES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_modify_widgets' ) ) :
	function lovecraft_modify_widgets() {

		// Register custom widgets
		register_widget( 'Lovecraft_Recent_Posts' );
		register_widget( 'Lovecraft_Recent_Comments' );

		// Unregister replaced Core widgets
		unregister_widget( 'WP_Widget_Recent_Posts' );
		unregister_widget( 'WP_Widget_Recent_Comments' );

	}
	add_action( 'widgets_init', 'lovecraft_modify_widgets' );
endif;


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_html_js_class' ) ) :
	function lovecraft_html_js_class() {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>' . "\n";

	}
	add_action( 'wp_head', 'lovecraft_html_js_class', 1 );
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOM READ MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_modify_read_more_link' ) ) :
	function lovecraft_modify_read_more_link() {

		return '<p class="more-link-wrapper"><a class="more-link faux-button" href="' . get_permalink() . '">' . __( 'Read More', 'lovecraft' ) . '</a></p>';

	}
	add_filter( 'the_content_more_link', 'lovecraft_modify_read_more_link' );
endif;


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_body_classes' ) ) :
	function lovecraft_body_classes( $classes ) {

		// Has post thumbnail
		if ( is_single() && has_post_thumbnail() ) {
			$classes[] = 'has-featured-image';
		}

		// Check whether we're showing the sidebar on mobile
		if ( get_theme_mod( 'lovecraft_show_sidebar_on_mobile', false ) ) {
			$classes[] = 'show-mobile-sidebar';
		}

		return $classes;

	}
	add_filter( 'body_class', 'lovecraft_body_classes' );
endif;


/* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_get_comment_excerpt' ) ) :
	function lovecraft_get_comment_excerpt( $comment_id = 0, $num_words = 20 ) {

		$comment = get_comment( $comment_id );
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
			$excerpt .= $blah[ $i ] . ' ';
		}
		$excerpt .= ( $use_dotdotdot ) ? '...' : '';

		return apply_filters( 'get_comment_excerpt', $excerpt );

	}
endif;


/* ---------------------------------------------------------------------------------------------
   OUTPUT POST META
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_post_meta' ) ) :
	function lovecraft_post_meta() {

		?>
		
		<div class="post-meta">

			<p class="post-author"><span><?php _e( 'By', 'lovecraft' ); ?> </span><?php the_author_posts_link(); ?></p>

			<p class="post-date"><span><?php _e( 'On', 'lovecraft' ); ?> </span><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></p>

			<?php if ( has_category() ) : ?>
				<p class="post-categories"><span><?php _e( 'In', 'lovecraft' ); ?> </span><?php the_category( ', ' ); ?></p>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'lovecraft' ), '<p>', '</p>' ); ?>

		</div><!-- .post-meta -->

		<?php

	}
endif;


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_comment' ) ) :
	function lovecraft_comment( $comment, $args, $depth ) {

		if ( in_array( $comment->comment_type, array( 'pingback', 'trackback' ) ) ) : ?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<?php __( 'Pingback:', 'lovecraft' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'lovecraft' ), '<span class="edit-link">', '</span>' ); ?>
			</li>

			<?php
		else :
			global $post; ?>

			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

				<div id="comment-<?php comment_ID(); ?>" class="comment">

					<?php

					echo get_avatar( $comment, 160 );

					if ( $comment->user_id === $post->post_author ) : ?>

						<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
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

							<div>
								<div class="genericon genericon-day"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							</div>

							<?php edit_comment_link( __( 'Edit', 'lovecraft' ), '<div><div class="genericon genericon-edit"></div>', '</div>' ); ?>

							<?php if ( 0 == $comment->comment_approved ) : ?>

								<div class="comment-awaiting-moderation">
									<div class="genericon genericon-show"></div>
									<?php _e( 'Your comment is awaiting moderation.', 'lovecraft' ); ?>
								</div>

								<?php
							else :

								comment_reply_link( array(
									'reply_text' 	=> __( 'Reply', 'lovecraft' ),
									'depth'			=> $depth,
									'max_depth' 	=> $args['max_depth'],
									'before'		=> '<div><div class="genericon genericon-reply"></div>',
									'after'			=> '</div>',
								) );

							endif; ?>

						</div><!-- .comment-meta -->

					</div><!-- .comment-inner -->

				</div><!-- .comment-## -->

			<?php
		endif;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'lovecraft_add_block_editor_features' ) ) :
	function lovecraft_add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#CA2017' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Block Editor palette', 'lovecraft' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Block Editor', 'lovecraft' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Block Editor editor.', 'lovecraft' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the normal font size in Block Editor', 'lovecraft' ),
				'shortName' => _x( 'N', 'Short name of the normal font size in the Block Editor editor.', 'lovecraft' ),
				'size' 		=> 18,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Block Editor', 'lovecraft' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Block Editor editor.', 'lovecraft' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Block Editor', 'lovecraft' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Block Editor editor.', 'lovecraft' ),
				'size' 		=> 27,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'lovecraft_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'lovecraft_block_editor_styles' ) ) :
	function lovecraft_block_editor_styles() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'lovecraft' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'lovecraft' ) ) {
			wp_register_style( 'lovecraft-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic' );
			$dependencies[] = 'lovecraft-block-editor-styles-font';
		}

		wp_enqueue_style( 'lovecraft-block-editor-styles', get_theme_file_uri( '/assets/css/lovecraft-block-editor-styles.css' ), $dependencies, $theme_version );

	}
	add_action( 'enqueue_block_editor_assets', 'lovecraft_block_editor_styles' );
endif;
