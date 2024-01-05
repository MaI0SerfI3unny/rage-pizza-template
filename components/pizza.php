<?php
    $slug_one = 'pizza-20';
    $slug_two = 'pizza-30';

    $slug_sanitized_one = sanitize_title($slug_one);
    $slug_sanitized_two = sanitize_title($slug_two);

    $pizza_small = get_term_by('slug', $slug_sanitized_one, 'product_cat');
    $pizza_big = get_term_by('slug', $slug_sanitized_two, 'product_cat');

    $pizza_small_id = $pizza_small->term_id;
    $pizza_big_id = $pizza_big->term_id;
    
    $pizza_small_url = get_category_link($pizza_small_id);
    $pizza_big_url = get_category_link($pizza_big_id);

    $loop_one = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'product_cat' => $slug_one,
    ));
?>


<div data-aos="fade-up" class="product_container">
    <div class="container">
        <div class="upper_head_panel">
            <h2>Піца</h2>
            <div class="tabs-container">
                <div class="tab" data-tab="tab1">20 см</div>
                <div class="tab" data-tab="tab2">30 см</div>
            </div>
        </div>

<div class="content-container">
    <div class="tab-content" id="tab1">
        <div class="product_list">
            <?php while ($loop_one->have_posts()) : $loop_one->the_post(); ?>
                <div class="product_list_item">
                    <a href="<?php echo get_permalink(); ?>">
                        <div class="product_list_subcontainer">
                            <?php the_post_thumbnail(); ?>
                            <p class="product_title"><?php the_title(); ?></p>
                            <div class="product_more_info">
                                <?php echo get_the_excerpt(); ?>
                            </div>
                            <div class="product_additional_info">
                                <div class="product_info">
                                        <?php
                                        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
                                        $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

                                        if ($sale_price && $regular_price > $sale_price) {
                                            echo '<p class="product_regular_price">' . esc_html($regular_price) . '</p>';
                                            echo '<p class="product_price">' . esc_html($sale_price) . ' <span>грн</span></p>';
                                        } else {
                                            echo '<p class="product_price">' . esc_html($regular_price) . ' <span>грн</span></p>';
                                        } ?>
                                    <p class="product_weight"><?php echo get_post_meta(get_the_ID(), '_weight', true); ?> <span>г</span></p>
                                </div>
                                <div class="product_buy_panel">
                                    <button data-product-id="<?php echo esc_attr(get_the_ID()); ?>">Перейти</button>
                                </div>
                            </div>
        
                            <div class="product_special_container">
                                <?php 
                                    $tags = get_the_terms(get_the_ID(), 'product_tag');
                                    foreach ($tags as $tag) :
                                        if(esc_html($tag->name) === "Вегетаріанська"){ ?>
                                        <img src="<?php bloginfo('template_url'); ?>/img/icons/vegan.svg">
                                    <?php }
                                        if(esc_html($tag->name) === "Гостра"){ ?>
                                        <img src="<?php bloginfo('template_url'); ?>/img/icons/hot_food.svg">
                                    <?php }
                                        endforeach; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    <div class="tab-content" id="tab2">
    <div class="product_list">
            <?php
                $loop_two = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'product_cat' => $slug_two,
                ));

                while ($loop_two->have_posts()) : $loop_two->the_post(); ?>
                    <div class="product_list_item">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="product_list_subcontainer">
                                    <?php the_post_thumbnail(); ?>
                                    <p class="product_title"><?php the_title(); ?></p>
                                    <div class="product_more_info">
                                        <?php echo get_the_excerpt(); ?>
                                    </div>
                                    <div class="product_additional_info">
                                        <div class="product_info">
                                                <?php
                                                $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
                                                $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

                                                if ($sale_price && $regular_price > $sale_price) {
                                                    echo '<p class="product_regular_price">' . esc_html($regular_price) . '</p>';
                                                    echo '<p class="product_price">' . esc_html($sale_price) . ' <span>грн</span></p>';
                                                } else {
                                                    echo '<p class="product_price">' . esc_html($regular_price) . ' <span>грн</span></p>';
                                                } ?>
                                            <p class="product_weight"><?php echo get_post_meta(get_the_ID(), '_weight', true); ?> <span>г</span></p>
                                        </div>
                                        <div class="product_buy_panel">
                                            <button class="add-to-cart-button" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">В кошик</button>
                                        </div>
                                    </div>
                
                                    <div class="product_special_container">
                                        <?php 
                                            $tags = get_the_terms(get_the_ID(), 'product_tag');
                                            foreach ($tags as $tag) :
                                                if(esc_html($tag->name) === "Вегетаріанська"){ ?>
                                                <img src="<?php bloginfo('template_url'); ?>/img/icons/vegan.svg">
                                            <?php }
                                                if(esc_html($tag->name) === "Гостра"){ ?>
                                                <img src="<?php bloginfo('template_url'); ?>/img/icons/hot_food.svg">
                                            <?php }
                                                endforeach; ?>
                                    </div>
                                </div>
                            </a>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>

        <div class="more_container">
            <a href="<?php echo esc_url($pizza_small_url); ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/icons/eye.svg" alt="more button"><span>Дивитись всі</span>
            </a>
        </div>
    </div>
</div>