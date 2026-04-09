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

            <?php
            $is_b2c = false;
            $is_ecommerce = false;
            $is_medical = false;
            $is_startup = false;
            $is_tech_industry = false;
            $is_b2b_industry = false;
            if (is_singular('industry')) {
                $slug = get_post_field('post_name', get_the_ID());
                $title = get_the_title();
                $slug_lower = strtolower($slug);
                $title_lower = strtolower($title);
                $is_b2c = ($slug_lower === 'b2c' || stripos($title, 'B2C') !== false);
                $is_ecommerce = (
                    $slug_lower === 'e-commerce' || $slug_lower === 'ecommerce' ||
                    stripos($title, 'e-commerce') !== false || stripos($title, 'ecommerce') !== false
                );
                $is_medical = ($slug_lower === 'medical' || stripos($title, 'Medical') !== false);
                $is_startup = (
                    $slug_lower === 'startup' || $slug_lower === 'start-up' ||
                    stripos($title, 'Startup') !== false || stripos($title, 'Start-up') !== false
                );
                $is_tech_industry = ($slug_lower === 'tech-industry-page');
                $is_b2b_industry = ($slug_lower === 'b2b-industry-page');
            }
            if ($is_b2c): ?>
                <div class="industry-hero__visual">
                    <video class="industry-hero__video" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/B2C.mp4'); ?>" autoplay muted loop playsinline></video>
                </div>
            <?php elseif ($is_ecommerce): ?>
                <div class="industry-hero__visual">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/gifs/e-commerce.gif'); ?>" alt="E-commerce" class="industry-hero__gif">
                </div>
            <?php elseif ($is_medical): ?>
                <div class="industry-hero__visual">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/gifs/Medical.gif'); ?>" alt="Medical" class="industry-hero__gif">
                </div>
            <?php elseif ($is_startup): ?>
                <div class="industry-hero__visual">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/gifs/' . rawurlencode('Startup 1.gif')); ?>" alt="Startup" class="industry-hero__gif">
                </div>
            <?php elseif ($is_tech_industry || $is_b2b_industry): ?>
                <div class="industry-hero__visual">
                    <div id="hero-lottie" class="industry-hero__lottie" aria-hidden="true"></div>
                </div>
            <?php elseif ($hero_image): ?>
                <div class="industry-hero__visual">
                    <?php echo wp_get_attachment_image($hero_image['ID'], 'large', false, ['alt' => esc_attr($hero_image['alt'] ?? '')]); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

