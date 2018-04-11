<div class="adm">
	<?php
		$login = TRUE;
		foreach ($users as $val) {
			if ($val[username] == $_SESSION['loggued_on_user']) {
				echo '<span class="h_span">Logged as ' . $_SESSION['loggued_on_user']. '</span>';
				echo '<a href="login_form/logout.php"><button class="headBtn">log out</button></a>';
				if ($val[isadmin])
					echo '<a href="http://localhost:8080/phpmyadmin/db_structure.php?db=' . $cont[2] . '"><button class="headBtn">ADM</button></a>';
				$login = FALSE;
				break ;
			}
		}
		if ($login) {
			?>
			<a href="login_form/login.php"><button class="headBtn">Log in!</button></a>
			<a href="login_form/create.php"><button class="headBtn">Create an account</button></a>
	<?php } ?>
</div>