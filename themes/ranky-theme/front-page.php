<?php
/**
 * Front Page Template
 */

get_header();
?>

<main id="site-content">

    <?php
    // Hero section
    get_template_part('template-parts/hero');
    get_template_part('template-parts/why-ranky');
    get_template_part('template-parts/what-you-gain');
    get_template_part('template-parts/our-client');
    get_template_part('template-parts/blue-cards');
    get_template_part('template-parts/services-grid');
    get_template_part('template-parts/success-in-action');
    get_template_part('template-parts/faq');
    get_template_part('template-parts/contact-form-card'); 
    get_template_part('template-parts/global-cta');
    ?>

</main>

<?php
get_footer();
