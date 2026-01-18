<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<?php
// Check if we're on a service page with light hero background
$is_light_hero_service = false;
$light_hero_class = '';
if (is_singular('service')) {
    $post_slug = get_post_field('post_name', get_the_ID());
    $post_title = get_the_title();
    
    // Services with light hero backgrounds that need dark blue header
    $light_hero_services = ['content-marketing', 'social-media', 'orm'];
    $light_hero_titles = ['Content Marketing', 'Social Media', 'ORM'];
    
    $is_light_hero_service = in_array(strtolower($post_slug), array_map('strtolower', $light_hero_services)) 
                          || in_array($post_title, $light_hero_titles);
    
    if ($is_light_hero_service) {
        $light_hero_class = 'service-light-hero';
    }
}
?>

<body <?php body_class($light_hero_class); ?>>

<header class="site-header <?php echo $is_light_hero_service ? 'site-header--dark' : ''; ?>">
  <div class="container site-header__inner">

    <div class="site-header__logo">
      <?php the_custom_logo(); ?>
      <?php 
      $tagline = get_field('header_logo_tagline', 'option');
      if ($tagline): ?>
        <p class="site-header__tagline"><?php echo esc_html($tagline); ?></p>
      <?php endif; ?>
    </div>

    <nav class="site-header__nav">
      <ul class="site-header__menu">
        <?php 
        $contact_text = get_field('header_contact_button_text', 'option') ?: 'Contact Us';
        $nav_items = get_field('header_navigation_items', 'option');
        if ($nav_items && is_array($nav_items)):
          foreach ($nav_items as $item): 
            $label = $item['label'] ?? '';
            $link = $item['link'] ?? [];
            $has_dropdown = !empty($item['has_dropdown']);
            $dropdown_items = $item['dropdown_items'] ?? [];
            
            if (!$label) continue;
            
            $url = !empty($link['url']) ? $link['url'] : '#';
            $target = !empty($link['target']) ? $link['target'] : '';
        ?>
          <li class="site-header__menu-item <?php echo $has_dropdown ? 'has-dropdown' : ''; ?>">
            <a 
              href="<?php echo esc_url($url); ?>"
              <?php if ($target): ?>target="<?php echo esc_attr($target); ?>"<?php endif; ?>
              class="site-header__menu-link"
            >
              <?php echo esc_html($label); ?>
              <?php if ($has_dropdown): ?>
                <svg class="site-header__dropdown-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              <?php endif; ?>
            </a>
            
            <?php if ($has_dropdown && !empty($dropdown_items)): ?>
              <ul class="site-header__dropdown">
                <?php foreach ($dropdown_items as $dropdown_item): 
                  $dropdown_label = $dropdown_item['label'] ?? '';
                  $dropdown_link = $dropdown_item['link'] ?? [];
                  if (!$dropdown_label) continue;
                  
                  $dropdown_url = !empty($dropdown_link['url']) ? $dropdown_link['url'] : '#';
                  $dropdown_target = !empty($dropdown_link['target']) ? $dropdown_link['target'] : '';
                ?>
                  <li class="site-header__dropdown-item">
                    <a 
                      href="<?php echo esc_url($dropdown_url); ?>"
                      <?php if ($dropdown_target): ?>target="<?php echo esc_attr($dropdown_target); ?>"<?php endif; ?>
                      class="site-header__dropdown-link"
                    >
                      <?php echo esc_html($dropdown_label); ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php 
          endforeach;
        endif; 
        ?>
      </ul>
    </nav>

    <div class="site-header__cta">
      <a 
        href="#contact-card"
        class="btn btn--primary"
      >
        <?php echo esc_html($contact_text); ?>
      </a>
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
      <ul class="mobile-menu__list">
        <?php 
        if ($nav_items && is_array($nav_items)):
          foreach ($nav_items as $item): 
            $label = $item['label'] ?? '';
            $link = $item['link'] ?? [];
            $has_dropdown = !empty($item['has_dropdown']);
            $dropdown_items = $item['dropdown_items'] ?? [];
            
            if (!$label) continue;
            
            $url = !empty($link['url']) ? $link['url'] : '#';
            $target = !empty($link['target']) ? $link['target'] : '';
        ?>
          <li class="mobile-menu__item <?php echo $has_dropdown ? 'has-dropdown' : ''; ?>">
            <a 
              href="<?php echo esc_url($url); ?>"
              <?php if ($target): ?>target="<?php echo esc_attr($target); ?>"<?php endif; ?>
              class="mobile-menu__link"
            >
              <?php echo esc_html($label); ?>
            </a>
            
            <?php if ($has_dropdown && !empty($dropdown_items)): ?>
              <ul class="mobile-menu__dropdown">
                <?php foreach ($dropdown_items as $dropdown_item): 
                  $dropdown_label = $dropdown_item['label'] ?? '';
                  $dropdown_link = $dropdown_item['link'] ?? [];
                  if (!$dropdown_label) continue;
                  
                  $dropdown_url = !empty($dropdown_link['url']) ? $dropdown_link['url'] : '#';
                  $dropdown_target = !empty($dropdown_link['target']) ? $dropdown_link['target'] : '';
                ?>
                  <li class="mobile-menu__dropdown-item">
                    <a 
                      href="<?php echo esc_url($dropdown_url); ?>"
                      <?php if ($dropdown_target): ?>target="<?php echo esc_attr($dropdown_target); ?>"<?php endif; ?>
                      class="mobile-menu__dropdown-link"
                    >
                      <?php echo esc_html($dropdown_label); ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php 
          endforeach;
        endif; 
        ?>
      </ul>
      <a 
        href="#contact-card"
        class="btn btn--primary mobile-menu__cta"
      >
        <?php echo esc_html($contact_text); ?>
      </a>
    </nav>
  </div>

</header>
