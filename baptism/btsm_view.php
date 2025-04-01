<head>
        <link rel="stylesheet" type="text/css" href="../css/search.css">
    <link rel="stylesheet" type="text/css" href="../css/viewPage.css">  
    <link rel="stylesheet" type="text/css" href="../css/ui.css">        
    <link rel="stylesheet" type="text/css" href="print.css">
     <script src="print.js"></script>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

		<div class="dataDispaly">
            <?php
                include '../connection.php';
                $id = $_GET['id'];
                $sql = "SELECT * FROM baptism WHERE reg_no = '$id'";
                $result = $conn->query($sql); 

                while ($rows=$result->fetch_assoc()) { 
            ?>
            <div class="head">
                <table border="0" width="100%">
                    <tr>
                        <td width="4%">Last modified: <span style="color: var(--navcolor); font-size: 14px;"><?php echo $rows['last_update'] ;?></span></td>
<!--                         <td>
                            <form id="form1" method="post" action="head_frm.php?id=&fav=&draft=">
                                <input type="submit" name="fav" id="fav" value="Mark as important">
                                <input type="submit" name="draft" value="Mark as Draft">
                            </form>
                        </td> -->                   
                    </tr>
                </table>
            </div>
            <br>

            
            <div class="legend" style="float: left; width: 59.2%;"> Baptism Information</div>    
            <div style="width: 60%;" class="legend-content">       
			<table width="100%" border="0" cellspacing="7">
                <tr>
                    <td>Registration No.</td>
                    <th>:</th>
                    <td><?php echo $rows['reg_no']; ?></td>
                </tr>
                <tr>
                    <td>Date of baptism</td>
                    <th>:</th>
                    <td><?php echo $rows['baptism_date']; ?></td>
                </tr>    
                <tr>
                    <td>Sex</td>
                    <th>:</th>
                    <td><?php echo $rows['dob']; ?></td>
                </tr>                            
                <tr>
                    <td>Name</td>
                    <th>:</th>
                    <td><?php echo $rows['name']; ?></td>
                </tr>
                <tr>
                    <td>Surname</td>
                    <th>:</th>
                    <td><?php echo $rows['surname']; ?></td>
                </tr>   
                <tr>
                    <td>Date of birth</td>
                    <th>:</th>
                    <td><?php echo $rows['dob']; ?></td>
                </tr>  
                <tr>
                    <td>Father's Name</td>
                    <th>:</th>
                    <td><?php echo $rows['father_name']; ?></td>
                </tr>                
                <tr>
                    <td>Mother's Name</td>
                    <th>:</th>
                    <td><?php echo $rows['mother_name']; ?></td>
                </tr> 
                <tr>
                    <td>Address</td>
                    <th>:</th>
                    <td><?php echo $rows['address']; ?></td>
                </tr>            
                <tr>
                    <td>Father's Occupation</td>
                    <th>:</th>
                    <td><?php echo $rows['father_occupation']; ?></td>
                </tr>                       
                <tr>
                    <td>Father's Nationality</td>
                    <th>:</th>
                    <td><?php echo $rows['father_nationality']; ?></td>
                </tr>
                <tr>
                    <td>Godfather's Name</td>
                    <th>:</th>
                    <td><?php echo $rows['godfather_name']; ?></td>
                </tr>                                       
                <tr>
                    <td>His Address</td>
                    <th>:</th>
                    <td><?php echo $rows['godfather_address']; ?></td>
                </tr>    
                <tr>
                    <td>Godmother's Name</td>
                    <th>:</th>
                    <td><?php echo $rows['godmother_name']; ?></td>
                </tr>                                       
                <tr>
                    <td>Her Address</td>
                    <th>:</th>
                    <td><?php echo $rows['godmother_address']; ?></td>
                </tr>   
                <tr>
                    <td>Place of baptism</td>
                    <th>:</th>
                    <td><?php echo $rows['church_name']; ?></td>
                </tr>                                       
                <tr>
                    <td>Minister's Name</td>
                    <th>:</th>
                    <td><?php echo $rows['minister_name']; ?></td>
                </tr>           
                <tr>
                    <td>First Communion</td>
                    <th>:</th>
                    <td><?php echo $rows['communion']; ?></td>
                </tr>                 
                <tr>
                    <td>Confirmation</td>
                    <th>:</th>
                    <td><?php echo $rows['confirmation']; ?></td>
                </tr>     
                <tr>
                    <td>Marriage</td>
                    <th>:</th>
                    <td><?php echo $rows['marriage']; ?></td>
                </tr>                       
                <tr>
                    <td>Remarks</td>
                    <th>:</th>
                    <td><?php echo $rows['remarks']; ?></td>
                </tr>                                                              
                <?php } ?>	
			 </table>
            </div>
            

		</div>

<script type="text/javascript">
    const params = new URLSearchParams(window.location.search);
    const f = params.get('fav');
    // alert("Fav " + f);

    if (f == 1) {
       const impBtn =  document.getElementById("fav");
       impBtn.value = "Remove from important";
       impBtn.style.background  = "maroon";
       impBtn.style.color  = "white";
       if (impBtn.value == "Remove from important") {
        impBtn.addEventListener("click", () => {
            document.getElementById('form1').action = "head_frm.php?fav=1&draft=0";
    document.getElementById('form1').submit();
});
       }
    }
</script>