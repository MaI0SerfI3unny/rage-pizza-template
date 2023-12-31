<?php
/*
Template Name: success
*/
?>
<?php get_header() ?>
<main>
    <div class="success_page">
        <div class="success_container">
            <img src="<?php bloginfo('template_url'); ?>/img/icons/success.png">
            <p>Замовлення успішно створене. Натисніть кнопку для повернення на головну сторінку</p>
            <button><a href="/">На головну</a></button>
        </div>
    </div>
</main> 
<?php get_footer() ?>