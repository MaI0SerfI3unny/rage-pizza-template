jQuery(document).ready(function ($) {
    $('.cart_product_container_list').on('click', '.add_to_cart', function() {
        let cartItem = $(this).closest('.product_in_cart_item');
        let productId = cartItem.data('product-id');
        let quantityElement = cartItem.find('.quantity');
        let currentQuantity = parseInt(quantityElement.text());

        updateCartItem(productId, currentQuantity + 1, quantityElement);
    });

    $('.cart_product_container_list').on('click', '.remove_from_cart', function() {
        let cartItem = $(this).closest('.product_in_cart_item');
        let productId = cartItem.data('product-id');
        let quantityElement = cartItem.find('.quantity');
        let currentQuantity = parseInt(quantityElement.text());

        if (currentQuantity === 1) 
            removeCartItem(productId, cartItem);
        else 
            updateCartItem(productId, currentQuantity - 1, quantityElement);
    });

    $('.cart_product_container_list').on('click', '.remove_from_cart_all', function() {
        let cartItem = $(this).closest('.product_in_cart_item');
        let productId = cartItem.data('product-id');
        
        removeCartItem(productId, cartItem);
    });

    function updateCartItem(productId, newQuantity, quantityElement) {
        $.ajax({
            type: 'POST',
            url: custom_cart_ajax.ajax_url,
            data: {
                action: 'update_cart_item',
                product_id: productId,
                quantity: newQuantity
            },
            success: function (response) {
                // Обновление количества на клиенте
                quantityElement.text(newQuantity);

                //Update cart count
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
                    success: function(cartContents) {
                        cartContents = JSON.parse(cartContents);
                        var totalSum = cartContents.reduce(function (accumulator, item) {
                            var price = parseFloat(item.price);
                            var sum = price * item.quantity;
                            return accumulator + sum;
                        }, 0);
                        
                        
                        $(".total_price_main").html(` ${totalSum}<span>грн</span>`)
                    }
                });
            }
        });
    }

    function removeCartItem(productId, cartItem) {
        $.ajax({
            type: 'POST',
            url: custom_cart_ajax.ajax_url,
            data: {
                action: 'remove_cart_item',
                product_id: productId
            },
            success: function (response) {
                cartItem.remove();
                //Update cart count
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
                    success: function(cartContents) {
                        cartContents = JSON.parse(cartContents);
                        var totalSum = cartContents.reduce(function (accumulator, item) {
                            var price = parseFloat(item.price);
                            var sum = price * item.quantity;
                            return accumulator + sum;
                        }, 0);
                        
                        
                        $(".total_price_main").html(` ${totalSum}<span>грн</span>`)
                    }
                });
            }
        });
    }
});
