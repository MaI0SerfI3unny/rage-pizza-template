<?php
    $slug = 'additional';
    $slug_sanitized = sanitize_title($slug);
    $category = get_term_by('slug', $slug_sanitized, 'product_cat');
    $category_id = $category->term_id;
    $category_url = get_category_link($category_id);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'product_cat' => $slug,
    );
    $loop = new WP_Query($args);
?>

<div data-aos="fade-up" class="product_container">
    <div class="container">
        <h2>Додатки</h2>
        <div class="product_list">
        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <div class="product_list_item">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="product_list_subcontainer">
                                    <?php the_post_thumbnail(); ?>
                                    <p class="product_title"><?php the_title(); ?></p>
                                    <div class="product_more_info">
                                        <?php 
                                        $content = get_the_excerpt();
                                        $content = strip_tags($content);
                                        
                                        $dots = mb_strlen(mb_substr($content, 0, 63)) < 63 ? " " : "...";
                                        echo mb_substr($content, 0, 63) . $dots;
                                        ?>
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
                wp_reset_postdata();
            ?>
        </div>
        <div class="more_container">
            <a href="<?php echo esc_url($category_url); ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/icons/eye.svg" alt="more button"><span>Дивитись всі</span>
            </a>
        </div>
    </div>
</div>