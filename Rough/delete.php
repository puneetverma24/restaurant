<?php


$conn=new mysqli("localhost","thevimck_puneet","e9ZSiSJEmv*#","thevimck_gondiashop"); // address usename password Database name
$data = json_decode(file_get_contents("php://input")); 
 
$delete_item_id = mysqli_real_escape_string($conn,$data->item_id);
 
 

$sql = "DELETE FROM `food_menu_item` WHERE item_id = '$delete_item_id' ";

 
if (mysqli_query($conn,$sql)) {
    echo "New record delete successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>