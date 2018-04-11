<!DOCTYPE html>
<html>
	<head>
		<title>Change password!</title>
		<link rel="stylesheet" href="../css/modal.css">
		<link rel="stylesheet" href="../css/plainw.css">
		<style>
			#top-bar {
				margin-bottom: 0vh;
			}
		</style>
	</head>

	<body>
		<form action="chn_ps.php" method="post">
			<div id="top-bar">Change your password</div>
			<?php
				if ($_GET['loginErr'])
					echo "<div class=\"errvis\">Check the input fields!</div>";
				else
					echo "<div class=\"errhide\">Check the input fields!</div>";
			?>
			<input type="text" name="login" value="" placeholder="Username" /><br />
			<input type="password" name="oldpasswd" value="" placeholder="Old Password" /><br />
			<input type="password" name="passwd" value="" placeholder="New Password" /><br />
			<input type="password" name="newpasswd" value="" placeholder="Type New Password again" /><br />
			<input id="butt" type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>