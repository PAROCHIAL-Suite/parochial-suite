<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="searchContainer">
        <table>
			<tr>
				<td colspan="5" width="50%">					
					<input type="text" name="query" id="searchbox" placeholder="Type here..." >
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>	
				<td>
					<button onclick="location.reload();" >
						<i style="font-size:14px; color: #202020;" class="fa">&#xf021;</i>
					</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button  class="excelBtn" onclick="exportToExcel('table', 'Exported from parochilcloud')">Export to Excel</button>					
				
				</td>							
			</tr>          		
        </table>	
	</div>
</body>
</html>	


