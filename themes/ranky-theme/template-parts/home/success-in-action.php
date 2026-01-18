<?php
/**
 * Home Success in Action Section
 */

$title_light = get_field('success_section_title_light');
$title_bold = get_field('success_section_title_bold');
$items = get_field('success_items');

if (!$items || !is_array($items)) return;
?>

<section class="success">
  <div class="container">

    <?php if ($title_light || $title_bold): ?>
      <h2 class="success__title">
        <?php 
          if ($title_light) {
            echo '<span class="success__title-light">' . esc_html($title_light) . '</span>';
            if ($title_bold) {
              echo ' ';
            }
          }
          if ($title_bold) {
            echo '<span class="success__title-bold">' . esc_html($title_bold) . '</span>';
          }
        ?>
      </h2>
    <?php endif; ?>

    <div class="success__carousel">
    <div class="success__track">        

      <?php foreach ($items as $item): ?>
        <article class="success-card">

          <?php if (!empty($item['image'])): ?>
            <div class="success-card__image">
              <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
            </div>
          <?php endif; ?>

          <?php if (!empty($item['quote'])): ?>
            <div class="success-card__quote">
              <?php echo esc_html($item['quote']); ?>
            </div>
          <?php endif; ?>

          <div class="success-card__author">
            <strong><?php echo esc_html($item['name']); ?></strong>
            <span><?php echo esc_html($item['role']); ?></span>
          </div>

          <div class="success-card__divider"></div>

          <div class="success-card__kpi">
            <span class="success-card__kpi-value">
              <?php echo esc_html($item['kpi_value']); ?>
            </span>
            <span class="success-card__kpi-label">
              <?php echo esc_html($item['kpi_label']); ?>
            </span>
            <span class="success-card__industry">
              <?php echo esc_html($item['industry']); ?>
            </span>
          </div>

        </article>
      <?php endforeach; ?>

    </div>
  </div>
</section>

