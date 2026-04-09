<?php
/**
 * Enterprise CTA Section
 * On blog: uses industry-approach design. Elsewhere: uses default enterprise-cta layout.
 *
 * How to add the image:
 * - Single blog post: Edit the post → "Enterprise CTA" tab → "CTA Image" → upload/select image.
 * - Blog archive (/blog/): Theme Settings → "Blog Archive – Enterprise CTA" tab → "CTA Image" → upload/select image.
 */

$is_blog = is_singular('blog') || is_post_type_archive('blog');
if (is_singular('blog') && get_field('blog_enterprise_cta_enabled') === false) {
    return;
}

if (is_singular('blog')) {
    $cta_title  = get_field('blog_enterprise_cta_title');
    $cta_text   = get_field('blog_enterprise_cta_text');
    $cta_button = get_field('blog_enterprise_cta_button');
    $cta_image  = get_field('blog_enterprise_cta_image');
} else {
    $cta_title  = get_field('blog_archive_enterprise_cta_title', 'option');
    $cta_text   = get_field('blog_archive_enterprise_cta_text', 'option');
    $cta_button = get_field('blog_archive_enterprise_cta_button', 'option');
    $cta_image  = get_field('blog_archive_enterprise_cta_image', 'option');
}

$cta_title   = $cta_title ?: "Ranky's Enterprise Approach";
$cta_text    = $cta_text ?: "Scale your growth with strategies built for enterprise. From SEO to content and paid media, we align every channel with your business goals.";
$cta_button_url  = ($cta_button && !empty($cta_button['url'])) ? $cta_button['url'] : home_url('/contact');
$cta_button_text = ($cta_button && !empty($cta_button['title'])) ? $cta_button['title'] : 'Learn More';
$cta_eyebrow = 'OUR APPROACH';
?>

<?php if ($is_blog) : ?>
<section class="industry-approach industry-approach--blog">
    <div class="container">
        <p class="industry-approach__eyebrow"><?php echo esc_html($cta_eyebrow); ?></p>
        <h2 class="industry-approach__title">
            <?php
            $title = $cta_title;
            $title = preg_replace('/\b(Enterprise|Approach)\b/i', '<span class="industry-approach__title-highlight">$1</span>', esc_html($title));
            echo $title;
            ?>
        </h2>
        <div class="industry-approach__content">
            <div class="industry-approach__text">
                <p><?php echo esc_html($cta_text); ?></p>
            </div>
            <div class="industry-approach__visual">
                <?php if ($cta_image && !empty($cta_image['url'])) : ?>
                    <img src="<?php echo esc_url($cta_image['url']); ?>" alt="<?php echo esc_attr(!empty($cta_image['alt']) ? $cta_image['alt'] : $cta_title); ?>">
                <?php else : ?>
                    <div class="industry-approach__placeholder" aria-hidden="true"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php else : ?>
<section class="enterprise-cta">
    <div class="container enterprise-cta__inner">
        <div class="enterprise-cta__content">
            <h2 class="enterprise-cta__title"><?php echo esc_html($cta_title); ?></h2>
            <p class="enterprise-cta__text"><?php echo esc_html($cta_text); ?></p>
            <a href="<?php echo esc_url($cta_button_url); ?>" class="btn btn--primary enterprise-cta__button"><?php echo esc_html($cta_button_text); ?></a>
        </div>
        <div class="enterprise-cta__visual">
            <?php if ($cta_image && !empty($cta_image['url'])) : ?>
                <img src="<?php echo esc_url($cta_image['url']); ?>" alt="<?php echo esc_attr($cta_image['alt'] ?: $cta_title); ?>" class="enterprise-cta__image">
            <?php else : ?>
                <div class="enterprise-cta__image-placeholder" aria-hidden="true"></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
