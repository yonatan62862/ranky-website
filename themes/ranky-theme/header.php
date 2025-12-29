<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container site-header__inner">

    <div class="site-header__logo">
      <?php the_custom_logo(); ?>
    </div>

    <nav class="site-header__nav">
      <?php
      wp_nav_menu([
        'theme_location' => 'main_menu',
        'container' => false,
        'menu_class' => 'main-menu',
      ]);
      ?>
    </nav>

    <div class="site-header__cta">
      <a href="#contact" class="btn btn--primary">Get Started</a>
    </div>

    <!-- Hamburger -->
    <button class="hamburger" aria-label="Open menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </div>

  <!-- Mobile Menu -->
  <div class="mobile-menu">
    <nav class="mobile-menu__nav">
      <?php
      wp_nav_menu([
        'theme_location' => 'main_menu',
        'container' => false,
        'menu_class' => 'mobile-menu__list',
      ]);
      ?>
      <a href="#contact" class="btn btn--primary mobile-menu__cta">
        Get Started
      </a>
    </nav>
  </div>

</header>
