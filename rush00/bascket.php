<?php
	include('main.php');
	$categories = FALSE;
	session_start();
	if ($_GET['additem']) {
		$_GET['item'] = $_GET['additem'];
	}
	if ($_GET['item']) {
		foreach ($products as $key => $val) {
			if ($val['id'] == $_GET['item']) {
				$_SESSION['cart'][$key] = array();
				$_SESSION['cart'][$key]['id'] = $_GET['item'];
				if (!($_SESSION['cart'][$key]['quantity']))
					$_SESSION['cart'][$key]['quantity'] = 1;
					unset($_GET['item']);
				break ;
			}
		}
	}
	if ($_GET['additem']) {
		header('Location: index.php?hey');
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
				foreach($_SESSION['cart'] as $key => $value) {
					if ($_GET[$key . "discard"])
						unset($_SESSION['cart'][$key]);
				}
				if (count($_SESSION['cart']) == 0) {
					echo '<h2>There are no items in your cart. Maybe you want to go to <a href="index.php">Main Page of our site</a></h2>';
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
						<td class="exit"></td>
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
						<td>
							<form id='myform' method='get' action='bascket.php'>
			<?php
									if ($_GET[$key . 'quantity'] && ($_GET[$key . 'quantity'] != $_SESSION['cart'][$key]['quantity'])) {
										$_SESSION['cart'][$key]['quantity'] = $_GET[$key . 'quantity'];
										unset($_GET[$key . 'quantity']);
										header('Location: bascket.php');
									}
									else if ($_GET[$key . 'up']) {
										$_SESSION['cart'][$key]['quantity']++;
										header('Location: bascket.php');
									}
									else if ($_GET[$key . 'down']) {
										$_SESSION['cart'][$key]['quantity']--;
										header('Location: bascket.php');
									}
									if ($_SESSION['cart'][$key]['quantity'] < 1)
										$_SESSION['cart'][$key]['quantity'] = 1;
			?>
								<input type='submit' name="<?php echo $key; ?>down" value='&#5121;' class='qtyminus' field='quantity' />
								<input type='text' name='<?php echo $key; ?>quantity' value="<?php echo $_SESSION['cart'][$key]['quantity']; ?>" class='qty' />
								<input type='submit' name="<?php echo $key; ?>up" value='&#5123;' class='qtyplus' field='quantity' />
							</form>
						</td>
						<td><?php echo $total_price; ?></td>
						<td class="exit">
							<form method='get' action='bascket.php'>
								<input type='submit' name="<?php echo $key; ?>discard" value='Discard' />
							</form>
						</td>
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
						<td class="exit"></td>
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