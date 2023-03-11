<?php 
require 'admin_function.php';

if($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }

$id= $_GET['id'];

if (delete_dept($id) > 0) {
	echo "<script>
				alert('data deleted!');
				document.location.href='admin_dashboard.php';
				</script>";
} else {
	echo "data fail to delete";
}
	





