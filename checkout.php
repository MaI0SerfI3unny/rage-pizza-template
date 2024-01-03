<?php
/*
Template Name: checkout
*/
?>

<?php get_header() ?>
<main>
    <div class="container checkout">
        <h2>Кошик</h2>
        <div class="checkout_container">
            <div class="checkout_container_form">
                <p class="input_checkout_main_title">Адреса доставки</p>
            
                <p class="input_checkout_title">Спосіб доставки</p>
                <div class="dropdown">
                    <button id="dropdownBtn"><p>Доставка</p> <img src="<?php bloginfo('template_url'); ?>/img/icons/checker.svg"></button>
                    <ul id="dropdownList">
                        <li data-value="самовивіз">Самовивіз</li>
                        <li data-value="доставка">Доставка</li>
                    </ul>
                </div>
                <div class="container_input">
                    <p class="input_checkout_title">Адреса та номер будинку</p>
                    <input id="address">
                </div>

                <div class="container_input">
                    <p class="input_checkout_title">Коментар до адреси:</p>
                    <input id="comment_to_address" placeholder="Під’їзд/ поверх/ номер квартири/ інше">
                </div>
               
               
                <div class="container_input">
                    <p class="input_checkout_title">Ваше ім'я<span>*</span></p>
                    <input id="name">
                    <p id="name_check" class="attention_error">Необхідне поле</p>
                </div>
                
                <div class="container_input">
                    <p class="input_checkout_title">Телефон<span>*</span></p>
                    <input type="tel" id="phone" name="phone" data-default-country="ua">
                    <p id="phone_check" class="attention_error">Необхідне поле</p>
                </div>
                
                <div class="container_input">
                    <div id="phone-widget"></div>
                </div>
                
                <div class="container_input">
                    <p class="input_checkout_title">Коментар до замовлення</p>
                    <textarea id="comment_to_order" placeholder="Ввведіть коментар до замовлення"></textarea>
                </div>

            </div>
            <div class="checkout_container_list">
                <p class="checkout_container_list_title">Кошик</p>
                <div class="cart_product_container_list cart-contents_cart"></div>
                <p class="total_price">Всього: <span class="total_price_main"> 0<span>грн</span></span></p>

                <div class="container_submit">
                    <button id="create_order_btn" class="btn_order submit-order-button">Оформити замовлення</button>
                    <p id="product_check" class="attention_error_btn">Кошик пустий. Необхідно обрати товари</p>
                </div>

            </div>
        </div>
    </div>
</main> 
<script>
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
            html += '<div class="trash_container_product_item"><img class="remove_from_cart_all" src="<?php bloginfo('template_url'); ?>/img/icons/trash.svg"></div>';
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
            $('.cart-contents_cart').html(buildCartHtml(cartContents));
        }
    });
});
</script>

<?php get_footer() ?>
