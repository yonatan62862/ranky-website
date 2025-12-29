<?php
if (!is_front_page()) return;

$title = get_field('services_section_title');
$services = get_field('services');

if (!$services || !is_array($services)) return;
?>

<section class="services">
  <div class="container">

    <?php if ($title): ?>
      <h2 class="services__title">
        <?php echo esc_html($title); ?>
      </h2>
    <?php endif; ?>

    <div class="services__grid">

      <!-- LEFT: Tabs -->
      <div class="services__tabs">
        <?php foreach ($services as $index => $service): ?>
          <?php
            $is_active = !empty($service['is_active']);
          ?>
          <button
            class="services__tab <?php echo $is_active ? 'is-active' : ''; ?>"
            data-service="<?php echo esc_attr($index); ?>"
            type="button"
          >
            <?php if (!empty($service['icon'])): ?>
              <img src="<?php echo esc_url($service['icon']['url']); ?>" alt="">
            <?php endif; ?>

            <span><?php echo esc_html($service['title']); ?></span>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- RIGHT: Content Panels -->
      <div class="services__content">
        <?php foreach ($services as $index => $service): ?>
          <?php
            $is_active = !empty($service['is_active']);
          ?>
          <div
            class="services__panel <?php echo $is_active ? 'is-active' : ''; ?>"
            data-service="<?php echo esc_attr($index); ?>"
          >
            <h3><?php echo esc_html($service['content_title']); ?></h3>
            <p><?php echo esc_html($service['content_text']); ?></p>

            <div class="services__actions">
              <?php if (!empty($service['primary_button'])): ?>
                <a class="btn btn--primary"
                   href="<?php echo esc_url($service['primary_button']['url']); ?>">
                  <?php echo esc_html($service['primary_button']['title']); ?>
                </a>
              <?php endif; ?>

              <?php if (!empty($service['secondary_button'])): ?>
                <a class="btn btn--secondary"
                   href="<?php echo esc_url($service['secondary_button']['url']); ?>">
                  <?php echo esc_html($service['secondary_button']['title']); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>
