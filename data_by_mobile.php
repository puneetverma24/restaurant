<?php
require_once('includes/config.php');



$q = $_GET['q'];
//$q="A";
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}


$sql="SELECT * FROM user_profile WHERE user_phone LIKE '%$q%'";
$result = mysqli_query($conn,$sql);




while($row = mysqli_fetch_array($result)) {
  echo "<br>";
    echo $row['user_name']."  ";
    echo "<t>"; 
    echo  $row['user_phone']; 
   echo "<br>";
   
   
}

mysqli_close($conn);
?>