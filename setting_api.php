 <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Kolkata');
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 


if($data->request_type=='rDisplay')
{

$result = $conn->query("SELECT 	restaurant_id, restaurant_name, restaurant_phone, restaurant_address , restaurant_gstno, restaurant_taxtype, no_of_table  FROM restaurant_details");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"rId":"'  . $rs["restaurant_id"] . '",';
    $outp .= '"rName":"'   . $rs["restaurant_name"]        . '",';
    $outp .= '"rPhone":"'   . $rs["restaurant_phone"]        . '",';
    $outp .= '"rAddress":"'   . $rs["restaurant_address"]        . '",';
    $outp .= '"rTaxType":"'   . $rs["restaurant_taxtype"]        . '",';
    $outp .= '"rNoTable":"'   . $rs["no_of_table"]        . '",';
    $outp .= '"rGstNo":"'. $rs["restaurant_gstno"]     . '"}';
}
$outp ='{"Restaurant":['.$outp.']}';

echo($outp);

}


if($data->request_type=='rUpdate')
{
$rId = mysqli_real_escape_string($conn,$data->rId);
$rName = mysqli_real_escape_string($conn,$data->rName);
$rPhone = mysqli_real_escape_string($conn,$data->rPhone);
$rAddress = mysqli_real_escape_string($conn,$data->rAddress);
$rGstNo = mysqli_real_escape_string($conn,$data->rGstNo);
$rTaxType = mysqli_real_escape_string($conn,$data->rTaxType);
$rNoTable = mysqli_real_escape_string($conn,$data->rNoTable); 
 
$sql = " UPDATE restaurant_details SET  restaurant_name='$rName', restaurant_phone='$rPhone', restaurant_address='$rAddress', restaurant_gstno='$rGstNo', restaurant_taxtype='$rTaxType', no_of_table='$rNoTable'  WHERE restaurant_id='$rId' ";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}


if($data->request_type=='dInsert')
{
$d_name = mysqli_real_escape_string($conn,$data->dName);
$d_type = mysqli_real_escape_string($conn,$data->dType);
$d_rate = mysqli_real_escape_string($conn,$data->dRate);
$d_coupon = mysqli_real_escape_string($conn,$data->dCoupon);
$d_mbill = mysqli_real_escape_string($conn,$data->dMbill);
$d_description = mysqli_real_escape_string($conn,$data->dDescription);
$d_active = mysqli_real_escape_string($conn,$data->dActive);
$d_expiry = mysqli_real_escape_string($conn,$data->dExpiry);
 $newDate = date("Y-m-d", strtotime($d_expiry));
 
$sql = "INSERT INTO `discount_table` (`d_id`, `d_name`, `d_type`, `d_rate`, `d_mbill`, `d_coupon`, `d_activate`,`d_description`,`d_expiry`) VALUES ('', '$d_name', '$d_type', '$d_rate', '$d_mbill','$d_coupon','$d_active','$d_description','$newDate')";

 
if (mysqli_query($conn,$sql)) {
  //  echo "New record created successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}



if($data->request_type=='dDisplay')
{

$result = $conn->query("SELECT 	d_id, d_name, d_type, d_rate , d_mbill, d_coupon, d_activate, d_description, d_expiry  FROM discount_table");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"dId":"'  . $rs["d_id"] . '",';
    $outp .= '"dName":"'   . $rs["d_name"]        . '",';
    $outp .= '"dType":"'   . $rs["d_type"]        . '",';
     $outp .= '"dRate":"'   . $rs["d_rate"]        . '",';
      $outp .= '"dMbill":"'   . $rs["d_mbill"]        . '",';
    $outp .= '"dCoupon":"'. $rs["d_coupon"]     . '",';
      $outp .= '"dDescription":"'. $rs["d_description"]     . '",';
          $outp .= '"dExpiry":"'. $rs["d_expiry"]     . '",';
    $outp .= '"dActive":"'. $rs["d_activate"]     . '"}';
}
$outp ='{"Discount":['.$outp.']}';

echo($outp);

}

if($data->request_type=='dUpdate')
{
$d_id = mysqli_real_escape_string($conn,$data->dId);
$d_name = mysqli_real_escape_string($conn,$data->dName);
$d_type = mysqli_real_escape_string($conn,$data->dType);
$d_rate = mysqli_real_escape_string($conn,$data->dRate);
$d_coupon = mysqli_real_escape_string($conn,$data->dCoupon);
$d_mbill = mysqli_real_escape_string($conn,$data->dMbill);
$d_description = mysqli_real_escape_string($conn,$data->dDescription);
$d_active = mysqli_real_escape_string($conn,$data->dActive);
 $d_expiry = mysqli_real_escape_string($conn,$data->dExpiry);
 $newDate = date("Y-m-d", strtotime($d_expiry));
 //$d_expiry = new DateTime( $d_expiry , new DateTimeZone('IST'));
 // $d_expiry=date("Y-m-d", $d_expiry);
 
$sql = " UPDATE discount_table SET d_name='$d_name', d_type='$d_type', d_rate = '$d_rate', d_mbill = '$d_mbill', d_activate = '$d_active', d_description ='$newDate', d_coupon = '$d_coupon', d_expiry  =  '$newDate' WHERE d_id ='$d_id'";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}

if($data->request_type=='dDelete')
{
$delete_d_id = mysqli_real_escape_string($conn,$data->dId);

$sql = "DELETE FROM `discount_table` WHERE d_id = '$delete_d_id' ";

 
if (mysqli_query($conn,$sql)) {
   // echo "New record delete successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}


if($data->request_type=='dStatus')
{
$d_id = mysqli_real_escape_string($conn,$data->dId);
$d_activate = mysqli_real_escape_string($conn,$data->dActive);
if($d_activate == 1){
$d_status = 0;
}
else {
$d_status = 1;
} 
$sql = " UPDATE discount_table SET d_activate='$d_status' WHERE d_id ='$d_id'";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();

?>