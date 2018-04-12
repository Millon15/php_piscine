<?php
	include('main.php');
	$categories = FALSE;
	session_start();
	if ($_GET['item']) {
		foreach ($products as $key => $val) {
			if ($val['id'] == $_GET['item']) {
				$_SESSION['cart'][$key] = array();
				$_SESSION['cart'][$key]['id'] = $_GET['item'];
				if (!($_SESSION['cart'][$key]['quantity']))
					$_SESSION['cart'][$key]['quantity'] = 1;
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
		<?php include('other/header.php'); ?>

		<div class="cart_main">
			<?php
				if (count($_SESSION['cart']) == 0) {
					echo '<h2>There are no items in your cart. Maybe you want to go to <a href="/rush00/index.php">Main Page of our site</a></h2>';
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
						<td id="quantity">
							<form id='myform' method='POST' action='#'>
								<input type='button' value='&#5121;' class='qtyminus' field='quantity' />
								<input type='text' name='quantity' value='<?php echo $_SESSION['cart'][$key]['quantity']; ?>' class='qty' />
								<input type='button' value='&#5123;' class='qtyplus' field='quantity' />
							</form>
						</td>
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
		<footer>
			<script src="other/jquery-3.3.1.min.js">
				jQuery(document).ready(function(){
					// This button will increment the value
					$('.qtyplus').click(function(e){
						// Stop acting like a button
						e.preventDefault();
						// Get the field name
						fieldName = $(this).attr('field');
						// Get its current value
						var currentVal = parseInt($('input[name='+fieldName+']').val());
						// If is not undefined
						if (!isNaN(currentVal)) {
							// Increment
							$('input[name='+fieldName+']').val(currentVal + 1);
						} else {
							// Otherwise put a 0 there
							$('input[name='+fieldName+']').val(0);
						}
					});
					// This button will decrement the value till 0
					$(".qtyminus").click(function(e) {
						// Stop acting like a button
						e.preventDefault();
						// Get the field name
						fieldName = $(this).attr('field');
						// Get its current value
						var currentVal = parseInt($('input[name='+fieldName+']').val());
						// If it isn't undefined or its greater than 0
						if (!isNaN(currentVal) && currentVal > 0) {
							// Decrement one
							$('input[name='+fieldName+']').val(currentVal - 1);
						} else {
							// Otherwise put a 0 there
							$('input[name='+fieldName+']').val(0);
						}
					});
				});
			</script>
		</footer>
	</body>
</html>