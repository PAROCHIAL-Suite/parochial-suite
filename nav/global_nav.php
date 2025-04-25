<?php include '../connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="https://kit.fontawesome.com/088cbc7107.js" crossorigin="anonymous"></script>	
	<title></title>
	<style type="text/css">
		.btnNav{ 
			background: #E8EDF1;		  
		  color: #000;
		  cursor: pointer;
		  display: inline-block;
		  font-family: "Titillium Web", sans-serif;
		  font-size: 16px;
		  height: 40px;
		  outline: 0;
		  overflow: hidden;
		  padding: 0px 16px 0px;
		  text-align: center;
		  text-decoration: none;
		  background: transparent		;
		  touch-action: manipulation;
		  white-space: nowrap;
/*		  font-weight: 550;*/
		  }	

		  .btnNav:hover{
		  	background: var(--accent-color);
			color: #fff;
		  }


	</style>
</head>
<body>
	<nav class="global_nav">
		
		<a href="../home/index.php"><button  id="home" class="btnNav"><i class="fa fa-home"></i></button></a>  
	
		<button  id="recent" class="btnNav"><i class="fa fa-clock-o"></i></button>
		<!-- <button  id="recent" ><i class="fa fa-bookmark-o"></i></button>  -->
		
 		<div class="dropdown">
		  <button class="btnNav" >Sacraments</button>
		  <div class="dropdown-content">
		  		<a href="../baptism/baptism_reg.php" target="_self">Baptism</a>
		  		<a href="../eucharist/index.php">Holy Communion</a>
		  		<a href="../confirmation/index.php">Confirmation</a>
		  		<a href="#">Matrimony</a>
		  </div>
		</div>

 		
		<div class="dropdown">
		  <button class="btnNav">Family</button>
		  <div class="dropdown-content">
		    <a href="../family/create_unit.php">CREATE UNIT</a>
		    <a href="../family/create_family.php">CREATE FAMILY</a>
			<a href="../family/add_member_index.php">ADD MEMBER</a>			
		  </div>
		</div>

		<a href="../priest/index.php"><button class="btnNav">Priests</button></a>
		<div class="dropdown">
		  <button class="btnNav">Council</button>
		  <div class="dropdown-content">
		    <a href="../council/index.php">CREATE COUNCIL</a>	
		    <a href="../council/add_council_member.php">ADD MEMBER</a>	
		    <a href="../council/view_member.php">VIEW MEMBERS</a>	
		  </div>
		</div>
		<div class="dropdown">
		  <button class="btnNav">Reports</button>
		  <div class="dropdown-content">
		    <a href="../family/member_list.php">
		    	MEMBER
			</a>		  	
		    <a href="../family/family_list.php">
		    	FAMILY
			</a>

			<hr style="width: 90%; margin: auto;">
		  	<a href="../baptism/sacrament_search_index.php">
		  		BAPTISM
		  	</a>	
		    <a href="../eucharist/search_communion.php">
		    	HOLY COMMUNION
			</a>
		    <a href="../confirmation/search_confirmation.php">
		    	CONFIRMATION
			</a>

		  </div>
		</div>

		<div class="dropdown">
		  <button class="btnNav">Customize</button>
		  <div class="dropdown-content">
		    <a href="../customize/edit_report_header.php">EDIT REPORT HEADER</a>
			
		  </div>
		</div>
	</nav>


</body>
</html>