<?php
/**
 * Plugin Name: Product Banner Image for WooCommerce
 * Description: Product Banner Image for WooCommerce is easily manage gift order in woocommerce platform. In this plugin you can easily handle order as a gift.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Rejuan Ahamed
 * Text Domain:       wcpb
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


defined( 'ABSPATH' ) || exit;

/**
* Support for Multi Network Site
*/
if( !function_exists('is_plugin_active_for_network') ){
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

/**
* @Type
* @Version
* @Directory URL
* @Directory Path
* @Plugin Base Name
*/
define('WPBI_FILE', __FILE__);
define('WPBI_VERSION', '1.0.0');
define('WPBI_DIR_URL', plugin_dir_url( WPBI_FILE ));
define('WPBI_DIR_PATH', plugin_dir_path( WPBI_FILE ));
define('WPBI_BASENAME', plugin_basename( WPBI_FILE ));
/**
* Load Text Domain Language
*/
add_action('init', 'wpbi_language_load');
function wpbi_language_load(){
    load_plugin_textdomain('wcpb', false, basename(dirname( WPBI_FILE )).'/languages/');
}

if (!function_exists('wpbi_function')) {
    function wpbi_function() {
        require_once WPBI_DIR_PATH . 'includes/Functions.php';
        return new \WPBI\Functions();
    }
}

if (!class_exists( 'Product_Banner_Image' )) {
    require_once WPBI_DIR_PATH . 'includes/Product_Banner_Image.php';
    new \WPBI\Product_Banner_Image();
}




add_action('woocommerce_before_single_product_summary', function() {

    defined( 'ABSPATH' ) || exit;
    
    global $post;
    $wp_banner_image   = get_post_meta($post->ID, 'wp_product_banner_image', true);
    $banner_info = json_decode($wp_banner_image, true);

    if (is_array($banner_info)) {
        if (count($banner_info) > 0) {
            foreach ($banner_info as $value) { 
                if( $value['enable_banner_image'] == 'yes' ) { ?>
                    <div class="wpbi-shadow wpbi-padding15 wpbi-clearfix" 
                    style="background-image: url(<?php echo !empty($value['product_banner_bg_image']) ? wp_get_attachment_url( $value["product_banner_bg_image"] ) : ''; ?>); background-repeat: no-repeat; background-size: cover;">
                        <h2><?php echo wpautop(wp_unslash($value['product_banner_title'])); ?></h2>
                        <div><?php echo wpautop(wp_unslash($value['product_banner_description'])); ?></div>

                        <a href="<?php echo esc_url($value['wp_banner_button_url']); ?>">
                            <?php echo $value['wp_banner_button_name']; ?>
                        </a>
                    </div>
                <?php
                }
            }
        }
    }
    ?>
    <div style="clear: both"></div>

    <?php
} );



















// Add term page
function custom_url_taxonomy_add_new_meta_field() { ?>
    <div class="form-field">
        <h2 for="term_meta[custom_term_meta]"><?php _e( 'Add Category Banner Image', 'custom_url_category' ); ?></h2>
		<label for="term_meta[custom_term_meta]"><?php _e( 'Custom url category', 'custom_url_category' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Inserisci un custom url prodotto per la categoria','custom_url_category' ); ?></p>
	</div>
<?php
}
add_action( 'product_cat_add_form_fields', 'custom_url_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function custom_url_taxonomy_edit_meta_field($term) {
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Custom url category', 'custom_url_category' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Inserisci un custom url prodotto per la categoria','custom_url_category' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'custom_url_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );

		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}

		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'save_taxonomy_custom_meta', 10, 2 );
