<?php

session_start();
require_once('includes/config.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents("php://input"));

if (!isset($myObj)) {
    $myObj = new stdClass();
} // to initialize object ,other it will work, but you get warning message

$username = $data->username;
$password = $data->password;
 
$sql      = "SELECT * FROM access_level WHERE username = '$username' AND password = '$password' ";

$result   = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $role       = $row['role'];
        $permission = $row['permission'];
    } //$row = $result->fetch_assoc()
    $_SESSION['username']   = $username;
    $_SESSION['status']     = "success";
    $_SESSION['role']       = $role;
    $_SESSION['permission'] = $permission;
    $myObj->status          = "success";
    $result                 = $conn->query("SELECT restaurant_id, restaurant_name, restaurant_phone FROM restaurant_details");
    while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
        // $_SESSION['restaurant_id']=$rs["restaurant_id"]; 
        $_SESSION['restaurant_name']  = $rs["restaurant_name"];
        $_SESSION['restaurant_phone'] = $rs["restaurant_phone"];
    } //$rs = $result->fetch_array(MYSQLI_ASSOC)
} //$result->num_rows > 0
else {
    session_unset();
    session_destroy();
    $myObj->status = "failed";
}
$myJSON = json_encode($myObj);
echo $myJSON;
?>