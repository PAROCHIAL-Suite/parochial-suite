<?php
include '../config/connection.php';
$id = $_GET['id'];
$sql = "SELECT * FROM baptism WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {
    $last_update = $rows['last_update'];
    $name = $rows['name'];
    $surname = $rows['surname'];
    $dob = $rows['dob'];
    $gender = $rows['gender'];
    $address = $rows['address'];
    $father_name = $rows['father_name'];
    $mother_name = $rows['mother_name'];
    $father_nationality = $rows['father_nationality'];
    $father_occupation = $rows['father_occupation'];
    $godfather_name = $rows['godfather_name'];
    $godfather_address = $rows['godfather_address'];
    $godmother_name = $rows['godmother_name'];
    $godmother_address = $rows['godmother_address'];
    $place_of_baptism = $rows['church_name'];
    $minister_name = $rows['minister_name'];
    $communion = $rows['communion'];
    $confirmation = $rows['confirmation'];
    $marriage = $rows['marriage'];
    $remarks = $rows['remarks'];
    $reg_no = $rows['reg_no'];
    $baptism_dt = $rows['baptism_date'];
    $created_on = $rows['created_on'];

}

if (isset($_GET['delete']) && $_GET['delete'] == '1') {
    // Show confirmation prompt before deleting
    echo "<script>
        if (confirm('Are you sure you want to delete this record?')) {
            window.location.href = '" . $_SERVER['PHP_SELF'] . "?id=" . urlencode($id) . "&delete=confirmed';
        } else {
            window.location.href = '" . $_SERVER['PHP_SELF'] . "?id=" . urlencode($id) . "';
        }
    </script>";
}

if (isset($_GET['delete']) && $_GET['delete'] == 'confirmed') {
    $delete_id = $conn->real_escape_string($id);
    $delete_sql = "DELETE FROM baptism WHERE reg_no = '$delete_id' AND stationID = '$STATION_CODE'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>
            alert('Record deleted successfully.');
            window.location.href = 'search.php';
        </script>";
        exit();
    } else {
        echo "<div style='color:red;'>Error deleting record: " . $conn->error . "</div>";
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/ui.css">
    <link rel="stylesheet" type="text/css" href="../css/baptism.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName card-heading">
        <table border="0">
            <tr>
                <td width="40%">
                    <h3>UPDATE RECORD - BAPTISM</h3>
                </td>
            </tr>
        </table>
    </div>
    <Br>
    <div class="form-header">

        <div class="form-actions">
            <div class="">
                <label><b>Create On</b></label>
                <h3 style="color: var(--accent-color);"><span style="font-weight: normal; "></span>
                    <?php echo $created_on; ?></h3>
            </div>
            <div style="float: right; right: 0; position: relative;">
                <form>

                </form>
            </div>
        </div>
    </div>

    <!-- Form for baptism registration -->
    <form id="baptismFrom" method="post" action="update_btsm_data.php?id=<?php echo $_GET['id']; ?>"
        enctype="multipart/form-data">
        <div class="form-section">
            <div class="form-section-header">
                <h3>Registration Information</h3>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="Pries Name">REGISTRATION NUMBER</label>
                    <input type="text" name="reg_no" placeholder="Number" value="<?php echo $reg_no; ?> " required>
                </div>

                <div class="form-group">
                    <label for="Pries Name">DATE OF BAPTISM</label>
                    <input type="text" name="baptism_dt" class="auto-format-date" placeholder="dd/mm/yyyy"
                        value="<?php echo $baptism_dt; ?>" required>
                </div>
                <div class="form-group">
                    <!-- <label for="Pries Name">YEAR OF REGISTRATION</label>
                    <input type="text" name="reg_year" placeholder="Year" required> -->
                </div>
            </div>

            <div class="form-section-header">
                <h3>Basic Information</h3>
            </div>
            <!-- NEW ROWS -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">NAME</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Name">SURNAME</label>
                    <input type="text" name="surname" value="<?php echo $surname; ?>">
                </div>
                <div class="form-group">
                    <label for="Name">DATE OF BIRTH</label>
                    <input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy"
                        value="<?php echo $dob; ?>">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">GENDER</label>
                    <select name="gender">
                        <option value="" hidden required>Select</option>
                        <option value="Male" <?php if ($gender == "Male")
                            echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if ($gender == "Female")
                            echo "selected"; ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Name">FATHER'S NAME</label>
                    <input type="text" name="father_name" value="<?php echo htmlspecialchars($father_name); ?>">
                </div>
                <div class="form-group">
                    <label for="Name">MOTHER'S NAME</label>
                    <input type="text" name="mother_name" value="<?php echo htmlspecialchars($mother_name); ?>">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">NATIONALITY</label>
                    <input type="text" name="nationality" value="<?php echo htmlspecialchars($father_nationality); ?>">
                </div>
                <div class="form-group">
                    <label for="Name">ADDRESS</label>
                    <textarea id="address" rows="3" name="address"><?php echo htmlspecialchars($address); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="Name">FATHER'S OCCUPATION</label>
                    <input type="text" name="occupation" value="<?php echo htmlspecialchars($father_occupation); ?>">
                </div>
            </div>

            <div class="form-section-header">
                <h3>Godparents Information</h3>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">GODFATHER'S NAME</label>
                    <input type="text" name="godfather_name" value="<?php echo htmlspecialchars($godfather_name); ?>">
                </div>
                <div class="form-group">
                    <label for="Name">HIS ADDRESS</label>
                    <textarea id="godfather_address" rows="3"
                        name="godfather_address"><?php echo htmlspecialchars($godfather_address); ?></textarea>
                </div>
                <div class="form-group"></div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">GODMOTHER'S NAME</label>
                    <input type="text" name="godmother_name" value="<?php echo htmlspecialchars($godmother_name); ?>">
                </div>
                <div class="form-group">
                    <label for="Name">HER ADDRESS</label>
                    <textarea id="godmother_address" rows="3"
                        name="godmother_address"><?php echo htmlspecialchars($godmother_address); ?></textarea>
                </div>
                <div class="form-group"></div>
            </div>
            <div class="form-section-header">
                <h3>Other Information</h3>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">PLACE OF BAPTISM</label>
                    <input type="text" name="church_name" value="<?php echo htmlspecialchars($place_of_baptism); ?>">
                </div>

                <div class="form-group">
                    <label for="Name">MINISTER'S NAME</label>
                    <input type="text" name="minister_name" value="<?php echo htmlspecialchars($minister_name); ?>">
                </div>
                <div class="form-group"></div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">COMMUNION</label>
                    <textarea id="communion" rows="3"
                        name="communion"><?php echo htmlspecialchars($communion); ?></textarea>

                </div>
                <div class="form-group">
                    <label for="Name">CONFIRMATION</label>
                    <textarea id="confirmation" rows="3"
                        name="confirmation"><?php echo htmlspecialchars($confirmation); ?></textarea>

                </div>

                <div class="form-group">
                    <label for="Name">MARRIAGE</label>
                    <textarea id="marriage" rows="3"
                        name="marriage"><?php echo htmlspecialchars($marriage); ?></textarea>
                </div>

            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Name">REMARKS</label>
                    <textarea id="remarks" rows="3" name="remarks"><?php echo htmlspecialchars($remarks); ?></textarea>
                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
            </div>
        </div>
        <div class="form-header">
            <div class="form-actions">
                <button type="submit" class="btn-primary" name="update_btsm_info" id="update_btsm_info">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn-danger"
                    onclick="if(confirm('Are you sure you want to delete this record?')){ window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo urlencode($id); ?>&delete=confirmed'; }"
                    name="delete" id="delete_btsm_info">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </form>



</body>

</html>