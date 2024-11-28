<?php

define( "IS_VITE_DEVELOPMENT", true ); // develop mode

// Initializing the Theme's Core Classes
require_once(__DIR__ . '/functions/class-my-theme.php');
$MT = new My_Theme();
$MT->init();

// Development mode only functions
if ( defined( 'IS_VITE_DEVELOPMENT') && IS_VITE_DEVELOPMENT === true ) {
    require_once(__DIR__ . '/functions/modules/dev.php');
}

// ------------------------------ ここから追加 ------------------------------