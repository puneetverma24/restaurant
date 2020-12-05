<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 
date_default_timezone_set('Asia/Kolkata'); 

$todaydate = date('Y-m-d');

if($data->request_type=='get_coupon')

{

$total = mysqli_real_escape_string($conn,$data->total);

$result = $conn->query("SELECT * FROM discount_table where d_expiry>='$todaydate' and d_activate=1 and d_mbill<=$total and d_coupon='0'");
$outp = "";
while($row = $result->fetch_array(MYSQLI_ASSOC)) {

    if ($outp != "") {$outp .= ",";}
    $outp .= '{"d_id":"'  . $row["d_id"] . '",';
   $outp .= '"d_name":"'  . $row["d_name"] . '",';
   $outp .= '"d_rate":"'  . $row["d_rate"] . '",';
    $outp .= '"d_type":"'  . $row["d_type"] . '",';
    $outp .= '"d_coupon":"'  . $row["d_coupon"] . '"}';
     
      
}
$outp ='{"coupons":['.$outp.']}';

echo($outp);


}



$conn->close();

?>