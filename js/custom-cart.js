jQuery(document).ready(function ($) {
    $('.add-to-cart-button').on('click', function (e) {
        e.preventDefault();

        var product_id = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: custom_cart_ajax.ajax_url,
            data: {
                action: 'add_to_cart_action',
                product_id: product_id
            },
            success: function (response) {
                // Update the cart menu or display a success message
                console.log(response);

                function buildCartHtml(cartContents) {
                    var html = '';
                    $.each(cartContents, function (key, item) {
                        html += '<div class="product_in_cart_item">';
                        html += '<div class="product_in_cart_item_img">';
                        html += '<img src="' + item.image + '">';
                        html += '</div>';
                        html += '<div class="product_in_cart_item_info">';
                        html += '<div class="product_in_cart_item_info_head">';
                        html += '<div class="product_in_cart_item_info_head_title">' + item.name + '</div>';
                        html += '<div></div>';
                        html += '</div>';
                        html += '<p class="product_in_cart_item_info_head_desc">' + item.short_description + '</p>';
                        html += '<div class="product_in_cart_item_panel">';
                        html += '<div class="cart_item_panel">';
                        html += '<p class="remove-from-cart" data-product-id="' + item.id + '">-</p>';
                        html += '<p class="cart-item-quantity">' + item.quantity + '</p>';
                        html += '<p class="add-to-cart" data-product-id="' + item.id + '">+</p>';
                        html += '</div>';
                        html += '<div class="cart_item_price"><p>' + item.regular_price + '</p><span>грн</span></div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });
                
                    return html;
                }

                $.ajax({
                    type: 'GET',
                    url: custom_cart_ajax.ajax_url,
                    data: { action: 'get_cart_item_count' },
                    success: function (count) {
                        $('.cart-item-count').text(count);
                    }
                });
                
                $.ajax({
                    type: 'GET',
                    url: custom_cart_ajax.ajax_url,
                    data: { action: 'get_cart_contents' },
                    success: function (cartContents) {
                        cartContents = JSON.parse(cartContents);
                        $('#cart__toggle').prop('checked', true);
                        $('.cart-contents').html(buildCartHtml(cartContents));
                    }
                });
            }
        });
    });
});

jQuery(document).ready(function($) {
    function buildCartHtml(cartContents) {
        var html = '';
        $.each(cartContents, function (key, item) {
            html += '<div class="product_in_cart_item">';
            html += '<div class="product_in_cart_item_img">';
            html += '<img src="' + item.image + '">';
            html += '</div>';
            html += '<div class="product_in_cart_item_info">';
            html += '<div class="product_in_cart_item_info_head">';
            html += '<div class="product_in_cart_item_info_head_title">' + item.name + '</div>';
            html += '<div></div>';
            html += '</div>';
            html += '<p class="product_in_cart_item_info_head_desc">' + item.short_description + '</p>';
            html += '<div class="product_in_cart_item_panel">';
            html += '<div class="cart_item_panel">';
            html += '<p class="remove-from-cart" data-product-id="' + item.id + '">-</p>';
            html += '<p class="cart-item-quantity">' + item.quantity + '</p>';
            html += '<p class="add-to-cart" data-product-id="' + item.id + '">+</p>';
            html += '</div>';
            html += '<div class="cart_item_price"><p>' + item.regular_price + '</p><span>грн</span></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        });
    
        return html;
    }
    $.ajax({
        type: 'GET',
        url: custom_cart_ajax.ajax_url,
        data: { action: 'get_cart_contents' },
        success: function(cartContents) {
            cartContents = JSON.parse(cartContents);
            $('.cart-contents').html(buildCartHtml(cartContents));
        }
    });
});

jQuery(document).ready(function($) {
    function buildCartHtml(cartContents) {
        var html = '';
        $.each(cartContents, function (key, item) {
            html += '<div class="product_in_cart_item">';
            html += '<div class="product_in_cart_item_img">';
            html += '<img src="' + item.image + '">';
            html += '</div>';
            html += '<div class="product_in_cart_item_info">';
            html += '<div class="product_in_cart_item_info_head">';
            html += '<div class="product_in_cart_item_info_head_title">' + item.name + '</div>';
            html += '<div></div>';
            html += '</div>';
            html += '<p class="product_in_cart_item_info_head_desc">' + item.short_description + '</p>';
            html += '<div class="product_in_cart_item_panel">';
            html += '<div class="cart_item_panel">';
            html += '<p class="remove-from-cart" data-product-id="' + item.id + '">-</p>';
            html += '<p class="cart-item-quantity">' + item.quantity + '</p>';
            html += '<p class="add-to-cart" data-product-id="' + item.id + '">+</p>';
            html += '</div>';
            html += '<div class="cart_item_price"><p>' + item.regular_price + '</p><span>грн</span></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        });
    
        return html;
    }
    
    $(document).on('click', '.add-to-cart', function () {
        var productId = $(this).data('product-id');
        updateCartItem(productId, 'add');
    });
    
    $(document).on('click', '.remove-from-cart', function () {
        console.log("click")

        var productId = $(this).data('product-id');
        updateCartItem(productId, 'remove');
    });
    
    function updateCartItem(productId, action) {
        $.ajax({
            type: 'POST',
            url: custom_cart_ajax.ajax_url,
            data: {
                action: 'update_cart_item_action',
                product_id: productId,
                cart_action: action
            },
            success: function (response) {
                //console.log(response)
                if (response.status === 'success') {
                    $.ajax({
                        type: 'GET',
                        url: custom_cart_ajax.ajax_url,
                        data: { action: 'get_cart_contents' },
                        success: function (cartContents) {
                            $('.cart-contents').html(buildCartHtml(cartContents));
                        }
                    });
                } else {
                    console.log('Error updating cart item.');
                }
            }
        })
    }
})