	<div class="searchContainer">
        <table>
				<td colspan="5" width="35%">
					<i style="font-size:15px; margin-left: 20px; margin-right:10px;" class="fa">&#xf002;</i>
					<input type="text" name="query" id="searchbox" placeholder="Search by name, surname, dob, etc." style="width: 400px;">
				</td>	
				<td>
					<button onclick="location.reload();" >
						<i style="font-size:17px; color: green" class="fa">&#xf021;</i>

					</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button  class="excelBtn" onclick="exportToExcel('table', 'Exported from parochilcloud')">Export as excel</button>					
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button  class="excelBtn" onclick="exportTableToPDF()" >PDF</button>
				</td>							
			</tr>          		
        </table>	
	</div>
