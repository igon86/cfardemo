<!DOCTYPE html>
<html>
<body>

<h1>Thanks for your help!</h1>

<?php 
session_start();
$read = $_SESSION['read'];
$output_name = $_SESSION['output_name'];

		// perform training
        $handle = popen("./rbmApp $read 2>&1", "r");
		$read   = fread($handle, 8092);
		//echo nl2br (" TRAINING OUTPUT: $read\n");
		pclose($handle);

		// perform prediction on the new model
		$handle = popen("./predict-fp 1682 edges_after_training.txt $output_name 2>&1","r");
		$read   = fread($handle, 8092); 
		//echo (" PREDICTION OUTPUT: $read\n"); 
		pclose($handle); 
		ob_flush();

		header("Location: prediction.php"); /* Redirect browser */
		exit();

?>



</html>
