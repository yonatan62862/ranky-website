<?php
/**
 * Global CTA / Footer CTA Section (Home only)
 */

if (!is_front_page()) {
    return;
}

$variant = get_field('global_cta_variant') ?: 'default';
$columns = get_field('global_cta_columns');

$newsletter_title = get_field('global_cta_newsletter_title');
$newsletter_placeholder = get_field('global_cta_newsletter_placeholder') ?: 'Enter Your Email';
$newsletter_button = get_field('global_cta_newsletter_button') ?: 'Subscribe';

$socials = get_field('global_cta_socials');
?>

<section class="global-cta global-cta--<?php echo esc_attr($variant); ?>">
  <div class="container">

    <div class="global-cta__grid">

      <!-- LINK COLUMNS -->
      <?php if ($columns && is_array($columns)) : ?>
        <?php foreach ($columns as $column) : ?>
          <div class="global-cta__column">

            <?php if (!empty($column['title'])) : ?>
              <h4 class="global-cta__column-title">
                <?php echo esc_html($column['title']); ?>
              </h4>
            <?php endif; ?>

            <?php if (!empty($column['links']) && is_array($column['links'])) : ?>
              <ul class="global-cta__links">
                <?php foreach ($column['links'] as $item) : ?>
                  <?php if (!empty($item['link'])) : ?>
                    <li>
                      <a
                        href="<?php echo esc_url($item['link']['url']); ?>"
                        <?php if (!empty($item['link']['target'])) : ?>
                          target="<?php echo esc_attr($item['link']['target']); ?>"
                        <?php endif; ?>
                      >
                        <?php echo esc_html($item['link']['title']); ?>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <!-- NEWSLETTER -->
      <div class="global-cta__newsletter">

        <?php if ($newsletter_title) : ?>
          <h4 class="global-cta__newsletter-title">
            <?php echo esc_html($newsletter_title); ?>
          </h4>
        <?php endif; ?>

        <form class="global-cta__newsletter-form" action="#" method="post">
          <div class="global-cta__newsletter-field">
            <input
              type="email"
              name="newsletter_email"
              placeholder="<?php echo esc_attr($newsletter_placeholder); ?>"
              required
            >
            <button type="submit">
              <?php echo esc_html($newsletter_button); ?>
            </button>
          </div>
        </form>

        <?php if ($socials && is_array($socials)) : ?>
          <div class="global-cta__socials">
            <?php foreach ($socials as $social) : ?>
              <?php if (!empty($social['icon']) && !empty($social['url'])) : ?>
                <a
                  href="<?php echo esc_url($social['url']); ?>"
                  target="_blank"
                  rel="noopener"
                  class="global-cta__social"
                >
                  <img
                    src="<?php echo esc_url($social['icon']['url']); ?>"
                    alt=""
                  >
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>

    </div>
  </div>
</section>
