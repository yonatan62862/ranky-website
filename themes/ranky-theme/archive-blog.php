<?php
/**
 * Archive Template for Blog CPT
 * Displays blog listing with hero, grid of cards, enterprise CTA, and contact form.
 */

get_header();
?>

<main class="blog-archive" id="content">
    <header class="blog-archive__hero">
        <div class="container blog-archive__hero-inner">
            <?php
            $hero_eyebrow = function_exists('get_field') ? get_field('blog_archive_hero_eyebrow', 'option') : null;
            $hero_title   = function_exists('get_field') ? get_field('blog_archive_hero_title', 'option') : null;
            $hero_eyebrow = $hero_eyebrow ?: 'What app?';
            $hero_title   = $hero_title ?: 'THE BLOG';
            ?>
            <?php if ($hero_eyebrow) : ?>
                <p class="blog-archive__eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
            <?php endif; ?>
            <h1 class="blog-archive__title"><?php echo esc_html($hero_title); ?></h1>
        </div>
    </header>

    <?php if (have_posts()) : ?>
        <section class="blog-archive__grid-section">
            <div class="container">
                <?php
                $current_cat = isset($_GET['category_name']) ? sanitize_text_field($_GET['category_name']) : '';
                $blog_categories = get_terms(['taxonomy' => 'category', 'hide_empty' => true]);
                $blog_categories = ($blog_categories && !is_wp_error($blog_categories)) ? $blog_categories : [];
                ?>
                <nav class="blog-archive__filters" aria-label="Blog categories">
                    <a href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>" class="blog-archive__filter <?php echo !$current_cat ? 'is-active' : ''; ?>">All</a>
                    <?php foreach ($blog_categories as $term) : ?>
                        <a href="<?php echo esc_url(add_query_arg('category_name', $term->slug, get_post_type_archive_link('blog'))); ?>" class="blog-archive__filter <?php echo ($current_cat === $term->slug) ? 'is-active' : ''; ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </nav>
                <ul class="blog-archive__grid">
                    <?php
                    while (have_posts()) {
                        the_post();
                        echo '<li class="blog-archive__item">';
                        get_template_part('template-parts/blog/blog-card');
                        echo '</li>';
                    }
                    ?>
                </ul>

                <?php get_template_part('template-parts/global/enterprise-cta'); ?>
            </div>
        </section>
    <?php else : ?>
        <section class="blog-archive__empty">
            <div class="container">
                <p class="blog-archive__empty-text">No posts yet. Check back soon.</p>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
