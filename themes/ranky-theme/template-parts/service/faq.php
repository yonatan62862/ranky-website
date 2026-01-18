<?php
/**
 * Service FAQ Section
 */

$faq_title_light = get_field('faq_title_light');
$faq_title_bold = get_field('faq_title_bold');
$faq_items = get_field('faq_items');

if (!$faq_items || !is_array($faq_items)) {
    return;
}
?>

<section class="faq">
  <div class="container">

    <?php if ($faq_title_light || $faq_title_bold): ?>
      <h2 class="faq__title">
        <?php 
          if ($faq_title_light) {
            echo '<span class="faq__title-light">' . esc_html($faq_title_light) . '</span>';
            if ($faq_title_bold) {
              echo ' ';
            }
          }
          if ($faq_title_bold) {
            echo '<span class="faq__title-bold">' . esc_html($faq_title_bold) . '</span>';
          }
        ?>
      </h2>
    <?php endif; ?>

    <?php foreach ($faq_items as $item): ?>
      <div class="faq__item">

        <button class="faq__question" type="button">
          <?php echo esc_html($item['question']); ?>
          <span class="faq__icon">+</span>
        </button>

        <div class="faq__answer">
          <?php echo wp_kses_post($item['answer']); ?>
        </div>

      </div>
    <?php endforeach; ?>

  </div>
</section>

