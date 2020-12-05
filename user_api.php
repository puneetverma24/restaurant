	<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 
date_default_timezone_set('Asia/Kolkata'); 



if($data->request_type=='userDataDirect')
{
  
$user_name = mysqli_real_escape_string($conn,$data->user_name);
$user_phone = mysqli_real_escape_string($conn,$data->user_number);
$user_gender = mysqli_real_escape_string($conn,$data->user_gender);
$user_email = mysqli_real_escape_string($conn,$data->user_email);
$user_dob = mysqli_real_escape_string($conn,$data->user_dob); 
 
$newDate = date("Y-m-d", strtotime($user_dob));


$sql = "INSERT INTO `user_profile` (`user_id`, `user_name`, `user_phone`, `user_gender`, `user_dob`, `user_email`) VALUES ('', '$user_name', '$user_phone', '$user_gender', '$newDate', '$user_email')";

if (mysqli_query($conn,$sql)) {
   // echo "New record delete successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}


}


if($data->request_type=='updateUserData')
{
$user_id = mysqli_real_escape_string($conn,$data->user_id);
$user_name = mysqli_real_escape_string($conn,$data->user_name);
$user_phone = mysqli_real_escape_string($conn,$data->user_number);
$user_gender = mysqli_real_escape_string($conn,$data->user_gender);
$user_email = mysqli_real_escape_string($conn,$data->user_email);
$user_dob = mysqli_real_escape_string($conn,$data->user_dob); 

$newDate = date("Y-m-d", strtotime($user_dob));
 
$sql = " UPDATE user_profile SET user_name='$user_name', user_phone = '$user_phone', user_gender = '$user_gender', user_dob = '$newDate', user_email = '$user_email' WHERE user_id ='$user_id' ";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}


if($data->request_type=='user_records')

{

 

$result = $conn->query("SELECT * FROM user_profile ");
$outp = "";
while($row = $result->fetch_array(MYSQLI_ASSOC)) {

    if ($outp != "") {$outp .= ",";}
    $outp .= '{"user_id":"'  . $row["user_id"] . '",';
    $outp .= '"user_name":"'  . $row["user_name"] . '",';
    $outp .= '"user_gender":"'  . $row["user_gender"] . '",';
    $outp .= '"user_email":"'  . $row["user_email"] . '",';
     $outp .= '"user_dob":"'  . $row["user_dob"] . '",';
    $outp .= '"user_number":"'  . $row["user_phone"] . '",';
    $outp .= '"user_address":"'  . $row["user_address"] . '"}';
     
      
}
$outp ='{"userRecords":['.$outp.']}';

echo($outp);


}

// Delete User Data 

if($data->request_type=='delete')

{
$delete_user_id = mysqli_real_escape_string($conn,$data->user_id);

$sql = "DELETE FROM user_profile WHERE user_id = '$delete_user_id' ";

 
if (mysqli_query($conn,$sql)) {
   // echo "New record delete successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}










// Below Codes are use in order_bill

if($data->request_type=='user_array')

{

$user_id = mysqli_real_escape_string($conn,$data->user_id);

$result = $conn->query("SELECT * FROM user_profile where user_id = $user_id ");
$outp = "";
while($row = $result->fetch_array(MYSQLI_ASSOC)) {

    if ($outp != "") {$outp .= ",";}
    $outp .= '{"user_id":"'  . $row["user_id"] . '",';
    $outp .= '"user_name":"'  . $row["user_name"] . '",';
    $outp .= '"user_number":"'  . $row["user_phone"] . '",';
    $outp .= '"user_address":"'  . $row["user_address"] . '"}';
     
      
}
$outp ='{"users":['.$outp.']}';

echo($outp);


}















 

if($data->request_type=='userData')
{
  
$user_name = mysqli_real_escape_string($conn,$data->user_name);
$user_number = mysqli_real_escape_string($conn,$data->user_number);
$user_gender = mysqli_real_escape_string($conn,$data->user_gender);
$user_email = mysqli_real_escape_string($conn,$data->user_email);
$user_dob = mysqli_real_escape_string($conn,$data->user_dob); 
 
$newDate = date("Y-m-d", strtotime($user_dob));

$order_id = mysqli_real_escape_string($conn,$data->order_id);

$exist = $conn->query("SELECT user_id FROM user_profile where user_phone = '$user_number' ");
$check= $exist->fetch_array(MYSQLI_ASSOC);



if (!$check["user_id"])
{
 //echo "not exist";
$sql = $conn->query("INSERT INTO `user_profile` (`user_id`, `user_name`, `user_phone`, `user_gender`, `user_dob`, `user_email`) VALUES ('', '$user_name', '$user_number', '$user_gender', '$newDate', '$user_email')");

   $result = $conn->query("SELECT user_id FROM user_profile where user_phone = '$user_number' ");
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $user_id = $row["user_id"];
   $newSql= $conn->query("UPDATE food_order SET user_id='$user_id' WHERE order_id = '$order_id' ");

}
else
{
//echo "already";
$user_id = $check["user_id"];
$newSql= $conn->query("UPDATE food_order SET user_id='$user_id' WHERE order_id = '$order_id' ");

}

 
}  

$conn->close();





?>