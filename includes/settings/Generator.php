<?php
namespace Banner_Image\settings;

defined( 'ABSPATH' ) || exit;

class Generator {

    // Settings Option Generator
    public function generator( $arr ) {

        $html = '';
        $html .= '<table class="form-table">';
        $html .= '<tbody>';

        foreach ($arr as $value) {
            if(isset( $value['type'] )) {
                switch ( $value['type'] ) {
                    case 'image':
                        $html .= '<tr>';
                            $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value['label']) . '</label></th>';

                            $html .= '<td>';
                                $image_id = get_option($value['id']);
                                $raw_id = $image_id;
                                if ($image_id != 0 && $image_id != '') {
                                    $image_url = wp_get_attachment_url($image_id);
                                    if ($image_url) {
                                        $image_id = '<img width="400" src="' . esc_url($image_url) . '"><span class="biw-image-remove">X</span>';
                                    } else {
                                        $image_id = '';
                                    }
                                } else {
                                    $image_id = '';
                                }

                                $html .= '<p class="form-field">';
                                $html .= '<input type="hidden" class="product_banner_bg_image" name="' . esc_attr($value["id"]) . '" value="' . esc_attr($raw_id) . '" placeholder="' . esc_attr($value["label"]) . '"/>';
                                $html .= '<span class="biw-image-container">' . $image_id . '</span>';
                                $html .= '<button class="biw-image-upload-btn button">' . esc_html__("Add Image", "banner-image") . '</button>';
                                $html .= '</p>';

                            $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'dropdown':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value["label"]) . '</label></th>';
                        $html .= '<td>';
                        $multiple = '';
                        if (isset($value['multiple'])) {
                            $multiple = 'multiple';
                        }
                        $html .= '<select id="' . esc_attr($value['id']) . '" name="' . esc_attr($value['id']) . '" ' . esc_attr($multiple) . '>';
                        $product_status = get_option($value['id']);
                        if (!empty($value['option'])) {
                            foreach ($value['option'] as $key => $val) {
                                $html .= '<option value="' . esc_attr($key) . '" ' . selected($key, $product_status, false) . '>' . esc_html($val) . '</option>';
                            }
                        }
                        $html .= '</select>';
                        if (isset($value['desc'])) {
                            $html .= '<p>' . esc_html($value['desc']) . '</p>';
                        }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'multiple':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value["label"]) . '</label></th>';
                        $html .= '<td>';
                        $multiple = isset($value['multiple']) ? 'multiple' : '';
                        $html .= '<select style="height:190px;" id="' . esc_attr($value['id']) . '" name="' . esc_attr($value['id']) . '[]" ' . esc_attr($multiple) . '>';
                        $product_status = get_option($value['id']);

                        if (!empty($value['option'])) {
                            foreach ($value['option'] as $val) {
                                $selected = (!empty($product_status) && is_array($product_status) && in_array($val, $product_status)) ? 'selected' : '';
                                $html .= '<option value="' . esc_attr($val) . '" ' . esc_attr($selected) . '>' . esc_html($val) . '</option>';
                            }
                        }

                        $html .= '</select>';

                        if (isset($value['desc'])) {
                            $html .= '<p>' . esc_html($value['desc']) . '</p>';
                        }

                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'text':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value['label']) . '</label></th>';
                        $html .= '<td>';
                        $var = get_option($value['id']);
                        $default_value = isset($value["value"]) ? $value["value"] : '';
                        $html .= '<input type="text" id="' . esc_attr($value['id']) . '" value="' . esc_attr($var ? $var : $default_value) . '" name="' . esc_attr($value['id']) . '">';
                        if (isset($value['desc'])) { $html .= '<p>' . esc_html($value['desc']) . '</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'textarea':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value['label']) . '</label></th>';
                        $html .= '<td>';
                        $var = get_option($value['id']);
                        $textarea_value = esc_textarea($var ? $var : $value["value"]);
                        $html .= '<textarea name="' . esc_attr($value['id']) . '" id="' . esc_attr($value['id']) . '">' . $textarea_value . '</textarea>';
                        if (isset($value['desc'])) { $html .= '<p>' . esc_html($value['desc']) . '</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'number':
                        $html .= '<tr>';
                        $html .= '<th scope="row"><label for="' . esc_attr($value["id"]) . '">' . esc_html($value["label"]) . '</label></th>';
                        $html .= '<td>';

                        $data = '';
                        $var = get_option($value["id"]);

                        // Escape and set min and max attributes if they exist
                        if (isset($value["min"]) && $value["min"] !== "") {
                            $data .= ' min="' . esc_attr($value["min"]) . '"';
                        }
                        if (isset($value["max"]) && $value["max"] !== "") {
                            $data .= ' max="' . esc_attr($value["max"]) . '"';
                        }

                        // Escape the value and id attributes
                        $html .= '<input type="number" value="' . esc_attr($var ? $var : $value["value"]) . '" ' . $data . ' name="' . esc_attr($value["id"]) . '" />';

                        // Escape description if it exists
                        if (isset($value['desc'])) {
                            $html .= '<p>' . esc_html($value['desc']) . '</p>';
                        }

                        $html .= '</td>';
                        $html .= '</tr>';
                        break;


                    case 'checkbox':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value['label']) . '</label></th>';
                        $html .= '<td>';

                        $var = get_option($value['id']);
                        if (isset($value['multiple'])) {
                            $save_value = (is_array($var) ? $var : array());
                            foreach ($value['option'] as $key => $val) {
                                $html .= '<label><input type="checkbox" name="' . esc_attr($value['id']) . '[]" value="' . esc_attr($key) . '" ' . (in_array($key, $save_value) ? "checked='checked'" : "") . '/>' . esc_html($val) . '</label><br>';
                            }
                        } else {
                            $html .= '<input type="checkbox" name="' . esc_attr($value['id']) . '" id="' . esc_attr($value['id']) . '" value="true" ' . ($var == "true" ? "checked='checked'" : "") . '/>';
                        }

                        // Escape description if it is set
                        if (isset($value['desc'])) {
                            $html .= '<label for="' . esc_attr($value['id']) . '">' . esc_html($value['desc']) . '</label>';
                        }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'seperator':
                        $html .= '<tr>';
                        $html .= '<th colspan="2">';
                        if (isset($value['label'])) { $html .= '<h2>' . esc_html($value['label']) . '</h2>'; }
                        if (isset($value['desc'])) { $html .= '<p>' . esc_html($value['desc']) . '</p>'; }
                        if (!empty($value['top_line'])) { $html .= '<hr>'; }
                        $html .= '</th>';
                        $html .= '</tr>';
                        break;

                    case 'color':
                        $html .= '<tr>';
                        $html .= '<th><label for="' . esc_attr($value['id']) . '">' . esc_html($value['label']) . '</label></th>';
                        $html .= '<td>';
                        $var = get_option($value['id']);
                        if (!$var) { $var = $value['value']; }
                        $html .= '<input type="text" name="' . esc_attr($value['id']) . '" value="' . esc_attr($var) . '" id="' . esc_attr($value['id']) . '" class="biw-color-field">';
                        if (isset($value['desc'])) { $html .= '<p>' . esc_html($value['desc']) . '</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'hidden':
                        $html .= '<tr>';
                        $html .= '<th colspan="2">';
                        $html .= '<input type="hidden" value="' . esc_attr($value["value"]) . '" name="' . esc_attr($value['id']) . '">';
                        $html .= '</th>';
                        $html .= '</tr>';
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        echo $html;
    }
}
