<!DOCTYPE html>
<html>
	<head>
		<title>Create account form</title>
		<link rel="stylesheet" href="../css/modal.css">
		<link rel="stylesheet" href="../css/plainw.css">
	</head>

	<body>
		<form action="na_creation.php" method="post">
			<div id="top-bar">Account setup</div>
			<?php
				if ($_GET['loginErr']) 
					echo "<div class=\"errvis\">Check the input fields!</div>";
				else
					echo "<div class=\"errhide\">Check the input fields!</div>";
			?>
			<input type="text" name="login" value="" placeholder="Username" /><br />
			<input type="password" name="passwd" value="" placeholder="Password" /><br />
			<input type="password" name="passwd2" value="" placeholder="Same password again" /><br />
			<input type="text" name="email" value="" placeholder="@email" /><br />
			<input id="butt" type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>