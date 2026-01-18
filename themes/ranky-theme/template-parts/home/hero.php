<?php
/**
 * Home Hero Section
 */

// Get ACF fields
$visual_type = get_field('hero_visual_type');
$hero_image = get_field('hero_image');
$title_line1 = get_field('hero_title_line1_cyan');
$title_line2 = get_field('hero_title_line2_cyan');
$title_line3 = get_field('hero_title_line3_white');
$title_line4 = get_field('hero_title_line4_white');
$description = get_field('hero_description');
$primary_button_text = get_field('hero_primary_button_text');
$primary_button_link = get_field('hero_primary_button_link');
$secondary_button_text = get_field('hero_secondary_button_text');
$secondary_button_link = get_field('hero_secondary_button_link');

// If no content, don't render
if (!$title_line1 && !$title_line2 && !$title_line3 && !$title_line4) {
    return;
}
?>

<section class="hero">
    <div class="container">
        <div class="hero__content">
            <div class="hero__text">
                <?php if ($title_line1 || $title_line2 || $title_line3 || $title_line4) : ?>
                    <h1 class="hero__title">
                        <?php if ($title_line1) : ?>
                            <span class="hero__title-cyan"><?= esc_html($title_line1); ?></span>
                        <?php endif; ?>
                        <?php if ($title_line2) : ?>
                            <span class="hero__title-cyan"><?= esc_html($title_line2); ?></span>
                        <?php endif; ?>
                        <?php if ($title_line3) : ?>
                            <span class="hero__title-white"><?= esc_html($title_line3); ?></span>
                        <?php endif; ?>
                        <?php if ($title_line4) : ?>
                            <span class="hero__title-white"><?= esc_html($title_line4); ?></span>
                        <?php endif; ?>
                    </h1>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="hero__description">
                        <?= esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <?php if ($primary_button_text || $secondary_button_text) : ?>
                    <div class="hero__actions">
                        <?php if ($primary_button_text && $primary_button_link) : ?>
                            <a href="<?= esc_url($primary_button_link); ?>" class="btn btn--primary">
                                <?= esc_html($primary_button_text); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($secondary_button_text && $secondary_button_link) : ?>
                            <a href="<?= esc_url($secondary_button_link); ?>" class="btn btn--secondary">
                                <?= esc_html($secondary_button_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hero__visual">
                <?php if ($visual_type === 'image' && $hero_image) : ?>
                    <img 
                        src="<?= esc_url($hero_image['url']); ?>" 
                        alt="<?= esc_attr($hero_image['alt'] ?? ''); ?>"
                    >
                <?php else : ?>
                    <video 
                        autoplay 
                        loop 
                        muted 
                        playsinline
                        class="hero__video"
                    >
                        <source src="<?= esc_url(get_template_directory_uri() . '/assets/video/hero-animation.mp4'); ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

