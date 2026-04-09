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

            <?php
            $is_social_media = false;
            $is_paid_ads = false;
            $is_seo_geo = false;
            $is_external_cmo = false;
            $is_orm = false;
            $is_content_marketing = false;
            if (is_singular('service')) {
                $slug = get_post_field('post_name', get_the_ID());
                $post_title = get_the_title();
                $slug_lower = strtolower($slug);
                $is_social_media = (
                    $slug_lower === 'social-media' || $slug_lower === 'socialmedia' ||
                    stripos($post_title, 'Social Media') !== false
                );
                $is_paid_ads = (
                    $slug_lower === 'paid-ads' || $slug_lower === 'paidads' ||
                    stripos($post_title, 'Paid Ads') !== false
                );
                $is_seo_geo = ($slug_lower === 'seo-geo');
                $is_external_cmo = ($slug_lower === 'external-cmo');
                $is_orm = ($slug_lower === 'orm');
                $is_content_marketing = ($slug_lower === 'content-marketing');
            }
            if ($is_social_media) : ?>
                <div class="hero__visual">
                    <img 
                        src="<?= esc_url(get_template_directory_uri() . '/assets/gifs/Social.gif'); ?>" 
                        alt="Social Media"
                        class="hero__gif"
                    >
                </div>
            <?php elseif ($is_paid_ads) : ?>
                <div class="hero__visual">
                    <div id="hero-lottie" class="hero__lottie" aria-hidden="true"></div>
                </div>
            <?php elseif ($is_seo_geo || $is_external_cmo || $is_orm || $is_content_marketing) : ?>
                <div class="hero__visual">
                    <div id="hero-lottie" class="hero__lottie" aria-hidden="true"></div>
                </div>
            <?php elseif ($hero_image) : ?>
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

