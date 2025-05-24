<?php
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
	$id = $_GET['id'];

	// Sanitize and fetch form data
	$reg_no = trim($_POST['reg_no']);
	$baptism_dt = trim($_POST['baptism_dt']);
	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$dob = trim($_POST['dob']);
	$gender = trim($_POST['gender']);
	$father_name = trim($_POST['father_name']);
	$mother_name = trim($_POST['mother_name']);
	$father_nationality = trim($_POST['nationality']);
	$address = trim($_POST['address']);
	$father_occupation = trim($_POST['occupation']);
	$godfather_name = trim($_POST['godfather_name']);
	$godfather_address = trim($_POST['godfather_address']);
	$godmother_name = trim($_POST['godmother_name']);
	$godmother_address = trim($_POST['godmother_address']);
	$place_of_baptism = trim($_POST['church_name']);
	$minister_name = trim($_POST['minister_name']);
	$communion = trim($_POST['communion']);
	$confirmation = trim($_POST['confirmation']);
	$marriage = trim($_POST['marriage']);
	$remarks = trim($_POST['remarks']);

	// Prepare and execute update query
	$stmt = $conn->prepare(
		"UPDATE baptism SET 
            reg_no = ?, 
            baptism_date = ?, 
            name = ?, 
            surname = ?, 
            dob = ?, 
            gender = ?, 
            father_name = ?, 
            mother_name = ?, 
            father_nationality = ?, 
            address = ?, 
            father_occupation = ?, 
            godfather_name = ?, 
            godfather_address = ?, 
            godmother_name = ?, 
            godmother_address = ?, 
            church_name = ?, 
            minister_name = ?, 
            communion = ?, 
            confirmation = ?, 
            marriage = ?, 
            remarks = ?, 
            last_update = NOW()
        WHERE reg_no = ?"
	);

	$stmt->bind_param(
		"ssssssssssssssssssssss",
		$reg_no,
		$baptism_dt,
		$name,
		$surname,
		$dob,
		$gender,
		$father_name,
		$mother_name,
		$father_nationality,
		$address,
		$father_occupation,
		$godfather_name,
		$godfather_address,
		$godmother_name,
		$godmother_address,
		$place_of_baptism,
		$minister_name,
		$communion,
		$confirmation,
		$marriage,
		$remarks,
		$id
	);

	if ($stmt->execute()) {
		echo "<script>alert('Baptism record updated successfully!');window.location.href='btsm_edit.php?id=$reg_no';</script>";
	} else {
		echo "<script>alert('Update failed. Please try again.');window.history.back();</script>";
	}

	$stmt->close();
	$conn->close();
} else {
	header("Location: btsm_edit.php");
	exit();
}
?>