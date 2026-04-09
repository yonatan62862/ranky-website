<?php
/**
 * Blog Card Template Part
 * Used in archive and related posts. Expects global $post or passed post in scope.
 */

if (!isset($post) || !$post instanceof WP_Post) {
    return;
}

setup_postdata($post);

$permalink = get_permalink($post);
$title     = get_the_title($post);

// Use custom excerpt if set, otherwise WordPress excerpt, otherwise auto-generated
$custom_excerpt = get_field('blog_custom_excerpt', $post->ID);
$excerpt_length = get_field('blog_excerpt_length', $post->ID) ?: 20;

if ($custom_excerpt) {
    $excerpt = $custom_excerpt;
} elseif (has_excerpt($post)) {
    $excerpt = get_the_excerpt($post);
} else {
    $excerpt = wp_trim_words(get_the_content(null, false, $post), $excerpt_length);
}

// Use same image as single post hero: hero override if set, otherwise featured image
$hero_image  = get_field('blog_hero_featured_image_override', $post->ID);
$thumb_id    = get_post_thumbnail_id($post);
$card_has_img = ($hero_image && !empty($hero_image['ID'])) || $thumb_id;
?>

<article class="blog-card">
    <a href="<?php echo esc_url($permalink); ?>" class="blog-card__link">
        <?php if ($card_has_img) : ?>
            <div class="blog-card__image-wrap">
                <?php if ($hero_image && !empty($hero_image['url'])) : ?>
                    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr(!empty($hero_image['alt']) ? $hero_image['alt'] : $title); ?>" class="blog-card__image">
                <?php else : ?>
                    <?php echo get_the_post_thumbnail($post, 'medium_large', ['class' => 'blog-card__image']); ?>
                <?php endif; ?>
                <div class="blog-card__title-overlay">
                    <h3 class="blog-card__title"><?php echo esc_html($title); ?></h3>
                </div>
            </div>
        <?php else : ?>
            <div class="blog-card__image-wrap blog-card__image-wrap--no-image">
                <div class="blog-card__title-overlay">
                    <h3 class="blog-card__title"><?php echo esc_html($title); ?></h3>
                </div>
            </div>
        <?php endif; ?>
        <div class="blog-card__body">
            <?php if ($excerpt) : ?>
                <p class="blog-card__excerpt"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
            <span class="blog-card__read-more">Read More</span>
        </div>
    </a>
</article>

<?php
wp_reset_postdata();
