<?php
const DB_HOST = "localhost";
const DB_USERNAME= "root";
const DB_PASSWORD = "";
const DB_NAME = "mewad-haweli";

// Data Source Name
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

$options = [
    PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //make the default fetch be an anonymous object with column names as properties
];

//Create PDO instance
try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>