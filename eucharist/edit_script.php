<?php
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
	$id = $_GET['id'];
	if ($id == "") {
		echo "<script>alert('Invalid ID. Please try again.');window.history.back();</script>";
		exit();
	} else {

	}
	// Sanitize and fetch form data
	$reg_no = trim($_POST['reg_no']);
	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$dob = trim($_POST['dob']);
	$father_name = trim($_POST['father_name']);
	$mother_name = trim($_POST['mother_name']);
	$baptism_date = trim($_POST['baptism_date']);
	$baptism_reg = trim($_POST['baptism_reg']);
	$baptism_parish = trim($_POST['baptism_parish']);
	$p_address = trim($_POST['p_address']);
	$church_of_eucharist = trim($_POST['church_of_eucharist']);
	$date = trim($_POST['date']);
	$minister_name = trim($_POST['minister_name']);
	$parish_priest = trim($_POST['parish_priest']);

	// Prepare and execute update query
	$stmt = $conn->prepare(
		"UPDATE eucharist SET 
            reg_no = ?, 
            name = ?, 
            surname = ?, 
            dob = ?, 
            father_name = ?, 
            mother_name = ?, 
            baptism_date = ?, 
            baptism_reg_no = ?, 
            baptism_parish = ?, 
            parish_address = ?, 
            church_of_comunion = ?, 
            date_of_communion = ?, 
            minister = ?, 
            parish_priest = ?,
            last_update = NOW()
        WHERE id = ?"
	);

	$stmt->bind_param(
		"ssssssssssssssi",
		$reg_no,
		$name,
		$surname,
		$dob,
		$father_name,
		$mother_name,
		$baptism_date,
		$baptism_reg,
		$baptism_parish,
		$p_address,
		$church_of_eucharist,
		$date,
		$minister_name,
		$parish_priest,
		$id
	);

	if ($stmt->execute()) {
		echo "<script>alert('Holy Communion record updated successfully!');window.location.href='edit_eucharist.php?id=$reg_no';</script>";
	} else {
		echo "<script>alert('Update failed. Please try again.');window.history.back();</script>";
	}

	$stmt->close();
	$conn->close();
} else {
	header("Location: edit_eucharist.php");
	exit();
}


?>