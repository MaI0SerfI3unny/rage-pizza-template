<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

add_action('wp_enqueue_scripts', function(){
    // Enqueue the built-in jQuery
    wp_enqueue_script('jquery');

    // Enqueue your custom styles
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css' );
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/css/footer.css' );
    wp_enqueue_style('header-style', get_template_directory_uri() . '/css/header.css' );
    wp_enqueue_style('delivery-style', get_template_directory_uri() . '/css/delivery.css' );
    wp_enqueue_style('product-style', get_template_directory_uri() . '/css/product.css' );
    wp_enqueue_style('banner-style', get_template_directory_uri() . '/css/banner.css' );
    wp_enqueue_style('tabs-style', get_template_directory_uri() . '/css/tabs.css' );
    wp_enqueue_style('aos-style', get_template_directory_uri() . '/css/aos.css' );
    wp_enqueue_style('page-style', get_template_directory_uri() . '/css/page.css' );
    wp_enqueue_style('single-style', get_template_directory_uri() . '/css/single.css' );
    wp_enqueue_style('checkbox-style', get_template_directory_uri() . '/css/checkbox.css' );
    wp_enqueue_style('checkout-style', get_template_directory_uri() . '/css/checkout.css' );
    wp_enqueue_style('dropdown-style', get_template_directory_uri() . '/css/dropdown.css' );

    // Enqueue external styles and scripts
    wp_enqueue_style('swiper', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" );
    

    wp_enqueue_script('custom-cart', get_template_directory_uri() . '/js/custom-cart.js', array('jquery'), 'null', true);
    wp_localize_script('custom-cart', 'custom_cart_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
   
    wp_enqueue_script("phone-input", get_template_directory_uri() . '/js/phone.js', array('jquery'), 'null', true);
    wp_enqueue_script("dropdown", get_template_directory_uri() . '/js/dropdown.js', array('jquery'), 'null', true);
    wp_enqueue_script('aos', "https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js", array('jquery'), '8', true );
    wp_enqueue_script('scrollTo', "https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.3/jquery.scrollTo.min.js", array('jquery'), 'null', true );
    wp_enqueue_script("swipe-js", "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js", array('jquery'), '8', true);
    wp_enqueue_script("gsap", get_template_directory_uri() . '/js/gsap.min.js', array(), '3.9.0', true);
    wp_enqueue_script("plugin", get_template_directory_uri() . '/js/MotionPathPlugin.min.js', array('gsap'), '3.9.0', true);
    wp_enqueue_script("select", get_template_directory_uri() . '/js/custom-select.min.js', array('jquery'), 'null', true);
    wp_enqueue_script("app", get_template_directory_uri() . '/js/app.js', array('jquery'), 'null', true);
    wp_enqueue_script("single_panel", get_template_directory_uri() . '/js/single-panel.js', array('jquery'), 'null', true);
    wp_enqueue_script("header-burger", get_template_directory_uri() . '/js/custom-update.js', array('jquery'), 'null', true);
});

if(function_exists('acf_add_options_page')){
    acf_add_options_page();
    acf_add_options_sub_page('Header');
    acf_add_options_sub_page('Footer');
    acf_add_options_sub_page('Option');

    acf_add_options_sub_page(array(
        "page_title" => "Header",
        "menu_title" => "Header",
        "menu_slug" => "theme-options-header",
        "capability" => "edit_posts",
        "parent_slug" => "theme-options",
        "position" => false,
        "icon_url" => false
    ));
}

if ( ! defined( 'ABSPATH' ) ){ 
    exit;
}

add_filter( 'show_admin_bar', '__return_false' );

add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}
	if($dosvg ){
		if( current_user_can('manage_options') ){
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}
	return $data;
}

function get_the_image($image, $object = false){
    if(!is_array($image)){
        if($object !== false){
            $image = get_field($image, $object);
        } else {
            $image = get_field($image);
        }
    }
    if($image){
        return '<img src="' . $image . '">';
    }
}

function the_linker($link, $class="", $object = false){                                   
    if($link && $link['title']){ ?>
            <a href="<?php echo $link['url']; ?>" class="<?php echo $class; ?>" target="<?php echo $link['target'] ; ?>">
                <?php echo $link['title']; ?>
            </a>
        <?php
    }
}

function add_to_cart_ajax() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $souce_id = isset($_POST['souce_id']) ? intval($_POST['souce_id']) : 0;

    if($souce_id > 0){
        WC()->cart->add_to_cart($souce_id);
    }

    if ($product_id > 0) {
        WC()->cart->add_to_cart($product_id);

        echo json_encode(array('status' => 'success', 'message' => 'Product added to cart.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid product ID.'));
    }

    wp_die();
}

add_action('wp_ajax_add_to_cart_action', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart_action', 'add_to_cart_ajax');

function get_cart_item_count_ajax() {
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}

add_action('wp_ajax_get_cart_item_count', 'get_cart_item_count_ajax');
add_action('wp_ajax_nopriv_get_cart_item_count', 'get_cart_item_count_ajax');

function get_cart_contents_ajax() {
    $cart_items = WC()->cart->get_cart();
    $cart_contents = array();

    foreach ($cart_items as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];

        // Get the product image URL
        $thumbnail_id = $product->get_image_id();
        $image_url = wp_get_attachment_image_url($thumbnail_id, 'thumbnail');

        $cart_contents[] = array(
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'quantity' => $cart_item['quantity'],
            'price' => esc_html($product->get_price()),
            'regular_price' => esc_html($product->get_regular_price()),
            'sale_price' => esc_html($product->get_sale_price()),
            'short_description' => $product->get_short_description(),
            'image' => $image_url,
            'weight' => esc_html($product->get_weight()),
        );
    }
    // Return JSON response
    echo json_encode($cart_contents);

    wp_die();
}

add_action('wp_ajax_get_cart_contents', 'get_cart_contents_ajax');
add_action('wp_ajax_nopriv_get_cart_contents', 'get_cart_contents_ajax');

function create_order_ajax() {
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $address = sanitize_text_field($_POST['address']);
    $comment_to_order = sanitize_textarea_field($_POST['comment']);
    $products = $_POST['products'];

    $order = wc_create_order();
    foreach ($products as $product) {
        $order->add_product(get_product($product["id"]), $product['quantity']);
    }

    // Add customer information
    $order->set_billing_first_name($name);
    $order->set_billing_phone($phone);
    $order->set_billing_address_1($address);
    $order->set_customer_note($comment_to_order);

    $order_id = $order->save();

    echo json_encode(array('status' => 'success', 'message' => 'Order created successfully.', 'order_id' => $order_id));
    wp_die();
}

add_action('wp_ajax_create_order_action', 'create_order_ajax');
add_action('wp_ajax_nopriv_create_order_action', 'create_order_ajax');

function clear_cart_ajax() {
    WC()->cart->empty_cart();

    echo json_encode(array('status' => 'success', 'message' => 'Cart cleared successfully.'));
    wp_die();
}

add_action('wp_ajax_clear_cart_action', 'clear_cart_ajax');
add_action('wp_ajax_nopriv_clear_cart_action', 'clear_cart_ajax');


function update_cart_item_ajax() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $cart_item_key = WC()->cart->generate_cart_id($product_id);

    if (WC()->cart->find_product_in_cart($cart_item_key)) {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
        $cart_items = WC()->cart->get_cart();
        $cart_contents = array();
        echo json_encode($cart_contents);
        wp_die();
    } else {
        echo json_encode(array('status' => 'error', 'message' => $product_id));
        wp_die();
    }

}

function remove_cart_item_ajax() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $cart_item_key = WC()->cart->generate_cart_id($product_id);
    $removed = WC()->cart->remove_cart_item($cart_item_key);

    if ($removed) {
        $cart_items = WC()->cart->get_cart();
        $cart_contents = array();
        echo json_encode($cart_contents);
        wp_die();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Product not found in cart'));
        wp_die();
    }
}

add_action('wp_ajax_update_cart_item', 'update_cart_item_ajax');
add_action('wp_ajax_nopriv_update_cart_item', 'update_cart_item_ajax');
add_action('wp_ajax_remove_cart_item', 'remove_cart_item_ajax');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item_ajax');


add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
	remove_menu_page( 'index.php' );    
	remove_menu_page( 'edit.php' );    
	remove_menu_page( 'edit-comments.php' );  
}


add_theme_support("post-thumbnails");
add_theme_support("title-tag");
add_theme_support("custom-logo");
?>