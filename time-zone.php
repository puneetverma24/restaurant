<?php

echo 'Time zone is: '.date('e');
echo "<br>";

echo 'Time zone is: '.date_default_timezone_get(); 

echo "<br>";


echo date('d-m-Y H:i');
echo "<br>";
date_default_timezone_set('Asia/Kolkata');


echo 'Time zone is: '.date('e');
echo "<br>";
echo 'Time zone is: '.date_default_timezone_get(); 

echo "<br>";

echo date('Y-m-d H:i:s');


$timestamp = date('Y-m-d H:i:s');  //in database pass $timestamp
echo "Data=".$timestamp ;


$d=mktime(11, 14, 54, 12, 13, 2017); //mktime(hour,minute,second,month,day,year) 
echo "sc=".$d;
echo "<br>";
echo date("Y-m-d H:i:s", $d);




?>