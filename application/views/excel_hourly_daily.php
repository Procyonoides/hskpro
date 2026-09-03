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
<h3 align="center">HOURLY DAILY <?php echo strtoupper($tipe) ?> <?php echo $tanggal1 ?> TO <?php echo $tanggal2 ?></h3>
<strong>DATE: <?php echo $tanggal ?></strong><br>
<?php
echo
	'<table border="2">
		<thead>
			<tr style="font-weight:bold">
				<th style="width:280px;font-size:15px;background:#D3D3D3">ITEM</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 07:00:00 - JAM 07:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 08:00:00 - JAM 08:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 09:00:00 - JAM 09:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 10:00:00 - JAM 10:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 11:00:00 - JAM 11:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 12:00:00 - JAM 12:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 13:00:00 - JAM 13:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 14:00:00 - JAM 14:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 15:00:00 - JAM 15:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 16:00:00 - JAM 16:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 17:00:00 - JAM 17:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 18:00:00 - JAM 18:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 19:00:00 - JAM 19:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 20:00:00 - JAM 20:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 21:00:00 - JAM 21:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 22:00:00 - JAM 22:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 23:00:00 - JAM 23:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 00:00:00 - JAM 00:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 01:00:00 - JAM 01:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 02:00:00 - JAM 02:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 03:00:00 - JAM 03:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 04:00:00 - JAM 04:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 05:00:00 - JAM 05:59:59</th>
				<th style="width:80px;font-size:15px;background:#D3D3D3">JAM 06:00:00 - JAM 06:59:59</th>
				<th style="width:70px;font-size:15px;background:#D3D3D3">TOTAL</th>
			</tr>
		</thead>
		<tbody>';
			
		foreach ($detail as $array)
		{
			echo  '<tr>';
	
			foreach ($array as $key => $val)
			{
				if ($key !== 'item')
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