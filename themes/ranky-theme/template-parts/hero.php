<?php
/**
 * Global Hero Section
 */

// Detect context
$post_type = get_post_type();
$is_front  = is_front_page();

// Resolve fields
$hero_h1 = null;
$hero_h2 = null;
$visual_type = null;
$image = null;
$lottie = null;

// New editable hero fields (initialized for front page)
$hero_title_line1_cyan = null;
$hero_title_line2_cyan = null;
$hero_title_line3_white = null;
$hero_title_line4_white = null;
$hero_description = null;
$hero_primary_button_text = null;
$hero_primary_button_link = null;
$hero_secondary_button_text = null;
$hero_secondary_button_link = null;

// Home Page
if ($is_front) {
    $visual_type  = get_field('hero_visual_type');
    $image        = get_field('hero_image');
    $lottie       = get_field('hero_lottie');
    
    // New editable hero fields
    $hero_title_line1_cyan = get_field('hero_title_line1_cyan') ?: 'Strategic Growth';
    $hero_title_line2_cyan = get_field('hero_title_line2_cyan') ?: 'Marketing ';
    $hero_title_line3_white = get_field('hero_title_line3_white') ?: 'That';
    $hero_title_line4_white = get_field('hero_title_line4_white') ?: 'Outperforms.';
    $hero_description = get_field('hero_description') ?: 'Smarter insights, sharper execution. AI-powered strategies delivering leads, revenue, and brand authority.';
    $hero_primary_button_text = get_field('hero_primary_button_text') ?: 'Get A Free Consultation Today';
    $hero_primary_button_link = get_field('hero_primary_button_link') ?: '#contact';
    $hero_secondary_button_text = get_field('hero_secondary_button_text') ?: 'Explore Our Services';
    $hero_secondary_button_link = get_field('hero_secondary_button_link') ?: '/services';
}

// Service Page
elseif ($post_type === 'service') {
    $hero_h1 = get_field('hero_h1');
}

// Industry Page
elseif ($post_type === 'industry') {
    $hero_h1 = get_field('hero_h1');
}

// Fallback
if (!$hero_h1) {
    $hero_h1 = get_the_title();
}

// Final guard
if (!$hero_h1) {
    return;
}
?>

<section class="hero">
  <div class="container hero__inner">

    <!-- Left: Content -->
    <div class="hero__content">

      <?php if ($is_front): ?>
      <h1 class="hero__title">
          <?php if ($hero_title_line1_cyan): ?>
            <span class="hero__title--cyan"><?php echo esc_html($hero_title_line1_cyan); ?></span><br>
          <?php endif; ?>
          <?php if ($hero_title_line2_cyan): ?>
            <span class="hero__title--cyan"><?php echo esc_html($hero_title_line2_cyan); ?></span>
          <?php endif; ?>
          <?php if ($hero_title_line3_white): ?>
            <span class="hero__title--white"><?php echo esc_html($hero_title_line3_white); ?></span><br>
          <?php endif; ?>
          <?php if ($hero_title_line4_white): ?>
            <span class="hero__title--white"><?php echo esc_html($hero_title_line4_white); ?></span>
          <?php endif; ?>
      </h1>

        <?php if ($hero_description): ?>
      <p class="hero__text">
            <?php echo esc_html($hero_description); ?>
      </p>
        <?php endif; ?>

      <div class="hero__actions">
          <?php if ($hero_primary_button_text && $hero_primary_button_link): ?>
            <a href="<?php echo esc_url($hero_primary_button_link); ?>" class="btn btn--primary">
              <?php echo esc_html($hero_primary_button_text); ?>
            </a>
          <?php endif; ?>
          <?php if ($hero_secondary_button_text && $hero_secondary_button_link): ?>
            <a href="<?php echo esc_url($hero_secondary_button_link); ?>" class="btn btn--ghost">
              <?php echo esc_html($hero_secondary_button_text); ?>
        </a>
          <?php endif; ?>
      </div>
      <?php else: ?>
        <?php if ($hero_h1): ?>
          <h1 class="hero__title">
            <?php echo esc_html($hero_h1); ?>
          </h1>
        <?php endif; ?>
        <?php if ($hero_h2): ?>
          <p class="hero__text">
            <?php echo esc_html($hero_h2); ?>
          </p>
        <?php endif; ?>
      <?php endif; ?>

    </div>

    <!-- Right: Visuals -->
    <div class="hero__visuals">
    <div id="hero-lottie"></div>
</div>


  </div>
</section>

