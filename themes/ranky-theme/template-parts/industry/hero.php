<?php
$hero_title_prefix = get_field('hero_title_prefix');
$hero_title_main = get_field('hero_title_main');
$hero_subtitle = get_field('hero_subtitle');
$hero_primary_cta = get_field('hero_primary_cta');
$hero_secondary_cta = get_field('hero_secondary_cta');
$hero_image = get_field('hero_image');

if (!$hero_title_prefix && !$hero_title_main && !$hero_subtitle && !$hero_primary_cta && !$hero_secondary_cta && !$hero_image) {
    return;
}
?>

<section class="industry-hero">
    <div class="container">
        <div class="industry-hero__content">
            <div class="industry-hero__text">
                <?php if ($hero_title_prefix || $hero_title_main): ?>
                    <h1 class="industry-hero__title">
                        <?php if ($hero_title_prefix): ?>
                            <span class="industry-hero__title-prefix"><?php echo esc_html($hero_title_prefix); ?></span>
                        <?php endif; ?>
                        <?php if ($hero_title_main): ?>
                            <span class="industry-hero__title-main"><?php echo nl2br(esc_html($hero_title_main)); ?></span>
                        <?php endif; ?>
                    </h1>
                <?php endif; ?>

                <?php if ($hero_subtitle): ?>
                    <p class="industry-hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>

                <?php if ($hero_primary_cta || $hero_secondary_cta): ?>
                    <div class="industry-hero__actions">
                        <?php if ($hero_primary_cta && !empty($hero_primary_cta['url'])): ?>
                            <a
                                href="<?php echo esc_url($hero_primary_cta['url']); ?>"
                                <?php if (!empty($hero_primary_cta['target'])): ?>
                                    target="<?php echo esc_attr($hero_primary_cta['target']); ?>"
                                <?php endif; ?>
                                class="btn btn--primary">
                                <?php echo esc_html($hero_primary_cta['title'] ?? 'Click Here'); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($hero_secondary_cta && !empty($hero_secondary_cta['url'])): ?>
                            <a
                                href="<?php echo esc_url($hero_secondary_cta['url']); ?>"
                                <?php if (!empty($hero_secondary_cta['target'])): ?>
                                    target="<?php echo esc_attr($hero_secondary_cta['target']); ?>"
                                <?php endif; ?>
                                class="btn btn--secondary">
                                <?php echo esc_html($hero_secondary_cta['title'] ?? 'Click Here'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($hero_image): ?>
                <div class="industry-hero__visual">
                    <?php echo wp_get_attachment_image($hero_image['ID'], 'large', false, ['alt' => esc_attr($hero_image['alt'] ?? '')]); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

