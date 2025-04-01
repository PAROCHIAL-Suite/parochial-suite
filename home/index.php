<?php
// Database connection
include '../connection.php';
// Get current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Calculate days in month
$daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
$firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<?php include '../nav/global_nav.php'; include  '../connection.php'; ?>

    <br><br>
    <div class="pageName card-heading">
        <table border="0">
            <tr>
                <td width="40%" ><h3>HOME</h3></td>
            </tr>
        </table>
    </div>

    <div class="dashboard-container">
        <header>
            <h1 >Dashboard</h1>
            <div class="header-info">
                <!-- <span class="material-icons">account_circle</span> -->
                <span>Welcome, <?php echo $USERNAME; ?></span>
            </div>
        </header>
        <div class="stats-container">
        <a href="../family/member_list.php" style="text-decoration: none;">            
            <div class="stat-card" id="total-events">
                <div class="stat-icon">
                    <span class="material-icons">people</span>
                </div>
                <div class="stat-info">
                    <h3>Members</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM family_member WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>            
            </a>
            <a href="../family/family_list.php" style="text-decoration: none;">  
            <div class="stat-card" id="users-count">
                <div class="stat-icon">
                    <span class="material-icons">diversity_3</span>
                </div>
                <div class="stat-info">
                    <h3>Families</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM family_master_table WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>
        </a>
        </div>        
        <a href="../baptism/sacrament_search_index.php" style="text-decoration: none;">
        <div class="stats-container">
            <div class="stat-card" id="total-events">
                <div class="stat-icon">
                    <span class="material-icons">description</span>
                </div>
                <div class="stat-info">
                    <h3>Baptism</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM baptism WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>            
        </a>
        <a href="../eucharist/search_communion.php" style="text-decoration: none;">
            <div class="stat-card" id="upcoming-events">
                <div class="stat-icon">
                    <span class="material-icons">description</span>
                </div>
                <div class="stat-info">
                    <h3>Holy Communion</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM eucharist WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>
            </a>
            <a href="../confirmation/search_confirmation.php" style="text-decoration: none;">
            <div class="stat-card" id="users-count">
                <div class="stat-icon">
                    <span class="material-icons">description</span>
                </div>
                <div class="stat-info">
                    <h3>Confirmation</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM confirmation WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>
            </a>

            <div class="stat-card" id="active-projects">
                <div class="stat-icon">
                    <span class="material-icons">description</span>
                </div>
                <div class="stat-info">
                    <h3>Burial</h3>
                    <p>
		            <?php 
		                $sql = "SELECT COUNT(*) AS total_records FROM burial WHERE stationID = '$STATION_CODE'";
		                $result = $conn->query($sql);         
		                while ($rows=$result->fetch_assoc()) { echo "<p>".number_format($rows['total_records'])."</p>";}
		            ?>  	
                    </p>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="calendar-section">
                <div class="calendar-nav">
                    <a href="?month=<?= $month-1 < 1 ? 12 : $month-1 ?>&year=<?= $month-1 < 1 ? $year-1 : $year ?>">
                        <span class="material-icons">chevron_left</span>
                    </a>
                    <h2><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></h2>
                    <a href="?month=<?= $month+1 > 12 ? 1 : $month+1 ?>&year=<?= $month+1 > 12 ? $year+1 : $year ?>">
                        <span class="material-icons">chevron_right</span>
                    </a>
                </div>
                
                <table class="calendar">
                    <thead>
                        <tr>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                            <th>Sun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $day = 1;
                        for ($i = 1; $i <= 6; $i++) {
                            echo '<tr>';
                            for ($j = 1; $j <= 7; $j++) {
                                if (($i === 1 && $j < $firstDay) || $day > $daysInMonth) {
                                    echo '<td class="empty"></td>';
                                } else {
                                    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                                    $class = ($date == date('Y-m-d')) ? 'today' : '';
                                    echo '<td class="' . $class . '" data-date="' . $date . '">' . $day . '</td>';
                                    $day++;
                                }
                            }
                            echo '</tr>';
                            if ($day > $daysInMonth) break;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="events-section">
                <div class="section-header">
                    <h3>Events</h3>
                    <button id="add-event">
                        <span class="material-icons">add</span> Add Event
                    </button>
                </div>
                <div id="events-list">
                    <div class="empty-state">
                        <span class="material-icons">event_available</span>
                        <p>Select a date to view events</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="scripts.js"></script>
</body>
</html>