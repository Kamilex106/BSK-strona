<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'env.php';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_term = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];

    // Zapytanie SQL, które używa LIKE w celu dopasowania do produktu
    $sql = "SELECT * FROM products WHERE prodName LIKE ?";
    $stmt = $conn->prepare($sql);

    // Przygotowanie wartości wyszukiwania
    $search_value = "%" . $search_term . "%";
    $stmt->bind_param("s", $search_value);

}

$conn->close();
?>
