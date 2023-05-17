<?php
header('Content-Type: application/json');

$content = file_get_contents('php://input');
$json = json_decode($content, true);

include_once './database/connection.php';
$result = get_section($json['id'], $json['language']);

exit(json_encode($result));
