<?php
include_once __DIR__ . '/connection.php';
include_once __DIR__ . '/../configuration.php';

$CRAETE_DATABASE_QUERY = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME;

$CREATE_TABLE_SECTION_QUERY = 'CREATE TABLE IF NOT EXISTS `sections_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_id` int(11) unsigned NOT NULL,
    `heading` VARCHAR(255) NOT NULL,
    `paragraph` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`image_id`) REFERENCES images(`id`)
)';

$CREATE_TABLE_IMAGE_QUERY = 'CREATE TABLE IF NOT EXISTS `images` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `src` VARCHAR(255) NOT NULL
)';

$INSERT_SECTIONS_QUERY = "INSERT INTO sections_%s ('image_id', 'heading', 'paragraph') VALUES ('%s', '%s', '%s')";
$INSERT_IMAGES_QUERY = "INSERT INTO images ('src') VALUES ('%s')";

$SELECT_SECTION_QUERY = "SELECT sections_%s.id, sections_%s.heading, sections_%s.paragraph, images.src FROM sections_%s, images WHERE sections_%s.image_id = images.id AND sections_%s.id = %s";
$SELECT_ALL_SECTIONS_QUERY = "SELECT sections_%s.id, sections_%s.heading, sections_%s.paragraph, images.src FROM sections_%s, images WHERE sections_%s.image_id = images.id";

$SELECT_IMAGES_QUERY = "SELECT * FROM images WHERE id = %s";