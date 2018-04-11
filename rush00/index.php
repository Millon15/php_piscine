<?php include('main.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="description" content="Best Farm Products ever!">
	<title>Farmer's Bazaar</title>
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/style.css">
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
	<?php include('top_menu.php'); ?>
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

	<?php if (!$_GET) {
		echo '<div class="coverimg"><h1>Fresh products<br>from our farm<br>to your table!</h1></div>';
	}?>

	<div class="content">
		<div class="products-row">
			<?php foreach($products as $product) {?>
				<div class="product-card">
					<div class="product-thumbnail">
						<img src="<?php echo $product['img'];?>" alt="">
						<div class="caption">
							<div class="product-price"><h2>&dollar;<?php echo $product['price'];?></h2></div>
							<div class="product-title"><h1><?php echo $product['title'];?></h1></div>
							<div class="product-intro"><h4><?php echo $product['intro'];?></h4></div>
							<div class="button">
							<a href="bascket/bascket.php?item=<?php echo $product['id']; ?>"><button class="buy">BUY</button></a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

</body>
</html>
