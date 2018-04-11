<!DOCTYPE html>
<html>
	<head>
		<title>Log in!</title>
		<link rel="stylesheet" href="../css/modal.css">
		<link rel="stylesheet" href="../css/plainw.css">
		<style>
			#top-bar {
				margin-bottom: 3.5vh;
			}
		</style>
	</head>

	<body>
		<form action="lg_in.php" method="post">
			<div id="top-bar">Logging in</div>
			<div class="si">Sign in!</div>
			<div class="ca">...or you can <a href="change_pass.php">change password to an existing account</a></div>
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