<?php
	/*
		Template Name: About Us Page
	*/
?>

<?php get_header(); ?>

	<div id="full-width-page" class="about-us group">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                <h1 class="main-page-heading center-main-heading w-thin-text"><?php the_title(); ?></h1>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="about-us-featured-image parallax-featured-image">
                        <?php the_post_thumbnail('qshop-feat-thumb'); ?>
                    </div>
                <?php endif; ?>

                <div class="wrapper group">

                    <div class="entry group">
                        <?php the_content(); ?>
                    </div>

                    <?php
                        if ( is_plugin_active( 'qshop-pro-addon/qshop-pro-addon.php' ) ) {

                            include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/faq-section.php';
                            
                        }
                    ?>
			
				    <?php wp_link_pages(); ?>

                </div>
				
			</article>

		<?php endwhile; endif; ?>

	</div><!-- #full-width-page -->

<?php get_footer(); ?>