<?php

include '../config/connection.php';
$del_mem_id = $_GET['id'];

$sql = "DELETE FROM council_member WHERE ID = '$del_mem_id' ";


if (mysqli_query($conn, $sql)) {
	header("Location:  view_member.php?gID=$groupID");
} else {
	echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}

?>