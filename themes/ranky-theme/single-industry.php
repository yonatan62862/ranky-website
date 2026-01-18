<?php
get_header();
?>

<main id="site-content">
    <?php
get_template_part('template-parts/industry/hero');
    get_template_part('template-parts/industry/industry-flow');
get_template_part('template-parts/industry/results');
get_template_part('template-parts/industry/logos');
get_template_part('template-parts/industry/faq');
    ?>
</main>

<?php
get_footer();
