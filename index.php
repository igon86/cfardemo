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

<h1>Hardware Acceleration of Collaborative Filtering: Let us build the CFAR Prediction Model</h1>
 
Which movies did you watch?<br /><br />
<form action="train.php" method="post">
Name: <input type="text" name="name" value="<?php echo $name;?>">

<input type="submit" name="formSubmit" value="Submit" /><br /><br />

<p class="title-item"><span class="item"><b>Movie</b></a></span>
<span class="rating"><b>Rating</b>
<?php
$fh = fopen('./movies_small.txt','r');
if ($fh == 0)
{
    echo "file NOT found";
}

$ratings = array();
$counter = 1;
while ($line = fgets($fh))
{
    list($id, $name, $date, $empty, $link) = split('[|]', $line);
    $ratings[] = -1;
    echo "<p class=\"menu-item\"><span class=\"item\"><a href=\"#\" onclick=\"window.open('$link','name','width=600,height=400'); return false;\">$name</a></span>";
    echo "<span class=\"rating\">";
    echo "<input type=\"radio\" name=\"ratings[$counter]\" value=\"1\">1";
    echo "<input type=\"radio\" name=\"ratings[$counter]\" value=\"2\">2";
    echo "<input type=\"radio\" name=\"ratings[$counter]\" value=\"3\">3"; 
    echo "<input type=\"radio\" name=\"ratings[$counter]\" value=\"4\">4";
    echo "<input type=\"radio\" name=\"ratings[$counter]\" value=\"5\">5";
    echo "</span>";
    echo "</p>";
    $counter++;
}
echo count($names);
fclose($fh);
?>


</table>

</body>
</html>