<?php
$members = function_exists('maiteam_get_members') ? maiteam_get_members() : array();
?>

<section class="mai-about" id="mai-about">

    <div class="mai-about-heading">
        <p class="mai-eyebrow">GET TO KNOW US</p>
        <h2>MEET THE TEAM</h2>
        <p class="mai-subtitle">Four individuals. Different stories. One team.</p>
    </div>

    <div class="mai-team-grid">

        <?php foreach ($members as $slug => $member) :
            $has_hover = !empty($member['hover']) && strpos($member['hover'], 'hover-head.svg') === false;
            ?>
            <div class="mai-card-wrap">
                <div class="mai-hanger">
                    <div class="mai-lace"><span></span></div>
                    <div class="mai-id-card" role="button" tabindex="0" data-member="<?php echo esc_attr($slug); ?>">
                        <div class="mai-card-inner">
                            <div class="mai-card-front">
                                <span class="mai-card-label">MAI TEAM MEMBER</span>
                                <div class="mai-card-photo">
                                    <img class="mai-card-photo-front" src="<?php echo esc_url($member['portrait']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                                    <?php if ($has_hover) : ?>
                                        <div class="mai-portrait-head">
                                            <img class="mai-portrait-mask" src="<?php echo esc_url($member['hover']); ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h3><?php echo esc_html($member['name']); ?></h3>
                                <p><?php echo esc_html($member['role']); ?></p>
                                <span class="mai-flip-hint">CLICK TO FLIP ↻</span>
                            </div>
                            <div class="mai-card-back">
                                <span class="mai-card-label">PERSONAL DETAILS</span>
                                <h3><?php echo esc_html($member['name']); ?></h3>
                                <ul class="mai-details">
                                    <li><span>Age</span><strong><?php echo esc_html($member['age']); ?></strong></li>
                                    <li><span>Birthdate</span><strong><?php echo esc_html($member['birthdate']); ?></strong></li>
                                    <li><span>Address</span><strong><?php echo esc_html($member['address']); ?></strong></li>
                                </ul>
                                <a class="mai-more-info" href="<?php echo esc_url(home_url('/' . $slug . '/')); ?>" data-member="<?php echo esc_attr($slug); ?>">MORE INFO ↗</a>
                                <span class="mai-flip-hint">CLICK TO FLIP ↻</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</section>
