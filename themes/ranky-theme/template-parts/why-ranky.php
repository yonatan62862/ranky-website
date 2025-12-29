<?php
/**
 * Why Ranky Section (Home only)
 */

if (!is_front_page()) {
    return;
}

// Get header group
$header = get_field('why_ranky_header');
$header_title = $header['title'] ?? '';
$header_subtitle = $header['subtitle'] ?? '';
$header_description = $header['description'] ?? '';

// Get comparison headings
$comparison_old_heading = get_field('ranky_comparison_old_heading') ?: 'Old Way';
$comparison_new_heading = get_field('ranky_comparison_new_heading') ?: 'RANKY WAY';

// Get comparison repeater
$comparisons = get_field('ranky_comparison');

// Get statement
$statement = get_field('ranky_statement');

// Get core differentiators heading
$differentiators_heading = get_field('core_differentiators_heading') ?: 'Core Differentiators';

// Get core differentiators repeater
$differentiators = get_field('core_differentiators');

// Get CTA buttons group
$cta_buttons = get_field('cta_buttons');
$primary_button = $cta_buttons['primary_button'] ?? null;
$secondary_button = $cta_buttons['secondary_button'] ?? null;

// Get illustration
$illustration = get_field('illustration');

// If no content, don't render
if (!$header_title && !$comparisons && !$statement && !$differentiators) {
    return;
}
?>

<section class="why-ranky">
  <div class="container">

    <!-- Header -->
    <?php if ($header_title || $header_subtitle || $header_description): ?>
      <header class="why-ranky__header">
        <?php if ($header_title): ?>
          <h2 class="why-ranky__title">
            <?php echo esc_html($header_title); ?>
          </h2>
        <?php endif; ?>

        <?php if ($header_subtitle): ?>
          <h3 class="why-ranky__subtitle">
            <?php echo esc_html($header_subtitle); ?>
          </h3>
        <?php endif; ?>

        <?php if ($header_description): ?>
          <p class="why-ranky__desc">
            <?php echo esc_html($header_description); ?>
          </p>
        <?php endif; ?>
      </header>
    <?php endif; ?>

    <!-- Comparison -->
    <?php if ($comparisons && is_array($comparisons)): ?>
      <div class="why-ranky__comparison">
        <!-- Column Headings -->
        <div class="comparison-headings">
          <div class="comparison-heading comparison-heading--old">
            <?php if ($comparison_old_heading): ?>
              <h3 class="comparison-heading__text">
                <?php echo esc_html($comparison_old_heading); ?>
              </h3>
            <?php endif; ?>
          </div>
          <div class="comparison-heading comparison-heading--ranky">
            <?php if ($comparison_new_heading): ?>
              <h3 class="comparison-heading__text">
                <?php echo esc_html($comparison_new_heading); ?>
              </h3>
            <?php endif; ?>
          </div>
        </div>

        <!-- Comparison Items -->
        <?php foreach ($comparisons as $comparison): ?>
          <div class="comparison-row">
            <!-- Old Way -->
            <div class="comparison-col comparison-col--old">
              <?php if (!empty($comparison['old_icon'])): ?>
                <img
                  src="<?php echo esc_url($comparison['old_icon']['url']); ?>"
                  alt="<?php echo esc_attr($comparison['old_icon']['alt'] ?? ''); ?>"
                  class="comparison-icon"
                >
              <?php endif; ?>
              <?php if (!empty($comparison['old_text'])): ?>
                <p class="comparison-text">
                  <?php echo esc_html($comparison['old_text']); ?>
                </p>
              <?php endif; ?>
            </div>

            <!-- Ranky Way -->
            <div class="comparison-col comparison-col--ranky">
              <?php if (!empty($comparison['new_icon'])): ?>
                <img
                  src="<?php echo esc_url($comparison['new_icon']['url']); ?>"
                  alt="<?php echo esc_attr($comparison['new_icon']['alt'] ?? ''); ?>"
                  class="comparison-icon"
                >
              <?php endif; ?>
              <?php if (!empty($comparison['new_text'])): ?>
                <p class="comparison-text">
                  <?php echo esc_html($comparison['new_text']); ?>
                </p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Statement -->
    <?php if ($statement): ?>
      <p class="why-ranky__statement">
        <?php echo esc_html($statement); ?>
      </p>
    <?php endif; ?>

    <!-- Core Differentiators -->
    <?php if ($differentiators && is_array($differentiators)): ?>
      <h2 class="why-ranky__differentiators-heading">
        <?php echo esc_html($differentiators_heading); ?>
      </h2>
      <div class="why-ranky__differentiators">
        <?php foreach ($differentiators as $differentiator): ?>
          <div class="differentiator-item">
            <?php if (!empty($differentiator['title'])): ?>
              <h3 class="differentiator-title">
                <?php echo esc_html($differentiator['title']); ?>
              </h3>
            <?php endif; ?>
            <?php if (!empty($differentiator['description'])): ?>
              <p class="differentiator-description">
                <?php echo esc_html($differentiator['description']); ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- CTA Buttons -->
    <?php if ($primary_button || $secondary_button): ?>
      <div class="why-ranky__cta">
        <?php if ($primary_button): ?>
          <a
            href="<?php echo esc_url($primary_button['url'] ?? '#'); ?>"
            class="btn btn--primary"
            <?php if (!empty($primary_button['target'])): ?>
              target="<?php echo esc_attr($primary_button['target']); ?>"
            <?php endif; ?>
          >
            <?php echo esc_html($primary_button['title'] ?? 'Click Here'); ?>
          </a>
        <?php endif; ?>

        <?php if ($secondary_button): ?>
          <a
            href="<?php echo esc_url($secondary_button['url'] ?? '#'); ?>"
            class="btn btn--ghost"
            <?php if (!empty($secondary_button['target'])): ?>
              target="<?php echo esc_attr($secondary_button['target']); ?>"
            <?php endif; ?>
          >
            <?php echo esc_html($secondary_button['title'] ?? 'Click Here'); ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Illustration -->
    <?php if ($illustration): ?>
      <div class="why-ranky__illustration">
        <img
          src="<?php echo esc_url($illustration['url']); ?>"
          alt="<?php echo esc_attr($illustration['alt'] ?? ''); ?>"
          class="why-ranky-illustration"
        >
      </div>
    <?php endif; ?>

  </div>
</section>
