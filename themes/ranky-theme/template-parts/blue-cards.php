<?php
/**
 * Blue Cards Section (Home only)
 */

if (!is_front_page()) {
    return;
}

$cards = get_field('blue_cards');

if (!$cards || !is_array($cards)) {
    return;
}
?>

<section class="blue-cards">
  <div class="container">
    <div class="blue-cards__grid">
      
      <?php foreach ($cards as $card) : ?>
        <article class="blue-card">
          
          <?php if (!empty($card['icons']) && is_array($card['icons'])) : ?>
            <div class="blue-card__icons">
              <?php foreach ($card['icons'] as $icon_item) : ?>
                <?php if (!empty($icon_item['icon'])) : ?>
                  <div class="blue-card__icon">
                    <img 
                      src="<?php echo esc_url($icon_item['icon']['url']); ?>" 
                      alt="<?php echo esc_attr($icon_item['icon']['alt'] ?? ''); ?>"
                      class="blue-card__icon-image"
                    >
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($card['button'])) : ?>
            <a
              href="<?php echo esc_url($card['button']['url'] ?? '#'); ?>"
              <?php if (!empty($card['button']['target'])) : ?>
                target="<?php echo esc_attr($card['button']['target']); ?>"
              <?php endif; ?>
              class="blue-card__button btn btn--primary">
              <?php echo esc_html($card['button']['title'] ?? 'Click Here'); ?>
            </a>
          <?php endif; ?>

        </article>
      <?php endforeach; ?>

    </div>
  </div>
</section>

