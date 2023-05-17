<?php
session_start();
include_once __DIR__ . '/configuration.php';

# Connessione database
include_once __DIR__ . '/database/connection.php';

# Head della pagina
$title = 'Index';
include_once __DIR__ . '/components/head.php';

# Navbar
$links = $NAVBAR_LINKS;
include_once __DIR__ . '/components/navbar.php';

$result = select_all_sections('it');
$sections = mysqli_fetch_all($result);
include_once __DIR__ . '/components/sections.php';
?>

