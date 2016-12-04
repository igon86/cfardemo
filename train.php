<!DOCTYPE html>
<html>
<body>

<h1>Thanks for your help!</h1>

<?php 
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
            echo("$movie => $rating </br>");
            $txt = "1,$movie,$rating,0\n";
            fwrite($prediction, $txt);
        }
        fclose($prediction);
        $handle = popen("python create_training_set.py ./ratings/* $output_name", "r");
		$read   = fread($handle, 8092);
		echo(" COMMAND OUTPUT: $read");
		pclose($handle);
        echo("</br></br>Thank you! </br>");
        
    }
}
?>

<a href=index.php>Go back to main page</a>

</br></br><a href=prediction.php>See CFAR prediction results</a>
</br></br><a href=movielens_prediction.php>See MOVIELENS prediction results</a>

</br></br><a href=compare_prediction.php>Compare prediction results</a>

</html>
