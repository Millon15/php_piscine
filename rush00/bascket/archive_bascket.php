<?php
	include('../main.php');
	start_session();
	$super_total = 0;
	foreach($_SESSION['cart'] as $key => $value) {
		$quantity = $_SESSION['cart'][$key]['quantity'];
		$title = $products[$key]['title'];
		$price = $products[$key]['price'];
		$total_price = $quantity * $price;
	}
?>