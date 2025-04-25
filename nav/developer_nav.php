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
		  <button class=" ">Setup</button>
		  <div class="dropdown-content">
		    <a href="../family/create_unit.php">CREATE A NEW COMPANY</a>
		    <a href="../family/create_family.php">CREATE FAMILY</a>
			<a href="../family/add_member_index.php">ADD MEMBER</a>			
		  </div>
		</div>



		<a href="../config.php" hidden><button>Config</button></a>
	</nav>

</body>
</html>