<?php
/**
 * Home Blue Cards Section
 */

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

          <?php if (!empty($card['icon'])) : ?>
            <div class="blue-card__icon">
              <img
                src="<?php echo esc_url($card['icon']['url']); ?>"
                alt="<?php echo esc_attr($card['icon']['alt'] ?? ''); ?>"
                class="blue-card__icon-image"
              >
            </div>
          <?php endif; ?>

          <div class="blue-card__content">

            <?php if (!empty($card['top_label'])) : ?>
              <p class="blue-card__top-label"><?php echo esc_html($card['top_label']); ?></p>
            <?php endif; ?>

            <?php if (!empty($card['secondary_label'])) : ?>
              <p class="blue-card__secondary-label"><?php echo esc_html($card['secondary_label']); ?></p>
            <?php endif; ?>

            <?php if (!empty($card['title'])) :
              $title_color = !empty($card['title_color']) ? $card['title_color'] : 'orange';
            ?>
              <p class="blue-card__title blue-card__title--<?php echo esc_attr($title_color); ?>">
                <?php echo wp_kses_post(nl2br(esc_html($card['title']))); ?>
              </p>
            <?php endif; ?>

            <?php if (!empty($card['subtitle'])) :
              $subtitle_color = !empty($card['subtitle_color']) ? $card['subtitle_color'] : 'white';
            ?>
              <p class="blue-card__subtitle blue-card__subtitle--<?php echo esc_attr($subtitle_color); ?>">
                <?php echo wp_kses_post(nl2br(esc_html($card['subtitle']))); ?>
              </p>
            <?php endif; ?>

          </div>

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
