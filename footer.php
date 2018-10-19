<?php
/**
 * The template for displaying the footer.
 */
?>
	</div><!-- #main -->
</div><!-- #wrapper -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	get_sidebar( 'footer' );
?>

<div id="credits">&copy;&nbsp;<?php echo date("Y")." ".get_bloginfo('name'); ?> - All rights reserved<br />
    <a href="<?php echo esc_url( __( 'http://pqa.me', 'photolistic' ) ); ?>" title="<?php esc_attr_e( 'Wordpress for Photographers', 'photolistic' ); ?>"><?php printf( __( 'Photography Theme by %s.', 'photolistic' ), 'pqa' ); ?></a>

		</div><!-- #colophon -->
	</div><!-- #footer -->

<?php
	wp_footer();
?>
</body>
</html>
