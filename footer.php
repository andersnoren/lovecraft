</main><!-- #site-content -->

<?php if ( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ) : ?>

	<div class="footer section big-padding bg-white">

		<div class="section-inner">

			<div class="widgets"><?php dynamic_sidebar( 'footer-one' ); ?></div>
			<div class="widgets"><?php dynamic_sidebar( 'footer-two' ); ?></div>
			<div class="widgets"><?php dynamic_sidebar( 'footer-three' ); ?></div>

			<div class="clear"></div>

		</div><!-- .section-inner -->

	</div><!-- .footer.section -->

<?php endif; ?>

<div class="credits section bg-dark">

	<div class="credits-inner section-inner">

		<p><?php _e( 'Powered by', 'lovecraft' ); ?> <a href="https://www.wordpress.org">WordPress</a> <span class="sep">&amp;</span> <span><?php _e( 'Theme by', 'lovecraft' ) ?> <a href="https://www.andersnoren.se">Anders Nor&eacute;n</a></span></p>

	</div><!-- .section-inner -->

</div><!-- .credits.section -->

<?php wp_footer(); ?>

</body>
</html>
