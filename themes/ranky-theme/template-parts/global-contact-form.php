<?php
/**
 * Global Contact Form Section
 * Configured in Theme Settings
 */

$title_light = get_field('global_contact_form_title_light', 'option');
$title_bold = get_field('global_contact_form_title_bold', 'option');
$fields = get_field('global_contact_form_fields', 'option');
$checkbox_text = get_field('global_contact_form_checkbox_text', 'option');
$submit_text = get_field('global_contact_form_submit_text', 'option') ?: 'Get in touch';
?>

<section id="contact-card" class="contact-card">
  <div class="container">
    <div class="contact-card__inner">

      <?php if ($title_light || $title_bold): ?>
        <h2 class="contact-card__title">
          <?php 
            if ($title_light) {
              echo '<span class="contact-card__title-light">' . esc_html($title_light) . '</span>';
              if ($title_bold) {
                echo ' ';
              }
            }
            if ($title_bold) {
              echo '<span class="contact-card__title-bold">' . esc_html($title_bold) . '</span>';
            }
          ?>
        </h2>
      <?php endif; ?>

      <form class="contact-card__form" method="post" action="" id="contactCardForm">
      <?php wp_nonce_field('contact_card_submit', 'contact_card_nonce'); ?>


        <?php if ($fields && is_array($fields)): ?>
          <div class="contact-card__grid">

            <?php foreach ($fields as $index => $field): ?>
              <?php
                $type = $field['type'] ?? 'text';
                $label = $field['label'] ?? '';
                $placeholder = $field['placeholder'] ?? '';
                $required = !empty($field['required']);
                $name = 'field_' . $index;
              ?>

              <?php if ($type === 'select'): ?>
                <div class="contact-card__full">
                  <?php if ($label): ?>
                    <label class="contact-card__field-label">
                      <?php echo esc_html($label); ?>
                      <?php if ($required): ?><span class="required">*</span><?php endif; ?>
                    </label>
                  <?php endif; ?>
                  <select name="<?php echo esc_attr($name); ?>" <?php echo $required ? 'required' : ''; ?>>
                    <?php if ($placeholder): ?>
                      <option value=""><?php echo esc_html($placeholder); ?></option>
                    <?php endif; ?>

                    <?php if (!empty($field['options'])): ?>
                      <?php foreach ($field['options'] as $option): ?>
                        <option value="<?php echo esc_attr($option['value']); ?>">
                          <?php echo esc_html($option['label']); ?>
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

              <?php else: ?>
                <div class="contact-card__field">
                  <?php if ($label): ?>
                    <label class="contact-card__field-label" for="<?php echo esc_attr($name); ?>">
                      <?php echo esc_html($label); ?>
                      <?php if ($required): ?><span class="required">*</span><?php endif; ?>
                    </label>
                  <?php endif; ?>
                  <input
                    type="<?php echo esc_attr($type); ?>"
                    id="<?php echo esc_attr($name); ?>"
                    name="<?php echo esc_attr($name); ?>"
                    placeholder="<?php echo esc_attr($placeholder); ?>"
                    <?php echo $required ? 'required' : ''; ?>
                  >
                </div>
              <?php endif; ?>

            <?php endforeach; ?>

          </div>
        <?php endif; ?>

        <?php if ($checkbox_text): ?>
          <label class="contact-card__checkbox">
            <input type="checkbox" name="terms_approved" required>
            <span><?php echo esc_html($checkbox_text); ?></span>
          </label>
        <?php endif; ?>

        <button type="submit" class="btn btn--primary">
          <?php echo esc_html($submit_text); ?>
        </button>

      </form>

    </div>
  </div>
</section>

