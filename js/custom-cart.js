//Create Product in cart
jQuery(document).ready(function ($) {
    $('.add-to-cart-button').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var checkedSouce = $('.input_souce:checked');

            var productIdSouce = checkedSouce.data('product-id');
            $.ajax({
                type: 'POST',
                url: custom_cart_ajax.ajax_url,
                data: {
                    action: 'add_to_cart_action',
                    product_id: product_id,
                    souce_id: checkedSouce.length > 0 ? productIdSouce : 0
                },
                success: function (_) {
                    function buildCartHtml(cartContents) {
                        var html = '';
                
                        $.each(cartContents, function (_, item) {
                            html += '<div class="product_in_cart_item" data-product-id="' + item.id +'" data-quantity="' + item.quantity + '">';
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
                            html += '<p class="remove_from_cart">-</p>';
                            html += '<p class="cart-item-quantity quantity">' + item.quantity + '</p>';
                            html += '<p class="add_to_cart">+</p>';
                            html += '</div>';
                            html += '<div class="cart_item_price"><p>' + item.price + '</p><span>грн</span></div>';
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

//Get Cart Content
jQuery(document).ready(function($) {
    function buildCartHtml(cartContents) {
        var html = '';

        $.each(cartContents, function (_, item) {
            html += '<div class="product_in_cart_item" data-product-id="' + item.id +'" data-quantity="' + item.quantity + '">';
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
            html += '<p class="remove_from_cart">-</p>';
            html += '<p class="cart-item-quantity quantity">' + item.quantity + '</p>';
            html += '<p class="add_to_cart">+</p>';
            html += '</div>';
            html += '<div class="cart_item_price"><p>' + item.price + '</p><span>грн</span></div>';
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
            var totalSum = cartContents.reduce(function (accumulator, item) {
                var price = parseFloat(item.price);
                var sum = price * item.quantity;
                return accumulator + sum;
            }, 0);
            
            
            $(".total_price_main").html(` ${totalSum}<span>грн</span>`)
            $('.cart-contents').html(buildCartHtml(cartContents));
        }
    });
});

//Create order
jQuery(document).ready(function ($) {
    $('.submit-order-button').on('click', function (e) {
        e.preventDefault();
        let dropdownBtn = $('#dropdownBtn');
        let paragraphElement = dropdownBtn.find('p');
        let textContent = paragraphElement.text();
        
        let orderData = {
            action: 'create_order_action',
            name: $('#name').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            comment: `КОМЕНТАР ДО АДРЕСИ: \n${$('#comment_to_address').val()}\n
                      КОМЕНТАР ДО ЗАМОВЛЕННЯ: \n${$('#comment_to_order').val()}\n
                      СПОСІБ ДОСТАВКИ: \n${textContent}`,
            products: getCartContents()
        };

        if(!$('#name').val())
            $('#name_check').css("display","block")

        if(!$('#phone').val())
            $('#phone_check').css("display","block")

        if(getCartContents().length === 0)
            $('#product_check').css("display","block")


        if(
            $('#name').val() &&
            $('#phone').val() &&
            getCartContents().length > 0)
        {
            $.ajax({
                type: 'POST',
                url: custom_cart_ajax.ajax_url,
                data: orderData,
                success: function (_) {
                    $.ajax({
                        type: 'POST',
                        url: custom_cart_ajax.ajax_url,
                        data: { action: 'clear_cart_action' },
                        success: function (_) {
                            //Update cart count
                            $.ajax({
                                type: 'GET',
                                url: custom_cart_ajax.ajax_url,
                                data: { action: 'get_cart_item_count' },
                                success: function (count) {
                                    $('.cart-item-count').text(count);
                                }
                            });
    
                            //Clear cart
                            $('.cart-contents').empty();
                            window.location.href = "/success"
    
                            //Clear Input
                            $('#name').val('');
                            $('#phone').val('');
                            $('#address').val('');
                            $('#comment_to_address').val('');
                            $('#comment_to_order').val('');
                            $('#name_check').css("display","none")
                            $('#phone_check').css("display","none")
                            $('#product_check').css("display","none")
                        }
                    });
                }
            });   
        }
    });

    function getCartContents() {
        var cartContents = [];
        $.ajax({
            type: 'GET',
            url: custom_cart_ajax.ajax_url,
            data: { action: 'get_cart_contents' },
            async: false,
            success: function (response) {
                cartContents = JSON.parse(response);
            }
        });
    
        return cartContents;
    }
});


//header menu
jQuery(document).ready(function ($) {
    var fixedElementHeight = $('.header').outerHeight();

    $('#go_to_menu').on('click', function (e) {
        $('html, body').animate({
            scrollTop: $('#menus').offset().top - fixedElementHeight
        }, 800);
    })
})

