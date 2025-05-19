<?php
// Connect to database and fetch data
	include '../mobile_connection.php';
// replace this with mob_conn file

	$sql = "SELECT city_code, COUNT(*) AS user_count FROM u381709061_mobile_db.users GROUP BY city_code ORDER BY user_count DESC";
	$result = $conn_mob->query($sql);                                            

	// Convert to associative array
	$city = [];
	$count = [];
	while ($rows=$result->fetch_assoc()){
	    $city[] = $rows['city_code'];
	    $count[] = $rows['user_count'];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

<div id="myPlot" style="width:100%; max-width: 900px; overflow: auto !important;"></div>

<script>
const xArray = <?php echo json_encode($city); ?>;
const yArray = <?php echo json_encode($count); ?>;
// const xArray = ["Italy", "France", "Spain", "USA", "Argentina"];
// const yArray = [0, 1, 3, 4 ,5, ,6 ,7 , 8, 9,10,11,12,13,14,15];

const data = [{
  x:xArray,
  y:yArray,
  type: "line",
  orientation: "v",

  marker: {color:"#3C5898"}
}];

var layout = {
  title:"Churches & Their Family Count",
  plot_bgcolor: 'white', // Change plot area background color
  paper_bgcolor: '' // Change the whole chart background color
};


Plotly.newPlot("myPlot", data, layout);
</script>

</body>
</html>


