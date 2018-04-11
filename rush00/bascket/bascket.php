<?php
	include('../main.php');
	session_start();
	var_dump($_SESSION);
	if ($_GET['item']) {
		foreach ($products as $key => $val) {
			if ($val['id'] == $_GET['item']) {
				$_SESSION['cart'][$key] = array();
				$_SESSION['cart'][$key]['id'] = $_GET['item'];
				$_SESSION['cart'][$key]['quantity'] += 1;
				break ;
			}
		}
	}
?>
<html>
	<head>
		<title>Cart</title>
		<link rel="stylesheet" href="css/cart.css">
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
			<?php
				if (count($_SESSION['cart']) > 0) {
					?>
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
						echo '<a href="archive_cart.php">Validate cart</a>';
					else
						echo "Please login to validate your cart.";
				}
				else
					echo 'There are no items in your cart. Maybe you want to go to <a href="/rush00/index.php">Main Page of our site</a>';
			?>
		</div>
	</body>
</html>