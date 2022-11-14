<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
/*==========================================
    Add stylesheets and javascript files
==========================================*/ 

function custom_theme_scripts(){
    //Bootstrap CSS 
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    // wp_enqueue_style('bootstrap-grid', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css');

    //Main CSS
    wp_enqueue_style('main-styles', get_stylesheet_uri());

    //Javascript Files 
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js' );
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/scripts.js' );

}

add_action('wp_enqueue_scripts', 'custom_theme_scripts');



/*==========================================
    Custom Header Images
==========================================*/ 
$custom_image_header = array(
    'width'   => 520,
    'height'  => 150,
    'uploads' => true
);

add_theme_support('custo-header', $custom_image_header);

/*==========================================
    Adds Featured Images
==========================================*/ 
add_theme_support('post-thumbnails');


/*==========================================
    Post Data Information 
==========================================*/ 
function post_data(){
    $archive_year = get_the_time('Y');
    $archive_month = get_the_time('m');
    $archive_day = get_the_time('d');
?>
    <p>Written by: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a> | Published on: <a href="<?php echo get_day_link($archive_year.$archive_month,$archive_day); ?>"><?php echo "$archive_month/$archive_day/$archive_year"; ?></a></p>
<?php

}

/*==========================================
    Add menus to our theme
==========================================*/

function register_my_menus(){
    register_nav_menus(array(
        'main-menu'     => __('Main Manu'),
        'footer-left'   => __('Left Footer Menu'),
        'footer-middle' => __('Middle Footer Menu'),
        'footer-right'  => __('Right Footer Menu'),

        
    ));
}


add_action('init','register_my_menus');


/*===================================
  Pagination Links
=====================================*/


function proPhotographyPagination(){
  global $wp_query;

  $big = 999999999; // need an unlikely integer
  $translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

  echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
  ) );
}


/*===================================
  Creating Widget Areas 
=====================================*/

function blank_widgets_init(){
    register_sidebar(array(
        'name'              => ('Sidebar Widget'),
        'id'                => 'sidebar-widget',
        'description'       => 'Area in the sidebar for content',
        'before_widget'     => '<div class="sidebar-widget-container">',
        'after_widget'      => '</div>',
        'before_title'      => '<h2>',
        'after_title'       => '</h2>'
    ));

    register_sidebar(array(
        'name'              => ('Right Footer Widget'),
        'id'                => 'right-footer-widget',
        'description'       => 'Area in right footer for content',
        'before_widget'     => '<div class="right-footer-widget-container">',
        'after_widget'      => '</div>',
        'before_title'      => '<h2>',
        'after_title'       => '</h2>'
    ));
}

add_action('widgets_init','blank_widgets_init');

/*===================================
  Register Custom Post Type
=====================================*/

function employeeDirectory() {

	$labels = array(
		'name'                  => _x( 'Employees', 'Post Type General Name', 'Gymnastics' ),
		'singular_name'         => _x( 'Employee', 'Post Type Singular Name', 'Gymnastics' ),
		'menu_name'             => __( 'Employees', 'Gymnastics' ),
		'name_admin_bar'        => __( 'Employee', 'Gymnastics' ),
		'archives'              => __( 'Employee', 'Gymnastics' ),
		'attributes'            => __( 'Employee Attributes', 'Gymnastics' ),
		'parent_item_colon'     => __( 'Parent Employee', 'Gymnastics' ),
		'all_items'             => __( 'All Employees', 'Gymnastics' ),
		'add_new_item'          => __( 'Add New Employee', 'Gymnastics' ),
		'add_new'               => __( 'Add New', 'Gymnastics' ),
		'new_item'              => __( 'New Employee', 'Gymnastics' ),
		'edit_item'             => __( 'Edit Employee', 'Gymnastics' ),
		'update_item'           => __( 'Update Employee', 'Gymnastics' ),
		'view_item'             => __( 'View Employee', 'Gymnastics' ),
		'view_items'            => __( 'View Employees', 'Gymnastics' ),
		'search_items'          => __( 'Search Employee', 'Gymnastics' ),
		'not_found'             => __( 'Not found', 'Gymnastics' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'Gymnastics' ),
		'featured_image'        => __( 'Headshot', 'Gymnastics' ),
		'set_featured_image'    => __( 'Set Headshot', 'Gymnastics' ),
		'remove_featured_image' => __( 'Remove Headshot', 'Gymnastics' ),
		'use_featured_image'    => __( 'Use as Headshot', 'Gymnastics' ),
		'insert_into_item'      => __( 'Insert into Employee', 'Gymnastics' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Employee', 'Gymnastics' ),
		'items_list'            => __( 'Employees list', 'Gymnastics' ),
		'items_list_navigation' => __( 'Employees list navigation', 'Gymnastics' ),
		'filter_items_list'     => __( 'Filter Employees list', 'Gymnastics' ),
	);
    $rewrite = array(
		'slug'                  => 'employees',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Employee', 'Gymnastics' ),
		'description'           => __( 'Directory of employees for the company', 'Gymnastics' ),
		'labels'                => $labels,
        'show_in_rest'          => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'employeeDirectory', $args );

}
add_action( 'init', 'employeeDirectory', 0 );
?>