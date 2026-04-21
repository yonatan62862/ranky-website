<?php
/**
 * Home Why Ranky Section
 */

// Get header group
$header = get_field('why_ranky_header');
$header_title_light = $header['title_light'] ?? '';
$header_title_bold = $header['title_bold'] ?? '';
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
$differentiators_heading_light = get_field('core_differentiators_heading_light');
$differentiators_heading_bold = get_field('core_differentiators_heading_bold');

// Get core differentiators repeater
$differentiators = get_field('core_differentiators');

// Get CTA buttons group
$cta_buttons = get_field('cta_buttons');
$primary_button = $cta_buttons['primary_button'] ?? null;
$secondary_button = $cta_buttons['secondary_button'] ?? null;

// Get illustration
$illustration = get_field('illustration');

// If no content, don't render
if (!$header_title_light && !$header_title_bold && !$comparisons && !$statement && !$differentiators) {
    return;
}
?>

<section class="why-ranky">
  <div class="container">

    <!-- Header -->
    <?php if ($header_title_light || $header_title_bold || $header_subtitle || $header_description): ?>
      <header class="why-ranky__header">
        <?php if ($header_title_light || $header_title_bold): ?>
          <h2 class="why-ranky__title">
            <?php 
              if ($header_title_light) {
                echo '<span class="why-ranky__title-light">' . esc_html($header_title_light) . '</span>';
                if ($header_title_bold) {
                  echo ' ';
                }
              }
              if ($header_title_bold) {
                echo '<span class="why-ranky__title-bold">' . esc_html($header_title_bold) . '</span>';
              }
            ?>
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
        <!-- Old Way Column -->
        <div class="comparison-column comparison-column--old">
          <?php if ($comparison_old_heading): ?>
            <h3 class="comparison-heading comparison-heading--old">
              <?php echo esc_html($comparison_old_heading); ?>
            </h3>
          <?php endif; ?>

          <?php foreach ($comparisons as $comparison): ?>
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
          <?php endforeach; ?>
        </div>

        <!-- Ranky Way Column -->
        <div class="comparison-column comparison-column--ranky">
          <?php if ($comparison_new_heading): ?>
            <h3 class="comparison-heading comparison-heading--ranky">
              <?php echo esc_html($comparison_new_heading); ?>
            </h3>
          <?php endif; ?>

          <?php foreach ($comparisons as $comparison): ?>
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
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- Statement -->
    <?php if ($statement): ?>
      <p class="why-ranky__statement">
        <?php echo esc_html($statement); ?>
      </p>
    <?php endif; ?>

    <!-- Core Differentiators + Illustration -->
    <?php if (($differentiators && is_array($differentiators)) || $illustration): ?>
      <div class="why-ranky__bottom">

        <!-- Text Side -->
        <?php if ($differentiators && is_array($differentiators)): ?>
          <div class="why-ranky__bottom-text">
            <?php if ($differentiators_heading_light || $differentiators_heading_bold): ?>
            <h2 class="why-ranky__differentiators-heading">
                <?php 
                  if ($differentiators_heading_light) {
                    echo '<span class="why-ranky__differentiators-heading-light">' . esc_html($differentiators_heading_light) . '</span>';
                    if ($differentiators_heading_bold) {
                      echo ' ';
                    }
                  }
                  if ($differentiators_heading_bold) {
                    echo '<span class="why-ranky__differentiators-heading-bold">' . esc_html($differentiators_heading_bold) . '</span>';
                  }
                ?>
            </h2>
            <?php endif; ?>
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
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <!-- Illustration Side -->
        <?php if ($illustration): ?>
          <div class="why-ranky__illustration">
            <img
              src="<?php echo esc_url($illustration['url']); ?>"
              alt="<?php echo esc_attr($illustration['alt'] ?? 'Why Ranky'); ?>"
              class="why-ranky__illustration-img"
            >
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <!-- CTA Buttons (fallback when no differentiators) -->
    <?php if ((!$differentiators || !is_array($differentiators)) && ($primary_button || $secondary_button)): ?>
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
      </div>
    <?php endif; ?>

  </div>
</section>
