<?php
$languages = array(
    array(
        'name' => 'CSS',
        'file' => 'hello.css',
        'preview' => 'swatch',
        'text' => 'Styles how a page looks. It sets color, layout, spacing, and motion.',
        'code' => "h1 {\n    color: white;\n    letter-spacing: 2px;\n}",
        'output' => 'Hello',
    ),
    array(
        'name' => 'Python',
        'file' => 'hello.py',
        'preview' => '',
        'text' => 'Writes scripts and small tools. It can automate tasks and work with data.',
        'code' => "name = \"MAITEAM\"\nprint(\"Hello, \" + name)",
        'output' => 'Hello, MAITEAM',
    ),
    array(
        'name' => 'JavaScript',
        'file' => 'hello.js',
        'preview' => '',
        'text' => 'Runs in the browser. It responds to clicks and updates a page without a reload.',
        'code' => "const name = \"MAITEAM\";\nconsole.log(\"Hello, \" + name);",
        'output' => 'Hello, MAITEAM',
    ),
    array(
        'name' => 'PHP',
        'file' => 'hello.php',
        'preview' => '',
        'text' => 'Builds pages on the server. It can read forms and pull data before the page is sent.',
        'code' => "<?php\n\$name = \"MAITEAM\";\necho \"Hello, \" . \$name;",
        'output' => 'Hello, MAITEAM',
    ),
    array(
        'name' => 'HTML',
        'file' => 'hello.html',
        'preview' => '',
        'text' => 'Gives a page its structure. It holds the headings, text, images, and links.',
        'code' => "<h1>Hello, MAITEAM</h1>\n<p>Four people. One team.</p>",
        'output' => "Hello, MAITEAM\nFour people. One team.",
    ),
    array(
        'name' => 'React Native',
        'file' => 'Hello.js',
        'preview' => '',
        'text' => 'Builds phone apps. It can show screens, lists, and buttons on a mobile device.',
        'code' => "function Hello() {\n    return <Text>Hello, MAITEAM</Text>;\n}",
        'output' => 'Hello, MAITEAM',
    ),
    array(
        'name' => 'React CLI',
        'file' => 'App.js',
        'preview' => 'heading',
        'text' => 'Starts a React web app. It sets up the project so pages and components stay organized.',
        'code' => "function App() {\n    const name = \"MAITEAM\";\n    return <h1>Hello, {name}</h1>;\n}",
        'output' => 'Hello, MAITEAM',
    ),
    array(
        'name' => 'MySQL',
        'file' => 'hello.sql',
        'preview' => '',
        'text' => 'Stores data in tables. It can save records and return them when an app asks.',
        'code' => "SELECT 'Hello' AS greeting,\n       'MAITEAM' AS team;",
        'output' => "Hello\nMAITEAM",
    ),
    array(
        'name' => 'SQL',
        'file' => 'team.sql',
        'preview' => '',
        'text' => 'Asks a database questions. It can select, add, update, and remove stored data.',
        'code' => "SELECT name, role\nFROM team\nWHERE role = 'Programmer';",
        'output' => "Mark Lorence Loncion\nProgrammer",
    ),
    array(
        'name' => 'Java',
        'file' => 'Hello.java',
        'preview' => '',
        'text' => 'Builds larger programs. It keeps logic organized and can run full applications.',
        'code' => "String name = \"MAITEAM\";\nSystem.out.println(\"Hello, \" + name);",
        'output' => 'Hello, MAITEAM',
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
                    data-file="<?php echo esc_attr($language['file']); ?>"
                    data-preview="<?php echo esc_attr($language['preview']); ?>"
                >
                    <span class="mai-language-name"><?php echo esc_html($language['name']); ?></span>
                </button>
                <template>
                    <pre><?php echo esc_html($language['code']); ?></pre>
                    <span><?php echo esc_html($language['output']); ?></span>
                </template>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mai-language-zoom" hidden>
        <button type="button" class="mai-language-zoom-backdrop" aria-label="Close language"></button>
        <div class="mai-language-zoom-card" role="dialog" aria-modal="true">
            <p class="mai-eyebrow">LANGUAGE</p>
            <h3></h3>
            <p class="mai-language-zoom-text"></p>
            <div class="mai-language-editor">
                <div class="mai-language-editor-bar">
                    <span class="mai-language-file"></span>
                    <button type="button" class="mai-language-run">RUN</button>
                </div>
                <pre class="mai-language-code"></pre>
            </div>
            <div class="mai-language-result">
                <p class="mai-eyebrow">OUTPUT</p>
                <p class="mai-language-out"></p>
            </div>
        </div>
    </div>

</section>
