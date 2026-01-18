<?php
$logos_title = get_field('logos_title');
$logos = get_field('logos');

if (!$logos_title && (!$logos || !is_array($logos) || empty($logos))) {
    return;
}
?>

<section class="industry-logos">
    <div class="container">
        <?php if ($logos_title): ?>
            <h2 class="industry-logos__title">
                <?php 
                $title = esc_html($logos_title);
                // Highlight "Client" if it appears in the title
                if (preg_match('/^(Our)\s+(Client)$/i', $title, $matches)) {
                    echo '<span class="industry-logos__title-part industry-logos__title-part--light">' . esc_html($matches[1]) . '</span> ';
                    echo '<span class="industry-logos__title-part industry-logos__title-part--bold">' . esc_html($matches[2]) . '</span>';
                } else {
                    echo $title;
                }
                ?>
            </h2>
        <?php endif; ?>

        <?php if ($logos && is_array($logos) && !empty($logos)): ?>
            <div class="industry-logos__grid">
                <?php foreach ($logos as $logo): ?>
                    <div class="industry-logo">
                        <?php if (!empty($logo['logo_image'])): ?>
                            <?php echo wp_get_attachment_image($logo['logo_image']['ID'], 'medium', false, ['alt' => esc_attr($logo['logo_name'] ?? $logo['logo_image']['alt'] ?? '')]); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

