/*==================================
 * WP Product Banner Image
 *================================ */
jQuery(document).ready(function($){

	$('body').on('click','.wpbi-image-upload-btn',function(e) {
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
            $(that).parent().find( '.wpbi-image-container' ).html( '<img width="100" src="'+uploaded_url+'" ><span class="wpbi-image-remove">x</span>' );
        });
    });

});
