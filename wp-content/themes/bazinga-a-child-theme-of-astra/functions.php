<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

add_action( 'wp_enqueue_scripts', 'bazinga_a_child_theme_of_astra_style' );
				function bazinga_a_child_theme_of_astra_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}

/**
 * Your code goes below.
 */

/*====================
 *  Function to redirect users based on IP address
 * ================== */

function redirect_users_based_on_ip() {
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Check if the IP starts with '77.29'
    if (strpos($user_ip, '77.29') === 0) {
        // Redirect to google if the IP doesn't start with '77.29'
        wp_redirect('https://google.com'); // Replace with your desired URL
        exit();
    }
}
add_action('template_redirect', 'redirect_users_based_on_ip');

/*====================
 *  Register Custom Post Type "Projects"
 * ================== */
function create_projects_post_type() {
    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Projects', 'text_domain' ),
        'name_admin_bar'        => __( 'Project', 'text_domain' ),
        'archives'              => __( 'Project Archives', 'text_domain' ),
        'attributes'            => __( 'Project Attributes', 'text_domain' ),
        'all_items'             => __( 'All Projects', 'text_domain' ),
        'add_new_item'          => __( 'Add New Project', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Project', 'text_domain' ),
        'edit_item'             => __( 'Edit Project', 'text_domain' ),
        'update_item'           => __( 'Update Project', 'text_domain' ),
        'view_item'             => __( 'View Project', 'text_domain' ),
        'view_items'            => __( 'View Projects', 'text_domain' ),
        'search_items'          => __( 'Search Project', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into project', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'text_domain' ),
        'items_list'            => __( 'Projects list', 'text_domain' ),
        'items_list_navigation' => __( 'Projects list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter projects list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'text_domain' ),
        'description'           => __( 'Post Type for projects', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies'            => array( 'project_type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array( 'slug' => 'projects' ),
    );
    register_post_type( 'projects', $args );
}
add_action( 'init', 'create_projects_post_type', 0 );

/*====================
 *  Register Custom Taxonomy "Project Type"
 * ================== */
function create_project_type_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Project Type', 'text_domain' ),
        'all_items'                  => __( 'All Project Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Project Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Project Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Project Type Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Project Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Project Type', 'text_domain' ),
        'update_item'                => __( 'Update Project Type', 'text_domain' ),
        'view_item'                  => __( 'View Project Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate project types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove project types', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Project Types', 'text_domain' ),
        'search_items'               => __( 'Search Project Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No project types', 'text_domain' ),
        'items_list'                 => __( 'Project Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Project Types list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array( 'slug' => 'project-type' ),
    );
    register_taxonomy( 'project_type', array( 'projects' ), $args );
}
add_action( 'init', 'create_project_type_taxonomy', 0 );

/*====================
 *  Create an AJAX handler for fetching "Architecture" Projects
 * ================== */
function fetch_architecture_projects() {
    // Check if the user is logged in and set the number of posts
    $num_posts = is_user_logged_in() ? 6 : 3;

    // Arguments for WP_Query
    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => $num_posts,
        'tax_query'      => array(
            array(
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
            ),
        ),
    );

    // Fetch the latest Projects from "Architecture" taxonomy
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $projects = array();

        // Loop through the projects and prepare the response data
        while ($query->have_posts()) {
            $query->the_post();
            $projects[] = array(
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            );
        }

        // Return the results in JSON format
        wp_send_json_success($projects);
    } else {
        wp_send_json_success(array()); // Return an empty array if no posts found
    }

    wp_reset_postdata();
}

add_action('wp_ajax_fetch_architecture_projects', 'fetch_architecture_projects');
add_action('wp_ajax_nopriv_fetch_architecture_projects', 'fetch_architecture_projects');

/*====================
 *  Function to fetch and display 5 Kanye quotes in a shortcode "[kanye_quotes]"
 * ================== */
function fetch_kanye_quotes() {
    $api_url = 'https://api.kanye.rest/';

    $kanye_quotes = array();

    for ($i = 0; $i < 5; $i++) {
        $response = wp_remote_get($api_url);
        if (is_wp_error($response)) {
            return 'Error fetching Kanye quotes';
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        if (isset($data->quote)) {
            $kanye_quotes[] = $data->quote;
        }
    }
    $output = '<div class="kanyes-quotes">';
    foreach ($kanye_quotes as $quote) {
        $output .= '<blockquote>' . esc_html($quote) . '</blockquote>';
    }
    $output .= '</div>';

    return $output;
}

add_shortcode('kanye_quotes', 'fetch_kanye_quotes');

/*====================
 *  Function to fetch and return a random coffee image
 * ================== */
function hs_give_me_coffee() {
    $response = wp_remote_get('https://coffee.alexflipnote.dev/random.json');

    // Check for errors in the response
    if (is_wp_error($response)) {
        return 'Could not retrieve coffee image.';
    }

    // Parse the response
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    // If the image URL exists, return the HTML img element
    if (isset($data['file'])) {
        $coffee_image_url = esc_url($data['file']);
        return '<img src="' . $coffee_image_url . '" alt="Random Coffee" style="max-width:100%;height:auto;">';
    } else {
        return 'No coffee available at the moment.';
    }
}

// Register the shortcode [random_coffee]
function hs_give_me_coffee_shortcode() {
    return hs_give_me_coffee();
}
add_shortcode('random_coffee', 'hs_give_me_coffee_shortcode');

