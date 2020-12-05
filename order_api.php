<?php
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );
require_once( 'includes/config.php' );
$data = json_decode( file_get_contents( "php://input" ) );
date_default_timezone_set( 'Asia/Kolkata' ); //time zone set to india

if ( $data->request_type == 'orderPlaced' ) {
    $cart_item_id       = mysqli_real_escape_string( $conn, $data->cart_item_id );
    $cart_item_qty      = mysqli_real_escape_string( $conn, $data->cart_item_qty );
    $current_item_price = mysqli_real_escape_string( $conn, $data->current_item_price );
    $cart_item_price    = mysqli_real_escape_string( $conn, $data->cart_item_price );
    $cart_bill          = mysqli_real_escape_string( $conn, $data->cart_total );
    $table              = mysqli_real_escape_string( $conn, $data->table_no );
    //$cart_item=1;
    //$cart_bill=1;
    $timestamp          = date( 'Y-m-d H:i:s' );
    $todaydate          = date( 'Y-m-d' );
    $sql                = "INSERT INTO `food_order` (`restaurant_id`, `order_items`,`order_qty`,`current_price`,`item_price`, `order_bill`,`user_id`,`order_time`,`order_date`) VALUES ('1','$cart_item_id','$cart_item_qty','$current_item_price','$cart_item_price','$cart_bill', '1','$timestamp','$todaydate')";
    if ( mysqli_query( $conn, $sql ) ) {
        $result = $conn->query( "DELETE FROM order_table where table_no = '$table' " );
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ( $data->request_type == 'order_today_display' ) {
    $result = $conn->query( "SELECT * FROM food_order ORDER BY  `food_order`.`order_id` DESC " );
    $outp   = "";
    while ( $row = $result->fetch_array( MYSQLI_ASSOC ) ) {
        if ( $outp != "" ) {
            $outp .= ",";
        }
        $outp .= '{"order_id":"' . $row["order_id"] . '",';
        $outp .= '"order_items":"' . $row["order_items"] . '",';
        $outp .= '"order_qty":"' . $row["order_qty"] . '",';
        $outp .= '"order_time":"' . $row["order_time"] . '",';
        $outp .= '"order_bill":"' . $row["order_bill"] . '",';
        $outp .= '"order_status":"' . $row["order_status"] . '"}';
    }
    $outp = '{"orders":[' . $outp . ']}';
    echo ( $outp );
}

// Reloading the cart from table sql
if ( $data->request_type == 'reloadCart' ) {
    $table_no = $data->table_no;
     $result   = $conn->query( "SELECT item_order FROM order_table where table_no = '$table_no' " );
	 $outp   = "";
    while ( $row = $result->fetch_array( MYSQLI_ASSOC ) ) {
        if ( $outp != "" ) {
            $outp .= ",";
        }
        $outp .= $row["item_order"];
    }
    $outp = '{"orders":[' . $outp . ']}';
    echo ( $outp );
    //var_dump($outp);
}

if ( $data->request_type == 'orderSave' ) {
    $table  = $data->table;
    $cart   = $data->cart;
	 
    $result = $conn->query( "DELETE FROM order_table where table_no = '$table' " );
    foreach ( $cart as $x ) {
        $y   = json_encode( $x );		 
        $sql = "INSERT INTO `order_table` (`table_no`, `item_order` ) VALUES ('$table','$y')";
         
		 mysqli_query( $conn, $sql );
    }
}

if ( $data->request_type == 'assignGuest' ) {
    $order_id = mysqli_real_escape_string( $conn, $data->order_id );
    $sql      = "UPDATE `food_order` SET  order_status = 1  WHERE order_id = '$order_id' ";
    if ( mysqli_query( $conn, $sql ) ) {
        // echo "New record delete successfully";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>