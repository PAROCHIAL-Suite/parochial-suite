<?php
// CONFIGURATION FILE FOR DATABASE CONNECTION AND SESSION MANAGEMENT
// This file is responsible for establishing a connection to the database

$servername = "localhost";
$database = "parochial_cloud";
$username = "root";

// Create connecti
// Create connection
$conn = mysqli_connect($servername, $username, '', $database);


// Check connection

if (!$conn) {
    die("Unable to connect: " . mysqli_connect_error());
}


// Today's Date
$date = date("d/m/Y");

// RETRIVING CREDENTIALS STORES AT LOCAL SYSTEM
$STATION_CODE = $_COOKIE['user'];
$USERNAME = $_COOKIE['username'];

// ENSURING SESSION IS ACTIVE
// If the cookie 'user' is not set, redirect to index page

if (!isset($_COOKIE['user'])) {
    echo "<script>alert('Session Expired')</script>";
    header("Location: ../index.php");
}
?>



<script>
    var USERNAME = "<?php echo isset($USERNAME) ? addslashes($USERNAME) : ''; ?>";
</script>
<script>
    // Function to capitalize the first letter of every word and after every space
    // Function to capitalize the first letter of every word, but
    // only if the first letter is uppercase (do not override user's explicit lowercase)
    // Function to auto-capitalize the first letter of every word,
    // but if the user explicitly types a lowercase letter, do NOT override it.
    function capitalizeFirstCharacter(event) {
        const target = event.target;
        // Only target text inputs that are NOT for password or email fields
        if (
            target.tagName === 'INPUT' &&
            target.type === 'text' &&
            !/password|email/i.test(target.name)
        ) {
            let text = target.value;
            // Replace each word: only capitalize if the first character is uppercase
            target.value = text.replace(/\b\w+/g, function (word) {
                // If the user typed the first letter as lowercase, leave as is
                if (word.charAt(0) === word.charAt(0).toLowerCase()) {
                    return word;
                }
                // Otherwise, capitalize the first letter
                return word.charAt(0).toUpperCase() + word.slice(1);
            });
        }
    }

    // Add event listener to the document for input events
    document.addEventListener('input', capitalizeFirstCharacter);

    // Disable the context menu of browser
    // document.addEventListener("contextmenu", function(e) {
    //   e.preventDefault();
    // });

    // CODE TO VALIDATE DATE USING CLASS
    document.addEventListener('DOMContentLoaded', function () {
        const dateInputs = document.querySelectorAll('.auto-format-date');

        // Add CSS for error class if not present
        if (!document.getElementById('date-style')) {
            const style = document.createElement('style');
            style.id = 'date-style';
            style.textContent = `
            .date-error { border: 1.5px solid #b71c1c !important; background: #ffd6d6 !important; }
        `;
            document.head.appendChild(style);
        }

        dateInputs.forEach(input => {
            // Create error message element if not present
            let errorElem = input.nextElementSibling;
            if (!errorElem || !errorElem.classList.contains('date-error-msg')) {
                errorElem = document.createElement('div');
                errorElem.className = 'date-error-msg';
                errorElem.style.color = '#b71c1c';
                errorElem.style.fontSize = '0.95em';
                errorElem.style.marginTop = '2px';
                errorElem.style.display = 'none';
                input.insertAdjacentElement('afterend', errorElem);
            }

            input.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-digits

                // Auto-pad day
                // if (value.length >= 1 && value.length < 2) {
                //     if (parseInt(value, 10) > 1) {
                //         value = '0' + value;
                //     }
                // }
                // Auto-insert slash after day
                if (value.length > 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2);
                }

                // Auto-pad month
                if (value.length >= 4 && value.length < 5) {
                    let month = value.substring(3, 4);
                    if (parseInt(month, 10) > 1) {
                        value = value.substring(0, 3) + '0' + month;
                    }
                }
                // Auto-insert slash after month
                if (value.length > 5) {
                    value = value.substring(0, 5) + '/' + value.substring(5, 9);
                }

                e.target.value = value;
                validateDateInput(e.target, errorElem);
            });

            input.addEventListener('blur', function (e) {
                validateDateInput(e.target, errorElem);
            });
        });

        function validateDateInput(input, errorElem) {
            const value = input.value;
            const dateParts = value.split('/');
            const currentYear = new Date().getFullYear();

            input.classList.remove('date-error');
            input.style.backgroundColor = '';
            errorElem.style.display = 'none';
            errorElem.textContent = '';

            if (value.length === 0) {
                // Empty input, reset styles
                return;
            }

            // Error message logic
            let errorMsg = '';

            // Check day (1-31)
            if (value.length >= 2) {
                const day = parseInt(dateParts[0], 10);
                if (isNaN(day) || day < 1 || day > 31) {
                    errorMsg = 'Day must be between 01 and 31.';
                }
            }

            // Check month (1-12)
            if (!errorMsg && value.length >= 5) {
                const month = parseInt(dateParts[1], 10);
                if (isNaN(month) || month < 1 || month > 12) {
                    errorMsg = 'Month must be between 01 and 12.';
                }
            }

            // Check year (must be <= current year and >= 1900) ONLY if 4 digits entered
            if (!errorMsg && value.length === 10 && dateParts.length > 2) {
                const year = parseInt(dateParts[2], 10);
                if (isNaN(year)) {
                    errorMsg = 'Year must be a valid number.';
                } else if (year > currentYear) {
                    errorMsg = 'Year cannot be greater than ' + currentYear + '.';
                } else if (year < 1900) {
                    errorMsg = 'Year must be after 1900.';
                }
            }

            // Full date validation (dd/mm/yyyy)
            if (!errorMsg && value.length === 10) {
                const day = parseInt(dateParts[0], 10);
                const month = parseInt(dateParts[1], 10);
                const year = parseInt(dateParts[2], 10);

                // Check if day is valid for the month (e.g., no Feb 31)
                const maxDays = new Date(year, month, 0).getDate();
                if (day < 1 || day > maxDays) {
                    errorMsg = `Day must be between 01 and ${maxDays} for this month.`;
                }
            }

            if (errorMsg) {
                input.classList.add('date-error');
                errorElem.textContent = errorMsg;
                errorElem.style.display = 'block';
            } else if (value.length === 10) {
                // If all checks pass and format is correct, show correct format message (no green)
                input.classList.remove('date-error');
                input.style.backgroundColor = '';
                errorElem.textContent = 'Date format is correct.';
                errorElem.style.color = '#388e3c';
                errorElem.style.display = 'block';
            } else {
                // Incomplete date, do not show green/red
                input.classList.remove('date-error');
                errorElem.style.display = 'none';
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


        // Auto-format contact number in Indian format (e.g., 98765 43210 or +91 98765 43210)
        document.querySelectorAll('input[type="text"].auto-format-contact').forEach(input => {
            input.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');

                // Remove leading zeros
                value = value.replace(/^0+/, '');

                // If starts with 91 and length > 10, treat as country code
                let formatted = '';
                if (value.length > 10 && value.startsWith('91')) {
                    formatted = '+91 ';
                    value = value.substring(2);
                }

                // Format as 5+5 digits (e.g., 98765 43210)
                if (value.length > 5) {
                    formatted += value.substring(0, 5) + ' ' + value.substring(5, 10);
                } else {
                    formatted += value;
                }

                e.target.value = formatted.trim();

                // Display a note if the number is not 10 digits (after country code)
                let noteElem = input.nextElementSibling;
                if (!noteElem || !noteElem.classList.contains('contact-note')) {
                    noteElem = document.createElement('div');
                    noteElem.className = 'contact-note';
                    noteElem.style.color = '#b71c1c';
                    noteElem.style.fontSize = '0.95em';
                    noteElem.style.marginTop = '2px';
                    input.insertAdjacentElement('afterend', noteElem);
                }
                if (value.length !== 10) {

                    noteElem.textContent = 'Indian mobile numbers must start with 9, 8, 7, or 6.';
                    noteElem.style.color = '#b71c1c';
                    noteElem.style.display = 'block';
                }
                else if (!/^[6-9]/.test(value)) {
                    noteElem.textContent = 'Contact number should be exactly 10 digits.';
                    noteElem.style.color = '#b71c1c';
                    noteElem.style.display = 'block';
                }
                else {
                    noteElem.style.color = 'green';
                    noteElem.textContent = 'Valid';
                    noteElem.style.display = 'block';
                }
            });
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