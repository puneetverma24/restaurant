<?php
error_reporting(E_ERROR | E_PARSE);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 

 date_default_timezone_set('Asia/Kolkata'); 

$todaydate = date('Y-m-d');

$discount=0;


if($data->request_type=='coupon')
{
  
 $check_coupon=$data->check_coupon;
  $total_bill=$data->total_bill;
 $auto_discount=$data->auto_discount;
 $result = $conn->query("SELECT * FROM discount_table where d_activate=1 and d_coupon='$check_coupon'");
 
//$result = $conn->query("SELECT * FROM discount_table where d_expiry>='$todaydate' and d_activate=1 and d_mbill<=$total and d_coupon='0'");

 
 
if($result->num_rows > 0)
{

$r="1";
while($row = $result->fetch_assoc())
{

$n = 'fg';
//$discount=$row[''];

if($row['d_expiry']<$todaydate)
{
$discount=$auto_discount;
$mess="Sorry! Coupon Code Expiry";

}
else{


if($row['d_mbill']>$total_bill)
{
$discount=$auto_discount;
$mess="Minimum Bill should be ".$row['d_mbill'];

}
else
{


 
        if($row[d_type]==0)
        {
        $discount=$row[d_rate];
       
        
        }
      
      
        if($row[d_type]==1)
         {
         $discount=($row[d_rate]*$total_bill)/100;
        
         }







$mess="Applied Successfully";
}


}






}




}
else
{

$r="0";
$discount="$auto_discount";
$mess="Invalid Coupon";
}

 // "check":[{"status":"'.$r.'"},{"mess":"'.$mess.'"},{"discount":"'.$discount.'"}]  THIS will also work

$h='

{
"check":[{"status":"'.$r.'","name":"","mess":"'.$mess.'","discount":"'.$discount.'"}]

}


';
echo $h;
 


 
}

 
if($data->request_type=='order_bill')
{
 

$order_id=$data->order_id;

$result = $conn->query("SELECT * FROM food_order where order_id='$order_id'");

$outp = "";

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"order_id":"'  . $row["order_id"] . '",';
    $outp .= '"order_items":"'   . $row["order_items"] . '",';
     $outp .= '"order_qty":"'   . $row["order_qty"] . '",';
      $outp .= '"current_price":"'   . $row["current_price"] . '",';
       $outp .= '"item_price":"'   . $row["item_price"] . '",';
      $outp .= '"order_time":"'   . $row["order_time"]. '",';
    $outp .= '"order_bill":"'. $row["order_bill"]. '",';
     $outp .= '"user_id":"'   . $row["user_id"]. '",';
     $outp .= '"order_status":"'   . $row["order_status"].'"}';
      
}

//}

//$outp ='{"orders":['.$outp.']}';

//echo($outp);

$a=json_decode($outp);
//var_dump($a);
 
$getItemName=$a->order_items;
$getItemQty=$a->order_qty;
$getCurrentPrice=$a->current_price;
$getItemPrice=$a->item_price;
$getUserId=$a->user_id;

$ItemNameArray = explode(',', $getItemName);
$ItemQtyArray=explode(',',$getItemQty);
$ItemPriceArray=explode(',',$getItemPrice); 
$CurrentPriceArray=explode(',',$getCurrentPrice);

getItem($ItemNameArray,$conn,$ItemQtyArray,$getUserId,$ItemPriceArray,$CurrentPriceArray);



}



function getItem($ItemNameArray,$conn,$ItemQtyArray,$getUserId,$ItemPriceArray,$CurrentPriceArray)
{

   $i=0;
   $outp2 = "";
   foreach($ItemNameArray as $x){
 

         $result = $conn->query("SELECT item_name FROM food_menu_item where item_id='$x'");

         while($row = $result->fetch_array(MYSQLI_ASSOC)) {
         if ($outp2 != "") {$outp2 .= ",";}
         $outp2 .= '{"item_name":"'  . $row["item_name"] . '",';
         $outp2 .= '"item_qty":"'  . $ItemQtyArray[$i] . '",';
         $outp2 .= '"item_current_price":"'.$CurrentPriceArray[$i].'",';
         $outp2 .= '"item_actual_price":"'.$ItemPriceArray[$i].'",';
         $outp2 .= '"user_id":"'  .  $getUserId . '"}';
          
    
         }
    $i++;
   }
   
$outp2 ='{"orders":['.$outp2.']}';

echo($outp2);

}






$conn->close();

?>




