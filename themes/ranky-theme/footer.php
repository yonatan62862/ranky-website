<?php
/**
 * Footer
 */

get_template_part('template-parts/global-contact-form');
get_template_part('template-parts/global-cta');

$footer_text = get_field('footer_text', 'option');
$current_year = date('Y');
?>

<footer class="site-footer">
  <div class="container">
    <p class="site-footer__text">
      &copy; <?php echo esc_html($current_year); ?>
      – <?php echo esc_html($footer_text); ?>
    </p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
