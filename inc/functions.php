<?php

function nav_active($nav_name): string
{
    global $page_name;
    if($nav_name == $page_name)
        return 'active';
    else
        return '';
}

function toCommunityID($id) {
    if (str_starts_with($id, 'STEAM_')) {
        $parts = explode(':', $id);
        return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
    } elseif (is_numeric($id) && strlen($id) < 16) {
        return bcadd($id, '76561197960265728');
    } else {
        return $id;
    }
}

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
}

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
}

function toUserID($id) {
    if (str_starts_with($id, 'STEAM_')) {
        $split = explode(':', $id);
        return $split[2] * 2 + $split[1];
    } elseif (str_starts_with($id, '765') && strlen($id) > 15) {
        return bcsub($id, '76561197960265728');
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
}

function toSteamID_NO_STEAM($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub($id, '76561197960265728'), '2');
    } elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); // Actually new User ID format
    } else {
        return $id; // We have no idea what this is, so just return it.
    }
    $y = bcmod($id, '2');
    return $y . ':' . floor($z);
}

function CountryFlag($country, $country_flag, $continent_flag): string
{
    if(!empty($country_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/'.strtolower($country_flag).'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/continents/'.strtolower($continent_flag).'.svg"/>';
    else
        return '<img class="bg-transparent border" title="'.$country.'" height="16" src="./images/flags/unknown.svg"/>';
}

function CountryFlagProfile($countryCode, $continentCode): string
{
    if(!empty($countryCode))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/'.strtolower($countryCode).'.svg"/>';
    elseif(!empty($continent_flag))
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/continents/'.strtolower($continentCode).'.svg"/>';
    else
        return '<img class="rounded border bg-transparent shadow-sm mb-1" height="20" src="./images/flags/unknown.svg" alt="Unknown FLag"/>';
}


function LinkColor(): string
{
    global $settings_link_color;
    if($settings_link_color==='')
        return 'link-secondary';
    else
        return $settings_link_color;
}

$LinkColor = LinkColor();

function PlayerUsernameProfile($player_steamid64, $player_name): string
{
    global $settings_player_profile_icon, $LinkColor;

    if($player_name=='          ' || $player_name==''){
        $player_name = '<span class="text-muted">(Unknown)</span>';
        $player_name_title = '(Unknown)'; 
    } else 
        $player_name_title = $player_name;
        
    if($settings_player_profile_icon)
        return $player_name.' <a href="dashboard-player.php?id='.$player_steamid64.'" target="" title="'.$player_name_title.' - Surf Profile" class="link-secondary text-decoration-none"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/'.$player_steamid64.'" target="_blank" title="'.$player_name_title.' - Steam Profile" class="link-secondary text-decoration-none"><i class="fab fa-steam"></i></a>';
    else
        return  '<a href="dashboard-player.php?id='.$player_steamid64.'" title="'.$player_name_title.' - Surf Profile" class="'.$LinkColor.' text-decoration-none">'.$player_name.'</a>';
}

function MapPageLink($map_name): string
{
    global $settings_map_link_icon, $LinkColor;
    if($settings_map_link_icon)
            return  $map_name.' <a href="dashboard-maps.php?map='.$map_name.'" title="'.$map_name.' - Map Page" class="link-secondary text-decoration-none"><i class="fas fa-link"></i></a>';
            
        else
            return '<a href="dashboard-maps.php?map='.$map_name.'" title="'.$map_name.' - Map Page" class="'.$LinkColor.' text-decoration-none">'.$map_name.'</a>';
}

function BackgroundImage(): string
{
    global $settings_background_image;

    if($settings_background_image=='')
        return 'surf-images/'.date('N', strtotime(date('l'))).'.jpg';
    else 
        return $settings_background_image;
}

if($settings_language_enable):
    function LanguageActive($language): string
    {
        if($_SESSION['language'] == $language)
            return 'active';
        else
            return '';
    }

    function LanguageFlag(): string
    {
        if($_SESSION['language'] == 'Czech')
            return 'cz';
        elseif($_SESSION['language'] == 'English')
            return 'gb';
        elseif($_SESSION['language'] == 'German')
            return 'de';
        elseif($_SESSION['language'] == 'Slovak')
            return 'sk';
        elseif($_SESSION['language'] == 'Portuguese')
            return 'pt';
        elseif($_SESSION['language'] == 'French')
            return 'fr';
        elseif($_SESSION['language'] == 'Turkish')
            return 'tr';
        elseif($_SESSION['language'] == 'Danish')
            return 'dk';
        elseif($_SESSION['language'] == 'Korean')
            return 'kr';
        elseif($_SESSION['language'] == 'Spanish')
            return 'es';
	    elseif($_SESSION['language'] == 'Swedish')
		    return 'se';
        else
            return 'gb';
    }

    function LanguageURL($language): string
    {
        if(isset($_GET['map'])||isset($_GET['id']))
            return $_SERVER['REQUEST_URI'].'&language='.$language;
        else
            return '?language='.$language;
    }
    endif;

    function MapDownload($map_name): string
    {
        global $settings_maps_download_url;

        if($settings_maps_download_url!==''):
            $url = $settings_maps_download_url.$map_name.'.bsp.bz2';
        
            $file_headers = @get_headers($url);
            if(str_contains($file_headers[0], '200')){
                return ' <a href="'.$url.'" class="link-secondary text-decoration-none" title="Download map: '.$map_name.'"><i class="fa-solid fa-download"></i></a>';
            } else {
                $url = $settings_maps_download_url . $map_name . '.bsp';
                $file_headers = @get_headers($url);
                if (str_contains($file_headers[0], '200'))
                    return ' <a href="' . $url . '" class="link-secondary text-decoration-none" title="Download map: ' . $map_name . '"><i class="fa-solid fa-download"></i></a>';
                else return '';
            }
        else:
            return '';
        endif;
    }


    function MapPreviewImage($map_name): string
    {
        global $settings_map_image_preview;
        $images_source_url = "https://raw.githubusercontent.com/Sayt123/SurfMapPics/Maps-and-bonuses/csgo/";

        if($settings_map_image_preview === TRUE):
            return '<img src="'.$images_source_url.$map_name.'.jpg" class="img-fluid" alt="'.$map_name.' - Preview Image">';
        else:
            return '';
        endif;
    }
