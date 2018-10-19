<?php
/**
 * The main template file.
 */

get_header();
?>

	<div id="featured-block">
		<h3><?php echo stripslashes($photolistic_option['pl_featured_txt']); ?></h3>
	</div><!-- #featured-block -->

		<div id="container">
			<div id="content" role="main">
				<?php $i = 0; $j = 0;
          if (have_posts()): while (have_posts() && ($i < $photolistic_option['pl_featured_posts_nr'])) : the_post(); ?>
         <div id="post-<?php the_ID(); ?>"  <?php post_class('hfeatures'); ?>>
             <a href="<?php the_permalink() ?>" class="hfeatures-links">
                      <?php if (has_post_thumbnail()) {
              the_post_thumbnail('thumbnail');
          } else {
              ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/set-featured-image-<?php echo $j; ?>.jpg" width="280px" height="187px" />

				<?php
          } ?>
            </a>
            <h2>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php if (strlen($post->post_title) > 25) {
              echo substr(the_title($before = '', $after = '', false), 0, 25) . '...';
          } else {
              the_title();
          } ?></a>
            </h2>
               </div><?php $i++; $j++; if (is_int($i/3)) {
              $j= 0;
          }	   /* end post */ ?>
			<?php endwhile; ?>
      <?php else : ?>
              <h2 class="page_header center">Not Found</h2>
              <div class="entry">
                      <p>Sorry, but you are looking for something that isn't here.</p>
              </div>
      <?php endif; ?>
               <div style="clear:both;"> </div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>
