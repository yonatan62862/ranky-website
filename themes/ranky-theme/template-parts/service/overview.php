<?php
$eyebrow = get_field('why_different_eyebrow');
$title = get_field('why_different_title');
$subtitle = get_field('why_different_subtitle');
$old_items = get_field('old_way_items');
$ranky_items = get_field('ranky_way_items');
?>

<section class="why-different">
  <div class="container">

    <header class="why-different__header">
      <?php if ($eyebrow): ?>
        <p class="why-different__eyebrow"><?php echo esc_html($eyebrow); ?></p>
      <?php endif; ?>

      <?php if ($title): ?>
        <h2 class="why-different__title">
          <?php 
            $title_text = $title;
            if (stripos($title_text, 'Content Marketing') !== false) {
              $parts = preg_split('/(Content Marketing)/i', $title_text, 2, PREG_SPLIT_DELIM_CAPTURE);
              if (count($parts) >= 2) {
                echo esc_html(trim($parts[0])) . ' <span>' . esc_html($parts[1] . ($parts[2] ?? '')) . '</span> ' . esc_html($parts[3] ?? '');
              } else {
                echo esc_html($title_text);
              }
            } else {
              echo esc_html($title_text);
            }
          ?>
        </h2>
      <?php endif; ?>

      <?php if ($subtitle): ?>
        <p class="why-different__subtitle"><?php echo esc_html($subtitle); ?></p>
      <?php endif; ?>
    </header>

    <div class="why-different__comparison">

      <!-- LEFT COLUMN -->
      <div class="comparison-column comparison-column--old">
        <h3 class="comparison-column__title">Old Way</h3>

        <?php if ($old_items && is_array($old_items)): ?>
          <?php foreach ($old_items as $item): ?>
            <div class="comparison-row comparison-row--old">
              <?php if (!empty($item['icon'])): ?>
                <img 
                  src="<?php echo esc_url($item['icon']['url']); ?>" 
                  alt="<?php echo esc_attr($item['icon']['alt'] ?? ''); ?>"
                  class="comparison-row__icon"
                >
              <?php endif; ?>
              <?php if (!empty($item['text'])): ?>
                <span class="comparison-row__text"><?php echo esc_html($item['text']); ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="comparison-column comparison-column--ranky">
        <h3 class="comparison-column__title">Ranky Way</h3>

        <?php if ($ranky_items && is_array($ranky_items)): ?>
          <?php foreach ($ranky_items as $item): ?>
            <div class="comparison-card">
              <?php if (!empty($item['icon'])): ?>
                <img 
                  src="<?php echo esc_url($item['icon']['url']); ?>" 
                  alt="<?php echo esc_attr($item['icon']['alt'] ?? ''); ?>"
                  class="comparison-card__icon"
                >
              <?php endif; ?>
              <?php if (!empty($item['text'])): ?>
                <span class="comparison-card__text"><?php echo esc_html($item['text']); ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
