<?php
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css' );
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/css/footer.css' );
    wp_enqueue_style('header-style', get_template_directory_uri() . '/css/header.css' );
    wp_enqueue_style('delivery-style', get_template_directory_uri() . '/css/delivery.css' );
    wp_enqueue_style('product-style', get_template_directory_uri() . '/css/product.css' );

    wp_enqueue_style('swiper', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" );

    wp_enqueue_script("swipe-js", "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js");
    wp_enqueue_script("gsap", get_template_directory_uri() . '/js/gsap.min.js', array('jquery'), 'null', true);
    wp_enqueue_script("plugin", get_template_directory_uri() . '/js/MotionPathPlugin.min.js', array('jquery'), 'null', true);
    wp_enqueue_script("select", get_template_directory_uri() . '/js/custom-select.min.js', array('jquery'), 'null', true);
    wp_enqueue_script("app", get_template_directory_uri() . '/js/app.min.js', array('jquery'), 'null', true);
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

add_action( 'login_head', 'my_custom_login_logo' );

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