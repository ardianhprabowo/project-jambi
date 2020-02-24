<?php  

	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "staff") {
			header("location:staff/index.php");
		} else if ($_SESSION['level'] == "administrator"){
			header("location:admin/index.php");
		} else if ($_SESSION['level'] == "supervisor"){
			header("location:supervisor/index.php");
		} else {
			header("location:index.php");
		}
	}

?>