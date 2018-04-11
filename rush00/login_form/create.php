<!DOCTYPE html>
<html>
	<head>
		<title>Create an account!</title>
		<link rel="stylesheet" href="../css/modal.css">
		<link rel="stylesheet" href="../css/plainw.css">
		<style>
			#top-bar {
				margin-bottom: 0;
			}
		</style>
	</head>

	<body>
		<form action="na_creation.php" method="post">
			<div id="top-bar">Account setup</div>
			<?php
				if ($_GET['loginErr'] == 1)
					echo "<div class=\"errvis\">Check the input fields!</div>";
				else if ($_GET['loginErr'] == 2)
					echo "<div class=\"errvis\">User with same account login exists. Please change your login!</div>";
				else if ($_GET['loginErr'] == 3)
					echo "<div class=\"errvis\">ACHTUNG!</div>";
				else
					echo "<div class=\"errhide\">Check the input fields!</div>";
			?>
			<input type="text" name="login" value="" placeholder="Username" /><br />
			<input type="password" name="passwd" value="" placeholder="Password" /><br />
			<input type="text" name="address" value="" placeholder="&Delta; address" /><br />
			<input type="text" name="email" value="" placeholder="&commat; email" /><br />
			<input id="butt" type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>