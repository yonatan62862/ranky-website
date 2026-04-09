<?php
/**
 * Blog Hero Template Part
 * Title and featured image for single blog post. Use within the main loop.
 */

$title     = get_the_title();
$custom_author = get_field('blog_hero_custom_author');
$author    = $custom_author ? $custom_author : get_the_author();
$custom_date = get_field('blog_hero_custom_date');
$date      = $custom_date ? $custom_date : get_the_date();
$read_time = function_exists('ranky_estimated_read_time') ? ranky_estimated_read_time() : null;

// Use hero image override if set, otherwise use featured image
$hero_image = get_field('blog_hero_featured_image_override');
$thumb_id  = $hero_image ? $hero_image['ID'] : get_post_thumbnail_id();
$bg_image_url = $hero_image ? $hero_image['url'] : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '');

// Get categories for breadcrumbs
$categories = get_the_terms(get_the_ID(), 'category');
$category_name = !empty($categories) && !is_wp_error($categories) && !empty($categories[0]) ? $categories[0]->name : '';
?>

<section class="blog-hero"<?php if ($bg_image_url) : ?> style="--hero-bg-image: url('<?php echo esc_url($bg_image_url); ?>');"<?php endif; ?>>
    <div class="blog-hero__background"></div>
    <div class="container blog-hero__inner">
        <div class="blog-hero__content">
            <nav class="blog-hero__breadcrumbs" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="blog-hero__breadcrumb-link">Home</a>
                <span class="blog-hero__breadcrumb-separator">/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>" class="blog-hero__breadcrumb-link">Blog</a>
                <?php if ($category_name) : ?>
                    <span class="blog-hero__breadcrumb-separator">/</span>
                    <span class="blog-hero__breadcrumb-current"><?php echo esc_html($category_name); ?></span>
                <?php endif; ?>
            </nav>
            
            <header class="blog-hero__header">
                <h1 class="blog-hero__title"><?php echo esc_html($title); ?></h1>
                <div class="blog-hero__meta">
                    <span class="blog-hero__author">By <?php echo esc_html($author); ?><?php if ($read_time) : ?>, <?php echo esc_html($read_time); ?> min read<?php endif; ?></span>
                </div>
            </header>
        </div>
    </div>
    
    <?php if ($thumb_id) : ?>
        <div class="blog-hero__image-wrap">
            <?php if ($hero_image) : ?>
                <img 
                    src="<?php echo esc_url($hero_image['url']); ?>" 
                    alt="<?php echo esc_attr($hero_image['alt'] ?: $title); ?>"
                    class="blog-hero__image"
                >
            <?php else : ?>
                <?php the_post_thumbnail('large', ['class' => 'blog-hero__image']); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
