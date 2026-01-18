<?php
/**
 * Service Hero Section
 */

// Get ACF fields
$eyebrow = get_field('service_hero_eyebrow');
$title = get_field('service_hero_title');
$text = get_field('service_hero_text');
$primary_button = get_field('service_hero_primary_button');
$secondary_button = get_field('service_hero_secondary_button');
$hero_image = get_field('service_hero_image');

// If no title, don't render
if (!$title) {
    return;
}
?>

<section class="hero">
    <div class="container">
        <div class="hero__content">
            <div class="hero__text">
                <?php if ($eyebrow) : ?>
                    <p class="hero__eyebrow">
                        <?= esc_html($eyebrow); ?>
                    </p>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h1 class="hero__title">
                        <?= esc_html($title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <p class="hero__description">
                        <?= esc_html($text); ?>
                    </p>
                <?php endif; ?>

                <?php if ($primary_button || $secondary_button) : ?>
                    <div class="hero__actions">
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

            <?php if ($hero_image) : ?>
                <div class="hero__visual">
                    <img 
                        src="<?= esc_url($hero_image['url']); ?>" 
                        alt="<?= esc_attr($hero_image['alt'] ?? ''); ?>"
                    >
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

