<?php


// List Categories
function custom_wp_list_categories($categories){
    // do something to the $categories returned by wp_list_categories()

    return $categories;
}

// Add responsive class to images
function add_responsive_class($content){

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {           
           $img->setAttribute('class','responsive-img');
        }

        $html = $document->saveHTML();
        return $html;   
}

// Flow Text
function add_flowtext($content){

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $paragraphs = $document->getElementsByTagName('p');
        foreach ($paragraphs as $paragraph) {           
           $paragraph->setAttribute('class','flow-text');
        }

        $html = $document->saveHTML();
        return $html;   
}

// Widget functions
function lizepress_widgets_init() {
	register_sidebar( array(
			'name' => 'Footer Widget Area',
			'id' => 'footer_widget_area',
			'before_widget' => '<div class="col s4 footer-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>'
		));
}

// Generate auto featured images of first image in post
function auto_featured_image() {
    global $post;
 
    if (!has_post_thumbnail($post->ID)) {
        $attached_image = get_children( "post_parent=$post->ID&amp;post_type=attachment&amp;post_mime_type=image&amp;numberposts=1" );
         
      if ($attached_image) {
              foreach ($attached_image as $attachment_id => $attachment) {
                   set_post_thumbnail($post->ID, $attachment_id);
              }
         }
    }
}
// Featured images size
set_post_thumbnail_size( 845, 563, true ); 

// Load CSS Styles
function lizepress_enqueue_style() {

	wp_enqueue_style( 'core', get_stylesheet_uri()); 
	wp_enqueue_style( 'materialize', get_template_directory_uri() . '/css/materialize.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	
}

function lizepress_enqueue_script() {
	wp_enqueue_script( 'materialize-js', get_template_directory_uri() . '/js/materialize.min.js' );
}

// ---- Hooks

// List categories
add_filter('wp_list_categories', 'custom_wp_list_categories');

// responsive images
add_filter('the_content', 'add_responsive_class');

// Flow Text
add_filter('the_content', 'add_flowtext');

// Register menus

register_nav_menus(array(
		'footer_menu' => __( 'Footer Menu' ),
		'main_header_menu' => __( 'Main Header Menu' )
	));

// Load Widgets
add_action( 'widgets_init', 'lizepress_widgets_init');

// Load Style funcitons
add_action( 'wp_enqueue_scripts', 'lizepress_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'lizepress_enqueue_script' );

// Featured image functions
add_theme_support( 'post-thumbnails' ); 
// Use it temporary to generate all featured images
// add_action('the_post', 'auto_featured_image');
// Used for new posts
add_action('save_post', 'auto_featured_image');
add_action('draft_to_publish', 'auto_featured_image');
add_action('new_to_publish', 'auto_featured_image');
add_action('pending_to_publish', 'auto_featured_image');
add_action('future_to_publish', 'auto_featured_image');

 ?>