<?php
/**
 * Related Blog Posts Template Part
 * Shows 3 blog posts excluding the current one. Uses blog-card.php for each.
 */

$current_id = get_the_ID();
$related    = new WP_Query([
    'post_type'      => 'blog',
    'posts_per_page' => 3,
    'post__not_in'   => [$current_id],
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);

if (!$related->have_posts()) {
    return;
}
?>

<section class="blog-related">
    <div class="container">
        <h2 class="blog-related__title">Related Posts</h2>
        <ul class="blog-related__grid">
            <?php while ($related->have_posts()) : $related->the_post(); ?>
                <li class="blog-related__item">
                    <?php get_template_part('template-parts/blog/blog-card'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</section>

<?php
wp_reset_postdata();
