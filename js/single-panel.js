
jQuery(document).ready(function($) {
    $(".input_souce").prop( "checked", false );
    
    $('.input_souce').change(function() {
        var productId = $(this).data('product-id');
        $('.input_souce').prop('checked', false);
        $(this).prop('checked', true);    
    });
})