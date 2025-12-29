<?php
/**
 * FAQ Section (Reusable)
 */

$faq_title = get_field('faq_title');
$faq_items = get_field('faq_items');

if (!$faq_items || !is_array($faq_items)) {
    return;
}
?>

<section class="faq">
  <div class="container">

    <?php if ($faq_title): ?>
      <h2 class="faq__title">
        <?php 
          $title = esc_html($faq_title);
          if (stripos($faq_title, 'ASKED QUESTIONS') !== false) {
            $parts = explode('ASKED QUESTIONS', $faq_title, 2);
            echo '<span class="faq__title-light">' . esc_html(trim($parts[0])) . '</span>';
            echo '<span class="faq__title-bold"> ASKED QUESTIONS' . esc_html($parts[1] ?? '') . '</span>';
          } else {
            echo $title;
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

