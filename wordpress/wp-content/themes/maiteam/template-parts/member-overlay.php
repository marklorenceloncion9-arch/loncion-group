<?php
$members = maiteam_get_members();
?>

<div class="mai-member-overlay" id="mai-member-overlay" hidden>
    <?php foreach ($members as $slug => $member) : ?>
        <?php get_template_part('template-parts/member-panel', null, array(
            'slug'   => $slug,
            'member' => $member,
        )); ?>
    <?php endforeach; ?>
</div>
