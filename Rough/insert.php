<?php


$conn=new mysqli("localhost","thevimck_puneet","e9ZSiSJEmv*#","thevimck_gondiashop"); // address usename password Database name
$data = json_decode(file_get_contents("php://input")); 
 
$item_id = mysqli_real_escape_string($conn,$data->item_id);
$item_name = mysqli_real_escape_string($conn,$data->item_name);
$item_price = mysqli_real_escape_string($conn,$data->item_price);
 
 
 

$sql = "INSERT INTO `thevimck_gondiashop`.`food_menu_item` (`item_id`, `restaurant_id`, `item_name`, `item_description`, `item_image_url`, `item_price`, `item_dicount_price`, `item_type`, `category_name`) VALUES ('$item_id', '1', '$item_name', 'Kadwa', 'jgh', '$item_price', '120', 'Veg', 'Main Course')";

 
if (mysqli_query($conn,$sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>