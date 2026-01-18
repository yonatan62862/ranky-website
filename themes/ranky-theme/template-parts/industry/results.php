<?php
$results_title = get_field('results_title');
$results_subtitle = get_field('results_subtitle');
$results_items = get_field('results_items');

if (!$results_title && !$results_subtitle && (!$results_items || !is_array($results_items) || empty($results_items))) {
    return;
}
?>

<section class="industry-results">
    <div class="container">
        <?php if ($results_title): ?>
            <h2 class="industry-results__title">
                <?php 
                $title = esc_html($results_title);
                // Highlight "Results" if it appears in the title
                if (preg_match('/^(Real)\s+(Results)$/i', $title, $matches)) {
                    echo '<span class="industry-results__title-part industry-results__title-part--light">' . esc_html($matches[1]) . '</span> ';
                    echo '<span class="industry-results__title-part industry-results__title-part--highlight">' . esc_html($matches[2]) . '</span>';
                } else {
                    echo $title;
                }
                ?>
            </h2>
        <?php endif; ?>

        <?php if ($results_subtitle): ?>
            <p class="industry-results__subtitle"><?php echo esc_html($results_subtitle); ?></p>
        <?php endif; ?>

        <?php if ($results_items && is_array($results_items) && !empty($results_items)): ?>
            <div class="industry-results__grid">
                <?php foreach ($results_items as $item): ?>
                    <div class="industry-result-card">
                        <?php if (!empty($item['result_value'])): ?>
                            <div class="industry-result-card__value">
                                <?php echo esc_html($item['result_value']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['result_description'])): ?>
                            <div class="industry-result-card__description">
                                <?php echo esc_html($item['result_description']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

