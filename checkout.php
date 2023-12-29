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
                <div></div>
                <p class="input_checkout_title">Адреса та номер будинку</p>
                <input>
                <p class="input_checkout_title">Коментар до адреси:</p>
                <input placeholder="Під’їзд/ поверх/ номер квартири/ інше">
                <p class="input_checkout_title">Ваше ім'я<span>*</span></p>
                <input>
                <p class="input_checkout_title">Телефон<span>*</span></p>
                <input type="tel" id="phone" name="phone" data-default-country="ua">
                <div id="phone-widget"></div>
                <p class="input_checkout_title">Коментар до замовлення</p>
                <textarea placeholder="Ввведіть коментар до замовлення"></textarea>
            </div>
            <div class="checkout_container_list">
                <p class="checkout_container_list_title">Кошик</p>
            </div>
        </div>
    </div>
</main> 
<?php get_footer() ?>
