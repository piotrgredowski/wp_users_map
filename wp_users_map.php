<?php

/**
 * Plugin Name: Users Map
 * Plugin URI: https://github.com/piotrgredowski/wp_users_map
 * Description: This is the very first plugin I ever created.
 * Version: 1.0
 * Author: Piotr Grędowski
 * Author URI: https://github.com/piotrgredowski
 **/
add_shortcode('users_map', 'users_map');

function users_map()
{
    $users = get_users();
    $code = do_shortcode('[leaflet-map address="Polska" zoom="6" zoomcontrol scrollwheel height="500px"]');

    foreach ($users as $user) {
        if (is_user_logged_in()) {
            $code .= do_shortcode(sprintf('[leaflet-marker address="%s"]<p><a href="%s"><button>Zobacz profil <b>%s</b></button></a></p>[/leaflet-marker]', $user->location, get_site_url() . '/user/' . $user->user_login, $user->user_login));
        } else {
            $code .= do_shortcode(sprintf('[leaflet-marker address="%s"]Zaloguj się aby zobaczyć dane użytkownika[/leaflet-marker]', $user->location));
        }
    }

    return $code;
}
