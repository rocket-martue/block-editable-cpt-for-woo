<?php
/**
 * Register custom post type
 *
 * @package block-editable-cpt-for-woo
 */

add_action(
	'init',
	function() {
		// Register custom post type "Product Description."
		$labels = array(
		 'name' => __( 'Product Description', 'block-editable-cpt-for-woo' ),
		);
		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => true,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-products',
			'show_ui'            => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'product_desc' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'revisions' )
		);
		register_post_type( 'product_desc', $args );
	}
);

register_activation_hook(
	__FILE__,
	function() {
		my_cpt_init();
		flush_rewrite_rules();
	}
);

add_filter(
	'manage_posts_columns',
	function ( $columns ) {
		global $post_type;
		if( in_array( $post_type, array( 'product_desc' ) ) ) {
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
			echo '<span class="product_desc-short-code">[product_desc slug=' . esc_html( $slug ) . ']</span>';
		}
	},
	10,
	2
);

/**
 * shortcode.
 *
 * @param array $atts User defined attributes in shortcode tag.
 *
 * @return string
 */
function product_desc_shortcode( $atts ) {
	extract( shortcode_atts(
		array(
			'slug' => '',
		), $atts ) );
	ob_start();
	$args = array(
		'post_type' => array( 'product_desc' ),
		'name'      => $slug,
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			the_content();
		}
	}
	wp_reset_postdata();
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}
add_shortcode( 'product_desc', 'product_desc_shortcode' );
