<?php
if ( ! function_exists( 'zt_add_json_query_var' ) ) :
/**
 * Register a new query variable that will be used to show a JSON representation of a post.
 *
 * @since  1.0.
 *
 * @param  array    $vars    The current query variables.
 * @return array             The modified query variables.
 */
function zt_add_json_query_var( $vars ) {
	$vars[] = 'zt-json';
	return $vars;
}
endif;

add_filter( 'query_vars', 'zt_add_json_query_var' );

if ( ! function_exists( 'zt_json_template_redirect' ) ) :
/**
 * Redirect to a JSON representation of a post if the JSON query var is set.
 *
 * In order to power the SPA, a JSON representation of a post is needed. This function hooks into "template_redirect"
 * and will use a JSON template to render a post when needed. Appending "?cspa-json=1" to a post or a post format
 * archive will render the JSON template.
 *
 * @since  1.0.
 *
 * @return void
 */
function zt_json_template_redirect() {
	global $wp_query;

	// If this is not a request for json then bail
	if ( ! isset( $wp_query->query_vars['zt-json'] ) || '1' !== $wp_query->query_vars['zt-json'] ) {
		return;
	}

	// Set the appropriate header
	header( 'Content-Type: application/json; charset=utf-8' );

	// Help prevent MIME-type confusion attacks in IE8+
	send_nosniff_header();

	// Render the template and stop execution
	get_template_part( 'json', 'posts' );
	exit;
}
endif;

add_action( 'template_redirect', 'zt_json_template_redirect' );