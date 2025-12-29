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
    wp_enqueue_style(
        'ranky-style',
        get_stylesheet_uri(), // style.css
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'ranky_enqueue_styles');


function ranky_enqueue_lottie_assets() {

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
        'path' => get_template_directory_uri() . '/assets/animations/hero-animation.json'
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