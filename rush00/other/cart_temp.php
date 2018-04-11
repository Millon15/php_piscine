<?php
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
<!-- Trigger/Open The Modal -->
<button class="cart" id="myBtn"><img src="img/cart.png"></button>
<!-- The Modal -->
<div id="myModal" class="modal">
	<h1>Here are the items in your cart:</h1>
	<!--Name, price, quantity, total-->
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

<script>
	// Get the modal
	var modal = document.getElementById('myModal');
	
	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		modal.style.display = "block";
	}
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>