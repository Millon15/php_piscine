<?php
	include('main.php');

	$id_ord = rand(0, 2147483647);
	start_session();
	foreach ($users as $val) {
		if ($val['login'] == $_SESSION['loggued_on_user']) {
			$sql = "INSERT INTO orders (id_ord, username, email, address)
			VALUES ($id_ord, '" . $val['username'] . "', '" . $val['email'] . "', '" . $val['address'] . "')";
			if (!mysqli_query($conn, $sql)) {
				die("Error filling users: " . mysqli_error($conn));
			}
			break ;
		}
	}

	$ord_name = "orderNo_$id_ord";

	$sql = "CREATE TABLE $ord_name (
		id_ord INT(11) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(255) NOT NULL,
		price VARCHAR(255) NOT NULL,
		quantity INT(11) NOT NULL
	)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating order: " . mysqli_error($conn));
	}

	foreach($_SESSION['cart'] as $key => $value) {
		$title = $products[$key]['title'];
		$price = $products[$key]['price'];
		$quantity = $_SESSION['cart'][$key]['quantity'];
		
		$sql = "INSERT INTO $ord_name (id_ord, title, price, quantity)
		VALUES ($id_ord, '$title', '$price', $quantity)";
		!mysqli_query($conn, $sql);
	}
?>