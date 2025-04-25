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
		  	background: orange;
		  }

		  nav{
		  	background: white;box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
		  	height: 40px;

		  }

	</style>
</head>
<body>
	<nav class="global_nav" style="">		
		<a href="../superuser/dashboard.php"><button  id="home" class="btnNav"><i class="fa fa-home"></i></button></a>

		<a href="../superuser-priest/index.php"><button  id="home" class="btnNav">Priest</button></a>  
		<a href="../superuser-family/index.php"><button  id="home" class="btnNav">Family</button></a>  
		



</nav>

</body>
</html>