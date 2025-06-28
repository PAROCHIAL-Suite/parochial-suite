<?php

include '../config/connection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing record
$patient_name = $age = $gender = $contact_no = $address = $date = $priest_name = $remarks = '';
if ($id > 0) {
    $sql = "SELECT * FROM anointing_of_the_sick WHERE id = '$id' AND stationID = '$STATION_CODE' LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $patient_name = $row['patient_name'];
        $age = $row['age'];
        $gender = $row['gender'];
        $contact_no = $row['contact_no'];
        $address = $row['address'];
        $date = $row['date'];
        $priest_name = $row['priest_name'];
        $remarks = $row['remarks'];
    }
}

// Handle update
if (isset($_POST['update_anointing'])) {
    $patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $priest_name = mysqli_real_escape_string($conn, $_POST['priest_name']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    $sql = "UPDATE anointing_of_the_sick SET 
                patient_name = '$patient_name',
                age = '$age',
                gender = '$gender',
                contact_no = '$contact_no',
                address = '$address',
                date = '$date',
                priest_name = '$priest_name',
                remarks = '$remarks'
            WHERE id = '$id' AND stationID = '$STATION_CODE'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Anointing record updated successfully!');window.location.href='search.php';</script>";

        exit;
    } else {
        echo "<script>alert('Error updating record: " . addslashes(mysqli_error($conn)) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <link rel="stylesheet" type="text/css" href="print.css">
    <title>Edit Anointing of the Sick</title>
</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>Edit Anointing of the Sick</h3>
    </div>
    <br>
    <form id="editAnointingForm" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="POST"
        enctype="multipart/form-data">
        <div class="form-section">
            <div class="form-section-header">
                <h3>Patient Information</h3>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    <input type="text" id="patient_name" name="patient_name"
                        value="<?php echo htmlspecialchars($patient_name); ?>" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" min="0" max="130" required
                        value="<?php echo htmlspecialchars($age); ?>"
                        oninput="if(this.value < 0) this.value=0; if(this.value > 100) this.value=100;">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" hidden>Select</option>
                        <option <?php if ($gender == 'Male')
                            echo 'selected'; ?>>Male</option>
                        <option <?php if ($gender == 'Female')
                            echo 'selected'; ?>>Female</option>
                        <option <?php if ($gender == 'Other')
                            echo 'selected'; ?>>Other</option>
                    </select>
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="contact_no">Contact No.</label>
                    <input type="text" id="contact_no" name="contact_no" class="auto-format-contact" required
                        value="<?php echo htmlspecialchars($contact_no); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="2"
                        required><?php echo htmlspecialchars($address); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date of Anointing</label>
                    <input type="text" id="date" name="date" required value="<?php echo htmlspecialchars($date); ?>">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="priest_name">Priest Name</label>
                    <input type="text" id="priest_name" name="priest_name" required
                        value="<?php echo htmlspecialchars($priest_name); ?>">
                </div>
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks" rows="2"><?php echo htmlspecialchars($remarks); ?></textarea>
                </div>
                <div></div>
            </div>
        </div>
        <div class="form-header">
            <div class="form-actions">
                <button type="submit" class="btn-primary" name="update_anointing">
                    <i class="fas fa-save"></i> Update
                </button>
                <button class="btn-secondary" onclick="window.location.href='index.php'; return false;">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </div>
        <br><br>
    </form>
</body>

</html>