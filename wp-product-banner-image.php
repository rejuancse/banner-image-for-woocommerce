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












//Product Cat creation page
function text_domain_taxonomy_add_new_meta_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[wh_meta_title]"><?php _e('Meta Title', 'text_domain'); ?></label>
        <input type="text" name="term_meta[wh_meta_title]" id="term_meta[wh_meta_title]">
        <p class="description"><?php _e('Enter a meta title, <= 60 character', 'text_domain'); ?></p>
    </div>
    <div class="form-field">
        <label for="term_meta[wh_meta_desc]"><?php _e('Meta Description', 'text_domain'); ?></label>
        <textarea name="term_meta[wh_meta_desc]" id="term_meta[wh_meta_desc]"></textarea>
        <p class="description"><?php _e('Enter a meta description, <= 160 character', 'text_domain'); ?></p>
    </div>
    <?php
}

add_action('product_cat_add_form_fields', 'text_domain_taxonomy_add_new_meta_field', 10, 2);

//Product Cat Edit page
function text_domain_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("taxonomy_" . $term_id);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[wh_meta_title]"><?php _e('Meta Title', 'text_domain'); ?></label></th>
        <td>
            <input type="text" name="term_meta[wh_meta_title]" id="term_meta[wh_meta_title]" value="<?php echo esc_attr($term_meta['wh_meta_title']) ? esc_attr($term_meta['wh_meta_title']) : ''; ?>">
            <p class="description"><?php _e('Enter a meta title, <= 60 character', 'text_domain'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[wh_meta_desc]"><?php _e('Meta Description', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[wh_meta_desc]" id="term_meta[wh_meta_desc]"><?php echo esc_attr($term_meta['wh_meta_desc']) ? esc_attr($term_meta['wh_meta_title']) : ''; ?></textarea>
            <p class="description"><?php _e('Enter a meta description', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}

add_action('product_cat_edit_form_fields', 'text_domain_taxonomy_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_option("taxonomy_" . $term_id);
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option("taxonomy_" . $term_id, $term_meta);
    }
}

add_action('edited_product_cat', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_product_cat', 'save_taxonomy_custom_meta', 10, 2);


// Save extra taxonomy fields callback function - create.
function wh_save_taxonomy_custom_meta_create($term_id) {

    $wh_meta_title = filter_input(INPUT_POST, 'wh_meta_title');
    $wh_meta_desc = filter_input(INPUT_POST, 'wh_meta_desc');
    
    update_term_meta($term_id, 'wh_meta_title', $wh_meta_title);
    update_term_meta($term_id, 'wh_meta_desc', $wh_meta_desc);
    }
    
// Save extra taxonomy fields callback function - edit.
function wh_save_taxonomy_custom_meta($term_id) {
    $screen = get_current_screen();
    if ( $screen->id != 'edit-product_cat' )
            return; // exit if incorrect screen id

$wh_meta_title = filter_input(INPUT_POST, 'wh_meta_title');
$wh_meta_desc = filter_input(INPUT_POST, 'wh_meta_desc');

update_term_meta($term_id, 'wh_meta_title', $wh_meta_title);
update_term_meta($term_id, 'wh_meta_desc', $wh_meta_desc);
}

add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta_create', 10, 1);