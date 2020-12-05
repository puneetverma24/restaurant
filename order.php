<?php
require_once( 'login_check.php' );
if ( substr( $_SESSION['permission'], 5, 1 ) == '0' ) {
    header( "Location:" . $url );
    die();
} //substr( $_SESSION['permission'], 5, 1 ) == '0'
require_once( 'includes/config.php' );
//make function for different task
//todo
/*
all order 
new order
completed order
cancelled order 
*/
?>

<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <!-- favicon Image -->
        <link rel="icon" type="image/png" href="assets/images/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Title of Webpage -->
        <title>Gondia Restaurant</title>
        <!-- Responsive Code -->
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <!-- Style Goes Here -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
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
        <style>
            .item {
            position:relative;
            padding-top:20px;
            }
            .badge{
            position: absolute;
            left: 40px; 
            top:10px;
            background:red;
            text-align: center;
            color:white;
            padding: 2px 4px;
            font-size:10px;
            }
            .btn-default {
            color: #000;
            }
            .btn-default:hover {
            background: #000;
            color: #fff;
            }
        </style>
    </head>
    <body>
        <!-- Panel Inculde --> 
        <?php require_once('includes/panel.php') ?> 
        <div ng-app="mainApp" data-ng-controller="CRUDController">
            <div class="content">
                <div class="container-fluid">
                    Today's Order(status missing)(sql put todays date, time convert in php )
                    <br>
                    Number of Time Repeat: {{timerCount}}
                    <table class="table table-striped table-responsive " >
                        <thead   >
                            <!-- Heading of Menu Table -->
                            <tr>
                                <td> Order Id  </td>
                                <td> Order Timing</td>
                                <td> Total Bill</td>
                                <td> Order Bill Edit </td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Repeat Row for Menu Table Here -->
                            <tr ng-repeat="x in orders| filter : paginate">
                                <!-- Filter Table According to Search Text And Category -->
                                <td class="item"><span ng-if="x.order_status == 0" class="badge">New</span>{{ x.order_id }}</td>
                                <td>{{x.order_time}}</td>
                                <td>{{ x.order_bill | currency:"&#8377;" }}</td>
                                <td><button  class="btn btn-primary btn-md" ng-click="redirect(x)" >View Bill</button></td>
                                <!--- Edit & Delete Button for Each Row of Menu Table-->
                            </tr>
                        </tbody>
                    </table>
                    <pagination class="pagination" total-items="totalItems" ng-model="currentPage" max-size="5" boundary-links="true" items-per-page="numPerPage" ></pagination>
                    <br>
                    Show all order(filter by month,year,date range,cancelled, completed,pending)(need pagination)
                </div>
            </div>
        </div>
        <script type="text/javascript">  
            var app = angular.module("mainApp", ['ui.bootstrap']); 
            
            
            app.controller('CRUDController', function ($scope, $http,$interval) {  
            
            $scope.timerCount=0;
            
            $interval(function(){
            $scope.timerCount++;
            order_today_display(); 
            },10000);    //after every 10sec function repeats itself
            
              
             $scope.playAudio = function() {
            var audio = new Audio('audio/song.mp3');
            audio.play();
            };
            
            order_today_display();  // Display Menu Table Using Post Request
            
            function order_today_display(){
            
                   $http.post("order_api.php",{
                                               'request_type':'order_today_display'})
                   .then(function (response) {$scope.orders = response.data.orders;
                   
                   if($scope.orders[0].order_status==0)
                   {
                   $scope.playAudio();
                   }
                    // console.log($scope.orders);
                   })     
                   
              
            };
            
            $scope.redirect=function(x){		
             
                       $http.post("order_api.php", {
                                                  'request_type':'assignGuest',
                                    'order_id': x.order_id
                            
                                     })
            
                                        .success(function(data,status,headers,config){
                                        
                                        });
                      $scope.ID = x.order_id;
                      $scope.TIME = x.order_time;
                      $scope.SEND= $scope.ID+"&order_time="+$scope.TIME;
                     //alert($scope.SEND );
                     window.location = "order_list.php?order_id="+$scope.SEND  ;
                      
                       
             }
             
              $scope.redirect_front=function(x){		
             
                      
                     
                     //alert(x.order_id);
                     window.location = "front.php?order_id="+x.order_id;
                      
                       
             }
            
            
               rDisplay();   // Display Restaurant Details
            
            function rDisplay(){
                   $http.post("setting_api.php",{
                                               'request_type':'rDisplay'})
                   .then(function (response) {$scope.restaurant = response.data.Restaurant;
                     console.log($scope.restaurant)
                     $scope.restaurant_id = $scope.restaurant[0].rId;
                     $scope.restaurant_name = $scope.restaurant[0].rName;
                     $scope.restaurant_address = $scope.restaurant[0].rAddress;
                     $scope.restaurant_phone= $scope.restaurant[0].rPhone;
                     $scope.restaurant_gstNo = $scope.restaurant[0].rGstNo;
                     $scope.restaurant_tax = $scope.restaurant[0].rTaxType;
                     $scope.myTableRange = $scope.restaurant[0].rNoTable;
                   })     
            }; 
            
            
            $scope.setSelected = function(k) {
                     k.newBadge=true;
            }
             
            
             $scope.currentPage = 1;
             $scope.numPerPage = 5;
            
             $scope.paginate = function(value) {
             $scope.xxx=$scope.orders;
             $scope.totalItems = $scope.xxx.length;
            
            
             var begin, end, index;
             begin = ($scope.currentPage - 1) * $scope.numPerPage;
             end = begin + $scope.numPerPage;
             index = $scope.xxx.indexOf(value);
             return (begin <= index && index < end);
             };
            
            
            
             });  // Compelete myapp controller close
            
        </script>    
        <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>   
        <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    </body>
</html>