<?php
/**
 * Plugin Name:     Must Have
 * Plugin URI:      https://tubemint.com/
 * Description:     Tubemint must have feature plugin backup
 * Author:          Amulya Shahi
 * Author URI:      https://tubemint.com/
 * Text Domain:     wordpress-optin-form
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Must_Have
 */

add_action( 'loop_end', 'add_content_to_post_end' );
function add_content_to_post_end() {
if ( is_single() or is_archive() or is_home() or is_page()) {
	echo '<a class="post-end" href="http://bit.ly/JavaSciprtProjects">
		<img src="https://tubemint.com/wp-content/uploads/2021/01/learn-javascript.png" />
		</a>';
    }
}


add_action( 'loop_start', 'add_content_to_post_top' );
function add_content_to_post_top() {
if ( is_single() or is_archive() or is_home() or is_page()) {
	
	the_breadcrumb();
	if(!is_front_page()){
	echo '<a class="post-end" href="http://bit.ly/WPTechnicalSEO">
		<img src="https://tubemint.com/wp-content/uploads/2021/01/technical-seo-course.png" />
		</a>
		<h4><a href="http://bit.ly/affMarkting">Learn Affiliate Marketing & Blogging</a></h4>	';
    }}
}







add_action( 'loop_end', 'add_ads_to_post_end' );
function add_ads_to_post_end(){
if(is_single() or is_archive() or is_home() ){
echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- horizontal posts -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9519529156425842"
     data-ad-slot="8116237513"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>';
}
}

add_action('wp_head', google_auto_ads);

function google_auto_ads(){
	echo '<script data-ad-client="ca-pub-9519529156425842" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
}



/*=============================================
=            BREADCRUMBS			            =
=============================================*/

function the_breadcrumb() {

    $sep = ' > ';

    if (!is_front_page()) {
	
	// Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs"><p>';
        echo '<a href="';
        echo get_option('home');
        echo '">';
        bloginfo('name');
        echo '</a>' . $sep;
	
	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single() ){
            the_category('title_li=');
        } elseif (is_archive() || is_single()){
            if ( is_day() ) {
                printf( __( '%s', 'text_domain' ), get_the_date() );
            } elseif ( is_month() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
            } elseif ( is_year() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
            } else {
                _e( 'Blog Archives', 'text_domain' );
            }
        }
	
	// If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            the_title();
        }
	
	// If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
	
	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }

        echo '</p></div>';
    }
}