<?php
$faq_title_light = get_field('faq_title_light');
$faq_title_bold = get_field('faq_title_bold');
$faq_items = get_field('faq_items');

if (!$faq_items || !is_array($faq_items)) {
    return;
}
?>

<section class="industry-faq">
    <div class="container">
        <?php if ($faq_title_light || $faq_title_bold): ?>
            <h2 class="industry-faq__title">
                <?php 
                    if ($faq_title_light) {
                        echo '<span class="industry-faq__title-light">' . esc_html($faq_title_light) . '</span>';
                        if ($faq_title_bold) {
                            echo ' ';
                        }
                    }
                    if ($faq_title_bold) {
                        echo '<span class="industry-faq__title-bold">' . esc_html($faq_title_bold) . '</span>';
                    }
                ?>
            </h2>
        <?php endif; ?>

        <?php foreach ($faq_items as $item): ?>
            <div class="industry-faq__item">
                <button class="industry-faq__question" type="button">
                    <?php echo esc_html($item['question']); ?>
                    <span class="industry-faq__icon">+</span>
                </button>

                <div class="industry-faq__answer">
                    <?php echo wp_kses_post($item['answer']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

