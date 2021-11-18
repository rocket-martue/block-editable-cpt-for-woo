<?php
/**
 * manage_posts_columns
 *
 * @package block-editable-cpt-for-woo
 */

add_filter(
	'manage_posts_columns',
	function ( $columns ) {
		global $post_type;
		if( in_array( $post_type, array( 'product_content' ) ) ) {
			$new_columns = array(
				'shortcode' => esc_html__( 'Shortcode', 'block-editable-cpt-for-woo' ),
			);
			return array_merge( $columns, $new_columns );
		}
		return $columns;
	}
);

add_filter(
	'manage_posts_custom_column',
	function ( $column_name, $post_id ) {
		if ( 'shortcode' === $column_name ) {
			$post = get_post( $post_id );
			$slug = $post->post_name;
			echo '<span class="product_content-short-code">[product_content slug=' . esc_html( $slug ) . ']</span>';
		}
	},
	10,
	2
);