<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once './utils/env.php';
include_once './utils/search.php';
include_once './utils/templates.php';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_term = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
}

// Jeśli jest wyszukiwanie, wywołaj wyszukiwanie z bazy danych
if (!empty($search_term)) {
    $search_sql = "SELECT * FROM products WHERE prodName LIKE ?";
    $stmt = $conn->prepare($search_sql);
    $search_value = "%" . $search_term . "%";
    $stmt->bind_param("s", $search_value);
    $stmt->execute();
    $search_result = $stmt->get_result();
    $stmt->close();
}

renderHeader("Moderato - Home");

if (!empty($search_term)) {
    // Jeśli jest wyszukiwanie, wyświetl wyniki
    if ($search_result->num_rows > 0) {
        echo "<h2>Wyniki wyszukiwania dla: " . htmlspecialchars($search_term) . "</h2>";
        echo "<ul>";
        while ($row = $search_result->fetch_assoc()) {
            echo "<li><a href='product.php?id=" . htmlspecialchars($row["id"]) . "'>" . 
                 htmlspecialchars($row["prodName"]) . " - " . 
                 htmlspecialchars($row["price"]) . " PLN</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Brak produktów odpowiadających zapytaniu.</p>";
    }
} else {
    // Jeśli nie ma wyszukiwania, wyświetl rekomendowane produkty i kategorie
    $recommended_sql = "SELECT * FROM products LIMIT 4";
    $recommended_result = $conn->query($recommended_sql);
    if (!$recommended_result) {
        die("Query failed: " . $conn->error);
    }


    // Query to get categories
    $categories_sql = "SELECT DISTINCT c.id, c.catName FROM categories c 
                        JOIN products p ON c.id = p.category";
    $categories_result = $conn->query($categories_sql);
    if (!$categories_result) {
        die("Query failed: " . $conn->error);
    }

    if ($categories_result->num_rows > 0) {
        // Wyświetlanie produktów według kategorii
        while ($category_row = $categories_result->fetch_assoc()) {
            $category_id = $category_row['id'];
            $category_name = $category_row['catName'];

            $products_sql = "SELECT * FROM products WHERE category = '$category_id'";
            $products_result = $conn->query($products_sql);
            if (!$products_result) {
                echo "<p>Error fetching products for category '" . htmlspecialchars($category_name) . "': " . $conn->error . "</p>";
                continue;
            }

            renderProductList($category_name, $products_result);
        }
    } else {
        echo "<p>Brak kategorii produktów.</p>";
    }
}

renderFooter();
$conn->close();
?>
