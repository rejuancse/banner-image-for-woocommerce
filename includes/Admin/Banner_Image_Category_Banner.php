<?php
namespace Banner_Image\Admin;

if ( ! class_exists( 'Banner_Image_Category_Banner' ) ) {

    class Banner_Image_Category_Banner {

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
                <h2><?php esc_html_e('Category Banner BG Image', 'banner-image'); ?></h2>
            </div>

            <!-- Banner Image -->
            <div class="form-field term-group">
                <label for="category-image-id"><?php esc_html_e('Upload Banner Image', 'banner-image'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_attr_e( 'Add Image', 'banner-image' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_attr_e( 'Remove Image', 'banner-image' ); ?>" />

                    <?php wp_nonce_field( 'save_category_image_nonce_action', 'save_category_image_nonce' ); ?>
                </p>
            </div>

            <!-- Banner SubTitle -->
            <div class="form-field">
                <label for="term_meta[category_banner_subtitle]"><?php esc_html_e('Banner SubTitle', 'banner-image'); ?></label>
                <input type="text" name="term_meta[category_banner_subtitle]" id="term_meta[category_banner_subtitle]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Title', 'banner-image'); ?></p>
            </div>

            <!-- Banner Title -->
            <div class="form-field">
                <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'banner-image'); ?></label>
                <input type="text" name="term_meta[category_banner_title]" id="term_meta[category_banner_title]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Title', 'banner-image'); ?></p>
            </div>

            <!-- Banner Short Description -->
            <div class="form-field">
                <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Description', 'banner-image'); ?></label>
                <input type="text" class="cat-desc"  name="term_meta[category_banner_short_desc]" id="term_meta[category_banner_short_desc]" value="" />
                <p class="description"><?php esc_html_e('Write Banner Short Description', 'banner-image'); ?></p>
            </div>

            <div class="form-field">
                <label for="term_meta[banner_image_category_button]"><?php esc_html_e('Banner Button Name', 'banner-image'); ?></label>
                <input type="text" class="cat-desc"  name="term_meta[banner_image_category_button]" id="term_meta[banner_image_category_button]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN Name', 'banner-image'); ?></p>
            </div>

            <!-- Banner Button URL -->
            <div class="form-field">
                <label for="term_meta[banner_image_category_button_url]"><?php esc_html_e('Banner Button URL', 'banner-image'); ?></label>
                <input type="text" class="cat-desc"  name="term_meta[banner_image_category_button_url]" id="term_meta[banner_image_category_button_url]" value="" />
                <p class="description"><?php esc_html_e('Write Banner BTN URL', 'banner-image'); ?></p>
            </div>

            <!-- Enable Full Banner Link -->
            <div class="form-field">
                <label for="term_meta[category_banner_full_link]"><?php esc_html_e('Enable Full Banner Link', 'banner-image'); ?></label>
                <select id="term_meta[category_banner_full_link]" name="term_meta[category_banner_full_link]">
                    <option value="no" selected><?php esc_html_e('Disable', 'banner-image'); ?></option>
                    <option value="yes"><?php esc_html_e('Enable', 'banner-image'); ?></option>
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
            $term_meta = get_option("banner_image_taxonomy_$t_id"); ?>

            <tr class="form-field">
                <th scope="row" valign="top">
                    <h2><?php esc_html_e('Category Banner BG Image', 'banner-image'); ?></h2>
                </th>
            </tr>

            <!-- Update Banner Image -->
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php esc_html_e( 'Upload Banner Image', 'banner-image' ); ?></label>
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
                        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_attr_e( 'Add Image', 'banner-image' ); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_attr_e( 'Remove Image', 'banner-image' ); ?>" />
                    </p>
                    <?php wp_nonce_field( 'update_category_image_nonce_action', 'update_category_image_nonce' ); ?>
                </td>
            </tr>

            <!-- Banner SubTitle -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_subtitle]"><?php esc_html_e('Banner SubTitle', 'banner-image'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_subtitle]"
                    id="term_meta[category_banner_subtitle]"
                    value="<?php echo !empty( $term_meta['category_banner_subtitle'] ) ? esc_attr( $term_meta['category_banner_subtitle'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Title', 'banner-image'); ?></p>
                </td>
            </tr>

            <!-- Banner Title -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_title]"><?php esc_html_e('Banner Title', 'banner-image'); ?></label>
                </th>
                <td>
                    <input type="text"
                    name="term_meta[category_banner_title]"
                    id="term_meta[category_banner_title]"
                    value="<?php echo !empty( $term_meta['category_banner_title'] ) ? esc_attr( $term_meta['category_banner_title'] ) : ''; ?>" />
                    <p class="description"><?php esc_attr_e('Write Banner Title', 'banner-image'); ?></p>
                </td>
            </tr>

            <!-- Banner Short Description -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_short_desc]"><?php esc_html_e('Banner Short Descriptions', 'banner-image'); ?></label>
                </th>
                <td>
                    <input type="text" class="cat-desc"
                    name="term_meta[category_banner_short_desc]"
                    id="term_meta[category_banner_short_desc]"
                    value="<?php echo !empty( $term_meta['category_banner_short_desc'] ) ? esc_attr( $term_meta['category_banner_short_desc'] ) : ''; ?>" />
                    <p class="description"><?php esc_html_e('Write Banner Short Descriptions', 'banner-image'); ?></p>
                </td>
            </tr>

            <!-- Banner Button Name -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[banner_image_category_button]"><?php esc_html_e('Banner Button Name', 'banner-image'); ?></label>
                </th>
                <td>
                    <input type="text" class="cat-desc"
                    name="term_meta[banner_image_category_button]"
                    id="term_meta[banner_image_category_button]"
                    value="<?php echo !empty( $term_meta['banner_image_category_button'] ) ? esc_attr( $term_meta['banner_image_category_button'] ) : ''; ?>" />
                    <p class="description"><?php esc_html_e('Write Banner Button Name', 'banner-image'); ?></p>
                </td>
            </tr>

            <!-- Banner Button URL -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[banner_image_category_button_url]"><?php esc_html_e('Banner Button URL', 'banner-image'); ?></label>
                </th>
                <td>
                    <input type="text" class="cat-desc"
                    name="term_meta[banner_image_category_button_url]"
                    id="term_meta[banner_image_category_button_url]"
                    value="<?php echo !empty( $term_meta['banner_image_category_button_url'] ) ? esc_attr( $term_meta['banner_image_category_button_url'] ) : ''; ?>" />
                    <p class="description"><?php esc_html_e('Write Banner Button URL', 'banner-image'); ?></p>
                </td>
            </tr>

            <!-- Enable Full Banner Link -->
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[category_banner_full_link]"><?php esc_html_e('Enable Full Banner Link', 'banner-image'); ?></label>
                </th>
                <td>
                    <select name="term_meta[category_banner_full_link]" id="term_meta[category_banner_full_link]">
                        <option value="yes" <?php echo !empty($term_meta['category_banner_full_link']) == 'yes' ? 'selected' : ''; ?>><?php esc_html_e('Enable', 'banner-image'); ?></option>
                        <option value="no" <?php echo !empty($term_meta['category_banner_full_link']) == 'no' ? 'selected' : ''; ?>><?php esc_html_e('Disable', 'banner-image'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('Enable Full Banner Link', 'banner-image'); ?></p>
                </td>
            </tr>
        <?php
        }

        /*
        * Save the form field
        * @since 1.0.0
        */
        public function save_category_image ( $term_id, $tt_id ) {
            if ( ! isset( $_POST['save_category_image_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_category_image_nonce'] ) ), 'save_category_image_nonce_action' ) ) {
                return;
            }

            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ) {
                $image = intval( $_POST['category-image-id'] ); // Sanitize integer
                add_term_meta( $term_id, 'category-image-id', $image, true );
            }

            if ( isset( $_POST['term_meta'] ) && is_array( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option("banner_image_taxonomy_$t_id");
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset( $_POST['term_meta'][$key] ) ) {
                        $term_meta[sanitize_key($key)] = sanitize_text_field( wp_unslash( $_POST['term_meta'][$key] ) );
                    }
                }
                // save the option array
                update_option("banner_image_taxonomy_$t_id", $term_meta);
            }
        }

        /*
        * Update the form field value
        * @since 1.0.0
        */
        public function updated_category_banner_image ( $term_id, $tt_id ) {
            // Verify the nonce before processing the form data
            if ( ! isset( $_POST['update_category_image_nonce'] ) ||
                 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['update_category_image_nonce'] ) ), 'update_category_image_nonce_action' ) ) {
                return;
            }

            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ) {
                $image = intval( $_POST['category-image-id'] ); // Sanitize integer
                update_term_meta( $term_id, 'category-image-id', $image );
            } else {
                update_term_meta( $term_id, 'category-image-id', '' );
            }

            if ( isset( $_POST['term_meta'] ) && is_array( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option("banner_image_taxonomy_$t_id");
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset( $_POST['term_meta'][$key] ) ) {
                        $term_meta[sanitize_key($key)] = sanitize_text_field( wp_unslash( $_POST['term_meta'][$key] ) );
                    }
                }
                // save the option array
                update_option("banner_image_taxonomy_$t_id", $term_meta);
            }
        }
    }

    $Banner_Image_Category_Banner = new Banner_Image_Category_Banner();
    $Banner_Image_Category_Banner -> init();
}
// Add term page
