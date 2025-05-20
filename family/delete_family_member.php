<?php

include '../config/connection.php';

// Sanitize input to prevent SQL injection
$del_mem_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$groupID = isset($_GET['famID']) ? mysqli_real_escape_string($conn, $_GET['famID']) : '';

if (empty($del_mem_id) || empty($groupID)) {
	echo "Invalid request.";
	exit;
}

$sql = "DELETE FROM family_member WHERE ID = '$del_mem_id'";

if (mysqli_query($conn, $sql)) {

	echo "<script>alert('Member deleted successfully!');</script>";
	echo "<script>window.location.href='view_family.php?id=$groupID';</script>";
	exit;
} else {
	echo "<br>ERROR: Unable to delete member.<br>" . htmlspecialchars(mysqli_error($conn));
	echo "<script>alert('Unable to delete member.');</script>";
	echo "<script>window.location.href='view_family.php?id=$groupID';</script>";
}

?>