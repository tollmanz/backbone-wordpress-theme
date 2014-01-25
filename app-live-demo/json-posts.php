<?php
/**
 * @package Collections
 */

$data = array();

if ( have_posts() ) {
	while( have_posts() ) {
		the_post();

		// Make sure that the content is properly processed before printing
		$content = apply_filters( 'the_content', get_the_content(), get_the_ID() );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$data[] = array(
			'id'      => get_the_ID(),
			'title'   => get_the_title(),
			'content' => $content,
		);
	}
}

echo json_encode( $data );