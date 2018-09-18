<?php
	require("config.php");
/* =============================================================================== */
	$nim = $_GET['nim'];
	$query = $pdo -> prepare("DELETE FROM tb_mahasiswa WHERE nim='$nim'");
	$query -> execute();
/* =============================================================================== */
	header("Location: data.php");

?>