<!DOCTYPE html>
<html>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.js"></script>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<script type='text/javascript'>//<![CDATA[
      $(function(){
          $('input[type="radio"]').mousedown(function() {
              if (this.checked) {
                  $(this).mouseup(function(e) {
                      var radio = this;
                      setTimeout(function() {
                          radio.checked = false;
                      }, 5);
                      $(this).unbind('mouseup');
                  });
              }
          });
      });//]]>
</script>

<body>

<h1>These are our suggestions</h1> 

<!-- <p class="title-item"><span class="item"><b>Movie</b></a></span> -->
<!-- <span class="rating"><b>Rating</b>  -->

<?php
/* $fh = fopen('./output_predictions.txt','r'); */
/* if ($fh == 0) */
/* { */
/*     echo "\nfile NOT found\n"; */
/* } */
/* $ratings = array(); */
/* $counter = 1; */
/* while ($line = fgets($fh)) */
/* { */
/* 	echo $line; */
/*     $rat=$line; */
/*     $ratings[] = $rat; */
/* } */
/* fclose($fh); */

/* $fh = fopen('./movies.txt','r'); */
/* if ($fh == 0) */
/* { */
/*     echo "file NOT found"; */
/* } */
/* $counter = 1; */
/* while ($line = fgets($fh)) */
/* { */
/* 	echo nl2br ("$line \n"); */
/*     list($id, $name, $date, $empty, $link) = split('[|]', $line); */
/*     if ($ratings[$counter] == "5\n") */
/*     { */
/*     echo "<p class=\"menu-item\"><span class=\"item\"><a href=\"#\" onclick=\"window.open('$link','name','width=600,height=400'); return false;\">$name</a></span>"; */
/*     echo "</p>"; */
/*     } */
/*     $counter++; */
/* } */
/* fclose($fh); */

	 $handle = popen("python suggestions.py 2>&1","r");
while ($line = fgets($handle)) 
{ 

 	list($name, $score) = split('[,]', $line);  
 	echo nl2br ("$name \n"); 
/* echo "<p class=\"menu-item\"><span class=\"item\"><a href=\"#\" onclick=\"window.open('$link','name','width=600,height=400'); return false;\">$name</a></span>";  */
/* echo "</p>"; */
}
	 pclose($handle); 

?>

<!-- </table> -->
</br></br>
<a href=index.php>Go back to main page</a>
</br></br>

</body>
</html>