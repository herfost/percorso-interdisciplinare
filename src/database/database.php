<?php
$QUERY_CREATE_TABLE_SECTION = 'CREATE TALBE IF NOT EXISTS `section_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `heading` VARCHAR(255) NOT NULL
)';

$QUERY_CREATE_TABLE_PARAGRAPH = 'CREATE TALBE IF NOT EXISTS `paragraph_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `section_id` int(11) unsigned NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `section_id` FOREIGN KEY (section_id) REFERENCES section_%s(id)
)';

$QUERY_CREATE_TABLE_IMAGE = 'CREATE TALBE IF NOT EXISTS `image` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `section_id` int(11) unsigned NOT NULL,
    `section_id` FOREIGN KEY (section_id) REFERENCES section_%s(id)
)';

$QUERY_SELECT_SECTIONS = 'SELECT * FROM `section_%s`';
$QUERY_SELECT_SECTION = 'SELECT * FROM `section_%s` s WHERE `s.section_id` = %d';

$QUERY_SELECT_PARAGRAPHS_BY_SECTION_ID = 'SELECT * FROM `paragraph_%s` p WHERE `p.section_id` = %d';

sprintf($QUERY_CREATE_TABLE_SECTION, 'it');
sprintf($QUERY_CREATE_TABLE_SECTION, 'en');

sprintf($QUERY_CREATE_TABLE_PARAGRAPH, 'it', 'it');
sprintf($QUERY_CREATE_TABLE_PARAGRAPH, 'en', 'en');

sprintf($QUERY_CREATE_TABLE_IMAGE, 'it');