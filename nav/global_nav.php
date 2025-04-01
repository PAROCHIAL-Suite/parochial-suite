<?php include '../connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<script src="https://kit.fontawesome.com/088cbc7107.js" crossorigin="anonymous"></script>	
	<title></title>
</head>
<body>
	<nav class="global_nav">
		<a href="../home/index.php"><button  id="home" hidden><i class="fa fa-home"></i></button></a>  
	<!-- 			<button  id="recent" hidden><i class="fa fa-clock-o"></i></button>
		<button  id="recent" hidden><i class="fa fa-bookmark-o"></i></button> -->
		
 		<div class="dropdown">
		  <button class="" hidden>Sacraments</button>
		  <div class="dropdown-content">
		  		<a href="../baptism/baptism_reg.php" target="_self">Baptism</a>
		  		<a href="../eucharist/index.php">Holy Communion</a>
		  		<a href="../confirmation/index.php">Confirmation</a>
		  		<a href="#">Matrimony</a>
		  		<a href="../burial/index.php">Burial</a>
		  </div>
		</div>

 		
		<div class="dropdown">
		  <button class=" ">Family</button>
		  <div class="dropdown-content">
		    <a href="../family/create_unit.php">CREATE UNIT</a>
		    <a href="../family/create_family.php">CREATE FAMILY</a>
			<a href="../family/add_member_index.php">ADD MEMBER</a>			
		  </div>
		</div>

		<a href="../priest/index.php"><button class=" " >Priests</button></a>
		<div class="dropdown">
		  <button class=" ">Council</button>
		  <div class="dropdown-content">
		    <a href="../council/index.php">CREATE COUNCIL</a>	
		    <a href="../council/add_council_member.php">ADD MEMBER</a>	
		    <a href="../council/view_member.php">VIEW MEMBERS</a>	
		  </div>
		</div>
		<div class="dropdown">
		  <button class="">Reports</button>
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
			<a href="../burial/member_list.php">
		    	BURIAL
			</a>

		  </div>
		</div>

		<a href="../config.php" hidden><button>Config</button></a>
	</nav>

</body>
</html>