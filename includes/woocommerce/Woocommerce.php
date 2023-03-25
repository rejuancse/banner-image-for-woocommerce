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
       // $var = stripslashes($var);
        $data_array = json_decode($var, true);

        $woocommerce_meta_field = array(

            // Pledge Amount
            array(
                'id'            => 'wp_product_banner_image_pladge_amount[]',
                'label'         => __('Pledge Amount', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Pledge Amount', 'wcpb'),
                'value'         => '',
                'class'         => 'wc_input_price',
                'field_type'    => 'textfield'
            ),
            
            // Banner Title
            array(
                'id'            => 'wp_product_banner_image_title[]',
                'label'         => __('Title', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Banner Title Description', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textareafield',
            ),

            array(
                'id'            => 'wp_product_banner_image_description[]',
                'label'         => __('Banner Intro Text', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'text',
                'placeholder'   => __('Write Description', 'wcpb'),
                'value'         => '',
                'field_type'    => 'textareafield',
            ),


            // Reward Image
            array(
                'id'            => 'wp_product_banner_image_image_field[]',
                'label'         => __('Image Field', 'wcpb'),
                'desc_tip'      => 'true',
                'type'          => 'image',
                'placeholder'   => __('Image Field', 'wcpb'),
                'value'         => '',
                'class'         => '',
                'field_type'    => 'image'
            ),

        );
        ?>

        <div id='banner_image_options' class='panel woocommerce_options_panel'>
            <?php
            $display = 'block';
            $meta_count = is_array($data_array) ? count($data_array) : 0;
            $field_count = count($woocommerce_meta_field);
            if ( $meta_count > 0 ){ $display = 'none'; }

            /*
            * Print without value of Reward System for clone group
            */
            echo "<div class='reward_group' style='display:" . $display . ";'>";
            echo "<div class='banner_image_field_wrap'>";

            foreach ($woocommerce_meta_field as $value) {
                switch ($value['field_type']) {

                    case 'textareafield':
                        woocommerce_wp_textarea_input($value);
                        break;

                    case 'selectfield':
                        woocommerce_wp_select($value);
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

            echo '<input name="remove_rewards" type="button" class="button tagadd removeCampaignRewards" value="' . __('- Remove', 'wcpb') . '" />';
            echo "</div>";
            echo "</div>";


            /*
            * Print with value of Reward System
            */
            if ($meta_count > 0) {
                if (is_array($data_array) && !empty($data_array)) {
                    foreach ($data_array as $k => $v) {
                        echo "<div class='reward_group'>";
                        echo "<div class='banner_image_field_wrap'>";
                        foreach ($woocommerce_meta_field as $value) {
                            if(isset( $v[str_replace('[]', '', $value['id'])] )){
                                $value['value'] = $v[str_replace('[]', '', $value['id'])];
                            }else{
                                $value['value'] = '';
                            }
                            switch ($value['field_type']) {

                                case 'textareafield':
                                    $value['value'] = wp_unslash($value['value']);
                                    woocommerce_wp_textarea_input($value);
                                    break;

                                case 'selectfield':
                                    woocommerce_wp_select($value);
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
                        echo '<input name="remove_rewards" type="button" class="button tagadd removeCampaignRewards" value="' . __('- Remove', 'wcpb') . '" />';
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
    function reward_action($post_id){
        if (!empty($_POST['wp_product_banner_image_pladge_amount'])) {
            $data             = array();

            $pladge_amount    = $_POST['wp_product_banner_image_pladge_amount'];
            $image_field      = $_POST['wp_product_banner_image_image_field'];
            $banner_title     = $_POST['wp_product_banner_image_title'];
            $description      = $_POST['wp_product_banner_image_description'];

            $field_count      = count($pladge_amount);

            for ($i = 0; $i < $field_count; $i++) {
                if (!empty($pladge_amount[$i])) {
                    $data[] = array(
                        'wp_product_banner_image_pladge_amount'   => intval($pladge_amount[$i]),
                        'wp_product_banner_image_image_field'     => intval($image_field[$i]),
                        'wp_product_banner_image_title'     => $banner_title[$i],
                        'wp_product_banner_image_description'     => $description[$i],
                    );
                }
            }
            $data_json = json_encode( $data, JSON_UNESCAPED_UNICODE );
            wpbi_function()->update_meta($post_id, 'wp_product_banner_image', wp_slash($data_json));
        }
    }
} //End class bracket