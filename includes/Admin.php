<?php
/**
 * The admin class
 */

class WC_Settings_product_banner_Plugin {

    /**
     * Constructor
     */
    public function __construct() {
        $this->id    = 'settings-product-banner-image';
		add_filter( 'woocommerce_product_data_tabs', array($this, 'add_my_custom_product_data_tab') );
		add_filter( 'admin_head', array($this, 'wcpp_custom_style') );
        add_action( 'woocommerce_product_data_panels', array( $this, 'woocom_custom_product_data_fields' ) );
		add_action( 'woocommerce_process_product_meta_simple', array($this, 'woocom_save_proddata_custom_fields') );
		add_action( 'woocommerce_process_product_meta_variable', array($this, 'woocom_save_proddata_custom_fields') );
		add_action( 'woocommerce_product_after_variable_attributes', array($this, 'woocom_save_proddata_custom_fields') );
		add_action( 'woocommerce_process_product_meta', array($this, 'woocom_save_proddata_custom_fields') );
    }

	public function add_my_custom_product_data_tab( $product_data_tabs ) {
		$product_data_tabs['product-banner-image'] = array(
			'label'     => __( 'Product Banner Image', 'wcpb' ),
			'target'    => 'my_custom_product_data',
			'class'     => array( 'show_if_simple' ),
		);
		return $product_data_tabs;
	}

	// functions you can call to output text boxes, select boxes, etc.
	public function woocom_custom_product_data_fields() {
		global $post; ?> 

		<div id='my_custom_product_data' class = 'panel woocommerce_options_panel' >
			<div class = 'options_group' >
				<?php
					// Checkbox
					woocommerce_wp_checkbox(
						array(
							'id'        => '_checkbox',
							'label'     => __('Enable Banner', 'wcpb' ),
						)
					);

					// Text Field
					woocommerce_wp_text_input(
						array(
							'id'            => '_text_field',
							'label'         => __( 'Banner Title', 'wcpb' ),
							'wrapper_class' => 'show_if_simple', //show_if_simple or show_if_variable
							'placeholder'   => 'Banner Title',
							'desc_tip'      => 'true',
							'description'   => __( 'Enter the custom value here.', 'wcpb' )
						)
					);

					// Textarea
					woocommerce_wp_textarea_input(
						array (
							'id'            => '_textarea',
							'label'         => __( 'Banner Intro Text', 'wcpb' ),
							'placeholder'   => '',
							'desc_tip'      => 'true',
							'description'   => __( 'Add your Banner info.', 'wcpb' )
						)
					);

					// Number Field
					woocommerce_wp_text_input(
						array(
							'id'            => '_number_field',
							'label'         => __( 'Custom Number Field', 'wcpb' ),
							'placeholder'   => '',
							'description'   => __( 'Enter the custom value here.', 'wcpb' ),
							'type'          => 'number',
							'desc_tip'      => 'true',
							'custom_attributes'         => array(
								'step'      => 'any',
								'min'       => '15'
							)
						)
					);

					// Select
					woocommerce_wp_select(
						array(
							'id'      	=> '_select',
							'label'   	=> __( 'Custom Select Field', 'wcpb' ),
							'options' 	=> array(
									'one'   	=> __( 'Custom Option 1', 'wcpb' ),
									'two'   	=> __( 'Custom Option 2', 'wcpb' ),
									'three' 	=> __( 'Custom Option 3', 'wcpb' )
								)
						)
					);
				?>
			</div>
		</div>
		<?php
	}

	/** Hook callback function to save custom fields information */
	public function woocom_save_proddata_custom_fields($post_id) {
		// Save Text Field
		$text_field = $_POST['_text_field'];
		update_post_meta($post_id, '_text_field', esc_attr($text_field));
		
		// Save Number Field
		$number_field = $_POST['_number_field'];
		update_post_meta($post_id, '_number_field', esc_attr($number_field));
		
		// Save Textarea
		$textarea = $_POST['_textarea'];
		update_post_meta($post_id, '_textarea', esc_html($textarea));

		// Save Select
		$select = $_POST['_select'];
		update_post_meta($post_id, '_select', esc_attr($select));
		
		// Save Checkbox
		$checkbox = isset($_POST['_checkbox']) ? 'yes' : 'no';
		update_post_meta($post_id, '_checkbox', $checkbox);

		// Save Hidden field
		$hidden = $_POST['_hidden_field'];
		update_post_meta($post_id, '_hidden_field', esc_attr($hidden));
	}

	/** CSS To Add Custom tab Icon */
	public function wcpp_custom_style() { ?>
		<style>
			#woocommerce-product-data ul.wc-tabs li.product-banner-image_options a:before { 
				font-family: WooCommerce; 
				content: '\e006'; 
			}
		</style>
	<?php 
	}
}

return new WC_Settings_product_banner_Plugin();
