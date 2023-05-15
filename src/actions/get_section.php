<?php
include_once '/../database/connection.php';

$id = $_POST['id'];
$language = $_POST['language'];

$result = select_section($id, 'it');

if ($result)
    echo json_encode(array('name' => 'joebiden'));