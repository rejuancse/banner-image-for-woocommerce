<?php
namespace BIW\Admin;

if ( ! class_exists( 'BIW_Category_Banner_Image' ) ) {

    class BIW_Category_Banner_Image {

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
                <h2><?php esc_html_e('Category Banner BG Image', 'biw'); ?></h2>
            </div>

            <!-- Banner Image -->
            <div class="form-field term-group">
                <label for="category-image-id"><?php _e('Upload Banner Image', 'biw'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'biw' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'biw' ); ?>" />

                    <?php wp_nonce_field( 'save_category_image_nonce_action', 'save_category_image_nonce' ); ?>
                </p>
            </div>

            <!-- Banner SubTitle -->
            <div class="form-field">
                <label for="term_meta[category_banner_subtitle]"><?php esc_html_e('Banner SubTitle', 'biw'); ?></label>
                <input type="text" name="term_meta[category_banner_subtitle]" id="term_meta[category_banner_subtitle]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Title', 'biw'); ?></p>
            </div>

            <!-- Banner Title -->
            <div class="form-field">
                <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'biw'); ?></label>
                <input type="text" name="term_meta[category_banner_title]" id="term_meta[category_banner_title]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Title', 'biw'); ?></p>
            </div>

            <!-- Banner Short Description -->
            <div class="form-field">
                <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Description', 'biw'); ?></label>
                <input type="text" class="cat-desc"  name="term_meta[category_banner_short_desc]" id="term_meta[category_banner_short_desc]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Short Description', 'biw'); ?></p>
            </div>

            <!-- Banner Button Name -->
            <div class="form-field">
                <label for="term_meta[category_banner_Button_Name]"><?php esc_html_e('Banner Button Name', 'biw'); ?></label>
                <input type="text" name="term_meta[category_banner_Button_Name]" id="term_meta[category_banner_Button_Name]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN Name', 'biw'); ?></p>
            </div>

            <!-- Banner Button URL -->
            <div class="form-field">
                <label for="term_meta[category_banner_Button_url]"><?php esc_html_e('Banner Button URL', 'biw'); ?></label>
                <input type="text" name="term_meta[category_banner_Button_url]" id="term_meta[category_banner_Button_url]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN URL', 'biw'); ?></p>
            </div>

            <!-- Enable Full Banner Link -->
            <div class="form-field">
                <label for="term_meta[category_banner_full_link]"><?php esc_html_e('Enable Full Banner Link', 'biw'); ?></label>
                <select id="term_meta[category_banner_full_link]" name="term_meta[category_banner_full_link]">
                    <option value="no" selected><?php esc_html_e('Disable', 'biw'); ?></option>
                    <option value="yes"><?php esc_html_e('Enable', 'biw'); ?></option>
                </select>
            </div>

            <?php wp_nonce_field( 'biw_settings_page_action', 'biw_settings_page_nonce_field' ); ?>
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
                    <h2><?php esc_html_e('Category Banner BG Image', 'biw'); ?></h2>
                </th>
            </tr>

            <!-- Update Banner Image -->
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php _e( 'Upload Banner Image', 'biw' ); ?></label>
                </th>
                <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo esc_attr($image_id); ?>">
                    <div id="category-image-wrapper">
                        <?php if ( $image_id ) { ?>
                        <?php echo wp_kses_post(wp_get_attachment_image ( $image_id, 'thumbnail' )); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'biw' ); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'biw' ); ?>" />
                    </p>
                    <?php wp_nonce_field( 'update_category_image_nonce_action', 'update_category_image_nonce' ); ?>
                </td>
            </tr>

            <!-- Banner SubTitle -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_subtitle]"><?php esc_html_e('Banner SubTitle', 'biw'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_subtitle]"
                    id="term_meta[category_banner_subtitle]"
                    value="<?php echo !empty( $term_meta['category_banner_subtitle'] ) ? esc_attr( $term_meta['category_banner_subtitle'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Title', 'biw'); ?></p>
                </td>
            </tr>

            <!-- Banner Title -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'biw'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_title]"
                    id="term_meta[category_banner_title]"
                    value="<?php echo !empty( $term_meta['category_banner_title'] ) ? esc_attr( $term_meta['category_banner_title'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Title', 'biw'); ?></p>
                </td>
            </tr>

            <!-- Banner Short Description -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Descriptions', 'biw'); ?></label>
                </th>
                <td>
                    <input type="text" class="cat-desc"
                    name="term_meta[category_banner_short_desc]"
                    id="term_meta[category_banner_short_desc]"
                    value="<?php echo !empty( $term_meta['category_banner_short_desc'] ) ? esc_attr( $term_meta['category_banner_short_desc'] ) : ''; ?>" />
                    <p class="description"><?php esc_html_e('Write Banner Short Descriptions', 'biw'); ?></p>
                </td>
            </tr>

            <!-- Banner Button Name -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_Button_Name]"><?php esc_html_e('Banner Button Name', 'biw'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_Button_Name]"
                    id="term_meta[category_banner_Button_Name]"
                    value="<?php echo !empty( $term_meta['category_banner_Button_Name'] ) ? esc_attr( $term_meta['category_banner_Button_Name'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Button Name', 'biw'); ?></p>
                </td>
            </tr>

            <!-- Banner Button URL -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_Button_url]"><?php esc_html_e('Banner Button URL', 'biw'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_Button_url]"
                    id="term_meta[category_banner_Button_url]"
                    value="<?php echo !empty( $term_meta['category_banner_Button_url'] ) ? esc_attr( $term_meta['category_banner_Button_url'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Button URL', 'biw'); ?></p>
                </td>
            </tr>

            <!-- Enable Full Banner Link -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_full_link]"><?php esc_html_e('Enable Full Banner Link', 'biw'); ?></label>
                </th>
                <td>
                    <select name="term_meta[category_banner_full_link]" id="term_meta[category_banner_full_link]">
                        <option value="no" <?php echo !empty($term_meta['category_banner_full_link']) == 'no' ? 'selected' : ''; ?>><?php esc_html_e('Disable', 'biw'); ?></option>
                        <option value="yes" <?php echo !empty($term_meta['category_banner_full_link']) == 'yes' ? 'selected' : ''; ?>><?php esc_html_e('Enable', 'biw'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('Enable Full Banner Link', 'biw'); ?></p>
                </td>
            </tr>
        <?php
        }

        /*
        * Save the form field
        * @since 1.0.0
        */
        public function save_category_image ( $term_id, $tt_id ) {
            if ( ! isset( $_POST['save_category_image_nonce'] ) || ! wp_verify_nonce( $_POST['save_category_image_nonce'], 'save_category_image_nonce_action' ) ) {
                return;
            }

            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ) {
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
            // Verify the nonce before processing the form data
            if ( ! isset( $_POST['update_category_image_nonce'] ) ||
                 ! wp_verify_nonce( $_POST['update_category_image_nonce'], 'update_category_image_nonce_action' ) ) {
                return;
            }

            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ) {
                $image = $_POST['category-image-id'];
                update_term_meta( $term_id, 'category-image-id', $image );
            } else {
                update_term_meta( $term_id, 'category-image-id', '' );
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
                    function biw_media_upload(button_class) {
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

                    biw_media_upload('.ct_tax_media_button.button');

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

    $BIW_Category_Banner_Image = new BIW_Category_Banner_Image();
    $BIW_Category_Banner_Image -> init();
}
// Add term page
