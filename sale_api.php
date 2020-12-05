<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once('includes/config.php');
$data = json_decode(file_get_contents("php://input")); 

date_default_timezone_set('Asia/Kolkata');



if($data->request_type=='sales_today')
{


$today=date('Y-m-d');

$result = $conn->query("SELECT 	* FROM food_order where order_time>='$today'");
$outp = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
       
   $outp+=$rs["order_bill"];
  //$outp .= '{"Id":"'  . $rs["order_bill"] . '"}';
}
$outp ='{"sales":'.$outp.'}';
echo($outp);

}


if($data->request_type=='sales_seven')
{

$today=date('Y-m-d', strtotime("-7 day"));

$result = $conn->query("SELECT 	* FROM food_order where order_time>='$today'");
$outp = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
       
   $outp+=$rs["order_bill"];
  //$outp .= '{"Id":"'  . $rs["order_bill"] . '"}';
}
$outp ='{"sales":'.$outp.'}';
echo($outp);

}

if($data->request_type=='sales_thirty')
{

$today=date('Y-m-d', strtotime("-30 day"));

$result = $conn->query("SELECT 	* FROM food_order where order_time>='$today'");
$outp = 0;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
       
   $outp+=$rs["order_bill"];
  //$outp .= '{"Id":"'  . $rs["order_bill"] . '"}';
}
$outp ='{"sales":'.$outp.'}';
echo($outp);

}

if($_POST['request_type']=='graph')
{
$col1=array();
$col1["id"]="";
$col1["label"]="Topping";
$col1["pattern"]="";
$col1["type"]="string";



$col2=array();
$col2["id"]="";
$col2["label"]="Sales";
$col2["pattern"]="";
$col2["type"]="number";
$cols = array($col1,$col2);


 $rows=array();




for($i=0;$i<=6;$i++)
{

$today=date('Y-m-d', strtotime("-$i day"));
$j=$i+1;
$future=date('Y-m-d', strtotime("$j day"));


$result = $conn->query("SELECT 	* FROM food_order where order_time>='$today' AND order_time<'$future' ");
 $total=0;
 
 
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
       
      
   $total+=$rs["order_bill"];
   
 
}
$cell1["v"]=$total;
$cell0["v"]=$today;
$row0["c"]=array($cell0,$cell1);
   array_push($rows,$row0);

}



 
$data=array("cols"=>$cols,"rows"=>$rows);
//print_r($data);
echo json_encode($data);
}






$conn->close();

?>