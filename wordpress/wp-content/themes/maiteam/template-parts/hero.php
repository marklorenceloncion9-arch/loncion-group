<?php
$uploads = wp_upload_dir();
$slides  = array(
    $uploads['baseurl'] . '/2026/11/Confident-Team-in-Black-Suits.png',
    $uploads['baseurl'] . '/2026/11/Formal-Young-Business-Team-Portrait.png',
    $uploads['baseurl'] . '/2026/11/Professional-Team-Portrait-on-Black.png',
);
?>

<section class="mai-hero" id="home">

    <div class="mai-hero-slideshow" aria-hidden="true">
        <?php foreach ($slides as $index => $slide) : ?>
            <div
                class="mai-hero-slide<?php echo $index === 0 ? ' is-active' : ''; ?>"
                style="background-image: url('<?php echo esc_url($slide); ?>');"
            ></div>
        <?php endforeach; ?>
    </div>

    <div class="mai-hero-overlay"></div>

    <div class="mai-hero-content">

        <h1>
            CREATIVITY,<br>
            INNOVATION AND<br>
            EXCELLENCE
        </h1>

        <p class="mai-hero-description">
            We are a passionate team of creative minds dedicated to bringing ideas to life through innovation, collaboration, and impactful digital solutions.
            Together, we turn visions into reality and create meaningful experiences that inspire.
        </p>

        <div class="mai-hero-actions">
            <a href="#mai-about" class="mai-hero-button mai-hero-button-solid">
                MEET THE TEAM
            </a>
            <a href="#contact" class="mai-hero-button mai-hero-button-outline">
                CONTACT US
            </a>
        </div>

    </div>

</section>
