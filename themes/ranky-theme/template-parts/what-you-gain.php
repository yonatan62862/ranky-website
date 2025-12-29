<?php
/**
 * What You Gain Section (Home only)
 */

if (!is_front_page()) {
    return;
}

// Get header fields
$eyebrow = get_field('what_you_gain_eyebrow');
$subtext = get_field('what_you_gain_subtext');
$title = get_field('what_you_gain_title');
$primary_button = get_field('what_you_gain_primary_button');
$secondary_button = get_field('what_you_gain_secondary_button');

// Get items repeater
$items = get_field('what_you_gain_items');

// If no content, don't render
if (!$items || !is_array($items)) {
    return;
}
?>

<section class="what-you-gain">
  <div class="container">

    <?php if ($eyebrow) : ?>
      <p class="what-you-gain__eyebrow">
        <?= esc_html($eyebrow); ?>
      </p>
    <?php endif; ?>

    <?php if ($subtext) : ?>
      <p class="what-you-gain__subtext">
        <?= esc_html($subtext); ?>
      </p>
    <?php endif; ?>

    <?php if ($title) : ?>
      <h2 class="what-you-gain__title">
        <?= esc_html($title); ?>
      </h2>
    <?php endif; ?>

    <div class="what-you-gain__grid">
      <?php foreach ($items as $item) : ?>
        <div class="gain-card">
          <?php if (!empty($item['icon'])) : ?>
            <img 
              src="<?= esc_url($item['icon']['url']); ?>" 
              alt="<?= esc_attr($item['icon']['alt'] ?? ''); ?>"
              class="gain-card__icon"
            >
          <?php endif; ?>

          <?php if (!empty($item['title'])) : ?>
            <div class="gain-card__title"><?= esc_html($item['title']); ?></div>
          <?php endif; ?>

          <?php if (!empty($item['description'])) : ?>
            <p class="gain-card__description"><?= esc_html($item['description']); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if ($primary_button || $secondary_button) : ?>
      <div class="what-you-gain__actions">
        <?php if ($primary_button) : ?>
          <a
            href="<?= esc_url($primary_button['url'] ?? '#'); ?>"
            <?php if (!empty($primary_button['target'])) : ?>
              target="<?= esc_attr($primary_button['target']); ?>"
            <?php endif; ?>
            class="btn btn--primary">
            <?= esc_html($primary_button['title'] ?? 'Click Here'); ?>
          </a>
        <?php endif; ?>

        <?php if ($secondary_button) : ?>
          <a
            href="<?= esc_url($secondary_button['url'] ?? '#'); ?>"
            <?php if (!empty($secondary_button['target'])) : ?>
              target="<?= esc_attr($secondary_button['target']); ?>"
            <?php endif; ?>
            class="btn btn--secondary">
            <?= esc_html($secondary_button['title'] ?? 'Click Here'); ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</section>


