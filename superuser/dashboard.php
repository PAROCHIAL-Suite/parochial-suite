<?php
// Database connection
include '../connection.php';
include('../mobile_connection.php');


    $getFamilyCount = "SELECT COUNT(*) AS totalFamilyCount FROM u381709061_mobile_db.users";
    $result = $conn_mob->query($getFamilyCount);
                    
    while ($rows=$result->fetch_assoc()){
        $totalFamilyCount = $rows['totalFamilyCount']   ;   }    

    $getMemberCount = "SELECT COUNT(*) AS totalUsers FROM u381709061_mobile_db.family_member";
    $result = $conn_mob->query($getMemberCount);
    while ($rows=$result->fetch_assoc()){
        $getMemberCount = $rows['totalUsers']   ;   }      
        
    $getChurchCount = "SELECT COUNT(name) AS totalChurch FROM u381709061_mobile_db.churches";
    $result = $conn_mob->query($getChurchCount);
    while ($rows=$result->fetch_assoc()){
        $getChurchCount = $rows['totalChurch']   ;   }          

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/parochialUI.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
	<?php include '../nav/superuser_nav.php';  ?>

    <br><br>
    <div class="pageName">      
        <h3>HOME</h3>
    </div>
    <br>
           <div class="container-widgets">
                <!-- KPI Widgets Row -->
                <div class="widget-row">                    
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Total Families</h3>
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
                            <h3>Total Faithful</h3>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value"><?php echo $getMemberCount;?> </div>
                        </div>
                    </div>  
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Total Churches</h3>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value"><?php echo $getChurchCount;?> </div>
                        </div>
                    </div>                      
                </div>
      
                <!-- Recent Transactions -->
                <div class="widget-row">
                    <div class="widget pie-widget" style="width: 48%; margin-left:52%; height: 90%;">
                        <div class="widget-header">
                            <h3>Graphical Representation of Families in Each Parish</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <?php include 'graph.php'; ?>
                        </div>
                    </div>                     
                    <div class="widget table-widget" style="max-height: 65%; width: 50%;">
                        <div class="widget-header">
                            <h3>Family Count of Parish</h3>                            
                            <button class="btn-primary" onclick="location.reload();">Refresh</button>

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
                                        
                                       $sql = "SELECT c.code AS church_code, c.name AS church_name, c.location As location, COUNT(DISTINCT u.id) AS total_users, COUNT(DISTINCT fm.ID) AS total_family_members 
                                       FROM u381709061_mobile_db.churches c 
                                       LEFT JOIN 
                                       u381709061_mobile_db.users u ON c.code = u.city_code 
                                       LEFT JOIN u381709061_mobile_db.family_member fm ON c.code = fm.stationID 
                                       GROUP BY c.code, c.name 
                                       HAVING COUNT(DISTINCT u.ID) > 0 
                                       ORDER BY  total_users DESC";

                                 
                                        $result = $conn_mob->query($sql);
                                            
                                        while ($rows=$result->fetch_assoc()){
                                            
                                    ?>          
                                    <tr>
                                       <td> 
                                            <a href="../superuser-family/family.php?id=<?php echo $rows['church_code']; ?>" class="table-action"><span title="View more record of this parish">View</span></a>                        
                                        </td>                                          
                                        <td><?php echo $rows['church_name']; ?></td>
                                        <td><?php echo $rows['church_code']; ?></td>
                                        <td><?php echo $rows['location']; ?></td>
                                         <td><span class="status-badge shipped"><?php echo $rows['total_users']; ?></span></td>
                                        <td><span class="status-badge fulfilled"><?php echo $rows['total_family_members']; ?></span></td>
                                       
                                    </tr>
                                <?php } ?>                        
                                </tbody>
                            </table>
                        </div>
                    </div>
             
             
                </div>



 </div>
    <!--  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="superDashboard.js"></script> -->
    <script src="scripts.js"></script>
 
</body>
</html>