
jQuery(document).ready(function($) {
    let product_type = $(".add-to-cart-button");


    $(".input_souce").prop( "checked", false );
    
    if(product_type.data('product-type'))
    {
        product_type.attr('disabled', true);
        product_type.css("background","darkgrey")
    }

    $('.input_souce').change(function() {
        $('.input_souce').prop('checked', false);
        $(this).prop('checked', true);
        product_type.attr('disabled', false);
        product_type.css("background","#00A8FF")
    });
})