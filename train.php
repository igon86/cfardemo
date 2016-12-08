<!DOCTYPE html>
<html>
<body>
<h1>Thanks for your help!</h1>

<?php 
ob_implicit_flush(true);
ob_end_flush();

//session_start();
$ratings = $_POST['ratings'];
$name = $_POST['name'];
if(empty($ratings)) 
{
    echo("You don't like movies?");
} 
else
{
    if(empty($ratings)) 
    {
        echo("You didn't specified your name!");
    } 
    else
    {
		
        $N = count($ratings);
		echo("You selected $N movie(s): </br>");
        $N2 = count($names);
        //echo $N2;
        $id = uniqid();
        $output_name = "ratings_$name-$id.txt";
		$prediction = fopen($output_name, "w") or die("can't open file");
        foreach($ratings as $movie => $rating)
        {        
            //echo("$movie => $rating </br>");
            $txt = "1,$movie,$rating,0\n";
            fwrite($prediction, $txt);
        }
        fclose($prediction);
		
		// create training set
        $handle = popen("python create_training_set.py ./ratings/* $output_name", "r");
		$read   = fread($handle, 8092);
		//echo  nl2br (" COMMAND OUTPUT: $read\n");
		pclose($handle);
	
		flush();
		/* $_SESSION['read'] = $read;	 */
		/* $_SESSION['output_name'] = $output_name;	 */
		/* header("Location: test.php"); /\* Redirect browser *\/ */
		/* exit(); */

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

        echo("</br></br>Prediction Complete! </br>");

    }
}
?>

<a href=index.php>Go back to main page</a>
</br></br>
<a href=prediction.php>See CFAR prediction results</a>        


</html>
