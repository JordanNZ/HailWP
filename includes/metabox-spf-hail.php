<?php

/**
 * Setup the metaboxes to pull through the private tag lists for template creation.
 *
 * @link          https://github.com/SPFWeb/SPF-Snippets/blob/master/wordpress/hail/
 * @since         1.0.0
 *
 * @package       SPF + Hail Wordpress Connection
 * @subpackage    spf-hail/includes
 */

function hail_info_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function hail_info_add_meta_box() {
	add_meta_box(
		'hail_info-hail-info',
		__( 'Hail Info', 'hail_info' ),
		'hail_info_html',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'hail_info_add_meta_box' );

function hail_info_html( $post) {
	wp_nonce_field( '_hail_info_nonce', 'hail_info_nonce' ); 
?>

	<p>
	<?php
		if (empty(get_option( 'spf_hail_orginization_id' ))) {
			echo 'Choose an Orginization you would like to pull your content from <a href="/wp-admin/options-general.php?page=spf-hail">here</a>';
		} else {
	?>
		<label for="hail_info_module_1"><?php _e( 'Module 1:', 'hail_mod1' ); ?></label><br>
		<?php 
			$spf = Hail_Helper::getInstance();
			$articles = $spf->getAllArticles();
		?>
			<select name="hail_info_module_1" id="hail_mod1" >
		<?php
				foreach($articles as $article) {
		?>
						<option value="<?php echo $article['id']; ?>" <?php if(hail_info_get_meta( 'hail_info_module_1' ) == $article['id']) { ?> selected <?php } ?>> <?php echo $article['title']; ?></option>
			<?php
				}
			?>
			</select>
	
	</p>	<p>
  <label for="hail_info_module_2"><?php _e( 'Module 2:', 'hail_mod2' ); ?></label><br>
			<select name="hail_info_module_2" id="hail_mod2" >
		<?php
				foreach($articles as $article) {
		?>
						<option value="<?php echo $article['id']; ?>" <?php if(hail_info_get_meta( 'hail_info_module_2' ) == $article['id']) { ?> selected <?php } ?>> <?php echo $article['title']; ?></option>
			<?php
				}
			?>
			</select>
			
	</p>
<p>
	
</p>
<p>
	Pick a module using the dropdowns above to build the content for the page.
</p><?php
		}
	}
function hail_info_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['hail_info_nonce'] ) || ! wp_verify_nonce( $_POST['hail_info_nonce'], '_hail_info_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( isset( $_POST['hail_info_module_1'] ) )
		update_post_meta( $post_id, 'hail_info_module_1', esc_attr( $_POST['hail_info_module_1'] ) );
	if ( isset( $_POST['hail_info_module_2'] ) )
		update_post_meta( $post_id, 'hail_info_module_2', esc_attr( $_POST['hail_info_module_2'] ) );
}
add_action( 'save_post', 'hail_info_save' );




