<?php
	if ($_POST["msqlogin"] == FALSE || $_POST["msqpasswd"] == FALSE || $_POST["dbname"] == FALSE  || $_POST["submit"] != "OK") {
		exit("BAD INPUT\n");
	}
	// echo "Connection died(maybe you have already created a new database?)".PHP_EOL;
	$servername = "localhost";
	$username = $_POST['msqlogin'];
	$password = $_POST['msqpasswd']; //Пароль mysql, который ты задавал при установке МАМПА
	$dbname = $_POST['dbname'];

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Удаляем старую БД
	unlink('shopdb.csv');
	$sql = "DROP DATABASE IF EXISTS $dbname";
	mysqli_query($conn, $sql);
	// if (!mysqli_query($conn, $sql)) {
	// 	die("Error dropping db: " . mysqli_error($conn));
	// }
	// Создаем БД
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating database: " . mysqli_error($conn));
	}
	mysqli_close($conn);
	
	//Подключаемся к БД
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Создаем таблицу категории
	$sql = "CREATE TABLE IF NOT EXISTS categories (
			id INT(11) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(255) NOT NULL
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating categories: " . mysqli_error($conn));
	}

	// Наполняем таблицу категорий
	$sql = "INSERT INTO categories (id, title)
			VALUES (1, 'Fruits'), (2, 'Greens'), (3, 'Meat')";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling categories: " . mysqli_error($conn));
	}

	// Создаем таблицу продуктов
	$sql = "CREATE TABLE IF NOT EXISTS products (
			id INT(11) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(255) NOT NULL,
			img VARCHAR(255) DEFAULT NULL,
			category VARCHAR(255) DEFAULT NULL,
			intro text NOT NULL,
			price DECIMAL(10,0) NOT NULL
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating products: " . mysqli_error($conn));
	}

	// Наполняем таблицу продуктов
	$sql = "INSERT INTO products (id, title, img, intro, price, category)
			VALUES (1, 'Apples', 'http://faynofruit.com.ua/wp-content/uploads/2015/02/01-apple-mutsu.png', 'Apples are cool', '12', 'Fruits'),
			(2, 'Onions', 'http://spicexpert.ru/files/Image/luk-rep.jpg', 'Onions are awful', '15', 'Greens'),
			(3, 'Deer', 'http://arvi.by/wp-content/uploads/2017/12/%D0%B31-1-300x300.jpg', 'Deers lives matter', '50', 'Meat'),
			(4, 'Carrot', 'https://freshproducegroup.us/wp-content/uploads/2018/02/CARROT-FRESH-PRODUCE-GROUP-LLC.jpg', 'Carrot is super-duper', '5', 'Greens'),
			(5, 'Chicken', 'http://cdn.shopify.com/s/files/1/1090/8304/products/whole_chicken_with_skinCompressed_grande.jpg?v=1449925650', 'Nom-nom chicken', '150', 'Meat'),
			(6, 'Grape', 'https://hmarapara.com/media/2018/03/Grape-Candy-300x300.jpg', 'Graaaaape', '500', 'Fruits'),
			(7, 'Banana', 'https://images-na.ssl-images-amazon.com/images/I/41JvAoqeMfL._SY300_QL70_.jpg', 'Bananas are whoaaa', '55', 'Fruits'),
			(8, 'Pork', 'http://www.highlandsfamilyfarm.com/wp-content/uploads/2015/04/pork-chops-300x300.png', 'Halal pork', '175', 'Meat'),
			(9, 'Cabbage', 'https://images-na.ssl-images-amazon.com/images/I/416Xjyn1R6L._SY300_QL70_.jpg', 'Cabbage helps with health issues', '1', 'Greens')";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling products: " . mysqli_error($conn));
	}
	// Создаем таблицу категорий продуктов для связи и заполняем ее в формате:
	// (id категории, id товара)
	$sql = "CREATE TABLE IF NOT EXISTS categories_products (
			id_category INT(11) NOT NULL, 
			id_product INT(11) NOT NULL,
			PRIMARY KEY (id_category, id_product)
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating categories_products: " . mysqli_error($conn));
	}
	$sql = "INSERT INTO categories_products (id_category, id_product)
			VALUES (1, 1), (2, 2), (3, 3), (1, 6), (2, 4), (3, 5), (1, 7), (2, 9), (3, 8)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling categories: " . mysqli_error($conn));
	}

	// Создаем таблицу заказов
	$sql = "CREATE TABLE IF NOT EXISTS orders (
		id_ord INT(11) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY, 
		username VARCHAR(255) NOT NULL,
		email VARCHAR(255),
		address VARCHAR(255)
	)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating order: " . mysqli_error($conn));
	}

	// Создаем таблицу юзеров и добавляем админа
	$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY, 
			username VARCHAR(255) NOT NULL,
			password TEXT NOT NULL,
			isadmin BOOLEAN NOT NULL,
			email VARCHAR(255),
			address VARCHAR(255)
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating users: " . mysqli_error($conn));
	}
	$adminPass = hash('whirlpool', 'admin');
	$sql = "INSERT INTO users (id, username, password, isadmin)
		VALUES (1, 'admin', '" . $adminPass . "', true)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling users: " . mysqli_error($conn));
	}

	file_put_contents('shopdb.csv', "$username;$password;$dbname");
	mysqli_close($conn);
	header('Location: index.php');
?>