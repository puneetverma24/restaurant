<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 



if($data->request_type=='accountDisplay')
{

$result = $conn->query("SELECT uid, username, role, permission FROM access_level");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"username":"'  . $rs["username"] . '",';
    $outp .= '"role":"'   . $rs["role"]  . '",';
    $outp .= '"uid":"'   . $rs["uid"]  . '",';
    $outp .= '"permission":"'   . $rs["permission"]  . '"}';
    
}
$outp ='{"access":['.$outp.']}';

echo($outp);

}

if($data->request_type=='insertAC')
{
$user_name = mysqli_real_escape_string($conn,$data->user_name);
$user_pwd = mysqli_real_escape_string($conn,$data->user_pwd);
$user_role = mysqli_real_escape_string($conn,$data->user_role);
 
 if ($user_role=='Admin')
 { $user_permission = '11111100'; }
 if ($user_role=='Manager')
  { $user_permission = '01111100'; }
  if ($user_role=='Waiter')
  { $user_permission = '00001000'; }
  
$sql = "INSERT INTO `access_level` (`username`, `password`, `role`, `permission`) VALUES ('$user_name', '$user_pwd', '$user_role','$user_permission')";

 
if (mysqli_query($conn,$sql)) {
  //  echo "New record created successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}



}

if($data->request_type=='new_permission')
{
$uid = mysqli_real_escape_string($conn,$data->u_id);
$new_permission = mysqli_real_escape_string($conn,$data->new_per_mission);
 
 
$sql = " UPDATE access_level SET permission='$new_permission' WHERE uid ='$uid' ";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}


if($data->request_type=='deleteUser')
{
$uid = mysqli_real_escape_string($conn,$data->u_id);
 
 
 
$sql = " Delete FROM access_level WHERE uid ='$uid' ";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}





$conn->close();

?>