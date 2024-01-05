<?php
    $queried_object = get_queried_object();
    $category_slug = $queried_object->slug;


    $args = array(
        'post_type' => 'product',
        'product_cat' => $category_slug,
        'posts_per_page' => -1,
    );
    $loop = new WP_Query($args);
?>

<?php get_header() ?>
<main>
    <div class="page_category">
        <div class="container">
            <h2><?php the_title(); ?></h2>
            <div class="product_list_category">
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <div class="product_item_category">
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
            <?php endwhile; ?>
            </div>
        </div>
    </div>
</main> 
<?php get_footer() ?>
