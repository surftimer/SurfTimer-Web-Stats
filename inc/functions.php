<?php

function nav_active($nav_name) {
    global $page_name;
    if($nav_name == $page_name)
        return 'active';
};