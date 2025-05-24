<!-- NAVIGATION FILE  -->
<!-- CONTAINS APPLICATION NAME AND USER DETAILS -->
<!-- TOP LEVEL NAVIGATION -->

<?php
if (!isset($_COOKIE['user'])) {
	header("Location: ../index.php");
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<script src="https://kit.fontawesome.com/088cbc7107.js" crossorigin="anonymous"></script>
	<title></title>
	<style>
		.nav-user-avatar {
			background: whitesmoke;
			border-radius: 20%;
			width: 34px;
			height: 34px;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 1px 4px rgba(56, 94, 150, 0.10);
			font-size: 1.3rem;
			color: rgb(56, 94, 150);
			margin-right: 10px;
		}

		.nav-user-info {
			display: flex;
			flex-direction: column;
			align-items: flex-end;
			line-height: 1.1;
			margin-right: 8px;
			cursor: pointer;
			margin-right: 30px;
			position: relative;
		}

		.nav-user-info span:first-child {
			font-weight: bold;
			color: #333;
		}

		.nav-user-info span:last-child {
			font-size: 0.82rem;
			color: #666;
		}

		.caret-btn {
			background: none;
			border: none;
			cursor: pointer;
			padding: 0 6px;
			font-size: 1.1rem;
			color: #444;
			display: flex;
			align-items: center;
			transition: color 0.2s;
			margin-right: 30px;
		}

		.caret-btn:focus {
			outline: none;
			color: rgb(56, 94, 150);
		}

		.logout-btn {
			background: transparent;
			border: none;
			padding: 8px 18px;
			cursor: pointer;
			color: var(--primary-color, #2a365f);
			text-decoration: none;
			font-size: 0.95rem;
			margin-left: 0;
			transition: background 0.2s;
			width: 100%;
			text-align: left;
		}

		.logout-btn:hover {
			background: rgb(211, 226, 247);
		}

		/* Dropdown styles */
		.nav-user-dropdown {
			position: relative;
			display: flex;
			align-items: center;
		}

		.nav-user-dropdown-content {
			display: none;
			position: absolute;
			right: 0;
			top: 110%;
			background: whitesmoke;
			min-width: 180px;
			border: 1px solid #ddd;
			box-shadow: 0 2px 8px rgba(56, 94, 150, 0.13);
			z-index: 100;
			padding: 8px 0;
			border-radius: 6px;
		}

		.nav-user-dropdown-content a {
			display: block;
			padding: 0;
			text-decoration: none;
		}

		.nav-user-dropdown.open .nav-user-dropdown-content {
			display: block;
		}
	</style>
	<script>
		function toggleUserDropdown() {
			const dropdown = document.getElementById('navUserDropdown');
			dropdown.classList.toggle('open');
		}
		// Optional: close dropdown when clicking outside
		document.addEventListener('click', function (event) {
			const dropdown = document.getElementById('navUserDropdown');
			if (!dropdown.contains(event.target)) {
				dropdown.classList.remove('open');
			}
		});
	</script>
</head>

<body>
	<?php
	include '../config/connection.php';
	$id = $_GET['ref'];
	$sql = "SELECT * FROM users WHERE ID = '$id'";
	$result = $conn->query($sql);
	$conn->close();
	if ($rows = $result->fetch_assoc()) {
		?>
		<div class="nav"
			style="display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 0 5px; min-height: 54px;">
			<div style="text-align: left;">
				<p
					style="margin:0; font-family: 'Archivo'; font-size:1.3rem; font-weight: normal; letter-spacing: 1px; color:rgb(195, 7, 36);">
					PAROCHIAL<span class="span"
						style="color:rgb(20, 89, 193); font-weight: 500; margin-left: 2px;">Suite</span>
				</p>
			</div>
			<div style="display: flex; align-items: center;">
				<div class="nav-user-avatar">
					<i class="fa-solid fa-user"></i>
				</div>
				<div class="nav-user-dropdown" id="navUserDropdown">
					<div style="display: flex; align-items: center;">
						<div class="nav-user-info">
							<span><?php echo htmlspecialchars($rows['Name']); ?></span>
							<span><?php echo htmlspecialchars($rows['role']); ?>
								<?php echo htmlspecialchars($_COOKIE['user']); ?></span>
						</div>
						<button class="caret-btn" onclick="event.stopPropagation();toggleUserDropdown();"
							aria-label="Show user menu">
							<i class="fa fa-caret-down"></i>
						</button>
					</div>
					<div class="nav-user-dropdown-content">
						<a href="../account_center/index.php?ref=<?php echo $_GET['ref']; ?>" target="_blank"><button
								class="logout-btn">Account
								Center</button></a>
						<a href="#"><button class="logout-btn">Parish Profile</button></a>
						<hr>
						<a href="../logout.php?id=<?php echo $id; ?>"><button class="logout-btn">Logout</button></a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</body>

</html>