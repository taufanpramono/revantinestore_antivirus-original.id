<?php 
//======================================
//Change the position of product tag
//by : mastau.fun
//update : 17/10/2023
//======================================


function custom_single_product_script() {
    if (is_product()) { 
        ?>
    <script type="text/javascript">
            var afterAddToCart = document.querySelector('.wd-after-add-to-cart');
            var productShare = document.querySelector('.product-share');
            if (afterAddToCart && productShare) {
                afterAddToCart.parentNode.removeChild(afterAddToCart);
                productShare.parentNode.insertBefore(afterAddToCart, productShare.nextSibling);
                }
        </script>
        <?php
    }
}

add_action('wp_footer', 'custom_single_product_script');


//=============================================
// Dynamic Product Tag Berdasarkan ID Product
// custom plugin by : mastau.fun
// New Update : 04/10/2023
//=============================================


function get_the_product_tags() {
    if ( is_product() ) {
        global $product;
        $product_id = $product->get_id();
        $product_tags = wp_get_post_terms( $product_id, 'product_tag' );
        if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ) {
            $tag_links = array();
            foreach ( $product_tags as $product_tag ) {
                $tag_links[] = '<a href="' . get_term_link( $product_tag->term_id, 'product_tag' ) . '" class="tag-cloud-link tag-link-184 tag-link-position-1" style="font-size: 22pt;">' . $product_tag->name . '</a>';
            }
            $output = '<div class="woocommerce widget_product_tag_cloud"><h5 style="margin-bottom: 20px; margin-top: 35px;">Product Tags</h5><div class="tagcloud">' . implode(" ", $tag_links) . '</div></div>';
            return $output;
            
        } else {
            return ' ';
        }
    }
}
add_shortcode( 'product_tags_with_url', 'get_the_product_tags' );


//==============================
// Dynamic Copy Right
// custom plugin by : mastau.fun
// 04/10/2023
//==============================

function copy_right(){
    $curent_year = date("Y");
    $site_title  = get_bloginfo( 'name' );
    $site_url = get_site_url();
    $output = "<span style='color:white; font-family:poppins;'>Copyright ©  $curent_year <a href='$site_url'> $site_title </a> | Powered by <a href='$site_url'> $site_title </a></span>";
    return $output;
    
}
add_shortcode ('copyright','copy_right');


//===================================================
// Dynamic Post / Article Tag Berdasarkan ID post
// custom plugin by : mastau.fun
// New Update : 04/10/2023
//===================================================


function mendapatkan_tag_cloud() {  
    $tags = wp_get_post_tags(get_the_ID());
    if ($tags) {
        echo '<div class="cc-class-singgle">';
        echo '<div class="cc-list">';
        foreach ($tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" rel="tag">' . esc_html($tag->name) . '</a>';
        }
        echo '</div>';
        echo '</div>';

    }
}
add_shortcode ('tag_cloud_shortcode','mendapatkan_tag_cloud');


//=============================================
// Dynamic Post Category Berdasarkan ID POST
// custom plugin by : mastau.fun
// New Update : 04/10/2023
//=============================================

function dapatkan_kategori_post() {
    $categories = get_the_category();
    $category_count = count($categories);
    $category_links = array();
    foreach ($categories as $category) {
        $category_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" style="color:white;">' . esc_html($category->name) . '</a>';
    }
    $category_list = implode('<span style="color:white;">,  </span>', $category_links);
    echo $category_list;
}
add_shortcode('kategori_custom','dapatkan_kategori_post');












 ?>