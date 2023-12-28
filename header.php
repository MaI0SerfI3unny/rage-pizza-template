<?php 
$args = array(
  'taxonomy'     => 'product_cat',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'exclude'      => get_option('default_product_cat'),
  'hierarchical' => 1,
  'title_li'     => '',
  'hide_empty'   => 0,
);

$categories = get_categories($args); ?>

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
      <a href="/"><img src="<?php bloginfo('template_url'); ?>/img/logo.svg" alt="logo"></a>
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
          <?php foreach ($categories as $category) {
                $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);
            ?>
            <div class="category_list_item">
              <a href="<?php echo get_category_link($category->term_id); ?>">
                <img src="<?php echo $image; ?>"> <?php echo $category->name; ?>
              </a>
            </div>          
          <?php } ?>
    </div>

    <div class="hamburger-menu">
      <input id="menu__toggle" type="checkbox" />
      <ul class="menu__box">
        <?php foreach ($categories as $category) {
                $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);?>
          <li><a class="menu__item" href="<?php echo get_category_link($category->term_id); ?>">
            <img src="<?php echo $image; ?>"> <?php echo $category->name; ?>
          </a></li>
        <?php } ?>

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