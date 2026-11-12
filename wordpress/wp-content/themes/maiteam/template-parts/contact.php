<?php
$members = function_exists('maiteam_get_members') ? maiteam_get_members() : array();
$emails  = array();

foreach ($members as $member) {
    if (!empty($member['email'])) {
        $emails[] = $member['email'];
    }
}

$socials = array(
    array(
        'name' => 'Facebook',
        'url'  => 'https://www.facebook.com/mark.lorence.loncion.2024',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.2 8.5V6.8c0-.7.5-1.1 1.2-1.1H17V3h-2.2C12.2 3 10.5 4.6 10.5 7.1v1.4H8.4V11h2.1v10h3.2V11h2.4l.4-2.5h-2.8z"/></svg>',
    ),
    array(
        'name' => 'TikTok',
        'url'  => 'https://www.tiktok.com/@hotdognipain',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.4 3c.4 2.5 1.9 4.2 4.3 4.5v2.6a7.2 7.2 0 0 1-4.1-1.3v6.7c0 3.4-2.7 5.9-6 5.9S2.6 18.9 2.6 15.5c0-3.3 2.6-5.8 5.8-5.9v2.7c-1.7.1-3 1.5-3 3.2 0 1.8 1.4 3.2 3.2 3.2s3.2-1.4 3.2-3.2V3h2.6z"/></svg>',
    ),
    array(
        'name' => 'Instagram',
        'url'  => 'https://www.instagram.com/shan.onlyme/',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4.5" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.8" cy="7.2" r="0.9" fill="currentColor"/></svg>',
    ),
    array(
        'name' => 'GitHub',
        'url'  => 'https://github.com/marklorenceloncion9-arch',
        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2C6.5 2 2 6.6 2 12.2c0 4.5 2.9 8.3 6.9 9.6.5.1.7-.2.7-.5v-1.7c-2.8.6-3.4-1.2-3.4-1.2-.5-1.1-1.1-1.4-1.1-1.4-.9-.6.1-.6.1-.6 1 .1 1.5 1 1.5 1 .9 1.6 2.4 1.1 3 .9.1-.7.4-1.1.6-1.4-2.2-.3-4.6-1.1-4.6-5 0-1.1.4-2 1-2.7-.1-.3-.4-1.3.1-2.7 0 0 .8-.3 2.8 1a9.5 9.5 0 0 1 5.1 0c1.9-1.3 2.7-1 2.7-1 .5 1.4.2 2.4.1 2.7.7.7 1.1 1.6 1.1 2.7 0 3.9-2.4 4.7-4.6 5 .4.3.7 1 .7 1.9v2.8c0 .3.2.6.7.5 4-1.3 6.9-5.1 6.9-9.6C22 6.6 17.5 2 12 2z"/></svg>',
    ),
);
?>

<section class="mai-contact" id="contact">

    <div class="mai-contact-heading">
        <p class="mai-eyebrow">SAY HELLO</p>
        <h2>CONTACT US</h2>
        <p class="mai-subtitle">A project, a class, or a question. The team is easy to reach.</p>
    </div>

    <div class="mai-contact-layout">

        <form class="mai-contact-form" data-mail="<?php echo esc_attr(implode(',', $emails)); ?>" novalidate>
            <p class="mai-contact-form-title">Write a message</p>

            <label class="mai-field">
                <span class="mai-field-body">
                    <span class="mai-field-label">Name</span>
                    <input type="text" name="name" autocomplete="name" required>
                </span>
            </label>

            <label class="mai-field">
                <span class="mai-field-body">
                    <span class="mai-field-label">Email</span>
                    <input type="email" name="email" autocomplete="email" required>
                </span>
            </label>

            <label class="mai-field">
                <span class="mai-field-body">
                    <span class="mai-field-label">Message</span>
                    <textarea name="message" rows="5" required></textarea>
                </span>
            </label>

            <p class="mai-contact-note" hidden></p>

            <button type="submit" class="mai-contact-send">SEND MESSAGE</button>
        </form>

        <aside class="mai-contact-side">
            <p class="mai-eyebrow">FIND US</p>
            <p class="mai-contact-side-copy">Facebook, TikTok, Instagram, and GitHub.</p>

            <div class="mai-socials">
                <?php foreach ($socials as $social) : ?>
                    <a class="mai-social" href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo $social['icon']; ?>
                        <span><?php echo esc_html($social['name']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

    </div>

    <?php if ($members) : ?>
        <p class="mai-eyebrow mai-contact-write">WRITE TO US</p>
        <ul class="mai-contact-people">
            <?php foreach ($members as $slug => $member) : ?>
                <li>
                    <button
                        type="button"
                        class="mai-contact-person"
                        data-name="<?php echo esc_attr($member['name']); ?>"
                        data-role="<?php echo esc_attr($member['role']); ?>"
                        data-phone="<?php echo esc_attr($member['phone']); ?>"
                        data-email="<?php echo esc_attr($member['email']); ?>"
                        data-portrait="<?php echo esc_url($member['portrait']); ?>"
                        data-more="<?php echo esc_url(home_url('/' . $slug . '/')); ?>"
                    >
                        <strong><?php echo esc_html($member['name']); ?></strong>
                        <span><?php echo esc_html($member['role']); ?></span>
                    </button>
                    <a href="mailto:<?php echo esc_attr($member['email']); ?>"><?php
                        $email_parts = explode('@', $member['email'], 2);
                        echo esc_html($email_parts[0]);
                        if (isset($email_parts[1])) {
                            echo '<wbr>@' . esc_html($email_parts[1]);
                        }
                    ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mai-contact-drawer" hidden>
            <button type="button" class="mai-contact-drawer-backdrop" aria-label="Close"></button>
            <aside class="mai-contact-drawer-panel" role="dialog" aria-modal="true" aria-labelledby="mai-contact-drawer-name">
                <button type="button" class="mai-contact-drawer-close" aria-label="Close">Close</button>
                <div class="mai-contact-drawer-top">
                    <img class="mai-contact-drawer-photo" alt="">
                </div>
                <p class="mai-eyebrow">TEAM</p>
                <h3 id="mai-contact-drawer-name"></h3>
                <p class="mai-contact-drawer-role"></p>
                <a class="mai-contact-drawer-phone" href="#"></a>
                <a class="mai-contact-drawer-email" href="#"></a>
                <a class="mai-contact-drawer-more" href="#">MORE INFO ↗</a>
            </aside>
        </div>
    <?php endif; ?>

</section>
