<?php
	include('main.php');
	$categories = FALSE;
	session_start();
	if ($_GET['item']) {
		foreach ($products as $key => $val) {
			if ($val['id'] == $_GET['item']) {
				$_SESSION['cart'][$key] = array();
				$_SESSION['cart'][$key]['id'] = $_GET['item'];
				var_dump($_SESSION['cart'][$key]['quantity']);
				$_SESSION['cart'][$key]['quantity'] += 1;
				break ;
			}
		}
	}
?>
<html>
	<head>
		<title>Cart</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/cart.css">
	</head>
	<body>
		<?php include('header.php'); ?>

		<div class="cart_main">
			<?php
				if (count($_SESSION['cart']) == 0) {
					echo '<h3>There are no items in your cart. Maybe you want to go to <a href="/rush00/index.php">Main Page of our site</a></h3>';
					exit();
				}
			?>
				<h1>Here are the items in your cart:</h1>
				<table>
					<tr class="title">
						<td>Name</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Total</td>
					</tr>
			<?php
				$super_total = 0;
				foreach($_SESSION['cart'] as $key => $value) {
					$quantity = $_SESSION['cart'][$key]['quantity'];
					$title = $products[$key]['title'];
					$price = $products[$key]['price'];
					$total_price = $quantity * $price;
			?>
					<tr>
						<td><?php echo $title; ?></td>
						<td><?php printf("%d", $price); ?></td>
						<td><?php echo $quantity; ?></td>
						<td><?php echo $total_price; ?></td>
					</tr>
			<?php
					$super_total += $total_price;
				}
			?>
					<tr>
						<td></td>
						<td></td>
						<td class="title">Super total:</td>
						<td class="title"><?php echo $super_total; ?></td>
					</tr>
				</table>
			<?php
				if ($_SESSION['loggued_on_user'] != "")
					echo '<a href="archive_bascket.php"><button class="buy validate">Validate cart</button></a>';
				else
					echo '<p class="validate">Please <a href="login_form/login.php">login</a> to validate your cart.</p>';
			?>
		</div>
	</body>
</html>