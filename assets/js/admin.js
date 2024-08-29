jQuery(document).ready(function ($) {
    // Enable Color Picker
    $('.biw-color-field').wpColorPicker();

    $('body').on('click', '.biw-image-upload-btn', function (e) {
        e.preventDefault();
        var that = $(this);
        var image = wp
        .media({
          title: 'Upload Image',
          multiple: false,
        })
        .open()
        .on('select', function (e) {
          var uploaded_image = image.state().get('selection').first();
          var uploaded_url = uploaded_image.toJSON().url;
          uploaded_image = uploaded_image.toJSON().id;
          $(that).parent().find('.product_banner_bg_image').val(uploaded_image);
          $(that)
            .parent()
            .find('.biw-image-container')
            .html(
              '<img width="400" src="' +
                uploaded_url +
                '" ><span class="biw-image-remove">X</span>'
            );
        });
    });

    $('body').on('click', '.biw-image-remove', function (e) {
        var that = $(this);
        $(that).parent().parent().find('.product_banner_bg_image').val('');
        $(that).parent().parent().find('.biw-image-container').html('');
    });


    // Product Category media upload
    function biw_media_upload(button_class) {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $('body').on('click', button_class, function(e) {
            var button_id = '#' + $(this).attr('id');
            var button = $(button_id);
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment) {
                if (_custom_media) {
                    $('#category-image-id').val(attachment.id);
                    $('#category-image-wrapper').html('<img class=\"custom_media_image\" src=\"\" style=\"margin:0;padding:0;max-height:100px;float:none;\" />');
                    $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                } else {
                    return _orig_send_attachment.apply(button_id, [props, attachment]);
                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }

    biw_media_upload('.ct_tax_media_button.button');

    $('body').on('click', '.ct_tax_media_remove', function() {
        $('#category-image-id').val('');
        $('#category-image-wrapper').html('<img class=\"custom_media_image\" src=\"\" style=\"margin:0;padding:0;max-height:100px;float:none;\" />');
    });

    $(document).ajaxComplete(function(event, xhr, settings) {
        var queryStringArr = settings.data.split('&');
        if ($.inArray('action=add-tag', queryStringArr) !== -1) {
            var xml = xhr.responseXML;
            var $response = $(xml).find('term_id').text();
            if ($response != "") {
                // Clear the thumb image
                $('#category-image-wrapper').html('');
            }
        }
    });

    // Enable Color Picker
    $('.pbw-wrap-color-field').wpColorPicker();
    $('body').on('click', '.pbw-wrap-image-upload-btn',function(e) {
        e.preventDefault();
        var that = $(this);
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open().on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            var uploaded_url = uploaded_image.toJSON().url;
            uploaded_image = uploaded_image.toJSON().id;
            $(that).parent().find( '.product_banner_bg_image' ).val( uploaded_image );
            $(that).parent().find( '.pbw-wrap-image-container' ).html( '<img width="400" src="'+uploaded_url+'" ><span class="pbw-wrap-image-remove">X</span>' );
        });
    });

    $('body').on('click','.pbw-wrap-image-remove',function(e) {
        var that = $(this);
        $(that).parent().parent().find( '.product_banner_bg_image' ).val( '' );
        $(that).parent().parent().find( '.pbw-wrap-image-container' ).html( '' );
    });
});
