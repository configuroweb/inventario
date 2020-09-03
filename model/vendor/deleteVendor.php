<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['vendorDetailsVendorID'])){
		
		$vendorDetailsVendorID = htmlentities($_POST['vendorDetailsVendorID']);
		
		// Check if mandatory fields are not empty
		if(!empty($vendorDetailsVendorID)){
			
			// Sanitize vendorID
			$vendorDetailsVendorID = filter_var($vendorDetailsVendorID, FILTER_SANITIZE_STRING);

			// Check if the customer is in the database
			$vendorSql = 'SELECT vendorID FROM vendor WHERE vendorID=:vendorID';
			$vendorStatement = $conn->prepare($vendorSql);
			$vendorStatement->execute(['vendorID' => $vendorDetailsVendorID]);
			
			if($vendorStatement->rowCount() > 0){
				
				// Vendor exists in DB. Hence start the DELETE process
				$deleteVendorSql = 'DELETE FROM vendor WHERE vendorID=:vendorID';
				$deleteVendorStatement = $conn->prepare($deleteVendorSql);
				$deleteVendorStatement->execute(['vendorID' => $vendorDetailsVendorID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Proveedor Eliminado.</div>';
				exit();
				
			} else {
				// Vendor does not exist, therefore, tell the user that he can't delete that vendor 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>El vendedor no existe en DB. Por lo tanto, no se puede eliminar.</div>';
				exit();
			}
			
		} else {
			// vendorDI is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Ingrese el ID del proveedor</div>';
			exit();
		}
	}
?>