<html>
<head>
	<title>
	<style>
		body {font-family:calibri}
		table {border-collapse: collapse}	
		
		td {
			padding: 7px 15px;
			color: black;
			font-size: 12px;
		}
	</style>	
	</title>
</head>
<body>
<h3 align="center">SUMMARY MONTHLY <?php echo strtoupper($tipe) ?> <?php echo $tanggal1 ?> TO <?php echo $tanggal2 ?></h3>
<strong>DATE: <?php echo $tanggal ?></strong><br>
<?php
echo
	'<table border="2">
		<thead>
			<tr style="font-weight:bold">
				<th style="width:280px;font-size:15px;background:#D3D3D3">MODEL</th>
				<th style="width:230px;font-size:15px;background:#D3D3D3">COLOR</th>
				<th style="width:180px;font-size:15px;background:#D3D3D3">DESCRIPTION</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">10K</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">10TK</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">11K</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">11TK</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">12K</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">12TK</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">13K</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">13TK</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">1</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">1T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">2</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">2T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">3</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">3T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">4</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">4T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">5</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">5T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">6</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">6T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">7</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">7T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">8</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">8T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">9</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">9T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">10</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">10T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">11</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">11T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">12</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">12T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">13</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">13T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">14</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">14T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">15</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">15T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">16</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">16T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">17</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">17T</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">18</th>
				<th style="width:50px;font-size:15px;background:#D3D3D3">18T</th>
				<th style="width:70px;font-size:15px;background:#D3D3D3">TOTAL</th>
			</tr>
		</thead>
		<tbody>';
			
		foreach ($detail as $array)
		{
			echo  '<tr>';
	
			foreach ($array as $key => $val)
			{
				if ($key !== 'model' && $key !== 'color' && $key !== 'description')
				{
					if($val == '0')
					{
						$val = "";
					} else
					{
						$val;
					}
				}
		
			echo '<td>'. $val .'</td>';

			}
		echo '</tr>';
		}
?>
		</tbody>
</table>	
</body>
</html>