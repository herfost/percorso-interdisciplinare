<?php

/**
 * Performs a query on the database and print debug content in case of error
 *
 * @param mysqli $connection Procedural style only: A mysqli object returned by mysqli_connect() or mysqli_init()
 * @param string $query The query string.
 * @param string|bool $error_message Additional message for debbuing
 * @return bool|mysqli_result Returns `false` on failure. For successful queries which produce a result set, such as `SELECT, SHOW, DESCRIBE` or `EXPLAIN`, mysqli_query() will return a mysqli_result object. For other successful queries, mysqli_query() will return `true` .
 */
function mysqli_query_trace($connection, $query, string|bool $error_message = false): bool|mysqli_result
{
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        if ($error_message !== false) echo $error_message . PHP_EOL;
        echo mysqli_error($connection);
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    }

    return $result;
}

