<?php


$conn=new mysqli("localhost","thevimck_puneet","e9ZSiSJEmv*#","thevimck_gondiashop"); // address usename password Database name
$data = json_decode(file_get_contents("php://input")); 
 
$item_id = mysqli_real_escape_string($conn,$data->item_id);
$item_name = mysqli_real_escape_string($conn,$data->item_name);
$item_price = mysqli_real_escape_string($conn,$data->item_price);
 
 
 
 

 
$sql = " UPDATE food_menu_item SET item_name='$item_name', item_price =  '$item_price' WHERE item_id ='$item_id' ";
 
 
if (mysqli_query($conn,$sql)) {
    echo "Update record successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
