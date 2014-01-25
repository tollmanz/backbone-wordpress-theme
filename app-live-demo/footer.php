		<?php if ( ! defined( 'ZT_IS_JS_TEMPLATE' ) ) : ?>
			<?php define( 'ZT_IS_JS_TEMPLATE', true ); ?>
		<?php endif; ?>

		<script type="text/template" id="tmpl-zt-archive-body">
			<?php get_template_part( '_archive', 'body' ); ?>
		</script>

		<?php wp_footer(); ?>
	</body>
</html>