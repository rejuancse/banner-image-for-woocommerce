<?php 
namespace WPBI\woocommerce;

if ( ! class_exists( 'wpbi_product_category_image' ) ) {

    class wpbi_product_category_image {
    
        public function __construct() {
            //
        }
        
        /*
        * Initialize the class and start calling our hooks and filters
        * @since 1.0.0
        */
        public function init() {
            add_action( 'product_cat_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
            add_action( 'created_product_cat', array ( $this, 'save_category_image' ), 10, 2 );
            add_action( 'product_cat_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
            add_action( 'edited_product_cat', array ( $this, 'updated_category_banner_image' ), 10, 2 );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
            add_action( 'admin_footer', array ( $this, 'add_script' ) );
        }
        
        public function load_media() {
            wp_enqueue_media();
        }
        
        /*
        * Add a form field in the new category page
        * @since 1.0.0
        */
        public function add_category_image ( $taxonomy ) { ?>
            <div class="form-field">
                <h2><?php esc_html_e('Category Banner BG Image', 'wpbi'); ?></h2>
            </div>
            
            <!-- Enable Banner Image -->
            <div class="form-field">
                <label for="term_meta[banner_image_visiblity]"><?php esc_html_e('Enable Banner Image', 'wpbi'); ?></label>
                <select id="term_meta[banner_image_visiblity]" name="term_meta[banner_image_visiblity]">
                    <option value="no" selected><?php esc_html_e('No', 'wpbi'); ?></option>
                    <option value="yes"><?php esc_html_e('Yes', 'wpbi'); ?></option>
                </select>
            </div>

            <!-- Banner Title -->
            <div class="form-field">
                <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'wpbi'); ?></label>
                <input type="text" name="term_meta[category_banner_title]" id="term_meta[category_banner_title]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Title', 'wpbi'); ?></p>
            </div>

            <!-- Banner Short Description -->
            <div class="form-field">
                <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Description', 'wpbi'); ?></label>
                <input type="text" name="term_meta[category_banner_short_desc]" id="term_meta[category_banner_short_desc]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Short Description', 'wpbi'); ?></p>
            </div>

            <!-- Banner Button Name -->
            <div class="form-field">
                <label for="term_meta[category_banner_Button_Name]"><?php esc_html_e('Banner Button Name', 'wpbi'); ?></label>
                <input type="text" name="term_meta[category_banner_Button_Name]" id="term_meta[category_banner_Button_Name]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN Name', 'wpbi'); ?></p>
            </div>

            <!-- Banner Button URL -->
            <div class="form-field">
                <label for="term_meta[category_banner_Button_url]"><?php esc_html_e('Banner Button URL', 'wpbi'); ?></label>
                <input type="text" name="term_meta[category_banner_Button_url]" id="term_meta[category_banner_Button_url]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN URL', 'wpbi'); ?></p>
            </div>

            <!-- Banner Image -->
            <div class="form-field term-group">
                <label for="category-image-id"><?php _e('Upload Banner Image', 'wpbi'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'wpbi' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'wpbi' ); ?>" />
                </p>
            </div>
        <?php
        }
        
        /*
        * Edit the form field
        * @since 1.0.0
        */
        public function update_category_image ( $term, $taxonomy ) {
            $t_id = $term->term_id;
            $term_meta = get_option("taxonomy_$t_id"); ?>

            <tr class="form-field">
                <th scope="row" valign="top">
                    <h2><?php esc_html_e('Category Banner BG Image', 'wpbi'); ?></h2>
                </th>
            </tr>

            <!-- Enable Banner Image -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[banner_image_visiblity]"><?php esc_html_e('Enable Banner Image', 'wpbi'); ?></label>
                </th>
                <td>
                    <select name="term_meta[banner_image_visiblity]" id="term_meta[banner_image_visiblity]">
                        <option value="no" <?php echo !empty($term_meta['banner_image_visiblity']) == 'no' ? 'selected' : ''; ?>><?php esc_html_e('No', 'wpbi'); ?></option>
                        <option value="yes" <?php echo !empty($term_meta['banner_image_visiblity']) == 'yes' ? 'selected' : ''; ?>><?php esc_html_e('Yes', 'wpbi'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('Enable Banner Image for category Page', 'wpbi'); ?></p>
                </td>
            </tr>

            <!-- Banner Title -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'wpbi'); ?></label>
                </th>
                <td>
                    <input type="text" 
                    name="term_meta[category_banner_title]" 
                    id="term_meta[category_banner_title]" 
                    value="<?php echo !empty( $term_meta['category_banner_title'] ) ? esc_attr( $term_meta['category_banner_title'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Title', 'wpbi'); ?></p>
                </td>
            </tr>

            <!-- Banner Short Description -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Descriptions', 'wpbi'); ?></label>
                </th>
                <td>
                    <input type="text" 
                    name="term_meta[category_banner_short_desc]" 
                    id="term_meta[category_banner_short_desc]" 
                    value="<?php echo !empty( $term_meta['category_banner_short_desc'] ) ? esc_attr( $term_meta['category_banner_short_desc'] ) : ''; ?>" />
                    <p class="description"><?php esc_html_e('Write Banner Short Descriptions', 'wpbi'); ?></p>
                </td>
            </tr>

            <!-- Banner Button Name -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_Button_Name]"><?php esc_html_e('Banner Button Name', 'wpbi'); ?></label>
                </th>
                <td>
                    <input type="text" 
                    name="term_meta[category_banner_Button_Name]" 
                    id="term_meta[category_banner_Button_Name]" 
                    value="<?php echo !empty( $term_meta['category_banner_Button_Name'] ) ? esc_attr( $term_meta['category_banner_Button_Name'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Button Name', 'wpbi'); ?></p>
                </td>
            </tr>

            <!-- Banner Button URL -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_Button_url]"><?php esc_html_e('Banner Button URL', 'wpbi'); ?></label>
                </th>
                <td>
                    <input type="text" 
                    name="term_meta[category_banner_Button_url]" 
                    id="term_meta[category_banner_Button_url]" 
                    value="<?php echo !empty( $term_meta['category_banner_Button_url'] ) ? esc_attr( $term_meta['category_banner_Button_url'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Button URL', 'wpbi'); ?></p>
                </td>
            </tr>

            <!-- Banner Image -->
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php _e( 'Category Page Banner Image', 'wpbi' ); ?></label>
                </th>
                <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
                    <div id="category-image-wrapper">
                        <?php if ( $image_id ) { ?>
                        <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'wpbi' ); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'wpbi' ); ?>" />
                    </p>
                </td>
            </tr>
        <?php
        }

        /*
        * Save the form field
        * @since 1.0.0
        */
        public function save_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
            $image = $_POST['category-image-id'];
                add_term_meta( $term_id, 'category-image-id', $image, true );
            }

            if ( isset( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option("taxonomy_$t_id");
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset ( $_POST['term_meta'][$key] ) ) {
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // save the option array
                update_option("taxonomy_$t_id", $term_meta);
            }
        }
        
        /*
        * Update the form field value
        * @since 1.0.0
        */
        public function updated_category_banner_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                $image = $_POST['category-image-id'];
                update_term_meta ( $term_id, 'category-image-id', $image );
            } else {
                update_term_meta ( $term_id, 'category-image-id', '' );
            }

            if ( isset( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option("taxonomy_$t_id");
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset ( $_POST['term_meta'][$key] ) ) {
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // save the option array
                update_option("taxonomy_$t_id", $term_meta);
            }
        }
        
        /*
        * Add script
        * @since 1.0.0
        */
        public function add_script() { ?>
            <script>
                jQuery(document).ready( function($) {
                    function wpbi_media_upload(button_class) {
                        var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                        $('body').on('click', button_class, function(e) {
                            var button_id = '#'+$(this).attr('id');
                            var send_attachment_bkp = wp.media.editor.send.attachment;
                            var button = $(button_id);
                            _custom_media = true;
                            wp.media.editor.send.attachment = function(props, attachment){
                                if ( _custom_media ) {
                                    $('#category-image-id').val(attachment.id);
                                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                    $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                                } else {
                                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                                }
                            }
                            wp.media.editor.open(button);
                            return false;
                        });
                    }

                    wpbi_media_upload('.ct_tax_media_button.button');

                    $('body').on('click','.ct_tax_media_remove',function(){
                        $('#category-image-id').val('');
                        $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    });

                    $(document).ajaxComplete(function(event, xhr, settings) {
                        var queryStringArr = settings.data.split('&');
                        if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                            var xml = xhr.responseXML;
                            $response = $(xml).find('term_id').text();
                            if($response!=""){
                                // Clear the thumb image
                                $('#category-image-wrapper').html('');
                            }
                        }
                    });
                });
            </script>
        <?php }
    }

    $wpbi_product_category_image = new wpbi_product_category_image();
    $wpbi_product_category_image -> init();   
}
// Add term page
