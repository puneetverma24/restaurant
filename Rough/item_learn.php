<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn=new mysqli("localhost","thevimck_puneet","e9ZSiSJEmv*#","thevimck_gondiashop"); // address usename password Database name

$result = $conn->query("SELECT 	item_id, item_name, item_price FROM food_menu_item");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Id":"'  . $rs["item_id"] . '"}';
   // $outp .= '"Name":"'   . $rs["item_name"]        . '",';
   // $outp .= '"Price":"'. $rs["item_price"]     . '"}';
}
$outp ='{"Records":['.$outp.']}';
$conn->close();

echo($outp);
?>