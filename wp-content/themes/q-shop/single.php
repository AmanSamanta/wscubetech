<?php get_header(); ?>

	<?php if ( !is_active_sidebar( 'blog-sidebar-widgets' ) ) { ?>

		<?php get_template_part('template-parts/posts/single', 'layout2'); ?>

	<?php } else { ?>

		<?php if ( esc_html( $qshop_design_option = get_theme_mod('qshop_single_design') ) == 'single_one' ) { ?>

			<?php get_template_part('template-parts/posts/single', 'layout1'); ?>

		<?php } elseif ( esc_html( $qshop_design_option = get_theme_mod('qshop_single_design') ) == 'single_two' ) { ?>

			<?php get_template_part('template-parts/posts/single', 'layout2'); ?>

		<?php } else { ?>

			<?php get_template_part('template-parts/posts/single', 'layout1'); ?>

		<?php } ?>

	<?php } ?>

<?php get_footer(); ?>