<?php
// Database connection
include '../connection.php';


    $getCount = "SELECT COUNT(*) AS totalPriestCount FROM priest";
    $result = $conn->query($getCount);
                    
    while ($rows=$result->fetch_assoc()){
        $totalPriestCount = $rows['totalPriestCount']   ;   }

    $getFamilyCount = "SELECT COUNT(*) AS totalFamilyCount FROM mobile_db.users";
    $result = $conn->query($getFamilyCount);
                    
    while ($rows=$result->fetch_assoc()){
        $totalFamilyCount = $rows['totalFamilyCount']   ;   }    

    $getMemberCount = "SELECT COUNT(*) AS totalUsers FROM mobile_db.family_member";
    $result = $conn->query($getMemberCount);
                    
    while ($rows=$result->fetch_assoc()){
        $getMemberCount = $rows['totalUsers']   ;   }               

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
	<?php include '../nav/superuser_nav.php';  ?>

    <br><br>
    <div class="pageName">      
        <h2>HOME</h2>
    </div>
    <br>
           <div class="dashboard-widgets">
                <!-- KPI Widgets Row -->
                <div class="widget-row">                    
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Families in the diocese</h3>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value"><?php echo $totalFamilyCount;?> </div>
                            <div class="kpi-change positive">
                            <i class="fas fa-arrow-up"></i> 18% from last month
                        </div> 
                        </div>
                       
                    </div> 
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Member in the diocese</h3>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value"><?php echo $getMemberCount;?> </div>
                        </div>
                    </div>               
                </div>
      
                <!-- Recent Transactions -->
                <div class="widget-row">
                    <div class="widget table-widget" style="max-height: 60%; margin-top: ;">
                        <div class="widget-header">
                            <h3>Family Count of Parish</h3>

                        </div>
                        <div class="widget-content">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Parish Name</th>
                                        <th>Parish Code</th>
                                        <th>Location</th>
                                        <th>Family Count</th>
                                        <th>Member Count</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                    
                                    <?php
                                        // include('../mobile_connection.php');
                                        $sql = "SELECT c.code, c.name, c.location, COUNT(fm.ID) AS member_count, COUNT(usr.ID) AS family_count FROM mobile_db.churches c LEFT JOIN mobile_db.family_member fm ON c.code = fm.stationID LEFT JOIN mobile_db.users usr ON c.code = usr.city_code GROUP BY c.code, c.name ORDER BY member_count DESC;";
                                        $result = $conn->query($sql);
                                            
                                        while ($rows=$result->fetch_assoc()){
                                            
                                    ?>          
                                    <tr>
                                       <td> 
                                            <a href="family.php?id=<?php echo $rows['code']; ?>"><button class="table-action">View</button></a>                        
                                        </td>                                          
                                        <td><?php echo $rows['name']; ?></td>
                                        <td><?php echo $rows['code']; ?></td>
                                        <td><?php echo $rows['location']; ?></td>
                                        <td>
                                            <span class="status-badge fulfilled"><?php echo $rows['family_count']; ?></span></td>
                                        <td>
                                            <span class="status-badge shipped"><?php echo $rows['member_count']; ?></span></td>
                                    </tr>
                                <?php } ?>                        
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                               <!-- Tasks and Alerts -->
                <!-- Chart Widget -->


    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="superDashboard.js"></script>
    <script src="scripts.js"></script>
</body>
</html>