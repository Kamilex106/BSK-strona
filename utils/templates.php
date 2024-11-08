<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function renderHeader($title = "Moderato - faster Allegro") {
    echo <<<HTML
<!DOCTYPE html>
<html lang='pl'>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LehA3QqAAAAAMrMdc554YLmQHRqNUprhO_AbbEy"></script>

    <script src='./js/search.js'></script>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1><a href='index.php'>Moderato</a></h1>
        <nav>
            <!-- Formularz wyszukiwania -->
            <form action="index.php" method="get">
                <input type="text" name="search" id="search" placeholder="Search..." value="">
                <button type="submit">Szukaj</button>
            </form>
            <a href="#" id="user-icon"><i class="fa fa-user"></i></a>
        </nav>
    </header>  
    <main>
HTML;
}


function renderFooter() {
    echo <<<HTML
</main>
<footer>
    <p>&copy; 2024 Moderato</p>
</footer>
</body>
</html>
HTML;
}

function renderProductList($category_name, $products) {
        // Display the category name
        echo "<h2>" . htmlspecialchars($category_name) . "</h2>";
        echo "<div class='product-list' data-category='" . htmlspecialchars($category_name) . "'>";

        // Display products under each category
        if ($products->num_rows > 0) {
            while ($product = $products->fetch_assoc()) {
                $product_id = htmlspecialchars($product["id"]);
                $product_name = htmlspecialchars($product["prodName"]);
                $product_price = htmlspecialchars($product["price"]);

                echo "<a href='product.php?id=$product_id' class='product-item'>
                        <img src='https://picsum.photos/200' alt='placeholder image'>
                        <h3>$product_name</h3>
                        <p>$product_price PLN</p>
                      </a>";
            }
        } else {
            echo "<p>No products in this category yet.</p>";
        }
        echo "</div>";

        echo "<div class='see-more'>
                <a href='category.php?category=" . urlencode($category_name) . "'>Show more</a>
              </div>";
}
?>