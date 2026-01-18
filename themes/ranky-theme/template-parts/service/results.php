<?php
/**
 * Service Results Section
 */

// Early return if section is disabled
$results_enabled = get_field('results_enabled');
if (!$results_enabled) {
    return;
}

// Get ACF fields
$results_eyebrow = get_field('results_eyebrow');
$results_title_light = get_field('results_title_light');
$results_title_bold = get_field('results_title_bold');
$results_subtitle = get_field('results_subtitle');
$results_items = get_field('results_items');

// Early return if no items exist
if (!$results_items || !is_array($results_items) || empty($results_items)) {
    return;
}
?>

<section class="results">
    <div class="container">

        <?php if ($results_eyebrow || $results_title_light || $results_title_bold || $results_subtitle): ?>
        <header class="results__header">
            <?php if ($results_eyebrow): ?>
                <span class="results__eyebrow"><?php echo esc_html($results_eyebrow); ?></span>
            <?php endif; ?>

            <?php if ($results_title_light || $results_title_bold): ?>
                <h2 class="results__title">
                  <?php 
                    if ($results_title_light) {
                      echo '<span class="results__title-light">' . esc_html($results_title_light) . '</span>';
                      if ($results_title_bold) {
                        echo ' ';
                      }
                    }
                    if ($results_title_bold) {
                      echo '<span class="results__title-bold">' . esc_html($results_title_bold) . '</span>';
                    }
                  ?>
                </h2>
            <?php endif; ?>

            <?php if ($results_subtitle): ?>
                <p class="results__subtitle"><?php echo esc_html($results_subtitle); ?></p>
            <?php endif; ?>
        </header>
        <?php endif; ?>

        <div class="results__grid">
            <?php foreach ($results_items as $item): ?>
                <article class="results-card">
                    <?php if (!empty($item['result_value'])): ?>
                        <div class="results-card__value"><?php echo esc_html($item['result_value']); ?></div>
                    <?php endif; ?>

                    <div class="results-card__content">
                        <?php if (!empty($item['result_title'])): ?>
                            <h3 class="results-card__title"><?php echo esc_html($item['result_title']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($item['result_description'])): ?>
                            <p class="results-card__description"><?php echo esc_html($item['result_description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($item['result_tag'])): ?>
                            <span class="results-card__tag"><?php echo esc_html($item['result_tag']); ?></span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

