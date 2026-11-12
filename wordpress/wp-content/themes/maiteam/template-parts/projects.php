<?php
$projects = array(
    array(
        'kind'  => 'web',
        'label' => 'Web',
        'title' => 'ES CityVet',
        'text'  => 'Staff sign-in for the El Salvador City Veterinary Office clinic dashboard.',
        'description' => 'This project is our capstone project in El Salvador City veterinary care. We started this in 3rd year, 2nd semester, for our group project.',
        'image' => maiteam_theme_img('projects/es-cityvet-web.png'),
        'alt'   => 'ES CityVet staff sign-in on the web',
    ),
    array(
        'kind'  => 'mobile',
        'label' => 'Mobile',
        'title' => 'Alagang Elsalvet',
        'text'  => 'A phone sign-in for pet owners. Alaga mo, Atiman Ko!',
        'description' => 'This is the mobile application of our El Salvador City veterinary care system, for animal owners to monitor their pets and book an appointment.',
        'image' => maiteam_theme_img('projects/alagang-elsalvet-mobile.jpg'),
        'alt'   => 'Alagang Elsalvet sign-in on mobile',
    ),
    array(
        'kind'  => 'soon',
        'label' => 'Next',
        'title' => 'More to come',
        'text'  => 'Another project is on the way.',
        'description' => 'We are learning and planning to explore the IT industry, and we want to create a free game using Unity soon.',
    ),
);

$arrow = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14.5 5.5 8 12l6.5 6.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<section class="mai-projects" id="mai-projects">

    <div class="mai-projects-heading">
        <p class="mai-eyebrow">SELECTED WORK</p>
        <h2>PROJECTS</h2>
        <p class="mai-subtitle">The same care, built for the browser and the phone.</p>
    </div>

    <div class="mai-project-carousel" data-index="0">
        <button type="button" class="mai-project-arrow is-prev" aria-label="Previous project">
            <?php echo $arrow; ?>
        </button>

        <div class="mai-project-viewport">
            <?php foreach ($projects as $index => $project) : ?>
                <button
                    type="button"
                    class="mai-project-slide is-<?php echo esc_attr($project['kind']); ?>"
                    data-index="<?php echo esc_attr($index); ?>"
                    data-label="<?php echo esc_attr($project['label']); ?>"
                    data-title="<?php echo esc_attr($project['title']); ?>"
                    data-description="<?php echo esc_attr($project['description']); ?>"
                    aria-label="<?php echo esc_attr($project['title']); ?>"
                >
                    <?php if (!empty($project['image'])) : ?>
                        <span class="mai-project-shot">
                            <img src="<?php echo esc_url($project['image']); ?>" alt="<?php echo esc_attr($project['alt']); ?>">
                        </span>
                    <?php else : ?>
                        <span class="mai-project-coming">
                            <span class="mai-eyebrow"><?php echo esc_html($project['label']); ?></span>
                            <strong><?php echo esc_html($project['title']); ?></strong>
                            <span><?php echo esc_html($project['text']); ?></span>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($project['image'])) : ?>
                        <span class="mai-project-caption">
                            <span><?php echo esc_html($project['label']); ?></span>
                            <strong><?php echo esc_html($project['title']); ?></strong>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <button type="button" class="mai-project-arrow is-next" aria-label="Next project">
            <?php echo str_replace('M14.5 5.5 8 12l6.5 6.5', 'M9.5 5.5 16 12l-6.5 6.5', $arrow); ?>
        </button>
    </div>

    <div class="mai-project-zoom" hidden>
        <button type="button" class="mai-project-zoom-backdrop" aria-label="Close project"></button>
        <button type="button" class="mai-project-arrow is-prev" data-zoom-step="-1" aria-label="Previous project">
            <?php echo $arrow; ?>
        </button>
        <div class="mai-project-zoom-frame"></div>
        <button type="button" class="mai-project-arrow is-next" data-zoom-step="1" aria-label="Next project">
            <?php echo str_replace('M14.5 5.5 8 12l6.5 6.5', 'M9.5 5.5 16 12l-6.5 6.5', $arrow); ?>
        </button>
    </div>

</section>
