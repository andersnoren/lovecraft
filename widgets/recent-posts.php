<?php

class Lovecraft_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' 	=> 'Widget_Lovecraft_Recent_Posts',
			'description' 	=> __( 'Displays recent blog entries.', 'lovecraft' ),
		);
		parent::__construct( 'Widget_Lovecraft_Recent_Posts', __( 'Recent Posts', 'lovecraft' ), $widget_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		$widget_title = null;
		$number_of_posts = null;

		$widget_title = esc_attr( apply_filters( 'widget_title', $instance['widget_title'] ) );
		$number_of_posts = esc_attr( $instance['number_of_posts'] );

		echo $before_widget;

		if ( ! empty( $widget_title ) ) {
			echo $before_title . $widget_title . $after_title;
		}

		if ( 0 === $number_of_posts ) {
			$number_of_posts = 5;
		}

		global $post;

		$ignore = get_option( 'sticky_posts' );
		$ignore[] = $post->ID;

		$recent_posts = get_posts( array(
			'posts_per_page' 	=> $number_of_posts,
			'post_status'    	=> 'publish',
			'ignore'			=> $ignore,
		) );

		if ( $recent_posts ) : ?>

			<ul class="lovecraft-widget-list">

				<?php foreach ( $recent_posts as $post ) :

					setup_postdata( $post );

					?>

					<li>

						<a href="<?php the_permalink(); ?>">

							<div class="post-icon">

								<?php

								$post_format = get_post_format() ? get_post_format() : 'standard';

								if ( has_post_thumbnail() ) {

									the_post_thumbnail( 'thumbnail' );

								} elseif ( 'gallery' === $post_format ) {

									$attachment_parent = get_the_ID();

									$images = get_posts( array(
										'numberposts'    => 1,
										'orderby'        => 'menu_order',
										'order'          => 'ASC',
										'post_parent'    => $attachment_parent,
										'post_type'      => 'attachment',
										'post_status'    => null,
										'post_mime_type' => 'image',
									) );

									if ( $images ) {
										foreach ( $images as $image ) {
											$attimg = wp_get_attachment_image( $image->ID, 'thumbnail' );
											echo $attimg;
										}
									} else {
										?>
										<div class="genericon genericon-<?php echo $post_format; ?>"></div>
										<?php
									}
								} else {
									?>

									<div class="genericon genericon-<?php echo $post_format; ?>"></div>

								<?php } ?>

							</div>

							<div class="inner">

								<p class="title"><?php the_title(); ?></p>
								<p class="meta"><?php the_time( get_option( 'date_format' ) ); ?></p>

							</div>

							<div class="clear"></div>

						</a>

					</li>

					<?php

				endforeach;

				wp_reset_postdata();

				?>

			</ul>

		<?php endif;

		echo $after_widget;

	}


	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['widget_title'] = strip_tags( $new_instance['widget_title'] );

		// Make sure we are getting a number
		$instance['number_of_posts'] = is_int( intval( $new_instance['number_of_posts'] ) ) ? intval( $new_instance['number_of_posts'] ) : 5;

		// Update and save the widget
		return $instance;

	}

	function form( $instance ) {

		// Set defaults
		if ( ! isset( $instance['widget_title'] ) ) {
			$instance['widget_title'] = '';
		}

		if ( ! isset( $instance['number_of_posts'] ) ) {
			$instance['number_of_posts'] = 5;
		}

		// Get the options into variables, escaping html characters on the way
		$widget_title = esc_attr( $instance['widget_title'] );
		$number_of_posts = esc_attr( $instance['number_of_posts'] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php  _e( 'Title', 'lovecraft' ); ?>:
			<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e( 'Number of posts to display', 'lovecraft' ); ?>:
			<input id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $number_of_posts ); ?>" /></label>
			<small>(<?php _e( 'Defaults to 5 if empty', 'lovecraft' ); ?>)</small>
		</p>

		<?php
	}
}
register_widget( 'Lovecraft_Recent_Posts' ); ?>
