<!DOCTYPE html>
<html>
	<head>
		<title>Log in!</title>
		<link rel="stylesheet" href="../css/plainw.css">
		<style>
			#top-bar {
				margin-bottom: 3.5vh;
			}
		</style>
	</head>

	<body>
		<form action="lg_in.php" method="post">
			<div id="top-bar">Logging in<a href="../index.php" class="close">&times;</a></div>
			<div class="main_text">Sign in!</div>
			<div class="middle_text">...or you can <a href="change_pass.php">change password to an existing account</a></div>
			<?php
				if ($_GET['loginErr'] == 1)
					echo "<div class=\"errvis\">Check the input fields!</div>";
				else
					echo "<div class=\"errhide\">Check the input fields!</div>";
			?>
			<input type="text" name="login" value="" placeholder="Username" /><br />
			<input type="password" name="passwd" value="" placeholder="Password" /><br />
			<input id="butt" type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>