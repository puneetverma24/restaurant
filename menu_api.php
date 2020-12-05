<?php
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );
require_once( 'includes/config.php' );
$data = json_decode( file_get_contents( "php://input" ) );
date_default_timezone_set( 'Asia/Kolkata' );
$todaydate = date( 'Y-m-d' );
if ( $data->request_type == 'display' ) {
    $result = $conn->query( "SELECT     item_id, item_name, item_price, item_discount_price, item_discount_expiry, item_image_url , category_name FROM food_menu_item WHERE item_visibility = 1 " );
    $outp   = "";
    while ( $rs = $result->fetch_array( MYSQLI_ASSOC ) ) {
        if ( $rs["item_discount_expiry"] < $todaydate ) {
            $rs["item_discount_price"]  = 0;
            $rs["item_discount_expiry"] = "0000-00-00";
            $x                          = $rs["item_id"];
            $sql                        = "UPDATE food_menu_item SET item_discount_price=0, item_discount_expiry='0000-00-00' WHERE item_id ='$x'";
            mysqli_query( $conn, $sql );
        } //$rs["item_discount_expiry"] < $todaydate
        if ( $outp != "" ) {
            $outp .= ",";
        } //$outp != ""
        $outp .= '{"Id":"' . $rs["item_id"] . '",';
        $outp .= '"Name":"' . $rs["item_name"] . '",';
        $outp .= '"Image":"' . $rs["item_image_url"] . '",';
        $outp .= '"Category":"' . $rs["category_name"] . '",';
        $outp .= '"Discount_price":"' . $rs["item_discount_price"] . '",';
        $outp .= '"Discount_expiry":"' . $rs["item_discount_expiry"] . '",';
        $outp .= '"Price":"' . $rs["item_price"] . '"}';
    } //$rs = $result->fetch_array( MYSQLI_ASSOC )
    $outp = '{"Records":[' . $outp . ']}';
    echo ( $outp );
} //$data->request_type == 'display'

if ( $data->request_type == 'category_display' ) {
    $result = $conn->query( "SELECT     category_id, category_name FROM item_category" );
    $outp2  = "";
    while ( $rs = $result->fetch_array( MYSQLI_ASSOC ) ) {
        if ( $outp2 != "" ) {
            $outp2 .= ",";
        } //$outp2 != ""
        $outp2 .= '{"category_id":"' . $rs["category_id"] . '",';
        $outp2 .= '"category_name":"' . $rs["category_name"] . '"}';
    } //$rs = $result->fetch_array( MYSQLI_ASSOC )
    $outp2 = '{"category":[' . $outp2 . ']}';
    echo ( $outp2 );
} //$data->request_type == 'category_display'

if ( $data->request_type == 'category_insert' ) {
    $item_category = mysqli_real_escape_string( $conn, $data->item_category );
    $sql           = " INSERT INTO `item_category` (`category_id`, `restaurant_id`, `category_name`) VALUES ('', '1', '$item_category')";
    if ( mysqli_query( $conn, $sql ) ) {
        //  echo "New record created successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'category_insert'

if ( $data->request_type == 'insert' ) {
    $item_category = mysqli_real_escape_string( $conn, $data->item_category );
    $item_name     = mysqli_real_escape_string( $conn, $data->item_name );
    $item_price    = mysqli_real_escape_string( $conn, $data->item_price );
    $item_image    = mysqli_real_escape_string( $conn, $data->item_image );
    //Anil: I have assign item_discount price is = TO ITEM PRiCE
    $sql           = "INSERT INTO `food_menu_item` (`item_id`, `restaurant_id`, `item_name`, `item_description`, `item_image_url`, `item_price`, `item_discount_price`, `item_type`, `category_name`) VALUES ('', '1', '$item_name', 'NULL', '$item_image', '$item_price', '$item_price', 'Veg', '$item_category')";
    if ( mysqli_query( $conn, $sql ) ) {
        //  echo "New record created successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'insert'

if ( $data->request_type == 'update' ) {
    $item_id       = mysqli_real_escape_string( $conn, $data->item_id );
    $item_name     = mysqli_real_escape_string( $conn, $data->item_name );
    $item_price    = mysqli_real_escape_string( $conn, $data->item_price );
    $item_category = mysqli_real_escape_string( $conn, $data->item_category );
    $item_image    = mysqli_real_escape_string( $conn, $data->item_image );
    $sql           = " UPDATE food_menu_item SET item_name='$item_name', item_price =  '$item_price', item_image_url = '$item_image', category_name = '$item_category' WHERE item_id ='$item_id' ";
    if ( mysqli_query( $conn, $sql ) ) {
        //  echo "Update record successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'update'

if ( $data->request_type == 'update_category' ) {
    $category_id   = mysqli_real_escape_string( $conn, $data->category_id );
    $category_name = mysqli_real_escape_string( $conn, $data->category_name );
    //$sql = UPDATE  `item_category` SET  `category_name` =  '$category_name' WHERE `category_id` =1;
    $sql           = " UPDATE item_category SET  category_name = '$category_name'  WHERE category_id = '$category_id' ";
    if ( mysqli_query( $conn, $sql ) ) {
        //  echo "Update record successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'update_category'

if ( $data->request_type == 'delete' ) {
    $delete_item_id = mysqli_real_escape_string( $conn, $data->item_id );
    $sql            = "UPDATE `food_menu_item` SET  item_visibility = 0  WHERE item_id = '$delete_item_id' ";
    //$sql = "DELETE FROM `food_menu_item` WHERE item_id = '$delete_item_id' ";
    if ( mysqli_query( $conn, $sql ) ) {
        // echo "New record delete successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'delete'

if ( $data->request_type == 'delete_category' ) {
    $delete_category_id = mysqli_real_escape_string( $conn, $data->category_id );
    $sql                = "DELETE FROM `item_category` WHERE category_id = '$delete_category_id' ";
    if ( mysqli_query( $conn, $sql ) ) {
        //echo "New record delete successfully";
    } //mysqli_query( $conn, $sql )
    else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //$data->request_type == 'delete_category'
$conn->close();
?>