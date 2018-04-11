<?php
	// Берём данные о БД из shopdb.csv
	$cont = file_get_contents('../shopdb.csv');
	if (!$cont) {
		header('Location: ../setup.html');
	}
	$cont = explode(';', $cont);

	// Подключаемся к mysql
	$conn = mysqli_init();
	if (!$conn) {
		// header('Location: /rush00/setup.html');
		die('mysqli_init failed');
	}
	if (!mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT = 0")) {
		// header('Location: /rush00/setup.html');
		die('MYSQLI_INIT_COMMAND failed');
	}
	if (!mysqli_real_connect($conn,"localhost", $cont[0], $cont[1], $cont[2])) {
		// header('Location: /rush00/setup.html');
		print_r($cont);
		die("mysqli_real_connect failed: " . mysqli_connect_error());
	}

	//Наполняем массив продуктов и привязывем к категориям
	$products = array();
	$cat = isset($_REQUEST['cat']) ? (int) $_REQUEST['cat'] : 0;
	$sql = 'SELECT p.* FROM products AS p ';
	if ($cat) {
		$sql .= ' INNER JOIN categories_products AS cp ON cp.id_product=p.id AND cp.id_category=' . $cat;
	}
	if ($result = mysqli_query($conn, $sql)) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$products[] = $tmp;
		}
		mysqli_free_result($result);
	}

	//Выкачиваем юзеров
	$users = array();
	if ($result = mysqli_query($conn, 'SELECT * FROM users')) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$users[] = $tmp;
		}
		mysqli_free_result($result);
	}
	mysqli_close($conn);

	session_start();
	if ($_GET['item']) {
		foreach ($products as $key => $val) {
			if ($val['id'] == $_GET['item']) {
				$_SESSION['cart'][$key] = array();
				$_SESSION['cart'][$key]['id'] = $_GET['item'];
				echo $_SESSION['cart'][$key]['quantity'];
				if ($_SESSION['cart'][$key]['quantity'] >= 1) {
					$_SESSION['cart'][$key]['quantity'] += 1;
					break ;
				}
				if (!($_SESSION['cart'][$key]['quantity'])) {
					$_SESSION['cart'][$key]['quantity'] = 1;
					break ;
				}
				break ;
			}
		}
	}
?>
<html>
<head>
	<title>Cart</title>
	<style>
		table {
			width: 80%;
		}

		.title {
			font-style: oblique;
		}

		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<div style="margin-left: auto; margin-right: auto; max-width: 1280px; min-width:840px;">
		<h1>Here are the items in your cart:</h1>
		<?PHP
		if (count($_SESSION['cart']) > 0)
		{
			echo <<<EOT
			<table>
				<tr class="title">
					<td>Name</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Total</td>
				</tr>
EOT;
			$super_total = 0;
			foreach($_SESSION['cart'] as $key => $value) {
				$quantity = $_SESSION['cart'][$key]['quantity'];
				$title = $products[$key]['title'];
				$price = $products[$key]['price'];
				$total_price = $quantity * $price;
				echo "
				<tr>
					<td>$title</td>
					<td>";
					printf("%d", $price);
					echo "</td>
					<td>$quantity</td>
					<td>$total_price</td>
				</tr>
";
				$super_total += $total_price;
			}
				echo <<<EOT
				<tr>
					<td></td>
					<td></td>
					<td class="title">Super total:</td>
					<td class="title">$super_total</td>
				</tr>
			</table>
EOT;
			if ($_SESSION['loggued_on_user'] != "") {
				echo '<a href="archive_cart.php">Validate cart</a>';
			}
			else {
				echo "Please login to validate your cart.";
			}
		}
		else {
			echo <<<EOT
			There are no items in your cart. Maybe you want to go to <a href="/rush00/index.php">Main Page of our site</a>
EOT;
		}
		?>
	</div>
</body>
</html>