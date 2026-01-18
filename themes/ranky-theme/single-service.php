<?php
/**
 * Single Service Template
 */

get_header();

if (!have_posts()) {
  return;
}

while (have_posts()) : the_post();
?>

<main class="service-page">

    <?php get_template_part('template-parts/service/hero'); ?>
    <?php get_template_part('template-parts/service/overview'); ?>
    <?php get_template_part('template-parts/service/what-you-gain'); ?>
    <?php get_template_part('template-parts/service/process'); ?>
    <?php get_template_part('template-parts/service/results'); ?>
    <?php get_template_part('template-parts/service/faq'); ?>
    <?php get_template_part('template-parts/service/cta'); ?>

</main>

<?php
endwhile;
get_footer();
