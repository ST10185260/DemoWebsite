<?php 

include("connection.php");


$stmt = $conn->prepare("SELECT * FROM products where product_category='Other' LIMIT 4" );

$stmt->execute();

$featured_products2 = $stmt->get_result();

