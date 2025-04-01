<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/script.js"></script>
	<title>Page with letter head</title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br><br>
	<div class="container">
		<div>
			<div style="background-color: var(--heading); padding: 10px">
				<table width="100%">
					<tr>
						<td class="objTitle">Letter Head</td>
						<td><button style="float: right;" onclick="printDoc('letterHead');">Print</button></td>
					</tr>
				</table>		
			</div>
			<br>
			<div id="letterHead" class="container" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; height: 50%;">
				<?php include '../prefrences/letterHead_header.php'; ?>
			</div>
		</div>
	</div>
</body>
</html>