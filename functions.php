<?php

// Let's define this as a constant so that we can use it in more than one place
define( 'SD_PORTFOLIO_POST_TYPE', 'sd_portfolio' );

// Wherein we register the portfolio post type
add_action( 'init', 'sd_init' );
function sd_init() {
	// Let's do the labels first
	// These make the admin area respond entirely to our post_type
	$labels = array(
		'name' => 'Portfolio Items',
		'singular_name' => 'Portfolio Item',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Porfolio Item',
		'edit_item' => 'Edit Portfolio Item',
		'new_item' => 'New Portfolio Item',
		'view_item' => 'View Portfolio Item',
		'search_items' => 'Search Portfolio Items',
		'not_found' => 'No porfolio items found',
		'not_found_in_trash' => 'No porfolio items found in trash',
		'all_items' => 'All Portfolio Items'
	);
	
	// We're not using all the $args
	// See http://codex.wordpress.org/Function_Reference/register_post_type
	$args = array(
		// features we should support in the admin UI
		'supports' => array('title', 'editor', 'thumbnail'),
		// Which slug should precede individual items
		'rewrite' => array('slug' => 'portfolio'),
		// Which slug should be used for the portfolio archive
		'has_archive' => 'portfolio',
		// We defined the labels above
		'labels' => $labels,
		// Show on the front end
		'public' => true,
		// Show the admin UI
		// Technically, setting public makes this unnecessary
		'show_ui' => true,
		// moves our side menu item just underneath "posts"
		'menu_position' => 6
	);
	
	register_post_type( SD_PORTFOLIO_POST_TYPE, $args );
}


add_action( 'init', 'sd_create_metaboxes' );
function sd_create_metaboxes() {
	// define our fields
	$meta_fields = array(
		array(
			'name' => 'Work Done',
			'meta' => 'work_done',
			'type' => 'text'
		),
		array(
			'name' => 'Agency',
			'meta' => 'agency',
			'type' => 'text'
		),
		array(
			'name' => 'Live site URL',
			'meta' => 'live_url',
			'type' => 'text'
		),
		array(
			'name' => 'Client Quote',
			'meta' => 'client_quote',
			'type' => 'textarea'
		)
	);
	
	// define our box
	$meta_box = array(
		'id' => 'portfolio-meta',
		'title' => 'Portfolio Metadata',
		'pages' => array(SD_PORTFOLIO_POST_TYPE),
		'fields' => $meta_fields
	);
	
	// include our helper function
	require_once 'tribe-meta-box.php';
	// off and running
	new Tribe_Meta_Box($meta_box);
}

// our image size
add_image_size('sd_portfolio', 1000, 500, true);

// Add JS & CSS
add_action( 'wp_enqueue_scripts', 'sd_portfolio_resources' );
function sd_portfolio_resources() {
	$resource_url = get_stylesheet_directory_uri() . '/resources/';
	wp_register_script( 'flexslider', $resource_url . 'jquery.flexslider-min.js', array('jquery'), '1.2', true );
	wp_register_script( 'portfolio-slideshow', $resource_url . 'slideshow.js', array('flexslider'), null, true );
	wp_register_style( 'flexslider', $resource_url . 'flexslider.css' );
	
	// only if we're on the portfolio archive
	if ( is_post_type_archive('sd_portfolio') ) {
		wp_enqueue_script( 'portfolio-slideshow' );
		wp_enqueue_style( 'flexslider' );
	}
}

