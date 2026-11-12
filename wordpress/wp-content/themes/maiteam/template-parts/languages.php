<?php
$languages = array(
    array(
        'name' => 'CSS',
        'text' => 'Styles how a page looks. It sets color, layout, spacing, and motion.',
    ),
    array(
        'name' => 'Python',
        'text' => 'Writes scripts and small tools. It can automate tasks and work with data.',
    ),
    array(
        'name' => 'JavaScript',
        'text' => 'Runs in the browser. It responds to clicks and updates a page without a reload.',
    ),
    array(
        'name' => 'PHP',
        'text' => 'Builds pages on the server. It can read forms and pull data before the page is sent.',
    ),
    array(
        'name' => 'HTML',
        'text' => 'Gives a page its structure. It holds the headings, text, images, and links.',
    ),
    array(
        'name' => 'React Native',
        'text' => 'Builds phone apps. It can show screens, lists, and buttons on a mobile device.',
    ),
    array(
        'name' => 'React CLI',
        'text' => 'Starts a React web app. It sets up the project so pages and components stay organized.',
    ),
    array(
        'name' => 'MySQL',
        'text' => 'Stores data in tables. It can save records and return them when an app asks.',
    ),
    array(
        'name' => 'SQL',
        'text' => 'Asks a database questions. It can select, add, update, and remove stored data.',
    ),
    array(
        'name' => 'Java',
        'text' => 'Builds larger programs. It keeps logic organized and can run full applications.',
    ),
);
?>

<section class="mai-languages" id="mai-languages">

    <div class="mai-languages-heading">
        <p class="mai-eyebrow">WHAT WE STUDY</p>
        <h2>LANGUAGES</h2>
        <p class="mai-subtitle">The languages we learn and build with.</p>
    </div>

    <ul class="mai-language-list">
        <?php foreach ($languages as $language) : ?>
            <li class="mai-language">
                <button
                    type="button"
                    class="mai-language-face"
                    data-name="<?php echo esc_attr($language['name']); ?>"
                    data-text="<?php echo esc_attr($language['text']); ?>"
                >
                    <span class="mai-language-name"><?php echo esc_html($language['name']); ?></span>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mai-language-zoom" hidden>
        <button type="button" class="mai-language-zoom-backdrop" aria-label="Close language"></button>
        <div class="mai-language-zoom-card" role="dialog" aria-modal="true">
            <p class="mai-eyebrow">LANGUAGE</p>
            <h3></h3>
            <p class="mai-language-zoom-text"></p>
        </div>
    </div>

</section>
