<?php if ( ! zt_is_js_template() ) : ?>
<article id="post-<?php the_ID(); ?>" class="post">
<?php endif; ?>

	<h1>
		<?php if ( zt_is_js_template() ) : ?>
			{{{ data.title }}}
		<?php else: ?>
			<?php the_title(); ?>
		<?php endif; ?>
	</h1>

	<section class="post-content">
		<?php if ( zt_is_js_template() ) : ?>
			{{{ data.content }}}
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>
	</section>

<?php if ( ! zt_is_js_template() ) : ?>
</article>
<?php endif; ?>
