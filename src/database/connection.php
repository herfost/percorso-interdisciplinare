<?php
include_once __DIR__ . '/../configuration.php';
include_once __DIR__ . '/../utility.php';
include_once __DIR__ . '/query.php';

$connection = mysqli_connect($SERVER_NAME, $HOST_NAME, $PASSWORD, null);

if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if (!mysqli_select_db($connection, $DB_NAME))
    include_once __DIR__ . '/database_setup.php';


function select_all_sections($language = 'it') {
    global $connection, $SELECT_ALL_SECTIONS_QUERY;
    $query = sprintf($SELECT_ALL_SECTIONS_QUERY, $language, $language, $language, $language, $language, $language);
    return mysqli_query_trace($connection, $query, 'Unable to select sections_' . $language);
}

function select_section($id, $language = 'it') {
    global $connection, $SELECT_SECTION_QUERY;
    $query = sprintf($SELECT_SECTION_QUERY, $language, $language, $language, $language, $language, $language, $id);
    return mysqli_query_trace($connection, $query, 'Unable to select sections_' . $language . ': ' . $id);
}

function get_section($id, $language = 'it') {
    $result = select_section($id, $language);
    return mysqli_fetch_assoc($result);
}