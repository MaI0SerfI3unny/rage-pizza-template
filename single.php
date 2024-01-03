<?php 
$product_id = get_the_ID();
$short_description = apply_filters('woocommerce_short_description', get_post_field('post_excerpt', $product_id));    
$image_url = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');

$regular_price = get_post_meta($product_id, '_regular_price', true);
$sale_price = get_post_meta($product_id, '_sale_price', true);

$product_tags = wp_get_post_terms($product_id, 'product_tag');

$pizza_bool = false;
foreach ($product_tags as $tag){
    if(esc_html($tag->name) === "Піца"){
        $pizza_bool = true;
    }
}
get_header() ?>
<main>
    <div class="single">
        <?php while (have_posts()) : the_post(); ?>
        <div class="container single_first_item">
            <div class="single_row">
                    <div class="img_single_container">
                        <?php echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '">';?>
                    </div>
                    <div class="content_single_container">
                        <h2 class="single_product_title"><?php the_title(); ?></h2>
                        <div class="content_single_description">
                            <p><?php echo wp_kses_post($short_description); ?></p>
                        </div>
                        
                        <?php if (!empty($product_tags) && !is_wp_error($product_tags)): ?>
                            <div class="single_tags_container">
                                <?php foreach ($product_tags as $tag):
                                    if(esc_html($tag->name) === "Вегетаріанська"): ?>
                                        <div class="vegan_span"><img src="<?php bloginfo('template_url'); ?>/img/icons/vegan_white.svg"><p>Вегетаріанська</p></div>
                                    <?php endif; 
                                    if(esc_html($tag->name) === "Гостра"): ?>
                                        <div class="hot_span"><img src="<?php bloginfo('template_url'); ?>/img/icons/hot_food.svg"><p>Гостра</p></div>
                                <?php endif;
                                    endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="single_panel_container">
                            <div>
                                <?php
                                    if ($sale_price && $regular_price > $sale_price) {
                                        echo '<span class="span_price_container">' . 
                                            '<p class="product_regular_price_panel">' . esc_html($regular_price) . '</p>' .
                                            esc_html($sale_price) . 
                                            ' <span>грн</span></span>';
                                    } else {
                                        echo '<span class="span_price_container">' . esc_html($regular_price) . '<span>грн</span></span>';
                                    }
                                ?>
                    
                            </div>
                            <div>
                                <button class="add-to-cart-button" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">В кошик</button>  
                            </div>
                        </div>

                        <?php if($pizza_bool):
                                $url = get_permalink();
                                $lastSegment = basename(parse_url($url, PHP_URL_PATH));
                                $decodedSegment = urldecode($lastSegment);
                                list($pizza_name, $pizza_length) = explode("-", $decodedSegment);
                                $product_similar = get_page_by_path(($pizza_name . "-" . ($pizza_length == 20 ? "30":"20")), OBJECT, 'product');
                            ?>                                
                            <div class="single_size_container">
                                <p class="single_size_container_title">Розмір</p>
                                <div class="single_size_subcontainer">
                                    <a class="size_container_item_link" href="<?php echo get_permalink(); ?>">
                                        <div class="size_container_item">
                                                <img src="<?php bloginfo('template_url'); ?>/img/size/small.png">
                                                <div class="size_characteristics">
                                                    <p><?php echo $pizza_length; ?> <span>см </span></p>
                                                    <p class="line">/</p>
                                                    <p> <?php echo get_post_meta(get_the_ID(), '_weight', true); ?> <span>г</span></p>
                                                </div>
                                        </div>
                                    </a>
                                    <?php if($product_similar): 
                                        $product_weight = get_post_meta($product_similar->ID, '_weight', true);
                                        $product_link = get_permalink($product_similar->ID); ?>
                                        <a class="size_container_item_link" href="<?php echo $product_link; ?>">
                                            <div class="size_container_item">
                                                <img src="<?php bloginfo('template_url'); ?>/img/size/big.png">
                                                <div class="size_characteristics">
                                                    <p><?php echo $pizza_length == 20 ? "30":"20"; ?> <span>см </span></p>
                                                    <p class="line">/</p>
                                                    <p><?php echo $product_weight; ?> <span>г</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="souce_container_chooser">
                                <div class="souce_container_chooser_head">
                                    <p class="souce_container_chooser_title">СОУСИ ДО БОРТИКІВ</p>
                                    <span>ОБОВ'ЯЗКОВИЙ</span>
                                </div>
                                <p class="souce_chooser_desc">Виберіть до 1 доповнень</p>
                                <?php 
                                    $slug = 'additional';
                                    $slug_sanitized = sanitize_title($slug);
                                    $category = get_term_by('slug', $slug_sanitized, 'product_cat');
                                    $category_id = $category->term_id;
                                    $category_url = get_category_link($category_id);
                                    
                                    $args = array(
                                        'post_type' => 'product',
                                        'product_cat' => $slug,
                                    );
                                    $loop = new WP_Query($args); 
                                    while ($loop->have_posts()) : $loop->the_post(); 
                                    $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
                                    ?>
                                    <div class="souce_item">
                                        <div>
                                            <label class="checkbox-custom">
                                                <input class="input_souce" data-product-id="<?php echo get_the_ID(); ?>" type="checkbox">
                                                <span class="checkmark"></span> <?php the_title(); ?>, <?php echo get_post_meta(get_the_ID(), '_weight', true); ?> г
                                            </label>
                                        </div>
                                        <div>
                                            <p>+<?php echo $regular_price; ?> UAH</p>
                                        </div>
                                    </div>                                
                                <?php endwhile; ?>


                            </div>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
        <div class="container">
            <div class="interest">
                        <p class="interest_title">Також зверніть увагу</p>
                        <div class="product_list">
                            <?php 
                                $slug = 'drinks';
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

                                while ($loop->have_posts()) : $loop->the_post(); ?>
                                
                                <div class="product_list_item">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <div class="product_list_subcontainer">
                                                <?php
                                                    global $product;
                                                    $attachment_ids = $product->get_gallery_image_ids();
                                                    if ( has_post_thumbnail() ) {
                                                        $image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
                                                        echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                                    } elseif ( $attachment_ids ) {
                                                        $secondary_image_url = wp_get_attachment_image_url( $attachment_ids[0], 'full' );
                                                        echo '<img src="' . esc_url( $secondary_image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                                    } else {
                                                        echo 'No Image';
                                                    }
                                                ?>
                                            <p class="product_title"><?php the_title(); ?></p>
                                            <div class="product_more_info">
                                                <?php
                                                    $product_id = get_the_ID();
                                                    $short_description = apply_filters('woocommerce_short_description', get_post_field('post_excerpt', $product_id));
                                                    echo  wp_kses_post($short_description);
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
        <?php  endwhile; ?>
    </div>
</main> 
<?php get_footer() ?>