<?php

include_once __DIR__ . '/../configuration.php';
include_once __DIR__ . '/../utility.php';
include_once __DIR__ . '/connection.php';
include_once __DIR__ . '/query.php';

mysqli_query_trace($connection, $CRAETE_DATABASE_QUERY, 'Unable to create database: ' . $DB_NAME);
mysqli_select_db($connection, $DB_NAME);
mysqli_query_trace($connection, sprintf($CREATE_TABLE_SECTION_QUERY, 'it'), 'Unable to create table: sections_it');
mysqli_query_trace($connection, sprintf($CREATE_TABLE_SECTION_QUERY, 'en'), 'Unable to create table: sections_en');
mysqli_query_trace($connection, $CREATE_TABLE_IMAGE_QUERY, 'Unable to table: images');