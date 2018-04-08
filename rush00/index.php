<?php
	// Берём данные о БД из shopdb.csv
	$cont = file_get_contents('shopdb.csv');
	if (!$cont) {
		header('Location: /rush00/setup.html');
	}
	$cont = explode(':', $cont);

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

	//Наполняем массив категорий в зависимости от того, что записано в таблицу категорий
	$categories = array();
	if ($result = mysqli_query($conn, 'SELECT * FROM categories')) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$categories[] = $tmp;
		}
		mysqli_free_result($result);
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
	// mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="description" content="Best Farm Products ever!">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/modal.css">
	<title>Farmer's Bazaar</title>
</head>
<body>
	<div class="adm">
		<?php
			session_start();
			$login = TRUE;
			foreach ($users as $val) {
				if ($val[username] == $_SESSION['loggued_on_user']) {
					echo '<a href="login_form/logout.php"><button id="myBtn">Log out</button></a>';
					if ($val[isadmin])
						echo '<a href="http://localhost:8080//phpmyadmin/"><button id="myBtn">ADM</button></a>';
					$login = FALSE;
					break ;
				}
			}
			if ($login || $_GET['loginErr']) {
				?>
				<!-- Trigger/Open The Modal -->
				<button id="myBtn">Log in!</button>
				
				<!-- The Modal -->
				<div id="myModal" class="modal">
					<!-- Modal content -->
					<div class="modal-content">
						<div class="close"><span>&times;</span></div>
						<div class="si">Sign in!</div>
						<div class="ca">...or <a href="login_form/create.php">create an account</a></div>
						<?php
							if ($_GET['loginErr']) 
								echo "<div class=\"errvis\">Check the input fields!</div>";
							else
								echo "<div class=\"errhide\">Check the input fields!</div>";
						?>
						<form action="login_form/login.php" method="get">
							<div id="top-bar"></div>
							<input type="text" name="login" value="" placeholder="Username" /><br />
							<input type="text" name="passwd" value="" placeholder="Password" /><br />
							<input id="butt" type="submit" name="submit" value="OK" />
						</form>
					</div>
				</div>
			<?php } ?>
	</div>
	<header>
		<nav class="navbar" role="navigation">
			<div class="logo">
				<a href="index.php"><p>Farmer's Bazaar</p></a>
			</div>
			<div class="header-categories">
				<?php
					foreach($categories as $category) {
						echo ' <a href="?cat=' . $category['id'] . '" class="list-group-item">' . $category['title'] . '</a>';
					}
				?>
			</div>
		</nav>
	</header>
	<div class="content">
		<div class="products-row">
			<?php foreach($products as $product) {?>
				<div class="product-card">
					<div class="product-thumbnail">
						<img src="<?php echo $product['img'];?>" alt="">
						<div class="caption">
							<div class="product-price"><h2>$<?php echo $product['price'];?></h2></div>
							<div class="product-title"><h1><?php echo $product['title'];?></h1></div>
							<div class="product-intro"><h4><?php echo $product['intro'];?></h4></div>
							<div class="button"><button class="buy">BUY</button></div>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php foreach($products as $product) {?>
				<div class="product-card">
					<div class="product-thumbnail">
						<img src="<?php echo $product['img'];?>" alt="">
						<div class="caption">
							<div class="product-price"><h2>$<?php echo $product['price'];?></h2></div>
							<div class="product-title"><h1><?php echo $product['title'];?></h1></div>
							<div class="product-intro"><h4><?php echo $product['intro'];?></h4></div>
							<div class="button"><button class="buy">BUY</button></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<footer>
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
	</footer>
</body>
</html>