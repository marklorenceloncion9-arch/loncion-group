<?php
$slug   = isset($args['slug']) ? $args['slug'] : '';
$member = isset($args['member']) ? $args['member'] : null;

if (!$slug || !$member) {
    return;
}

$info_id   = 'info-' . $slug;
$school_id = 'school-' . $slug;
$fav_id    = 'favorites-' . $slug;
$one_id    = 'one-' . $slug;
$home    = home_url('/');
?>

<article class="mai-member" data-member="<?php echo esc_attr($slug); ?>">

    <div class="mai-member-nav">
        <button type="button" class="mai-member-back" data-return="<?php echo esc_url($home . '#mai-about'); ?>">
            ← Return
        </button>

        <nav class="mai-pill-nav" aria-label="Member sections">
            <a href="#<?php echo esc_attr($info_id); ?>" class="is-active">Info</a>
            <a href="#<?php echo esc_attr($school_id); ?>">School</a>
            <a href="#<?php echo esc_attr($fav_id); ?>">Favorites</a>
            <a href="#<?php echo esc_attr($one_id); ?>">One &amp; Only</a>
        </nav>
    </div>

    <section class="mai-member-section" id="<?php echo esc_attr($info_id); ?>">
        <p class="mai-eyebrow">MORE INFO</p>
        <h1><?php echo esc_html($member['name']); ?></h1>
        <p class="mai-member-role"><?php echo esc_html($member['role']); ?></p>

        <div class="mai-member-profile">
            <div class="mai-member-portrait">
                <img class="mai-portrait-front" src="<?php echo esc_url($member['portrait']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                <?php if (!empty($member['hover'])) : ?>
                    <div class="mai-portrait-head">
                        <img class="mai-portrait-mask" src="<?php echo esc_url($member['hover']); ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>

            <ul class="mai-member-details">
                <li><span>Name</span><strong><?php echo esc_html($member['name']); ?></strong></li>
                <li><span>Age</span><strong><?php echo esc_html($member['age']); ?></strong></li>
                <li><span>Birthdate</span><strong><?php echo esc_html($member['birthdate']); ?></strong></li>
                <li><span>Address</span><strong><?php echo esc_html($member['address']); ?></strong></li>
                <li><span>Phone Number</span><strong><?php echo esc_html($member['phone']); ?></strong></li>
                <li><span>Email Address</span><strong><?php echo esc_html($member['email']); ?></strong></li>
            </ul>
        </div>

        <div class="mai-member-dreams">
            <p class="mai-eyebrow">FUTURE DREAMS</p>
            <p><?php echo esc_html($member['dreams']); ?></p>
        </div>
    </section>

    <section class="mai-member-section" id="<?php echo esc_attr($school_id); ?>">
        <p class="mai-eyebrow">SCHOOL BACKGROUND</p>
        <h2>Where we went to school</h2>

        <?php
        $schools = isset($member['school']) && is_array($member['school']) ? $member['school'] : array();
        $levels  = array(
            'elementary'  => 'Elementary',
            'high_school' => 'High School',
            'college'     => 'College',
        );
        ?>
        <div class="mai-school-list">
            <?php foreach ($levels as $key => $label) :
                $entry = isset($schools[$key]) ? $schools[$key] : '';
                $place = '';
                $logo  = '';

                if (is_array($entry)) {
                    $place = isset($entry['name']) ? trim($entry['name']) : '';
                    $logo  = isset($entry['logo']) ? trim($entry['logo']) : '';
                } else {
                    $place = trim((string) $entry);
                }
                ?>
                <article class="mai-school-card">
                    <div class="mai-school-logo<?php echo $logo !== '' ? ' has-photo' : ''; ?>" aria-hidden="true">
                        <?php if ($logo !== '') : ?>
                            <img src="<?php echo esc_url($logo); ?>" alt="">
                        <?php elseif ($key === 'elementary') : ?>
                            <svg viewBox="0 0 64 64">
                                <path d="M8 30 L32 12 L56 30" fill="none" stroke="currentColor" stroke-width="2.4"/>
                                <rect x="16" y="30" width="32" height="22" fill="none" stroke="currentColor" stroke-width="2.4"/>
                                <rect x="28" y="38" width="8" height="14" fill="none" stroke="currentColor" stroke-width="2.2"/>
                                <circle cx="46" cy="18" r="4" fill="currentColor"/>
                            </svg>
                        <?php elseif ($key === 'high_school') : ?>
                            <svg viewBox="0 0 64 64">
                                <path d="M10 28 H54 L32 12 Z" fill="none" stroke="currentColor" stroke-width="2.4"/>
                                <rect x="14" y="28" width="36" height="24" fill="none" stroke="currentColor" stroke-width="2.4"/>
                                <rect x="22" y="34" width="7" height="8" fill="none" stroke="currentColor" stroke-width="1.8"/>
                                <rect x="35" y="34" width="7" height="8" fill="none" stroke="currentColor" stroke-width="1.8"/>
                                <rect x="28" y="40" width="8" height="12" fill="none" stroke="currentColor" stroke-width="1.8"/>
                            </svg>
                        <?php else : ?>
                            <svg viewBox="0 0 64 64">
                                <path d="M8 28 L32 16 L56 28 L32 40 Z" fill="none" stroke="currentColor" stroke-width="2.4"/>
                                <path d="M20 34 V46 C24 50 40 50 44 46 V34" fill="none" stroke="currentColor" stroke-width="2.2"/>
                                <path d="M56 28 V42" stroke="currentColor" stroke-width="2.2"/>
                                <circle cx="56" cy="44" r="2.4" fill="currentColor"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <span><?php echo esc_html($label); ?></span>
                    <strong><?php echo $place !== '' ? esc_html($place) : 'Add school name'; ?></strong>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="mai-member-section" id="<?php echo esc_attr($fav_id); ?>">
        <p class="mai-eyebrow">FAVORITES</p>
        <h2>Five things close to the heart</h2>

        <div class="mai-fav-fan" data-count="<?php echo count($member['favorites']); ?>">
            <?php foreach ($member['favorites'] as $index => $favorite) : ?>
                <figure class="mai-fav-card" style="--i: <?php echo (int) $index; ?>;" data-index="<?php echo (int) $index; ?>">
                    <img src="<?php echo esc_url($favorite['src']); ?>" alt="<?php echo esc_attr($favorite['label']); ?>">
                    <figcaption>
                        <span><?php echo esc_html($favorite['label']); ?></span>
                        <button
                            type="button"
                            class="mai-heart"
                            data-heart="<?php echo esc_attr($slug . '-' . $index); ?>"
                            aria-pressed="false"
                            aria-label="Like <?php echo esc_attr($favorite['label']); ?>"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 21s-6.7-4.35-9.33-8.22C.7 9.7 2.05 6 5.5 6c1.9 0 3.17 1.12 3.9 2.2C10.13 7.12 11.4 6 13.3 6c3.45 0 4.8 3.7 2.83 6.78C18.7 16.65 12 21 12 21z"/>
                            </svg>
                        </button>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
        <p class="mai-fav-caption" aria-live="polite"></p>
    </section>

    <section class="mai-member-section" id="<?php echo esc_attr($one_id); ?>">
        <p class="mai-eyebrow">ONE AND ONLY</p>
        <h2>The photo that stays</h2>
        <p class="mai-one-hint">Hover inside the frame to send hearts. They only appear where you move.</p>

        <figure class="mai-one-only">
            <div class="mai-one-only-frame">
                <img src="<?php echo esc_url($member['one_only']['src']); ?>" alt="One and only">
                <div class="mai-one-hearts" aria-hidden="true"></div>
                <p class="mai-one-hint-overlay">Hover here to send hearts</p>
            </div>
            <figcaption><?php echo esc_html($member['one_only']['caption']); ?></figcaption>
        </figure>
    </section>

</article>
