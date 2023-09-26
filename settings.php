<?php
/*
    File: settings.php

    Author: Jack "Scarso" Farhall

    Description / Purpose:
    Holds & returns all system configuraiton.
*/
return array(
    'site-name' => 'Faction Database', // This is the name of our website. E.g. Microsoft or Apple or Steam.
    'sub-directory' => 'public', // Required if the site is not in the root folder.
    'version' => '1', // Holds framework version. Literally pointless...
    'db-type' => 'mysql', // We assume you're using the same type for both databases...
    'db-host' => array('localhost','localhost'), // Key 0 = Life Server Database, Key 1 = Web Server Database
    'db-name' => array('altislife_v2','factions_manager'), // Key 0 = Life Server Database, Key 1 = Web Server Database
    'db-user' => array('root','root'), // Key 0 = Life Server Database, Key 1 = Web Server Database
    'db-pass' => array('',''), // Key 0 = Life Server Database, Key 1 = Web Server Database
    'db-set' => 'utf8', // We assume you're using the same set for both databases...
    'db-player-table' => 'players',
    // The forums url is designed to work with IPB as it puts the forumid-name in the url. If you have any other forum software you maybe required to alter code.
    'forums-url' => '', // If blank no stats links will appear Format: https://example.com/forums/profile/{forumid} (forumid will be replaced with their forumid-name...)
    'stats-url' => '', // If blank no stats links will appear Format: https://example.com/stats/{steamid} (Steamid will be replaced with their steamid...)
    'steam-key' => '0995ADC322DCBDC3472EBA6D738DF20E'
);
?>