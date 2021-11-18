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