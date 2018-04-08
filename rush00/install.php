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
	$sql = "DROP DATABASE IF EXISTS $dbname";
	if (!mysqli_query($conn, $sql)) {
		die("Error killing db: " . mysqli_error($conn));
	}
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
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
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
			id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(255) NOT NULL,
			img VARCHAR(255) DEFAULT NULL,
			category VARCHAR(255)DEFAULT NULL,
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
			(3, 'Deer', 'http://arvi.by/wp-content/uploads/2017/12/%D0%B31-1-300x300.jpg', 'Deers lives matter', '50', 'Meat')";
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
			VALUES (1, 1), (2, 2), (3, 3)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling categories: " . mysqli_error($conn));
	}

	// Создаем таблицу юзеров и добавляем админа
	$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			username VARCHAR(255) NOT NULL,
			password VARCHAR(256) NOT NULL,
			isadmin BOOLEAN NOT NULL
			)";
	if (!mysqli_query($conn, $sql)) {
		die("Error creating users: " . mysqli_error($conn));
	}
	$sql = "INSERT INTO users (id, username, password, isadmin)
			VALUES (1, 'admin', 'admin', true)";
	if (!mysqli_query($conn, $sql)) {
		die("Error filling users: " . mysqli_error($conn));
	}

	mysqli_close($conn);
	header('Location: /rush00/_index.php?msqlogin='.$username.'&dbname='.$dbname.'&msqpasswd='.$password);
?>