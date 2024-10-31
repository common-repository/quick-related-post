jQuery(document).ready(function($)
{
		jQuery('.qrp_wrap_items').each(function (index, el) {
        var maxHeight = 0;
        var elementHeights = jQuery(this).find('.qrp_post_title').map(function () {
            return jQuery(this).height();
        }).get();
        maxHeight = Math.max.apply(null, elementHeights);
        jQuery(this).find('.qrp_post_title').height(maxHeight+16);
    });
});	