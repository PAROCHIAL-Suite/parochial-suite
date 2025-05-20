<?php include '../config/connection.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="https://kit.fontawesome.com/088cbc7107.js" crossorigin="anonymous"></script>
	<title></title>
	<style>
		/* Multi-level dropdown styles */
		.global_nav .dropdown-content {
			position: absolute;
			display: none;
			background: #fff;
			min-width: 250px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
			z-index: 100;
		}

		.global_nav .dropdown:hover>.dropdown-content {
			display: block;
		}

		.global_nav .dropdown-content .dropdown {
			position: relative;
		}

		.global_nav .dropdown-content .dropdown-content {
			left: 100%;
			top: 0;
			margin-left: 1px;
			display: none;
		}

		.global_nav .dropdown-content .dropdown:hover>.dropdown-content {
			display: block;
		}

		.global_nav .dropdown-content a,
		.global_nav .dropdown-content .dropdown>button.btnNav {
			display: block;
			padding: 8px 16px;
			color: #333;
			text-decoration: none;
			background: none;
			border: none;
			width: 100%;
			text-align: left;
			cursor: pointer;
		}

		.global_nav .dropdown-content a:hover,
		.global_nav .dropdown-content .dropdown>button.btnNav:hover {
			background: #f0f0f0;
		}

		.caret-right {
			text-align: right;
			margin-left: 55px;
			color: var(--accent-color);
		}
	</style>
</head>

<body>
	<!-- this code is get the user refrence id from session and when the user open any modules in new tab it will load within the iframe -->

	<?php
	$refID = $_COOKIE['userID'];
	if ($refID == null) {
		header("Location: ../index.php");
		exit();

	}
	?>
	<nav class="global_nav">

		<a href="../home/index.php"><button id="home" class="btnNav"><i class="fa fa-home"></i></button></a>

		<div class="dropdown">
			<button class="btnNav">Sacraments</button>
			<div class="dropdown-content">
				<a href="../baptism/baptism_reg.php" target="_self">Baptism</a>
				<a href="../eucharist/index.php">Holy Communion</a>
				<a href="../confirmation/index.php">Confirmation</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Family</button>
			<div class="dropdown-content">
				<a href="../family/create_unit.php">Create Unit</a>
				<a href="../family/create_family.php">Add Family</a>
				<a href="../family/add_member_index.php">Add Members</a>
				<div class="dropdown">
					<button class="btnNav">
						More Family Options <i class="fa fa-caret-right caret-right"></i>
					</button>
					<div class="dropdown-content">
						<a href="../family/family_list.php">Family List</a>
						<a href="../family/member_list.php">Member List</a>
					</div>
				</div>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Priests</button>
			<div class="dropdown-content">
				<a href="../priest/index.php">Add A Priest</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Council</button>
			<div class="dropdown-content">
				<a href="../council/create_tenure.php">Create New Term</a>
				<a href="../council/add_council_member.php">Add Members</a>
				<a href="../council/member_list.php">Members List</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Reports</button>
			<div class="dropdown-content">
				<a href="../family/member_list.php">Members List</a>
				<a href="../family/family_list.php">Family List</a>
				<div class="dropdown">
					<button class="btnNav">
						Sacrament Reports <i class="fa fa-caret-right caret-right"></i>
					</button>
					<div class="dropdown-content">
						<a href="../baptism/search.php">Baptism Records</a>
						<a href="../eucharist/search.php">Holy Communion Records</a>
						<a href="../confirmation/search.php">Confirmation Records</a>
					</div>
				</div>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Setup</button>
			<div class="dropdown-content">
				<!-- <a href="../prefrences/parish_setup.php">Parish</a> -->
				<a href="../prefrences/edit_report_header.php">Edit Report Header</a>
			</div>
		</div>
	</nav>
</body>

</html>