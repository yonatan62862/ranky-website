<?php
/**
 * Service Process Section
 */

$process_title_light = get_field('process_title_light');
$process_title_bold = get_field('process_title_bold');
$process_subtitle = get_field('process_subtitle');
$process_steps = get_field('process_steps');
$process_button = get_field('process_button');

if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    return;
}
?>

<section class="process">
    <div class="container">

        <?php if ($process_title_light || $process_title_bold): ?>
            <h2 class="process__title">
              <?php 
                if ($process_title_light) {
                  echo '<span class="process__title-light">' . esc_html($process_title_light) . '</span>';
                  if ($process_title_bold) {
                    echo ' ';
                  }
                }
                if ($process_title_bold) {
                  echo '<span class="process__title-bold">' . esc_html($process_title_bold) . '</span>';
                }
              ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($process_subtitle)): ?>
            <p class="process__subtitle"><?php echo esc_html($process_subtitle); ?></p>
        <?php endif; ?>

        <div class="process__steps">
            <?php foreach ($process_steps as $index => $step): ?>
                <div class="process-step">
                    <?php if (!empty($step['step_title'])): ?>
                        <h3 class="process-step__title"><?php echo esc_html($step['step_title']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($step['step_description'])): ?>
                        <p class="process-step__description"><?php echo esc_html($step['step_description']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($process_button) && !empty($process_button['url'])): ?>
            <div class="process__button-wrapper">
                <a href="<?php echo esc_url($process_button['url']); ?>" 
                   class="process__button"
                   <?php if (!empty($process_button['target'])): ?>target="<?php echo esc_attr($process_button['target']); ?>"<?php endif; ?>>
                    <?php echo esc_html($process_button['title']); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

