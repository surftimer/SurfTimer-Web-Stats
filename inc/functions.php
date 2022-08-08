<?php

function nav_active($nav_name) {
    global $page_name;
    if($nav_name == $page_name)
        return 'active';
}

function toCommunityID($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $parts = explode(':', $id);
        return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
    } elseif (is_numeric($id) && strlen($id) < 16) {
        return bcadd($id, '76561197960265728');
    } else {
        return $id;
    }
};
function toSteamID($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return 'STEAM_1:' . $y . ':' . floor($z);
};

function toSteamID_NULL($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return 'STEAM_0:' . $y . ':' . floor($z);
};

function toUserID($id) {
    if (preg_match('/^STEAM_/', $id)) {
        $split = explode(':', $id);
        return $split[2] * 2 + $split[1];
    } elseif (preg_match('/^765/', $id) && strlen($id) > 15) {
        return bcsub($id, '76561197960265728');
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
};

function toSteamID_NO_STEAM($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return '' . $y . ':' . floor($z);
};

function CountryFlag($country, $country_flag, $continent_flag) {
    if(!empty($country_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/'.$country_flag.'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/continents/'.$continent_flag.'.svg"/>';
    else
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/unknown.svg"/>';
}

function CountryFlagProfile($countryCode, $continentCode) {
    if(!empty($countryCode))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/'.$countryCode.'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/continents/'.$continentCode.'.svg"/>';
    else
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/unknown.svg"/>';
}
