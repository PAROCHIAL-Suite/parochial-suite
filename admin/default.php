<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" type="image/x-icon" href="#">
	<title>Parochial Cloud</title>

</head>
<body>
	<?php  include '../nav/app_header_nav.php';  $_GET['ref']; ?>


	<div class="main">
		<main>
			<iframe src="../home/index.php?ref=<?php echo $_GET['ref']; ?>" width="100%" height="100%" id="iframe"></iframe>
		</main>
	</div>

<!-- 	<script type="text/javascript">
		function baptism(){
			document.getElementById("iframe").src = "../baptism/index.php";
		}
		function Categroy(){
			document.getElementById("iframe").src = "../category/index.php";
		}
		function Files(){
			document.getElementById("iframe").src = "../files/index.php";
		}		
	</script>	 -->
</body>
</html>