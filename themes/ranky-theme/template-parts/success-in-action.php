<?php
if (!is_front_page()) return;

$title = get_field('success_section_title');
$items = get_field('success_items');

if (!$items || !is_array($items)) return;
?>

<section class="success">
  <div class="container">

    <?php if ($title): ?>
      <h2 class="success__title">
        <?php echo esc_html($title); ?>
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
