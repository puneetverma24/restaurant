<?php
require_once( 'login_check.php' );
if ( substr( $_SESSION['permission'], 5, 1 ) == '0' ) {
    header( "Location:" . $url );
    die();
} //substr( $_SESSION['permission'], 5, 1 ) == '0'
?>

<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <!-- favicon Image 
            <link rel="icon" type="image/png" href="assets/images/favicon.ico"> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Title of Webpage -->
        <title>Gondia Restaurant</title>
        <!-- Responsive Code -->
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <!-- Style Goes Here -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Suggestion Number--- CS-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type='text/css' />
        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet" type='text/css'/>
        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" type='text/css'/>
        <!-- Icon & Text Font -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type='text/css' />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="https://cdn.bootcss.com/pixeden-stroke-7-icon/1.2.3/dist/pe-icon-7-stroke.css" type='text/css' rel="stylesheet" />
        <!-- AngularJs Script -->  
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>    
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <!-- Bootstrap Script -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Auto Search Script -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            .strike { color: red;}
            .btn-default {
            color: #000;
            }
            .btn-default:hover {
            background: #000;
            color: #fff;
            }
            hr.style1 {
            border-top: 3px double #abcdef;
            }
        </style>
        <script>
            function showHint(str) {
                if (str.length == 0) {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "data_by_mobile.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>
    <body>
        <!-- Panel Inculde --> 
        <div ng-app="mainApp" data-ng-controller="CRUDController">
            <?php require_once('includes/panel.php') ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="panel panel-default" ng-hide="myUserButton"  data-ng-init="myUserButton= false">
                            <div class="panel-body">
                                <div class="btn-group" >
                                    <button  class="btn btn-primary btn-md" ng-click="addUser()" >Add User Detail</button>
                                </div>
                                <div id="item_category" ng-hide="myUserPanel"  data-ng-init="myUserPanel = true">
                                    <h5>Add Details Here:</h5>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="user_Number">Guest Mobile No.</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="user_Number" type="number"  placeholder="Enter Mobile Number Here..." ng-model="user_Number" data-ng-init="user_Number=''"> <!-- onkeyup="showHint(this.value)" -->    
                                            </div>
                                            <!--   <p>Users: <span id="txtHint"></span></p>   -->
                                            <label class="col-sm-2 control-label" for="user_Name">Guest Name</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" id="user_Name" type="text" placeholder="Enter Name Here..." ng-model="user_Name" data-ng-init="user_Name='Guest'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_category" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-3">
                                                <select id="user_Gender" class="form-control" ng-model="user_Gender" data-ng-init="user_Gender='male'"  >
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label" for="user_DOB">Birthday Date</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="user_DOB" type="date" ng-model="user_DOB">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="user_EmailId">Guest Email Id</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="user_EmailId" type="email" placeholder="Enter Email Id Here..." ng-model="user_EmailId">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <div class="btn-group">
                                                    <input class="btn btn-primary" type="button" value="Sumbit Detail" ng-click="insertUser()" />
                                                    <input class="btn btn-primary" type="button" value="Cancel" ng-click="cancel()" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="printableArea">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                {{restaurant_name}}  <br>
                                {{restaurant_address}}  <br>
                                +91-{{restaurant_phone}} 
                                <!-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                            </div>
                            <div class="col-md-4 col-sm-4"> 
                            </div>
                            <div class="col-md-4 col-sm-4"> 
                                Bill No: {{billNo}}<br>
                                Date: {{billTime}}<br>
                            </div>
                        </div>
                        <!-- Row Close Here -->
                        <hr class="style1">
                        <div class="row">
                            <div class="col-md-4 col-sm-4"> 
                                To<br>
                                Name: {{user_Name}} <br>
                                Mobile: {{user_Number}}
                            </div>
                        </div>
                        <hr class="style1">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-responsive " >
                                    <thead >
                                        <!-- Heading of Menu Table -->
                                        <tr>
                                            <td> Sr.No  </td>
                                            <td> Item  </td>
                                            <td>Price</td>
                                            <td> Quantity</td>
                                            <td> Total </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Repeat Row for Menu Table Here -->
                                        <tr ng-repeat="x in orders">
                                            <!-- Filter Table According to Search Text And Category -->
                                            <td> {{ $index+1}}</td>
                                            <td>{{ x.item_name }}</td>
                                            <td>  {{x.item_current_price-x.item_actual_price ==0 && '₹'+x.item_current_price ||' '  }}
                                                <strike class="strike"> {{x.item_current_price-x.item_actual_price  !=0 && '₹'+x.item_current_price ||' '  }}</strike>
                                                {{x.item_current_price-x.item_actual_price  !=0 && '₹'+x.item_actual_price ||' '  }}
                                            </td>
                                            <!--   <td>{{ x.item_current_price |currency:"&#8377;" }}</td>
                                                <td>{{ x.item_actual_price |currency:"&#8377;" }}</td> -->
                                            <td>{{ x.item_qty }}</td>
                                            <td>{{ x.item_actual_price * x.item_qty |currency:"&#8377;" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="style1">
                        <div class="row">
                            <div class="col-md-4 col-sm-4"> 
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h4>
                                <i> Discover the real Taste.</i></h>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <table class="table table-bordered table-responsive " >
                                    <tr>
                                        <td>Total</td>
                                        <td>{{total| currency:"&#8377;"}}</td>
                                    </tr>
                                    <tr>
                                        <td> Discount <br> {{discount_name}} Offer </td>
                                        <td>{{ temp | currency:"&#8377;"}} <br>  {{total-temp| currency:"&#8377;"}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- <input type="checkbox" id="activeCheck" ng-model="discount_active" ng-change="changeDStatus()" ng-init="discount_active=true"> -->
                                            {{validStatus}}
                                            <input type="text" ng-model="discount">
                                            <input   type="button" ng-click="apply()" value="Apply Coupon"/> 
                                        </td>
                                    <tr>
                                    <tr>
                                        <td>GST ({{restaurant_tax}}%) </td>
                                        <td>{{tax = (total-temp)*(restaurant_tax/100)| currency:"&#8377;"}} </td>
                                        <!-- Doubt about tax on discount-->
                                    <tr>
                                    <tr>
                                        <td>   Total Payable Amount </td>
                                        <td><b>{{total+tax-temp| currency:"&#8377;"}}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr class="style1">
                        <footer> 
                            phone number etc
                        </footer>
                    </div>
                    <!-- print area -->
                </div>
            </div>
        </div>
        <script type="text/javascript">  
            var app = angular.module("mainApp", [ ]); 
            
            app.controller('CRUDController', function ($scope, $http ) {  
            
            
            /* $scope.changeDStatus = function() {
             
             $scope.all = !$scope.all;
             }; */
             
             $scope.apply = function(){
             
             console.log($scope.discount);
             
             $http.post("order_list_api.php", {
                                                     'request_type':'coupon',
                                       'check_coupon':$scope.discount,		                                
                                       'total_bill':$scope.total,
                                       'auto_discount':$scope.temp
                                        })
                   .then(function (response) {$scope.checks = response.data.check;
                   console.log($scope.checks);
                   console.log($scope.checks[0].discount);
                   
                    $scope.temp=Number($scope.checks[0].discount);
                    $scope.discount_name=$scope.checks[0].name;
                    $scope.validStatus=$scope.checks[0].mess;
                   })  
             
             };
            
            $scope.total=0;
            
            var b="<?php echo  $_GET["order_id"]  ?>";
            var t="<?php echo  $_GET["order_time"]  ?>";
            $scope.billNo=b;
            
            $scope.billTime=t;
            bill_display(b);
            
             function bill_display(b){
                    $http.post("order_list_api.php", {
                                                     'request_type':'order_bill',
                                       'order_id':$scope.billNo })
                   .then(function (response) {$scope.orders = response.data.orders;
                   console.log($scope.orders);
                   $scope.status = $scope.orders[0].order_status;
                   $scope.userId = $scope.orders[0].user_id;
                   if($scope.status == 0)
                   { $scope.myUserButton = true ;
                    }
                   for(i=0;i<$scope.orders.length;i++)  
                     {
                       $scope.total+= $scope.orders[i].item_actual_price*$scope.orders[i].item_qty;
                     }
                     discount($scope.total);
                    
                    userArray($scope.userId);
                 
                   
                   })     
            };
            
            
            // discount();
             
             
             function discount(total){
             console.log("Total Bill"+$scope.total);
             $http.post("discount_api.php",{
             'request_type':'get_coupon',
             'total': total
              
             })
             
               .then(function(response){
               
                $scope.coupons= response.data.coupons;
                
             $scope.reduction=0;
             $scope.temp=0;
              
              
             if($scope.coupons.length==0)
             {
             console.log("No coupon Available");
             }
             
             else{
                       
             
             for(var i=0;i<$scope.coupons.length;i++)
              {
            
            
            
            if($scope.coupons[i].d_type==0)
            {$scope.reduction=Number($scope.coupons[i].d_rate);}
            
            
            if($scope.coupons[i].d_type==1)
             {
            $scope.reduction=(Number($scope.coupons[i].d_rate)*total)/100;
            
            
             }
             
               
            
            
             if($scope.reduction>$scope.temp)
             
             {$scope.temp=$scope.reduction;
             }
              
              
            console.log("coupons->"+$scope.coupons[i].d_name+"->"+$scope.reduction+"temp->"+$scope.temp);
            $scope.discount_name=$scope.coupons[i].d_name;
            
             
            
              }//for loop
            
            
            
            console.log("best discount->"+$scope.temp+"new total->"+(total-$scope.temp));
            
            
            
             }//else 
            
             
             })
             
             
             };
             
             
             
             function userArray(x){
                
                    $http.post("user_api.php", {
                                                     'request_type':'user_array',
                                                     'user_id': x
                                                     
                                       })
                   .then(function (response) {
                   $scope.users= response.data.users;
                     $scope.user_Name = $scope.users[0].user_name;
            $scope.user_Number = Number($scope.users[0].user_number);
                   console.log("data"+$scope.users);
                   
                    console.log("x"+x);
                   
                   })     
            };
            
            
            
            
            $scope.addUser = function() {
                     
                    $scope.myUserPanel = !$scope.myUserPanel;
                    if($scope.user_Name == 'Guest') 
                     { $scope.user_Name = ""; }
                    else
                     {$scope.user_Name = "Guest";}
                     
                    
            }; 
            
            $scope.cancel = function() {
                     
                    $scope.myUserPanel = true;
                    $scope.clear();
                    
            }; 
            
            $scope.clear = function(){
            
                $scope.user_Name = "Guest";
                $scope.user_Number ="";
                $scope.user_Gender = 'male';
                $scope.user_EmailId = "";
                $scope.user_DOB = "";
               
            };
            
            
              $scope.insertUser = function(){
              
                    $http.post("user_api.php", {
                                                     'request_type':'userData',
                                       'user_name':$scope.user_Name,
                                       'user_number':$scope.user_Number,
                                       'user_gender':$scope.user_Gender,
                                       'user_email':$scope.user_EmailId,
                                       'user_dob':$scope.user_DOB,
                                       'order_id':$scope.billNo
                                        })
                   .then(function (response) {
                    
                   alert("Inserted Successfully");
                     
                    $scope.myUserPanel = true;
                   
                   })     
            };
            
            
             rDisplay();   // Display Restaurant Details
            
            function rDisplay(){
                   $http.post("setting_api.php",{
                                               'request_type':'rDisplay'})
                   .then(function (response) {$scope.restaurant = response.data.Restaurant;
                     console.log("ex"+$scope.restaurant[0].rId);
                     $scope.restaurant_id = $scope.restaurant[0].rId;
                     $scope.restaurant_name = $scope.restaurant[0].rName;
                     $scope.restaurant_address = $scope.restaurant[0].rAddress;
                     $scope.restaurant_phone= $scope.restaurant[0].rPhone;
                     $scope.restaurant_gstNo = $scope.restaurant[0].rGstNo;
                     $scope.restaurant_tax = $scope.restaurant[0].rTaxType;
                     $scope.myTableRange = $scope.restaurant[0].rNoTable;
                   })     
            }; 
            
            
            
            
            
            
                
            
            
            });  // Compelete myapp controller close
            
        </script>  
    </body>
</html>