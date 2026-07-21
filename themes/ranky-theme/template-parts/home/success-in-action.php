<?php
/**
 * Home Success in Action Section
 */

$title_light = get_field('success_section_title_light');
$title_bold   = get_field('success_section_title_bold');
$items        = get_field('success_items');

if (!$items || !is_array($items)) return;
?>

<section id="success" class="success">

    <?php if ($title_light || $title_bold): ?>
      <div class="container">
        <h2 class="success__title">
          <?php if ($title_light): ?>
            <span class="success__title-light"><?php echo esc_html($title_light); ?></span>
            <?php if ($title_bold): ?> <?php endif; ?>
          <?php endif; ?>
          <?php if ($title_bold): ?>
            <span class="success__title-bold"><?php echo esc_html($title_bold); ?></span>
          <?php endif; ?>
        </h2>
      </div>
    <?php endif; ?>

    <div class="success__carousel">
      <div class="success__track">

        <?php foreach ($items as $item): ?>
          <article class="success-card">

            <div class="success-card__body">

              <?php if (!empty($item['image'])): ?>
                <div class="success-card__avatar">
                  <img
                    src="<?php echo esc_url($item['image']['url']); ?>"
                    alt="<?php echo esc_attr($item['image']['alt'] ?? $item['name'] ?? ''); ?>"
                  >
                </div>
              <?php endif; ?>

              <div class="success-card__body-right">
                <?php if (!empty($item['quote'])): ?>
                  <div class="success-card__quote">
                    <?php echo esc_html($item['quote']); ?>
                  </div>
                <?php endif; ?>
                <div class="success-card__author-info">
                  <?php if (!empty($item['name'])): ?>
                    <strong><?php echo esc_html($item['name']); ?></strong>
                  <?php endif; ?>
                  <?php if (!empty($item['role'])): ?>
                    <span><?php echo esc_html($item['role']); ?></span>
                  <?php endif; ?>
                </div>
              </div>

            </div>

            <div class="success-card__divider"></div>

            <div class="success-card__kpi">
              <?php if (!empty($item['kpi_value'])): ?>
                <span class="success-card__kpi-value"><?php echo esc_html($item['kpi_value']); ?></span>
              <?php endif; ?>
              <?php if (!empty($item['kpi_label'])): ?>
                <span class="success-card__kpi-label"><?php echo esc_html($item['kpi_label']); ?></span>
              <?php endif; ?>
              <?php if (!empty($item['industry'])): ?>
                <span class="success-card__industry"><?php echo esc_html($item['industry']); ?></span>
              <?php endif; ?>
            </div>

          </article>
        <?php endforeach; ?>

      </div>
    </div>

</section>
