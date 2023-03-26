<?php
namespace WPBI\woocommerce;

defined( 'ABSPATH' ) || exit;

class Woocommerce {

    protected static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
		add_filter( 'woocommerce_product_data_tabs', array($this, 'add_my_custom_product_data_tab') );
        add_action( 'woocommerce_product_data_panels', array( $this, 'woocom_custom_product_data_fields' ) );
        add_action( 'woocommerce_process_product_meta',  array($this, 'reward_action'));
    }

    public function add_my_custom_product_data_tab( $product_data_tabs ) {
		$product_data_tabs['product-banner-image'] = array(
			'label'     => __( 'Product Banner Image', 'wcpb' ),
			'target'    => 'banner_image_options',
			'class'     => array( 'show_if_simple' ),
		);
		return $product_data_tabs;
	}

    /*
    * Add Reward tab Content(Woocommerce).
    * Only show the fields under Reward Tab
    */
    function woocom_custom_product_data_fields($post_id){
        global $post;

        $var = get_post_meta($post->ID, 'wp_product_banner_image', true);
        $data_array = json_decode($var, true);

        $woocommerce_meta_field = array(

            // Enable Banner
            array(
                'id'            => 'enable_banner_image[]',
                'label'         => __('Enable Banner Image', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'checkbox',
                'placeholder'   => __('Enable Banner Image', 'wcpb'),
                'field_type'    => 'checkboxfield'
            ),
            
            // Banner Title
            array(
                'id'            => 'wp_product_banner_image_title[]',
                'label'         => __('Banner Title', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Write Banner Title', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textfield',
            ),

			// Short Description
            array(
                'id'            => 'wp_product_banner_image_description[]',
                'label'         => __('Banner Intro Text', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Write short description', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textfield',
            ),

            // Banner Image
            array(
                'id'            => 'wp_product_banner_image_image_field[]',
                'label'         => __('Upload Banner Image', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'image',
                'value'         => '',
                'field_type'    => 'image'
            ),

			// Button Name
            array(
                'id'            => 'wp_banner_button_name[]',
                'label'         => __('Button Name', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Write Banner button Name', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textfield',
            ),

			// Banner URL
            array(
                'id'            => 'wp_banner_button_url[]',
                'label'         => __('Banner URL', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Add custom URL', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textfield',
            ),
        );
        ?>

        <div id='banner_image_options' class='panel woocommerce_options_panel AA'>
            <?php
            $display = 'block';
            $meta_count = is_array($data_array) ? count($data_array) : 0;
            $field_count = count($woocommerce_meta_field);
            if ( $meta_count > 0 ){ $display = 'none'; }

            /*
            * Print without value of Reward System for clone group
            */
			if( $meta_count == '0' ) {
				echo "<div class='banner_image_wrap'>";
				echo "<div class='banner_image_field_wrap'>";

				foreach ($woocommerce_meta_field as $value) {
					switch ($value['field_type']) {
						case 'checkboxfield':
							woocommerce_wp_checkbox($value);
							break;

						case 'image':
							echo '<p class="form-field">';
							echo '<label for="wp_product_banner_image_image_field">'.$value["label"].'</label>';
							echo '<input type="hidden" class="wp_product_banner_image_image_field" name="'.$value["id"].'" value="" placeholder="'.$value["label"].'"/>';
							echo '<span class="wpneo-image-container"></span>';
							echo '<button class="wpneo-image-upload-btn shorter">'.__("Upload","wp-wpbi").'</button>';
							echo '</p>';
							break;

						default:
							woocommerce_wp_text_input($value);
							break;
					}
				}

				echo "</div>";
				echo "</div>";
			}

            /*
            * Print with value of Reward System
            */
            if ($meta_count > 0) {
                if (is_array($data_array) && !empty($data_array)) {
                    foreach ($data_array as $k => $v) {
                        echo "<div class='banner_image_wrap Alex'>";
                        echo "<div class='banner_image_field_wrap'>";
                        foreach ($woocommerce_meta_field as $value) {
                            if(isset( $v[str_replace('[]', '', $value['id'])] )){
                                $value['value'] = $v[str_replace('[]', '', $value['id'])];
                            }else{
                                $value['value'] = '';
                            }
                            switch ($value['field_type']) {

								case 'checkboxfield':
									woocommerce_wp_checkbox($value);
									break;

                                case 'image':
                                    $image_id = $value['value'];
                                    $raw_id = $image_id;
                                    if( $image_id!=0 && $image_id!='' ){
                                        $image_id = wp_get_attachment_url( $image_id );
                                        $image_id = '<img width="100" src="'.$image_id.'"><span class="wpneo-image-remove">x</span>';
                                    }else{
                                        $image_id = '';
                                    }
                                    echo '<p class="form-field">';
                                    echo '<label for="wp_product_banner_image_image_field">'.$value["label"].'</label>';
                                    echo '<input type="hidden" class="wp_product_banner_image_image_field" name="'.$value["id"].'" value="'.$raw_id.'" placeholder="'.$value["label"].'"/>';
                                    echo '<span class="wpneo-image-container">'.$image_id.'</span>';
                                    echo '<button class="wpneo-image-upload-btn shorter">'.__("Upload","wp-wpbi").'</button>';
                                    echo '</p>';
                                    break;

                                default:
                                    woocommerce_wp_text_input($value);
                                    break;
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>

        <?php
    }

    /*
    * Save Reward tab Data(Woocommerce).
    * Update Post Meta for Reward Tab
    */
    function reward_action($post_id) {
		$data             = array();

		$enable_banner    = $_POST['enable_banner_image'];
		$banner_title     = esc_html($_POST['wp_product_banner_image_title']);
		$description      = $_POST['wp_product_banner_image_description'];
		$image_field      = $_POST['wp_product_banner_image_image_field'];

		$button_name      = $_POST['wp_banner_button_name'];
		$button_url       = $_POST['wp_banner_button_url'];
		
		$data[] = array (
			'enable_banner_image'     => $enable_banner[0],
			'wp_product_banner_image_title'     => $banner_title[0],
			'wp_product_banner_image_description'     => $description[0],
			'wp_product_banner_image_image_field'     => intval($image_field[0]),

			'wp_banner_button_name'    => $button_name[0],
			'wp_banner_button_url'     => $button_url[0],
		);

		$data_json = json_encode( $data, JSON_UNESCAPED_UNICODE );
		wpbi_function()->update_meta($post_id, 'wp_product_banner_image', wp_slash($data_json));
    }

} //End class bracket
