<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['id'])){
		
		$productID = htmlentities($_POST['id']);
		
			
		$defaultImgFolder = 'data/item_images/';
		
		// Get all item details
		$sql = 'SELECT * FROM item WHERE productID = :productID';
		$stmt = $conn->prepare($sql);
		$stmt->execute(['productID' => $productID]);
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$output = '<p><img src="';
		
			if($row['imageURL'] === '' || $row['imageURL'] === 'imageNotAvailable.jpg'){
				$output .= 'data/item_images/imageNotAvailable.jpg" class="img-fluid"></p>';
			} else {
				$output .= 'data/item_images/' . $row['itemNumber'] . '/' . $row['imageURL'] . '" class="img-fluid"></p>';
			}
						
			$output .= '<span><strong>Nombre:</strong> ' . $row['itemName'] . '</span><br>';
			$output .= '<span><strong>Precio:</strong> ' . $row['unitPrice'] . '</span><br>';
			$output .= '<span><strong>Descuento:</strong> ' . $row['discount'] . ' %</span><br>';
			$output .= '<span><strong>Stock:</strong> ' . $row['stock'] . '</span><br>';
		}
		
		echo $output;
	}
?>