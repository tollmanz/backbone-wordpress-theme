<?php

require __DIR__ . '/json.php';

/**
 * Returns whether or not a JS template is being generated.
 *
 * @since  1.0.
 *
 * @return bool
 */
function zt_is_js_template() {
	return defined( 'ZT_IS_JS_TEMPLATE' ) && ZT_IS_JS_TEMPLATE;
}

/**
 * Enqueue frontend scripts.
 *
 * @since  1.0.
 *
 * @return void
 */
function zt_enqueue_scripts() {
	$version = '1.0.0';

	wp_enqueue_script(
		'js/models/post.js',
		get_template_directory_uri() . '/js/models/post.js',
		array( 'wp-backbone' ),
		$version,
		true
	);

	wp_enqueue_script(
		'js/collections/archive.js',
		get_template_directory_uri() . '/js/collections/archive.js',
		array( 'wp-backbone' ),
		$version,
		true
	);

	wp_enqueue_script(
		'js/views/post.js',
		get_template_directory_uri() . '/js/views/post.js',
		array( 'wp-backbone' ),
		$version,
		true
	);

	wp_enqueue_script(
		'js/views/core.js',
		get_template_directory_uri() . '/js/views/core.js',
		array( 'wp-backbone' ),
		$version,
		true
	);

	wp_enqueue_script(
		'js/routers/router.js',
		get_template_directory_uri() . '/js/routers/router.js',
		array( 'wp-backbone' ),
		$version,
		true
	);

	wp_enqueue_script(
		'js/app.js',
		get_template_directory_uri() . '/js/app.js',
		array(
			'js/models/post.js',
			'js/collections/archive.js',
			'js/views/post.js',
			'js/views/core.js',
			'js/routers/router.js',
		),
		$version,
		true
	);
}

add_action( 'wp_enqueue_scripts', 'zt_enqueue_scripts' );

/**
 * Support post formats.
 *
 * @since  1.0.
 *
 * @return void
 */
function zt_theme_setup() {
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
}

add_action( 'after_setup_theme', 'zt_theme_setup' );