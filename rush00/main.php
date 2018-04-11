<?php
	// Берём данные о БД из shopdb.csv
	$cont = file_get_contents('shopdb.csv');
	if (!$cont) {
		header('Location: ./setup.html');
	}
	// $cont = explode('\n', $cont);
	// $cont = explode(';', $cont[0]);
	$cont = explode(';', $cont);
	
	// Подключаемся к mysql
	$conn = mysqli_init();
	if (!$conn) {
		die('mysqli_init failed');
	}
	if (!mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT = 0")) {
		die('MYSQLI_INIT_COMMAND failed');
	}
	if (!mysqli_real_connect($conn, "localhost", $cont[0], $cont[1], $cont[2])) {
		echo "Debug info :: ";
		print_r($cont);
		?>
		<br />You, perhaps, have changed password and/or login and/or name of your mySQL database.<br />
		Please check the shopdb.csv file in the root of your server directory.<br /><br />
		shopdb.csv file has next syntax ::    login_to_your_mysql:password_to_your_mysql:name_of_your_database_on_mysql<br /><br />
<?php
		die("Connection failed: " . mysqli_connect_error());
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
	mysqli_close($conn);
	session_start();
	if (!$_SESSION['cart']) {
		$_SESSION['cart'] = array();
	}
?>