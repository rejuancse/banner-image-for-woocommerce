!function(){"use strict";jQuery(document).ready((function(e){e(".wpbi-color-field").wpColorPicker(),e("body").on("click",".wpbi-image-upload-btn",(function(i){i.preventDefault();var n=e(this),t=wp.media({title:"Upload Image",multiple:!1}).open().on("select",(function(i){var a=t.state().get("selection").first(),o=a.toJSON().url;a=a.toJSON().id,e(n).parent().find(".product_banner_bg_image").val(a),e(n).parent().find(".wpbi-image-container").html('<img width="400" src="'+o+'" ><span class="wpbi-image-remove">X</span>')}))})),e("body").on("click",".wpbi-image-remove",(function(i){var n=e(this);e(n).parent().parent().find(".product_banner_bg_image").val(""),e(n).parent().parent().find(".wpbi-image-container").html("")}))}))}();
//# sourceMappingURL=admin.js.map