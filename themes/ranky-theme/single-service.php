<?php
/**
 * Single Service Template
 */

get_header();

if (!have_posts()) {
  return;
}

while (have_posts()) : the_post();

$_service_slug    = is_singular('service') ? strtolower(get_post_field('post_name', get_the_ID())) : '';
$_is_paid_ads     = in_array($_service_slug, ['paid-ads', 'paidads', 'services-paid-ads'], true)
    || stripos(get_the_title(), 'Paid Ads') !== false;
$_is_external_cmo = in_array($_service_slug, ['external-cmo', 'services-external-cmo'], true)
    || stripos(get_the_title(), 'External CMO') !== false;
?>

<main class="service-page">

    <?php if ($_is_paid_ads || $_is_external_cmo) : ?>
    <div class="hero-overview-unified">
    <?php endif; ?>

    <?php get_template_part('template-parts/service/hero'); ?>
    <?php get_template_part('template-parts/service/overview'); ?>

    <?php if ($_is_paid_ads || $_is_external_cmo) : ?>
    </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/service/what-you-gain'); ?>
    <?php get_template_part('template-parts/service/process'); ?>
    <?php get_template_part('template-parts/service/results'); ?>
    <?php get_template_part('template-parts/service/faq'); ?>
    <?php get_template_part('template-parts/service/cta'); ?>

</main>

<?php
endwhile;
get_footer();
