<?php 
require 'admin_function.php';

if($_SESSION["adminLogged"] == 0) { header("Location: admin_login.php"); }

$id= $_GET['id'];
$mit_id = $_GET['mit_id'];

if (delete($id, $mit_id) > 0) {
	echo "<script>
				alert('data deleted!');
				document.location.href='admin_dashboard.php';
				</script>";
} else {
	echo "data fail to delete";
}
	





