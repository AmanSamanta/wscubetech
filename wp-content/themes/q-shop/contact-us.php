<?php
	/*
		Template Name: Contact Us Page
	*/
?>

<?php get_header(); ?>

	<div id="full-width-page" class="contact-us wrapper group">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                <h1 class="main-page-heading center-main-heading w-thin-text"><?php the_title(); ?></h1>

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