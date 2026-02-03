<?php
	/*
		Hidden Sidebar Template Part
	*/
?>

<?php if ( is_active_sidebar( 'hidden-sidebar-widgets' ) ) { ?>

	<div id="hidden-sidebar-wrap">
		
		<span class="hidden-sidebar-close" title="<?php esc_attr_e('Close', 'q-shop'); ?>"></span>

	    <aside id="hidden-sidebar" class="widget-sidebar group">

	        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Hidden Sidebar Widgets', 'q-shop'))) : else : ?>
	        
	        <?php endif; ?>

	    </aside>
	    
    </div>
    
<?php } ?>