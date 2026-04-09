<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * --------------------------------------------------------------------
 * Theme Setup
 * --------------------------------------------------------------------
 */
function ranky_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    register_nav_menus([
        'main_menu' => 'Main Menu',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 40,
        'width'       => 140,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'ranky_theme_setup');


/**
 * --------------------------------------------------------------------
 * Custom Post Types
 * --------------------------------------------------------------------
 */
function ranky_register_service_cpt()
{
    register_post_type('service', [
        'labels' => [
            'name'          => 'Services',
            'singular_name' => 'Service',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'services'],
        'menu_icon'     => 'dashicons-admin-tools',
        'supports'      => ['title'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'ranky_register_service_cpt');


function ranky_register_industry_cpt()
{
    register_post_type('industry', [
        'labels' => [
            'name'          => 'Industries',
            'singular_name' => 'Industry',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'industries'],
        'menu_icon'     => 'dashicons-building',
        'supports'      => ['title'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'ranky_register_industry_cpt');


function ranky_register_blog_cpt()
{
    register_post_type('blog', [
        'labels' => [
            'name'          => 'Blog',
            'singular_name' => 'Blog Post',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'blog'],
        'menu_icon'     => 'dashicons-edit',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'taxonomies'    => ['category'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'ranky_register_blog_cpt');


function ranky_blog_archive_filter_by_category($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('blog') && !empty($_GET['category_name'])) {
        $query->set('category_name', sanitize_text_field($_GET['category_name']));
    }
}
add_action('pre_get_posts', 'ranky_blog_archive_filter_by_category');


function ranky_estimated_read_time()
{
    $content = get_the_content();
    $words   = str_word_count(strip_tags($content));
    return $words > 0 ? max(1, (int) ceil($words / 200)) : null;
}


/**
 * --------------------------------------------------------------------
 * ACF (Options Page + JSON Sync)
 * --------------------------------------------------------------------
 * Runs AFTER:
 * - WordPress init
 * - CPT registration
 * - ACF Pro initialization
 */
add_action('acf/init', function () {

    // Register ACF Options Page
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug'  => 'ranky-theme-settings',
            'capability' => 'edit_posts',
            'redirect'   => false,
        ]);
    }

}, 20);


/**
 * --------------------------------------------------------------------
 * ACF JSON Sync Configuration
 * --------------------------------------------------------------------
 * Saves and loads ACF field groups from JSON files in /acf-json/
 * This enables version control and UI-based field group management.
 */
add_filter('acf/settings/save_json', function ($path) {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    // Remove original path (optional)
    unset($paths[0]);
    // Add theme JSON path
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});


function ranky_enqueue_scripts() {
    wp_enqueue_script(
        'ranky-faq',
        get_template_directory_uri() . '/assets/js/faq.js',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'ranky_enqueue_scripts');


function ranky_enqueue_styles() {
    // All styles are loaded via @import in style.css
    wp_enqueue_style(
        'ranky-style',
        get_stylesheet_uri(), // style.css
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'ranky_enqueue_styles');


function ranky_enqueue_lottie_assets() {
    $lottie_path = null;

    if (is_front_page()) {
        $lottie_path = get_template_directory_uri() . '/assets/animations/hero-animation.json';
    } elseif (is_singular('service')) {
        $service_slug = get_post_field('post_name', get_queried_object_id());
        if ($service_slug === 'seo-geo') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/GEO.json';
        } elseif ($service_slug === 'external-cmo') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/' . rawurlencode('External CMO.json');
        } elseif ($service_slug === 'orm') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/ORM.json';
        } elseif ($service_slug === 'content-marketing') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/Content.json';
        } elseif ($service_slug === 'paid-ads' || $service_slug === 'paidads') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/' . rawurlencode('paid ads new.json');
        }
    } elseif (is_singular('industry')) {
        $industry_slug = get_post_field('post_name', get_queried_object_id());
        if ($industry_slug === 'tech-industry-page') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/Tech.json';
        } elseif ($industry_slug === 'b2b-industry-page') {
            $lottie_path = get_template_directory_uri() . '/assets/animations/' . rawurlencode('B2B new.json');
        }
    }

    if (!$lottie_path) {
        return;
    }

    // Lottie library
    wp_enqueue_script(
        'lottie',
        'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js',
        [],
        '5.12.2',
        true
    );

    // Hero lottie script
    wp_enqueue_script(
        'ranky-hero-lottie',
        get_template_directory_uri() . '/assets/js/hero-lottie.js',
        ['lottie'],
        '1.0',
        true
    );

    // Pass animation path to JS
    wp_localize_script('ranky-hero-lottie', 'heroLottieData', [
        'path' => $lottie_path
    ]);
}
add_action('wp_enqueue_scripts', 'ranky_enqueue_lottie_assets');

function ranky_enqueue_header_scripts() {
    wp_enqueue_script(
      'ranky-mobile-menu',
      get_template_directory_uri() . '/assets/js/mobile-menu.js',
      [],
      '1.0',
      true
    );
  }
  add_action('wp_enqueue_scripts', 'ranky_enqueue_header_scripts');
  

  function enqueue_services_tabs_script() {
    if (is_front_page()) {
      wp_enqueue_script(
        'services-tabs',
        get_template_directory_uri() . '/assets/js/services-tabs.js',
        [],
        null,
        true
      );
    }
  }
  add_action('wp_enqueue_scripts', 'enqueue_services_tabs_script');

  function enqueue_success_in_action_script() {
    if (is_front_page()) {
      wp_enqueue_script(
        'success-in-action',
        get_template_directory_uri() . '/assets/js/success-in-action.js',
        [],
        null,
        true
      );
    }
  }
  add_action('wp_enqueue_scripts', 'enqueue_success_in_action_script');

  function enqueue_system_features_script() {
    if (is_singular('service')) {
      wp_enqueue_script(
        'system-features',
        get_template_directory_uri() . '/assets/js/system-features.js',
        [],
        '1.0',
        true
      );
    }
  }
  add_action('wp_enqueue_scripts', 'enqueue_system_features_script');

  add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
      'contact-form',
      get_template_directory_uri() . '/assets/js/contact-form.js',
      ['jquery'],
      null,
      true
    );
  
    wp_localize_script(
      'contact-form',
      'contactFormData',
      [
        'ajaxUrl' => admin_url('admin-ajax.php'),
      ]
    );
  });
  
  

  add_action('wp_ajax_submit_contact_card', 'handle_contact_card_submit');
  add_action('wp_ajax_nopriv_submit_contact_card', 'handle_contact_card_submit');
  
  function handle_contact_card_submit() {
    if (
      empty($_POST['formData']) ||
      !isset($_POST['formData'])
    ) {
      wp_send_json_error('Missing data');
    }
  
    parse_str($_POST['formData'], $data);
  
    if (
      empty($data['contact_card_nonce']) ||
      !wp_verify_nonce($data['contact_card_nonce'], 'contact_card_submit')
    ) {
      wp_send_json_error('Invalid nonce');
    }
  
    if (empty($data['terms_approved'])) {
      wp_send_json_error('Terms not approved');
    }
  
    $message = "New contact form submission:\n\n";
  
    foreach ($data as $key => $value) {
      if (strpos($key, 'field_') === 0 && $value !== '') {
        $message .= ucfirst(str_replace('_', ' ', $key)) . ": " . sanitize_text_field($value) . "\n";
      }
    }
    error_log('CONTACT FORM SUBMITTED');

    wp_mail(
      'yonatan62862@gmail.com',
      'New Contact Form Message',
      $message
    );
  
    wp_send_json_success();
  }
  