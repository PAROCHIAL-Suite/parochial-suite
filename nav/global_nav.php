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
			min-width: 270px;
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
			color: rgb(59, 76, 120);
			text-decoration: none;
			background: none;
			border: none;
			width: 100%;
			text-align: left;
			cursor: pointer;
			font-size: 15px;
			font-weight: 500;
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

		<a href="../home/index.php?ref=<?php echo $_COOKIE['userID']; ?>"><button id="home" class="btnNav"><i
					class="fa fa-home"></i></button></a>

		<div class="dropdown">
			<button class="btnNav">Sacraments</button>
			<div class="dropdown-content">
				<a href="../baptism/baptism_reg.php?ref=<?php echo $_COOKIE['userID']; ?>" target="_self">Baptism</a>
				<a href="../eucharist/index.php?ref=<?php echo $_COOKIE['userID']; ?>">Holy Communion</a>
				<a href="../confirmation/index.php?ref=<?php echo $_COOKIE['userID']; ?>">Confirmation</a>
				<a href="../anointing_of_sick/index.php?ref=<?php echo $_COOKIE['userID']; ?>">Annointing of the
					Sick</a>
				<a href="../burial/burial_reg.php?ref=<?php echo $_COOKIE['userID']; ?>">Burial</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Family</button>
			<div class="dropdown-content">
				<a href="../family/create_unit.php?ref=<?php echo $_COOKIE['userID']; ?>">Create Unit</a>
				<a href="../family/create_family.php?ref=<?php echo $_COOKIE['userID']; ?>">Add Family</a>
				<a href="../family/add_member_index.php?ref=<?php echo $_COOKIE['userID']; ?>">Add Members</a>
				<div class="dropdown">
					<button class="btnNav">
						More Family Options <i class="fa fa-caret-right caret-right"></i>
					</button>
					<div class="dropdown-content">
						<a href="../operations/move_bulk_family.php?ref=<?php echo $_COOKIE['userID']; ?>">Bulk
							Operations</a>
						<a href="../family/member_list.php?ref=<?php echo $_COOKIE['userID']; ?>">Member List</a>
					</div>
				</div>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Priests</button>
			<div class="dropdown-content">
				<a href="../priest/index.php?ref=<?php echo $_COOKIE['userID']; ?>" target="main-iframe">Add A
					Priest</a>
				<a href="../priest/priest_list.php?ref=<?php echo $_COOKIE['userID']; ?>">List of Priest</a>
			</div>

		</div>

		<div class="dropdown">
			<button class="btnNav">Council</button>
			<div class="dropdown-content">
				<a href="../council/create_tenure.php?ref=<?php echo $_COOKIE['userID']; ?>">Create New Term</a>
				<a href="../council/add_council_member.php?ref=<?php echo $_COOKIE['userID']; ?>">Add Members</a>
				<a href="../council/member_list.php?ref=<?php echo $_COOKIE['userID']; ?>">Members List</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Reports</button>
			<div class="dropdown-content">
				<a href="../family/member_list.php?ref=<?php echo $_COOKIE['userID']; ?>">Members List</a>
				<a href="../family/family_list.php?ref=<?php echo $_COOKIE['userID']; ?>">Family List</a>
				<div class="dropdown">
					<button class="btnNav">
						Sacrament Reports <i class="fa fa-caret-right caret-right"></i>
					</button>
					<div class="dropdown-content">
						<a href="../baptism/search.php?ref=<?php echo $_COOKIE['userID']; ?>">Baptism Records</a>
						<a href="../eucharist/search.php?ref=<?php echo $_COOKIE['userID']; ?>">Holy Communion
							Records</a>
						<a href="../confirmation/search.php?ref=<?php echo $_COOKIE['userID']; ?>">Confirmation
							Records</a>
						<a href="../anointing_of_sick/search.php?ref=<?php echo $_COOKIE['userID']; ?>">Anointing of the
							Sick</a>
						<a href="../burial/search.php?ref=<?php echo $_COOKIE['userID']; ?>">Burial</a>

					</div>
				</div>
			</div>
		</div>

		<div class="dropdown">
			<button class="btnNav">Setup</button>
			<div class="dropdown-content">
				<a href="../account_center/index.php?ref=<?php echo $_COOKIE['userID']; ?>">Account Center</a>
				<a href="../prefrences/edit_report_header.php?ref=<?php echo $_COOKIE['userID']; ?>">Edit Report
					Header</a>
			</div>
		</div>



		<div class="dropdown">
			<button class="btnNav">Support</button>
			<div class="dropdown-content">
				<a href="../support/index.php?ref=<?php echo $_COOKIE['userID']; ?>">Raise Ticket</a>
				<a href="../support/ticket_history.php?ref=<?php echo $_COOKIE['userID']; ?>">Ticket History</a>
			</div>
		</div>
	</nav>
</body>

</html>