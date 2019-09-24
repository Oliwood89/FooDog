<?php do_action('elementskit/template/before_footer'); ?>
<div class="ekit-template-content-markup ekit-template-content-footer ekit-template-content-theme-support">
<?php
	$template = \ElementsKit\Modules\Header_Footer\Activator::template_ids();
	$elementor = \Elementor\Plugin::instance();
	echo \ElementsKit\Utils::render($elementor->frontend->get_builder_content_for_display( $template[1] )); 
?>
</div>
<?php do_action('elementskit/template/after_footer'); ?>
<?php wp_footer(); ?>

</body>
</html>
