<?php
// Intro Section Fields
$intro_title_prefix = get_field('intro_title_prefix');
$intro_title_main = get_field('intro_title_main');
$intro_content = get_field('intro_content');
$intro_image = get_field('intro_image');

// Challenges & Solutions Section Fields
$challenges_solutions_title_prefix = get_field('challenges_solutions_title_prefix');
$challenges_solutions_title_main = get_field('challenges_solutions_title_main');
$challenges_solutions_subtitle_prefix = get_field('challenges_solutions_subtitle_prefix');
$challenges_solutions_subtitle_main = get_field('challenges_solutions_subtitle_main');
$challenges_column_title = get_field('challenges_column_title');
$solutions_column_title = get_field('solutions_column_title');
$challenges_solutions = get_field('challenges_solutions');

// Approach Section Fields
$approach_eyebrow = get_field('approach_eyebrow');
$approach_title = get_field('approach_title');
$approach_content = get_field('approach_content');
$approach_image = get_field('approach_image');

// Solutions Section Fields
$solutions_title = get_field('solutions_title');
$solutions_subtitle = get_field('solutions_subtitle');
$solutions_items = get_field('solutions_items');

// Check if any section has content
$has_intro = $intro_title_prefix || $intro_title_main || $intro_content || $intro_image;
$has_challenges = $challenges_solutions_title_prefix || $challenges_solutions_title_main || $challenges_solutions_subtitle_prefix || $challenges_solutions_subtitle_main || ($challenges_solutions && is_array($challenges_solutions) && !empty($challenges_solutions));
$has_approach = $approach_eyebrow || $approach_title || $approach_content || $approach_image;
$has_solutions = $solutions_title || $solutions_subtitle || ($solutions_items && is_array($solutions_items) && !empty($solutions_items));

if (!$has_intro && !$has_challenges && !$has_approach && !$has_solutions) {
    return;
}
?>

<div class="industry-flow">
<!-- Intro Section -->
<?php if ($has_intro): ?>
<section class="industry-intro">
  <div class="container">

    <div class="industry-intro__text">
      <?php if ($intro_title_prefix || $intro_title_main): ?>
        <h2 class="industry-intro__title">
          <?php if ($intro_title_prefix): ?>
            <span class="industry-intro__title-prefix"><?php echo esc_html($intro_title_prefix); ?></span>
          <?php endif; ?>
          <?php if ($intro_title_main): ?>
            <span class="industry-intro__title-main"><?php echo esc_html($intro_title_main); ?></span>
          <?php endif; ?>
        </h2>
      <?php endif; ?>

      <?php if ($intro_content): ?>
        <div class="industry-intro__content">
          <?php echo wp_kses_post($intro_content); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if ($intro_image): ?>
      <div class="industry-intro__image">
        <?php echo wp_get_attachment_image(
          $intro_image['ID'],
          'large',
          false,
          ['alt' => esc_attr($intro_image['alt'] ?? '')]
        ); ?>
      </div>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<!-- Challenges & Solutions Section -->
<?php if ($has_challenges): ?>
<section class="industry-challenges-solutions">
    <div class="container">
        <?php if ($challenges_solutions_title_prefix || $challenges_solutions_title_main): ?>
            <h2 class="industry-challenges-solutions__title">
                <?php if ($challenges_solutions_title_prefix): ?>
                    <span class="industry-challenges-solutions__title-prefix"><?php echo esc_html($challenges_solutions_title_prefix); ?></span>
                <?php endif; ?>
                <?php if ($challenges_solutions_title_main): ?>
                    <span class="industry-challenges-solutions__title-main"><?php echo esc_html($challenges_solutions_title_main); ?></span>
                <?php endif; ?>
            </h2>
        <?php endif; ?>

        <?php if ($challenges_solutions_subtitle_prefix || $challenges_solutions_subtitle_main): ?>
            <p class="industry-challenges-solutions__subtitle">
                <?php if ($challenges_solutions_subtitle_prefix): ?>
                    <span class="industry-challenges-solutions__subtitle-prefix"><?php echo esc_html($challenges_solutions_subtitle_prefix); ?></span>
                <?php endif; ?>
                <?php if ($challenges_solutions_subtitle_main): ?>
                    <span class="industry-challenges-solutions__subtitle-main"><?php echo esc_html($challenges_solutions_subtitle_main); ?></span>
                <?php endif; ?>
            </p>
        <?php endif; ?>

        <?php if ($challenges_solutions && is_array($challenges_solutions) && !empty($challenges_solutions)): ?>
            <div class="industry-challenges-solutions__wrapper">
                <div class="industry-challenges-solutions__headers">
                    <?php if ($challenges_column_title): ?>
                        <h3 class="industry-challenges-solutions__column-title industry-challenges-solutions__column-title--challenges">
                            <?php echo esc_html($challenges_column_title); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($solutions_column_title): ?>
                        <h3 class="industry-challenges-solutions__column-title industry-challenges-solutions__column-title--solutions">
                            <?php echo esc_html($solutions_column_title); ?>
                        </h3>
                    <?php endif; ?>
                </div>

                <div class="industry-challenges-solutions__list">
                    <?php foreach ($challenges_solutions as $item): ?>
                        <div class="industry-challenges-solutions__row">
                            <!-- Challenge Side (Left) -->
                            <div class="industry-challenges-solutions__challenge-item">
                                <?php if (!empty($item['challenge_icon'])): ?>
                                    <div class="industry-challenges-solutions__icon">
                                        <?php echo wp_get_attachment_image($item['challenge_icon']['ID'], 'thumbnail', false, ['alt' => esc_attr($item['challenge_icon']['alt'] ?? '')]); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($item['challenge_title'])): ?>
                                    <h4 class="industry-challenges-solutions__challenge-title">
                                        <?php echo esc_html($item['challenge_title']); ?>
                                    </h4>
                                <?php endif; ?>
                            </div>

                            <!-- Arrow -->
                            <div class="industry-challenges-solutions__arrow">
                                <div class="industry-challenges-solutions__arrow-line"></div>
                                <div class="industry-challenges-solutions__arrow-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="#00A8E8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Solution Side (Right) -->
                            <?php if (!empty($item['solution_text'])): ?>
                                <div class="industry-challenges-solutions__solution-item">
                                    <p class="industry-challenges-solutions__solution-text">
                                        <?php echo esc_html($item['solution_text']); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Approach Section -->
<?php if ($has_approach): ?>
<section class="industry-approach">
    <div class="container">
        <?php if ($approach_eyebrow): ?>
            <p class="industry-approach__eyebrow"><?php echo esc_html($approach_eyebrow); ?></p>
        <?php endif; ?>

        <?php if ($approach_title): ?>
            <h2 class="industry-approach__title">
                <?php 
                $title = $approach_title;
                // Highlight "Enterprise" and "Approach" if they appear in the title
                $title = preg_replace('/\b(Enterprise|Approach)\b/i', '<span class="industry-approach__title-highlight">$1</span>', esc_html($title));
                echo $title;
                ?>
            </h2>
        <?php endif; ?>

        <div class="industry-approach__content">
            <?php if ($approach_content): ?>
                <div class="industry-approach__text">
                    <p><?php echo esc_html($approach_content); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($approach_image): ?>
                <div class="industry-approach__visual">
                    <?php echo wp_get_attachment_image($approach_image['ID'], 'large', false, ['alt' => esc_attr($approach_image['alt'] ?? '')]); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Solutions Section -->
<?php if ($has_solutions): ?>
<section class="industry-solutions">
    <div class="container">
        <?php if ($solutions_title): ?>
            <h2 class="industry-solutions__title">
                <?php 
                $title = esc_html($solutions_title);
                // Split title: "Enterprise" in gray, "Marketing Solutions" in bold blue
                if (preg_match('/^(Enterprise)\s+(.+)$/i', $title, $matches)) {
                    echo '<span class="industry-solutions__title-part industry-solutions__title-part--light">' . esc_html($matches[1]) . '</span> ';
                    echo '<span class="industry-solutions__title-part industry-solutions__title-part--bold">' . esc_html($matches[2]) . '</span>';
                } else {
                    echo $title;
                }
                ?>
            </h2>
        <?php endif; ?>

        <?php if ($solutions_subtitle): ?>
            <p class="industry-solutions__subtitle"><?php echo esc_html($solutions_subtitle); ?></p>
        <?php endif; ?>

        <?php if ($solutions_items && is_array($solutions_items) && !empty($solutions_items)): ?>
            <div class="industry-solutions__grid">
                <?php foreach ($solutions_items as $item): ?>
                    <article class="industry-solution-card">
                        <?php if (!empty($item['solution_icon'])): ?>
                            <div class="industry-solution-card__icon">
                                <?php echo wp_get_attachment_image($item['solution_icon']['ID'], 'medium', false, ['alt' => esc_attr($item['solution_icon']['alt'] ?? '')]); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['solution_title'])): ?>
                            <h3 class="industry-solution-card__title">
                                <?php echo esc_html($item['solution_title']); ?>
                            </h3>
                        <?php endif; ?>

                        <div class="industry-solution-card__divider"></div>

                        <?php if (!empty($item['solution_you_gain'])): ?>
                            <div class="industry-solution-card__content">
                                <p class="industry-solution-card__label">YOU GAIN:</p>
                                <p class="industry-solution-card__text"><?php echo esc_html($item['solution_you_gain']); ?></p>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
</div>
