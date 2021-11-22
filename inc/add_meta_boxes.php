<?php
/**
 * add_meta_boxes
 *
 * @package block-editable-cpt-for-woo
 */

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box(
			'becpt_box_id',
			esc_html__( 'Shortcode', 'block-editable-cpt-for-woo' ),
			'becpt_custom_box_html',
			'product_desc'
		);
	},
);

function becpt_custom_box_html( $post ) {
	$post = get_post( $post_id );
	$slug = $post->post_name;
	echo '<p class="product_desc-short-code">[product_desc slug=' . esc_html( $slug ) . ']</p><p>こちらのショートコードをコピーして商品編集画面の「商品説明」に貼り付けます。</p>';
}