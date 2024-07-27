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
            if(isset( $value['type'] )){
                switch ( $value['type'] ) {
                    case 'image':
                        $html .= '<tr>';
                            $html .= '<th><label for="'.$value['id'].'">'.$value['label'].'</label></th>';

                            $html .= '<td>';
                                $image_id = get_option( $value['id'] );;
                                $raw_id = $image_id;
                                if( $image_id!=0 && $image_id!='' ){
                                    $image_id = wp_get_attachment_url( $image_id );
                                    $image_id = '<img width="400" src="'.$image_id.'"><span class="biw-image-remove">X</span>';
                                }else {
                                    $image_id = '';
                                }

                                $html .= '<p class="form-field">';
                                $html .= '<input type="hidden" class="product_banner_bg_image" name="'.$value["id"].'" value="'.$raw_id.'" placeholder="'.$value["label"].'"/>';
                                $html .= '<span class="biw-image-container">'.$image_id.'</span>';
                                $html .= '<button class="biw-image-upload-btn button">' . esc_html__("Add Image", "banner-image") . '</button>';
                                $html .= '</p>';

                            $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'dropdown':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value["label"].'</label></th>';
                        $html .= '<td>';
                        $multiple = '';
                        if(isset($value['multiple'])){ $multiple = 'multiple'; }
                        $html .= '<select id="'.$value['id'].'" name="'.$value['id'].'" '.$multiple.'>';
                        $product_status = get_option( $value['id'] );
                        if(!empty($value['option'])){
                            foreach ( $value['option'] as $key => $val ){
                                $html .= '<option value="'.$key.'" '.( $key == $product_status ? "selected":"" ).'>'.$val.'</option>';
                            }
                        }
                        $html .= '</select>';
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'multiple':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value["label"].'</label></th>';
                        $html .= '<td>';
                        $multiple = '';
                        if(isset($value['multiple'])){ $multiple = 'multiple'; }
                        $html .= '<select style="height:190px;" id="'.$value['id'].'" name="'.$value['id'].'[]" '.$multiple.'>';
                        $product_status = get_option( $value['id'] );
                        if(!empty($value['option'])){
                            foreach ( $value['option'] as $val ){
                                if( !empty($product_status) && is_array($product_status) ){
                                    if( in_array( $val , $product_status ) ){
                                        $html .= '<option value="'.$val.'" selected>'.$val.'</option>';
                                    }else{
                                        $html .= '<option value="'.$val.'">'.$val.'</option>';
                                    }
                                }else{
                                    $html .= '<option value="'.$val.'">'.$val.'</option>';
                                }
                            }
                        }
                        $html .= ' </select>';
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'text':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value['label'].'</label></th>';
                        $html .= '<td>';
                        $var = get_option( $value['id'] );
                        $default_value = ( isset($value["value"])) ? $value["value"] : '';
                        $html .= '<input type="text" id="'.$value['id'].'" value="'.( $var ? $var : $default_value ).'" name="'.$value['id'].'">';
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'textarea':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value['label'].'</label></th>';
                        $html .= '<td>';
                        $var = get_option( $value['id'] );
                        $html .= '<textarea name="'.$value['id'].'" id="'.$value['id'].'">'.( $var ? $var : $value["value"] ).'</textarea>';
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'number':
                        $html .= '<tr>';
                        $html .= '<th scope="row"><label for="'.$value["id"].'">'.$value["label"].'</label></th>';
                        $html .= '<td>';
                        $data = '';
                        $var = get_option( $value["id"] );
                        if( isset($value["min"]) != "" ){ $data .= 'min="'.$value["min"].'"'; }
                        if( isset($value["max"]) != "" ){ $data .= ' max="'.$value["max"].'"'; }
                        $html .= '<input type="number" value="'.( $var ? $var : $value["value"]).'" '.$data.' name="'.$value["id"].'" />';
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'checkbox':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value['label'].'</label></th>';
                        $html .= '<td>';
                            $var = get_option( $value['id'] );
                            if(isset($value['multiple'])) {
                                $save_value = ( is_array( $var ) ? $var : array() );
                                foreach( $value['option'] as $key => $val ){
                                    $html .= '<label><input type="checkbox" name="'.$value['id'].'[]" value="'.$key.'" '.( in_array( $key , $save_value )?"checked='checked'":"" ).'/>'.$val.'</label></br>';
                                }
                            } else {
                                $html .= '<input type="checkbox" name="'.$value['id'].'" id="'.$value['id'].'" value="true" '.($var=="true"?"checked='checked'":"").'/>';
                            }
                            if(isset($value['desc'])) {
                                $html .= '<label for="'.$value['id'].'">'.$value['desc'].'</label>';
                            }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'seperator':
                        $html .= '<tr>';
                        $html .= '<th colspan="2">';
                        if( isset($value['label']) ){ $html .= '<h2>'.$value["label"].'</h2>'; }
                        if( isset($value['desc']) ){ $html .= '<p>'.$value['desc'].'</p>'; }
                        if( isset($value['top_line']) != '' ){ $html .= '<hr>'; }
                        $html .= '</th>';
                        $html .= '</tr>';
                        break;

                    case 'color':
                        $html .= '<tr>';
                        $html .= '<th><label for="'.$value['id'].'">'.$value['label'].'</label></th>';
                        $html .= '<td>';
                        $var = get_option( $value['id'] );
                        if(!$var){ $var = $value['value']; }
                        $html .= '<input type="text" name="'.$value['id'].'" value="'.$var.'" id="'.$value['id'].'" class="biw-color-field" >';
                        if(isset($value['desc'])){ $html .= '<p>'.$value['desc'].'</p>'; }
                        $html .= '</td>';
                        $html .= '</tr>';
                        break;

                    case 'hidden':
                        $html .= '<tr>';
                        $html .= '<th colspan="2">';
                        $html .= '<input type="hidden" value="'.$value["value"].'" name="'.$value['id'].'">';
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
