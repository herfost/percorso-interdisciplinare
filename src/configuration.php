<?php
$PROJECTFOLDER_NAME = 'percorso-interdisciplinare-refactor';
$SERVER_NAME = 'database';
$HOST_NAME = 'root';
$PASSWORD = $_ENV['MYSQL_ROOT_PASSWORD'];
$DB_NAME = 'percorso_interdisciplinare_db';

# Direcoties
$BASE_URL = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST'] . '/' . $PROJECTFOLDER_NAME;
$SRC_URL = $BASE_URL . '/src';
$PAGE_DIR = $SRC_URL . '/pages';
$DATABASE_DIR = $SRC_URL . '/database';
$COMPONENT_DIR = $SRC_URL . '/components';

$DB_CONNECTION = $DATABASE_DIR . '/connection.php';

$NAVBAR_COMPONENT = $COMPONENT_DIR . '/navbar.php';
$HEAD_COMPONENT = $COMPONENT_DIR . '/head.php';

$UTILITY = $SRC_URL . '/utility.php';

# Pages
$HOME = array(
    'href' => $SRC_URL . '/index.php',
    'name' => 'Home'
);

$LOGIN = array(
    'href' => $SRC_URL . '/login.php',
    'name' => 'Login'
);

# Navbar
$NAVBAR_LINKS = array($HOME);