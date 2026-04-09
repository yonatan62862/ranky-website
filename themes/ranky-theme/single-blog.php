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

    <article class="single-blog__article">
        <div class="container single-blog__content-wrap">
            <div class="single-blog__content entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>

    <?php
    get_template_part('template-parts/blog/blog-related');
    get_template_part('template-parts/global/enterprise-cta');
    ?>
</main>

<?php
endwhile;
get_footer();
