<?php
/**
 * Front Page Template
 */

get_header();
?>

<main id="site-content">

    <?php
    get_template_part('template-parts/home/hero');
    get_template_part('template-parts/home/why-ranky');
    get_template_part('template-parts/home/what-you-gain');
    get_template_part('template-parts/home/results');
    get_template_part('template-parts/home/our-client');
    get_template_part('template-parts/home/blue-cards');
    get_template_part('template-parts/home/services');
    get_template_part('template-parts/home/success-in-action');
    get_template_part('template-parts/home/faq');
    ?>

</main>

<?php
get_footer();
