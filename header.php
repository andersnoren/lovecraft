<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">

		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>

		<a class="skip-link button" href="#site-content"><?php _e( 'Skip to the content', 'lovecraft' ); ?></a>

		<div class="header-wrapper">

			<div class="header section bg-white small-padding">

				<div class="section-inner">

					<?php if ( get_theme_mod( 'lovecraft_logo' ) ) : ?>

						<a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'>
							<img src='<?php echo esc_url( get_theme_mod( 'lovecraft_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
						</a>

					<?php elseif ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) :

						$title_type = is_singular() ? '2' : '1'; ?>

						<h<?php echo $title_type; ?> class="blog-title">
							<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
						</h<?php echo $title_type; ?>>

						<?php if ( get_bloginfo( 'description' ) ) : ?>

							<h4 class="blog-tagline">
								<?php bloginfo( 'description' ); ?>
							</h4>

						<?php endif; ?>

					<?php endif; ?>

					<div class="clear"></div>

				</div><!-- .section-inner -->

			</div><!-- .header -->

			<div class="toggles">

				<button type="button" class="nav-toggle toggle">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
					<span class="screen-reader-text"><?php _e( 'Toggle the mobile menu', 'lovecraft' ); ?></span>
				</button>

				<button type="button" class="search-toggle toggle">
					<div class="genericon genericon-search"></div>
					<span class="screen-reader-text"><?php _e( 'Toggle the search field', 'lovecraft' ); ?></span>
				</button>

				<div class="clear"></div>

			</div><!-- .toggles -->

		</div><!-- .header-wrapper -->

		<div class="navigation bg-white no-padding">

			<div class="section-inner">

				<ul class="mobile-menu">

					<?php if ( has_nav_menu( 'primary' ) ) {

						$menu_args = array(
							'container' 		=> '',
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary',
						);

						wp_nav_menu( $menu_args );

					} else {

						$list_pages_args = array(
							'container' => '',
							'title_li' 	=> '',
						);

						wp_list_pages( $list_pages_args );

					} ?>

				</ul>

				<div class="mobile-search">

					<?php get_search_form(); ?>

				</div>

				<ul class="main-menu">

					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( $menu_args );
					} else {
						wp_list_pages( $list_pages_args );
					}
					?>

				</ul>

				<div class="clear"></div>

			</div><!-- .section-inner -->

		</div><!-- .navigation -->

		<?php if ( is_singular() && has_post_thumbnail() && ! post_password_required() ) :
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-image-cover' );
			$post_image = $thumb['0'];
			?>

			<div class="header-image bg-image" style="background-image: url(<?php echo esc_url( $post_image ); ?>)">

				<?php the_post_thumbnail( 'post-image' ); ?>

			</div>

		<?php else :

			if ( get_header_image() ) {
				$header_image = get_header_image();
				$header_image_data = get_theme_mod( 'header_image_data' );
				$header_image_alt = get_post_meta( $header_image_data->attachment_id, '_wp_attachment_image_alt', true );
			} else {
				$header_image = get_template_directory_uri() . '/images/header.jpg';
				$header_image_alt = get_bloginfo( 'name' );
			}

			?>

			<div class="header-image bg-image" style="background-image: url( <?php echo esc_url( $header_image ); ?> );">

				<img src="<?php echo esc_url( $header_image ); ?>"<?php if ( $header_image_alt ) : ?> alt="<?php echo esc_attr( $header_image_alt ); ?>"<?php endif; ?> />

			</div>

		<?php endif; ?>

		<main id="site-content">