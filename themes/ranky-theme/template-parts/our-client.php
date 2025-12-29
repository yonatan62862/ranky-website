<?php
/**
 * Our Client Section (Home only)
 */

if (!is_front_page()) {
    return;
}

$title = get_field('our_client_title');
$text = get_field('our_client_text');
$primary_button = get_field('our_client_primary_button');
$secondary_button = get_field('our_client_secondary_button');
$logos = get_field('our_client_logos');

if (!$logos || !is_array($logos)) {
    return;
}
?>

<section class="our-client">
  <div class="container">
    <div class="our-client__grid">
      
      <!-- Left: Client Logos -->
      <div class="our-client__logos">
        <?php foreach ($logos as $logo_item) : ?>
          <?php if (!empty($logo_item['logo'])) : ?>
            <div class="client-logo client-logo--<?php echo esc_attr($logo_item['size'] ?? 'medium'); ?>">
              <img 
                src="<?php echo esc_url($logo_item['logo']['url']); ?>" 
                alt="<?php echo esc_attr($logo_item['logo']['alt'] ?? ''); ?>"
                class="client-logo__image"
              >
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <!-- Right: Content -->
      <div class="our-client__content">
        <?php if ($title) : ?>
          <h2 class="our-client__title">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>

        <?php if ($text) : ?>
          <p class="our-client__text">
            <?php echo esc_html($text); ?>
          </p>
        <?php endif; ?>

        <?php if ($primary_button || $secondary_button) : ?>
          <div class="our-client__actions">
            <?php if ($primary_button) : ?>
              <a
                href="<?php echo esc_url($primary_button['url'] ?? '#'); ?>"
                <?php if (!empty($primary_button['target'])) : ?>
                  target="<?php echo esc_attr($primary_button['target']); ?>"
                <?php endif; ?>
                class="btn btn--primary">
                <?php echo esc_html($primary_button['title'] ?? 'Click Here'); ?>
              </a>
            <?php endif; ?>

            <?php if ($secondary_button) : ?>
              <a
                href="<?php echo esc_url($secondary_button['url'] ?? '#'); ?>"
                <?php if (!empty($secondary_button['target'])) : ?>
                  target="<?php echo esc_attr($secondary_button['target']); ?>"
                <?php endif; ?>
                class="btn btn--secondary">
                <?php echo esc_html($secondary_button['title'] ?? 'Click Here'); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

