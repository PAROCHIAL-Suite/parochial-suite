<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" type="image/x-icon" href="#">
	<title>Parochial Suite</title>
</head>

<body style="background-color: rgb(243, 243, 243);">
	<?php include '../nav/app_header_nav.php'; ?>

	<div class="main">
		<main>
			<?php
			// Default page if none specified
			$defaultPage = "../home/index.php";
			// Get the requested page from the URL, or use default
			$page = isset($_GET['page']) ? $_GET['page'] : $defaultPage;
			// Optional: Security - allow only certain pages
			$allowed = [
				"../home/index.php",
				"../family/family_list.php",
				"../family/member_list.php",
				"../council/create_tenure.php",
				"../council/add_council_member.php",
				"../council/member_list.php",
				// ...add more allowed pages here
			];
			if (!in_array($page, $allowed)) {
				$page = $defaultPage;
			}
			?>
			<iframe src="<?php echo htmlspecialchars($page); ?>" width="100%" height="100%" id="iframe"></iframe>
		</main>
	</div>
</body>

</html>