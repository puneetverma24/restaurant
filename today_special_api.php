 <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 


if($data->request_type=='display')
{

$result = $conn->query("SELECT 	item_id, item_name, item_price,item_image_url,item_dicount_price, category_name FROM food_menu_item");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Id":"'  . $rs["item_id"] . '",';
    $outp .= '"Name":"'   . $rs["item_name"]        . '",';
    $outp .= '"Image":"'   . $rs["item_image_url"]        . '",';
    $outp .= '"Category":"'   . $rs["category_name"]        . '",';
     $outp .= '"Discount_price":"'   . $rs["item_dicount_price"]        . '",';
    $outp .= '"Price":"'. $rs["item_price"]     . '"}';
}
$outp ='{"Records":['.$outp.']}';

echo($outp);

}



if($data->request_type=='category_display')
{

$result = $conn->query("SELECT 	category_id, category_name FROM item_category");
$outp2 = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp2 != "") {$outp2 .= ",";}
    $outp2 .= '{"category_id":"'  . $rs["category_id"] . '",';
    $outp2 .= '"category_name":"'   . $rs["category_name"]        . '"}';
    
}
$outp2 ='{"category":['.$outp2.']}';

echo($outp2);

}



if($data->request_type=='updateData')
{
$item_id = mysqli_real_escape_string($conn,$data->item_id); 
$item_d_price = mysqli_real_escape_string($conn,$data->item_d_price);
$item_d_expiry = mysqli_real_escape_string($conn,$data->item_d_expiry);
 

//$newDate = date("Y-m-d", strtotime($item_d_expiry));
 
 
$sql = " UPDATE food_menu_item SET item_discount_price ='$item_d_price' , item_discount_expiry='$item_d_expiry' WHERE item_id ='$item_id' ";
 
 
if (mysqli_query($conn,$sql)) {
  //  echo "Update record successfully";
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

}






$conn->close();
?>