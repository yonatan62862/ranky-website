<?php
/**
 * Single Blog Post Template
 * Hero, content, related posts, enterprise CTA, contact form.
 */

get_header();

if (!have_posts()) {
    get_footer();
    return;
}

while (have_posts()) :
    the_post();
?>

<main class="single-blog" id="content">
    <?php get_template_part('template-parts/blog/blog-hero'); ?>
    <?php get_template_part('template-parts/blog/blog-share'); ?>

    <article class="single-blog__article">
        <div class="container single-blog__content-wrap">
            <?php
                $custom_date = get_field('blog_hero_custom_date');
                $pub_date    = $custom_date ? $custom_date : get_the_date();
            ?>
            <?php if ($pub_date) : ?>
                <p class="single-blog__published">Published on <?php echo esc_html($pub_date); ?></p>
            <?php endif; ?>

            <div class="single-blog__content entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>

    <?php
    get_template_part('template-parts/blog/blog-related');
    ?>
</main>

<?php
endwhile;
get_footer();
