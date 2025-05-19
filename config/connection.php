<?php
// $servername = "localhost";
// $database = "u381709061_parochial_db";
// $username = "u381709061_Ecclesiastical";

// // Create connection

// $conn = mysqli_connect($servername, $username, '/vV+q6=C', $database);

// // Check connection

// if (!$conn) {     
//     die("Unable to connect: " . mysqli_connect_error());     
// }
// mysqli_close($conn);

$conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
if ($conn->connect_error) {
    echo "\'<h2>Running Status :<b> Active</b></h2>";
    die("Connection failed. " . $conn->connect_error);
}

// USER CONFIGURATION FILE.

// Today's Date
$date = date("d/m/Y");

// RETRIVING CREDENTIALS STORES AT LOCAL SYSTEM
$STATION_CODE = $_COOKIE['user'];
$USERNAME = $_COOKIE['username'];


if (!isset($_COOKIE['user'])) {
    echo "<script>alert('Session Expired')</script>";
    header("Location: ../index.php");
}

// COUNT OF TOTAL MEMBER IN 
// PROCEDURE TO GENERATE MEMBER ID
$sql = "SELECT COUNT(*) as total_member FROM family_member WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $total_member = $row['total_member'];
    if ($total_member == 0) {
        // code...
        $total_member = 1;
    } elseif ($total_member > 0) {
        // code...
        $total_member = $total_member + 1;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// COUNT OF TOTAL FAMILIES
$sql = "SELECT COUNT(*) as total FROM family_master_table WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $family_count = $row['total'];
    if ($family_count == 0) {
        // code...
        $family_count = 1;
    } elseif ($family_count > 0) {
        // code...
        $family_count = $family_count + 1;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parochial Suite</title>
</head>

<body>
    <script>
        // Function to capitalize the first letter of every word and after every space
        function capitalizeFirstCharacter(event) {
            const target = event.target;
            // Check if the target is a text input or textarea
            if ((target.tagName === 'INPUT' && target.type === 'text') || target.tagName === 'TEXTAREA') {
                let text = target.value;
                if (text.length > 0) {
                    // Capitalize the first letter of every word
                    target.value = text.replace(/\b\w/g, char => char.toUpperCase());
                }
            }
        }

        // Add event listener to the document for input events
        document.addEventListener('input', capitalizeFirstCharacter);

        // Event to disable the enter key throughout the application.
        document.addEventListener('keydown', function (event) {
            // Check if the pressed key is "Enter" (key code 13)
            if (event.key === 'Enter') {
                // Prevent the default behavior of the Enter key
                event.preventDefault();
                console.log('Return key pressed, but its default behavior is disabled.');
            }
        });

        // Disable the context menu of browser
        // document.addEventListener("contextmenu", function(e) {
        //   e.preventDefault();
        // });


        // CODE TO VALIDATE DATE USEING CLASS

        document.addEventListener('DOMContentLoaded', function () {
            const dateInputs = document.querySelectorAll('.auto-format-date');

            dateInputs.forEach(input => {
                input.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits

                    // Auto-insert slashes
                    if (value.length > 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2);
                    }
                    if (value.length > 5) {
                        value = value.substring(0, 5) + '/' + value.substring(5, 9);
                    }

                    e.target.value = value;
                    validateDateInput(e.target); // Validate on every keystroke
                });

                // Validate on blur (final check)
                input.addEventListener('blur', function (e) {
                    validateDateInput(e.target);
                });
            });

            function validateDateInput(input) {
                const value = input.value;
                const dateParts = value.split('/');
                const currentYear = new Date().getFullYear(); // YYYY 2025

                input.classList.remove('date-error'); // Reset

                // Check day (1-31) if at least 2 digits entered
                if (value.length >= 2) {
                    const day = parseInt(dateParts[0], 10);
                    if (day < 1 || day > 31) {
                        input.classList.add('date-error');
                        return; // Exit early if day is invalid
                    }
                }

                // Check month (1-12) if at least 5 chars entered (dd/mm)
                if (value.length >= 5) {
                    const month = parseInt(dateParts[1], 10);
                    if (month < 1 || month > 12) {
                        input.classList.add('date-error');
                        return; // Exit early if month is invalid
                    }
                }

                // Full date validation (dd/mm/yyyy)
                if (value.length === 10) {
                    const day = parseInt(dateParts[0], 10);
                    const month = parseInt(dateParts[1], 10);
                    const year = parseInt(dateParts[2], 10);

                    // Check if year is in the future
                    if (year > currentYear) {
                        input.classList.add('date-error');
                        return;
                    }

                    // Check if day is
                    //  valid for the month (e.g., no Feb 31)
                    const maxDays = new Date(year, month, 0).getDate();
                    if (day < 1 || day > maxDays) {
                        input.classList.add('date-error');
                    }
                }
            }
        });


        // Functionality to highlight a row and navigate using arrow keys
        document.addEventListener('DOMContentLoaded', function () {
            let selectedRow = null;

            // Add click event listener to all rows except header rows (th)
            document.querySelectorAll('tr').forEach(row => {
                if (!row.querySelector('th')) {
                    row.addEventListener('click', function () {
                        if (selectedRow) {
                            selectedRow.classList.remove('highlighted');
                        }
                        selectedRow = this;
                        selectedRow.classList.add('highlighted');
                    });
                }
            });

            // Add keydown event listener for arrow navigation
            document.addEventListener('keydown', function (event) {
                if (!selectedRow) return;

                if (event.key === 'ArrowUp') {
                    let previousRow = selectedRow.previousElementSibling;
                    while (previousRow && previousRow.querySelector('th')) {
                        previousRow = previousRow.previousElementSibling;
                    }
                    if (previousRow && previousRow.tagName === 'TR') {
                        selectedRow.classList.remove('highlighted');
                        selectedRow = previousRow;
                        selectedRow.classList.add('highlighted');
                    }
                } else if (event.key === 'ArrowDown') {
                    let nextRow = selectedRow.nextElementSibling;
                    while (nextRow && nextRow.querySelector('th')) {
                        nextRow = nextRow.nextElementSibling;
                    }
                    if (nextRow && nextRow.tagName === 'TR') {
                        selectedRow.classList.remove('highlighted');
                        selectedRow = nextRow;
                        selectedRow.classList.add('highlighted');
                    }
                }
            });
        });

        // CSS for highlighted row
        const style = document.createElement('style');
        style.textContent = `
            .highlighted {
            background-color:#cbe6fb;
            outline: 0.1px solid rgb(89, 171, 226);
            }
        `;
        document.head.appendChild(style);






    </script>
</body>

</html>