<html>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico">

    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yanone+Kaffeesatz:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <title>Люта Піца</title>  
</head>
<body>
<header class="header">
  <div class="container">
    <div class="header_starter">
      <div>
        <img src="<?php bloginfo('template_url'); ?>/img/icons/time.svg" alt="time">
        <p>Київ</p>
      </div>

      <div>
        <img src="<?php bloginfo('template_url'); ?>/img/icons/location.svg" alt="map pin">
        <p>Пн-Нд 11:00 - 21:45</p>
      </div>
    </div>
    <div class="header_logo">
      <img src="<?php bloginfo('template_url'); ?>/img/logo.svg" alt="logo">
    </div>
    <div class="header_bucket">
        <a href="">Умови доставки</a>
        <div class="bucket">
          <img src="<?php bloginfo('template_url'); ?>/img/icons/boxes.svg" alt="bucket">
          <span>0</span>
        </div>
        <div class="menu__btn_container">
        <label class="menu__btn" for="menu__toggle">
          <span></span>
        </label>
      </div>
    </div>
  </div>

    <div class="container category">
    <div class="category_container">
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/discount.svg"> Акції</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/sets.svg">Сети</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/pizza20.svg">Піца 20 см</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/pizza30.svg">Піца 30 см</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/salad.svg">Салати</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/drinks.svg">Напої</a>
          </div>
          <div class="category_list_item">
            <a href=""><img src="<?php bloginfo('template_url'); ?>/img/category/additional.svg">Додатки</a>
          </div>
    </div>

    <div class="hamburger-menu">
      <input id="menu__toggle" type="checkbox" />
      <ul class="menu__box">
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/discount.svg"> Акції
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/sets.svg">Сети
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/pizza20.svg">Піца 20 см
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/pizza30.svg">Піца 30 см
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/salad.svg">Салати
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/drinks.svg">Напої
        </a></li>
        <li><a class="menu__item" href="#">
          <img src="<?php bloginfo('template_url'); ?>/img/category/additional.svg">Додатки
        </a></li>

        <div class="header_starter">
          <div>
            <img src="<?php bloginfo('template_url'); ?>/img/icons/time.svg" alt="time">
            <p>Київ</p>
          </div>

          <div>
            <img src="<?php bloginfo('template_url'); ?>/img/icons/location.svg" alt="map pin">
            <p>Пн-Нд 11:00 - 21:45</p>
          </div>
        </div>
      </ul>
    </div>
</header>