<?php

function maiteam_img($file) {
    $uploads = wp_upload_dir();
    return $uploads['baseurl'] . '/2026/11/' . $file;
}

function maiteam_theme_img($file) {
    return get_template_directory_uri() . '/assets/img/' . $file;
}

function maiteam_hover_head() {
    return maiteam_theme_img('hover-head.svg');
}

function maiteam_get_members() {
    return array(
        'mark-lorence' => array(
            'name'      => 'Mark Lorence Loncion',
            'role'      => 'Programmer',
            'age'       => '22',
            'birthdate' => 'March 5, 2004',
            'address'   => 'Gusa, Bonbon, Opol',
            'school'    => array(
                'elementary'  => array(
                    'name' => 'Opol Central School',
                    'logo' => maiteam_theme_img('loncion/elementary.png'),
                ),
                'high_school' => array(
                    'name' => 'Opol National Secondary Technical School',
                    'logo' => maiteam_theme_img('loncion/high_school.png'),
                ),
                'college'     => array(
                    'name' => 'Opol Community College',
                    'logo' => maiteam_theme_img('loncion/college.png'),
                ),
            ),
            'phone'     => '09386926535',
            'email'     => 'marklorenceloncion9@gmail.com',
            'portrait'  => maiteam_img('Professional-ID-Portrait-on-White-Background.png'),
            'hover'     => maiteam_theme_img('loncion-spiderman.png'),
            'dreams'    => 'I want to grow into a software engineer who builds tools people actually love to use - clean systems, honest work, and a life where code makes people live better and easier. I also want to be a WEB DEVELOPER and GAME DEVELOPER',
            'favorites' => array(
                array('src' => maiteam_theme_img('loncion/loncion-fav-01.jpg'), 'label' => 'Championnn'),
                array('src' => maiteam_theme_img('loncion/loncion-fav-02.jpg'), 'label' => 'Bridge days'),
                array('src' => maiteam_theme_img('loncion/loncion-fav-03.jpg'), 'label' => 'Close frame'),
                array('src' => maiteam_theme_img('loncion/loncion-fav-04.jpg'), 'label' => 'CAPSTONE DEFENDED'),
                array('src' => maiteam_theme_img('loncion/loncion-fav-05.jpg'), 'label' => 'Waterfall calm'),
            ),
            'one_only'  => array(
                'src'     => maiteam_theme_img('loncion/loncion-one-only.png'),
                'caption' => 'The one that stays - red walls, peace signs, and a heart made together.',
            ),
        ),
        'honey-rose' => array(
            'name'      => 'Honey Rose Rivera',
            'role'      => 'Technical Writer',
            'age'       => '22',
            'birthdate' => 'October 17, 2004',
            'address'   => 'Gusa, Bonbon, Opol',
            'school'    => array(
                'elementary'  => array(
                    'name' => 'Igpit Elementary School',
                    'logo' => maiteam_theme_img('rivera/elementary.png'),
                ),
                'high_school' => array(
                    'name' => 'Opol National Secondary Technical School',
                    'logo' => maiteam_theme_img('rivera/high_school.png'),
                ),
                'college'     => array(
                    'name' => 'Opol Community College',
                    'logo' => maiteam_theme_img('rivera/college.png'),
                ),
            ),
            'phone'     => '+63 917 000 0002',
            'email'     => 'honey.rivera@maiteam.group',
            'portrait'  => maiteam_img('Professional-Portrait-on-White-Background.png'),
            'hover'     => maiteam_theme_img('rivera-spidergwen.png'),
            'dreams'    => 'I want to write words that make complex ideas feel simple - stories, manuals, and messages that help people understand, feel, and move forward.',
            'favorites' => array(
                array('src' => maiteam_theme_img('rivera/rivera-fav-01.jpg'), 'label' => 'Waterfall view'),
                array('src' => maiteam_theme_img('rivera/rivera-fav-02.jpg'), 'label' => 'Love in the sand'),
                array('src' => maiteam_theme_img('rivera/rivera-fav-03.jpg'), 'label' => 'Friends by the falls'),
                array('src' => maiteam_theme_img('rivera/rivera-fav-04.jpg'), 'label' => 'Sunset shore'),
                array('src' => maiteam_theme_img('rivera/rivera-fav-05.jpg'), 'label' => 'Golden hour'),
            ),
            'one_only'  => array(
                'src'     => maiteam_theme_img('rivera/rivera-one-only.png'),
                'caption' => 'The one that stays - a quiet smile beside someone who feels like home.',
            ),
        ),
        'qeeundilyn' => array(
            'name'      => 'Qeeundilyn Castil',
            'role'      => 'System Analyst',
            'age'       => '27',
            'birthdate' => 'June 1, 1999',
            'address'   => 'Luyong Bonbon, Opol',
            'school'    => array(
                'elementary'  => array(
                    'name' => 'Manduao Elementary School',
                    'logo' => maiteam_theme_img('castil/elementary.png'),
                ),
                'high_school' => array(
                    'name' => 'Camiguin National High School',
                    'logo' => maiteam_theme_img('castil/high_school.png'),
                ),
                'college'     => array(
                    'name' => 'Opol Community College',
                    'logo' => maiteam_theme_img('loncion/college.png'),
                ),
            ),
            'phone'     => '09226735510',
            'email'     => 'castil.queendilyn@gmail.com',
            'portrait'  => maiteam_img('Professional-Business-Headshot.png'),
            'hover'     => maiteam_theme_img('castil-starfire.png'),
            'dreams'    => 'A healthy body and a successful business owner.',
            'favorites' => array(
                array('src' => maiteam_theme_img('castil/castil-fav-01.jpg'), 'label' => 'Peace sign'),
                array('src' => maiteam_theme_img('castil/castil-fav-02.jpg'), 'label' => 'Snack stop'),
                array('src' => maiteam_theme_img('castil/castil-fav-03.jpg'), 'label' => 'Side by side'),
                array('src' => maiteam_theme_img('castil/castil-fav-04.jpg'), 'label' => 'Red lanterns'),
                array('src' => maiteam_theme_img('castil/castil-fav-05.jpg'), 'label' => 'Family day'),
            ),
            'one_only'  => array(
                'src'     => maiteam_theme_img('castil/castil-one-only.jpg'),
                'caption' => 'The one that stays - a shared smile under the orange roof.',
            ),
        ),
        'michelou' => array(
            'name'      => 'Michelou Maglangit',
            'role'      => 'Project Manager',
            'age'       => '22',
            'birthdate' => 'September 21, 2004',
            'address'   => 'Zone 4, Malanang, Opol, Mis. Or.',
            'school'    => array(
                'elementary'  => array(
                    'name' => 'Malanang Elementary School',
                    'logo' => maiteam_theme_img('maglangit/elementary.png'),
                ),
                'high_school' => array(
                    'name' => 'Opol National Secondary Technical School',
                    'logo' => maiteam_theme_img('loncion/high_school.png'),
                ),
                'college'     => array(
                    'name' => 'Opol Community College',
                    'logo' => maiteam_theme_img('loncion/college.png'),
                ),
            ),
            'phone'     => '09941469123',
            'email'     => 'mitchirlou6@gmail.com',
            'portrait'  => maiteam_img('Professional-CV-Portrait.png'),
            'hover'     => maiteam_theme_img('maglangit/maglangit-wonderwoman.png'),
            'dreams'    => 'Military.',
            'favorites' => array(
                array('src' => maiteam_theme_img('maglangit/maglangit-fav-01-mall.jpg'), 'label' => 'Mall light'),
                array('src' => maiteam_theme_img('maglangit/maglangit-fav-02-florals.jpg'), 'label' => 'Soft florals'),
                array('src' => maiteam_theme_img('maglangit/maglangit-fav-03-family.jpg'), 'label' => 'Family days'),
                array('src' => maiteam_theme_img('maglangit/maglangit-fav-04-blue-m.jpg'), 'label' => 'Blue M days'),
                array('src' => maiteam_theme_img('maglangit/maglangit-fav-05-divine-mercy.jpg'), 'label' => 'Sacred steps'),
            ),
            'one_only'  => array(
                'src'     => maiteam_theme_img('maglangit/maglangit-one-only.jpg'),
                'caption' => 'The one moment that stays - caps, blooms, and a proud smile on graduation day.',
            ),
        ),
    );
}

function maiteam_get_member($slug) {
    $members = maiteam_get_members();
    return isset($members[$slug]) ? $members[$slug] : null;
}
