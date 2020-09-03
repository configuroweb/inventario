<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$customerDetailsSearchSql = 'SELECT * FROM customer';
	$customerDetailsSearchStatement = $conn->prepare($customerDetailsSearchSql);
	$customerDetailsSearchStatement->execute();

	$output = '<table id="customerDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>ID Cliente</th>
						<th>Nombre Completo</th>
						<th>Correo</th>
						<th>Teléfono 1</th>
						<th>Teléfono 2</th>
						<th>Dirección</th>
						<th>Departamento</th>
						<th>Ciudad</th>
						<th>Barrio</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $customerDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $row['customerID'] . '</td>' .
						'<td>' . $row['fullName'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $row['mobile'] . '</td>' .
						'<td>' . $row['phone2'] . '</td>' .
						'<td>' . $row['address'] . '</td>' .
						'<td>' . $row['address2'] . '</td>' .
						'<td>' . $row['city'] . '</td>' .
						'<td>' . $row['district'] . '</td>' .
						'<td>' . $row['status'] . '</td>' .
					'</tr>';
	}
	
	$customerDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
						<th>ID Cliente</th>
						<th>Nombre Completo</th>
						<th>Correo</th>
						<th>Teléfono 1</th>
						<th>Teléfono 2</th>
						<th>Dirección</th>
						<th>Departamento</th>
						<th>Ciudad</th>
						<th>Barrio</th>
						<th>Estado</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>