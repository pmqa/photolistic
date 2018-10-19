<?php
/**
 * The template for displaying Archive pages.
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) the_post(); ?>

			<h1 class="page-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'photolistic' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'photolistic' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'photolistic' ) ) ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'photolistic' ), get_the_date( _x( 'Y', 'yearly archives date format', 'photolistic' ) ) ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'photolistic' ); ?>
			<?php endif; ?>
			</h1>

<?php
	rewind_posts();
	
	 get_template_part( 'loop', 'archive' );
?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
