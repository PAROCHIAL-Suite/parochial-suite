<?php
include '../config/connection.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['assign_area_code'])) {
    $selected_families = $_POST['selected_families']; // Note: Make sure this matches your form field name
    $target_area = $_POST['move_to_station'];

    // Validate that selected_families is an array
    if (!is_array($selected_families)) {
        echo "<script>alert('No families selected!');window.history.back();</script>";
        exit;
    }

    $success = true;
    $errors = [];

    foreach ($selected_families as $poc) {
        // Sanitize the data
        $clean_poc = $conn->real_escape_string($poc);
        $clean_area = $conn->real_escape_string($target_area);

        $update_sql = "UPDATE family_members SET area_code='$clean_area', status = 'ACTIVE' WHERE poc='$clean_poc' AND stationID = '$STATION_CODE'";

        if (!$conn->query($update_sql)) {
            $success = false;
            $errors[] = $conn->error;
        }
    }

    if ($success) {
        echo "<script>alert('Area code updated for all selected families!');window.location.href='move_bulk_family.php';</script>";
    } else {
        $error_msg = implode("\n", $errors);
        echo "<script>alert('Some updates failed: " . addslashes($error_msg) . "');window.history.back();</script>";
    }
    exit;
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">

    <title></title>
    <style>
        .ps-flex-layout {
            display: flex;
            flex-direction: row;
            gap: 56px;
            width: 100%;
            align-items: flex-start;
            /* border: 1px solid lightgrey; */
            background-color: transparent;
            z-index: -1;
            margin: 30px auto !important;
            padding: 4px;
            height: calc(100vh - 100px);
            /* 100vh minus margin */
            overflow: hidden;
            max-height: 100vh;
            top: 30px !important;

        }

        .blk-left-panel {
            min-width: 30%;
            background: rgba(227, 230, 234, 0.59);
            border: 1px solid #e0e0e0;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 15px 10px 15px 10px;
            min-height: 90%;
            max-height: 100%;
            height: 70%;
            text-decoration: none;
            overflow-y: auto;
            margin: 0;
            flex: 1;

        }

        .blk-right-panel {
            min-width: 30%;
            background: rgba(227, 230, 234, 0.59);
            border: 1px solid #e0e0e0;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 15px 10px 15px 10px;
            min-height: 90%;
            max-height: 100%;
            height: 70%;
            text-decoration: none;
            overflow-y: auto;
            margin: 0;
            flex: 1;
        }

        .select_list {
            min-height: 86%;
            max-height: 100%;

        }

        .select_list,
        .select_list option {
            padding: 10px;
        }

        .select_list:focus {
            outline: 1px solid dodgerblue;
        }
    </style>
</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>Family - Bulk Operation</h3>
        <p>Move multiple families to diffenent area at once.</p>
    </div>
    <br>
    <br>

    <div class="ps-flex-layout">

        <form id="moveForm" method="post" action="">

            <div class="ps-flex-layout max-height">
                <!-- Left Panel: Available Families -->

                <div class="blk-left-panel">
                    <div class="form-section-header">
                        <h3>Families without Area Code</h3>
                    </div>
                    <select id="leftList" name="available_families[]" multiple size="50" style="width:100%;"
                        class="select_list">
                        <?php
                        // Make sure $STATION_CODE is defined or fetched as needed
                        $STATION_CODE = isset($STATION_CODE) ? $STATION_CODE : '';
                        $sql = "SELECT * FROM family_members WHERE relation_with_head = 'Head' AND stationID = '$STATION_CODE' AND area_code = '' ORDER BY name ASC";
                        $result = $conn->query($sql);

                        while ($rows = $result->fetch_assoc()) {
                            $optionValue = htmlspecialchars($rows['poc']);
                            $address = htmlspecialchars($rows['address']);
                            $optionText = htmlspecialchars($rows['name'] . ' ' . $rows['surname']) . ' - ' . htmlspecialchars($rows['address']);
                            echo '<option value="' . $optionValue . '" title = "' . $address . '">' . $optionText . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Middle Panel: Move Buttons -->
                <div
                    style="display:flex; flex-direction:column; justify-content:center; align-items:center; gap:52px; padding:234px 0; ">

                    <button type="button" id="moveRightBtn" style="" class="btn-primary">
                        Move selected &nbsp;<i class="fas fa-angle-double-right"></i>
                    </button>

                    <button type="button" id="moveLeftBtn" class="btn-danger"><i class="	fas fa-angle-double-left"></i>
                        Remove selected</button>
                </div>

                <!-- Right Panel: Selected Families -->

                <div class="blk-right-panel">
                    <div class="form-section-header">
                        <h3>Selected Families</h3>
                    </div>
                    <select id="rightList" name="selected_families[]" multiple size="18" style="width:100%;"
                        class="select_list">
                        <!-- Populated by JS -->
                    </select>
                </div>
                <div style=" " class="form-grid">
                    <div class="form-group">
                        <label for="move_to_station">Move to Area:</label>
                        <select name="move_to_station" id="" required>
                            <option hidden>Select Area Code</option>
                            <?php
                            include "../config/connection.php";
                            $sql = "SELECT * FROM area_mapping WHERE stationID = '$STATION_CODE' ORDER BY area_code ASC";

                            $result = $conn->query($sql);
                            $conn->close();
                            while ($rows = $result->fetch_assoc()) {
                                $area_Code = $rows['area_code'];
                                $area_Name = $rows['area_name'];
                                ?>
                                <option value="<?php echo $rows['area_code']; ?>">
                                    <?php echo $rows['area_code'] . ' - [' . $rows['area_name'] . "]";
                            } ?>
                            </option>
                        </select>
                        <br><br><br><br><br><br><br><br>
                        <button type="submit" class="btn-primary" name="assign_area_code">Move Selected
                            Families</button>
                    </div>
                </div>
            </div>
    </div>

    </form>

    <script>
        // Move selected from left to right
        document.getElementById('moveRightBtn').onclick = function () {
            let left = document.getElementById('leftList');
            let right = document.getElementById('rightList');
            Array.from(left.selectedOptions).forEach(option => {
                right.appendChild(option);
            });
        };

        // Move selected from right to left
        document.getElementById('moveLeftBtn').onclick = function () {
            let left = document.getElementById('leftList');
            let right = document.getElementById('rightList');
            Array.from(right.selectedOptions).forEach(option => {
                left.appendChild(option);
            });
        };

        // Ensure all rightList options are selected before submit
        document.getElementById('moveForm').onsubmit = function () {
            let right = document.getElementById('rightList');
            Array.from(right.options).forEach(option => option.selected = true);
        };
    </script>
</body>

</html>