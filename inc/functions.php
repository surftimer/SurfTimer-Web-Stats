<?php

function nav_active($nav_name) {
    global $page_name;
    if($nav_name == $page_name)
        return 'active';
};

if($settings_language_enable):
    function language($language) {
        if($_SESSION['language'] == $language)
            return 'active';
    };
endif;