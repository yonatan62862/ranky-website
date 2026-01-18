<?php
/**
 * What You Gain Service Section
 */

$title_light = get_field('wyg_title_light');
$title_bold = get_field('wyg_title_bold');
$subtitle = get_field('wyg_subtitle');
$cards = get_field('wyg_cards');
$primary = get_field('wyg_primary_button');
$secondary = get_field('wyg_secondary_button');

$sys_title_light = get_field('wyg_system_title_light');
$sys_title_bold = get_field('wyg_system_title_bold');
$sys_text = get_field('wyg_system_text');
$sys_features = get_field('wyg_system_features');
$sys_button = get_field('wyg_system_button');
$sys_image = get_field('wyg_system_image');
?>

<section class="what-you-gain">
  <div class="container">

    <header class="what-you-gain__header">
      <?php if ($title_light || $title_bold): ?>
        <h2>
          <?php 
            if ($title_light) {
              echo '<span class="what-you-gain__header-title-light">' . esc_html($title_light) . '</span>';
              if ($title_bold) {
                echo ' ';
              }
            }
            if ($title_bold) {
              echo '<span class="what-you-gain__header-title-bold">' . esc_html($title_bold) . '</span>';
            }
          ?>
        </h2>
      <?php endif; ?>
      <?php if ($subtitle): ?><p><?php echo esc_html($subtitle); ?></p><?php endif; ?>
    </header>

    <?php if ($cards): ?>
    <div class="what-you-gain__grid">
      <?php foreach ($cards as $card): ?>
        <article class="gain-card">
          <?php if (!empty($card['icon'])): ?>
            <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="">
          <?php endif; ?>
          <h3><?php echo esc_html($card['title']); ?></h3>
          <p><?php echo esc_html($card['description']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="what-you-gain__actions">
      <?php if ($primary): ?>
        <a href="<?php echo esc_url($primary['url']); ?>" class="btn btn--primary">
          <?php echo esc_html($primary['title']); ?>
        </a>
      <?php endif; ?>
      <?php if ($secondary): ?>
        <a href="<?php echo esc_url($secondary['url']); ?>" class="btn btn--secondary">
          <?php echo esc_html($secondary['title']); ?>
        </a>
      <?php endif; ?>
    </div>

    <div class="what-you-gain__system">
      <div class="system__content">
        <?php if ($sys_title_light || $sys_title_bold): ?>
          <h3 class="system__title">
            <?php 
              if ($sys_title_light) {
                echo '<span class="system__title-light">' . esc_html($sys_title_light) . '</span>';
                if ($sys_title_bold) {
                  echo ' ';
                }
              }
              if ($sys_title_bold) {
                echo '<span class="system__title-bold">' . esc_html($sys_title_bold) . '</span>';
              }
            ?>
          </h3>
        <?php endif; ?>

        <?php if ($sys_text): ?>
          <p class="system__text"><?php echo esc_html($sys_text); ?></p>
        <?php endif; ?>

        <?php if ($sys_features && is_array($sys_features)): ?>
          <div class="system__features-wrapper">
            <div class="system__dots">
              <?php foreach ($sys_features as $index => $feature): ?>
                <button 
                  class="system__dot <?php echo $index === 0 ? 'system__dot--active' : ''; ?>" 
                  data-index="<?php echo esc_attr($index); ?>"
                  aria-label="Feature <?php echo esc_attr($index + 1); ?>"
                ></button>
              <?php endforeach; ?>
            </div>
            <div class="system__features">
              <?php foreach ($sys_features as $index => $feature): ?>
                <div class="system__feature-card <?php echo $index === 0 ? 'system__feature-card--active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                  <p class="system__feature-text"><?php echo esc_html($feature['text']); ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($sys_button): ?>
          <a href="<?php echo esc_url($sys_button['url'] ?? '#'); ?>" class="system__button btn btn--primary">
            <?php echo esc_html($sys_button['title'] ?? 'Click Here'); ?>
          </a>
        <?php endif; ?>
      </div>

      <?php if ($sys_image): ?>
      <div class="system__image">
        <img src="<?php echo esc_url($sys_image['url']); ?>" alt="<?php echo esc_attr($sys_image['alt'] ?? ''); ?>">
      </div>
      <?php endif; ?>
    </div>

  </div>
</section>
