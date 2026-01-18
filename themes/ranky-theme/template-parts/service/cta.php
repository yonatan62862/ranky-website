<?php
/**
 * Service CTA Section
 */

$cta_title = get_field('service_cta_title');
$cta_text = get_field('service_cta_text');
$cta_button = get_field('service_cta_button');

if (!$cta_title && !$cta_text && !$cta_button) {
    return;
}
?>

<section class="service-cta">
    <div class="container">

        <?php if ($cta_title): ?>
            <h2 class="service-cta__title"><?php echo esc_html($cta_title); ?></h2>
        <?php endif; ?>

        <?php if ($cta_text): ?>
            <p class="service-cta__text"><?php echo esc_html($cta_text); ?></p>
        <?php endif; ?>

        <?php if ($cta_button): ?>
            <a href="<?php echo esc_url($cta_button['url'] ?? '#'); ?>" class="btn btn--primary">
                <?php echo esc_html($cta_button['title'] ?? 'Click Here'); ?>
            </a>
        <?php endif; ?>

    </div>
</section>

