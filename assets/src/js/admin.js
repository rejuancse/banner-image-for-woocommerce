// Styles
import '../sass/admin.scss';

jQuery(document).ready(function($){
    
    // Enable Color Picker
	$('.wpbi-color-field').wpColorPicker();

	$('body').on('click', '.wpbi-image-upload-btn',function(e) {
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
            $(that).parent().find( '.wpbi-image-container' ).html( '<img width="400" src="'+uploaded_url+'" ><span class="wpbi-image-remove">X</span>' );
        });
    });

    $('body').on('click','.wpbi-image-remove',function(e) {
		var that = $(this);
	    $(that).parent().parent().find( '.product_banner_bg_image' ).val( '' );
        $(that).parent().parent().find( '.wpbi-image-container' ).html( '' );
	});


    const progress = document.querySelector('#sliderRange');
    
    var slider = document.getElementById("sliderRange");
    var output = document.getElementById("rangeID");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }

    progress.addEventListener('input', function() {
        const value = this.value;
        this.style.background = `linear-gradient(to right, #82CFD0 0%, #82CFD0 ${value}%, #000 100%)`
    })
    
 


});
