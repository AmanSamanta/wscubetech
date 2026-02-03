<?php
	/*
		Template Name: Full Width Page
	*/
?>

<?php get_header(); ?>

	<div id="full-width-page" class="wrapper group">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
								
				<div class="entry group">
					<?php the_content(); ?>
				</div>
			
				<?php wp_link_pages(); ?>
				
			</article>

		<?php endwhile; endif; ?>

	</div><!-- #full-width-page -->

<?php get_footer(); ?>