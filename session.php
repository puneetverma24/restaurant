<?php
 session_start();
echo "permission";
echo $_SESSION['permission'];
echo "<br>";
echo substr($_SESSION['permission'],1,1);


?>