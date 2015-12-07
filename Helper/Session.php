<?php
session_start ();

function CheckUser() {
	if (isset ($_SESSION['Identifier'])) {
	} else {
		header("Location: Login.php");
		exit;
	}
}

?>