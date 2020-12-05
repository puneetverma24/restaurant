  <?php
require_once('login_check.php');

if(substr($_SESSION['permission'],1,3)=='0') 
                {
                header("Location:".$url);
die();
                
                }

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
         
        
      
      
      <input type="text" ng-model="search" >
      
                   
         
             <table class="table table-striped table-responsive" >
                                   <thead>  <!-- Heading of Menu Table -->
                                           <tr>
                                              <td> Id  </td>                                            
                                              <td> Name </td>
                                              <td> Price </td>
                                              <td> Discounted Price </td>
                                                                                    
                                              <td> End Date</td>
                                              <td>  Submit </td>
                                             
                                          </tr>
                                   </thead>
    
                                
                                  
                                  
                                   <tbody >
                                           <!-- Repeat Row for Menu Table Here -->
                                          <tr ng-repeat="x in names | filter:search| filter : paginate"  ng-click="setSelected(x)">   <!-- Filter Table According to Search Text And Category -->
                                              <td>{{ x.Id }}</td>
                                               <td>{{ x.Name }}</td>
                                              <td>{{ x.Price | currency:"&#8377;" }}</td>
                                              
                                              <td ng-if='x.Discount_price==0'><input type="text" ng-model="x.Discount_price"  ng-init="x.Discount_price=x.Discount_price " ></td>
                                              
                                               <td ng-if='x.Discount_price!=0'><input type="text" ng-model="x.Discount_price"  ng-init="x.Discount_price=x.Price-x.Discount_price " ></td>
                                              
                                              
                                              
                                              
                                              
                                               <!--- Edit & Delete Button for Each Row of Menu Table-->
                                 
                                                
                                  
                           
                              <td>   <input  type="date" ng-model="x.Discount_expiry" ng-init="x.Discount_expiry=StrToDate(x.Discount_expiry)" >
                                  </td>  
                           
                              
                                              <td><button type="button" class="btn btn-success" ng-click="updateSave(x)"><i class="glyphicon glyphicon-transfer"></i></button></td>
                                              
                                             
                                          </tr>
                                  </tbody>
                                  
    
                             </table>

   
<pagination class="pagination" total-items="totalItems" ng-model="currentPage" max-size="5" boundary-links="true" items-per-page="numPerPage" >
</pagination>
  
  
  
  

  </div>
  </div>
  
<script type="text/javascript">  
        
        var app = angular.module("mainApp", ['ui.bootstrap']); 
      
      
      
      
        app.controller('CRUDController', function ($scope, $http ) {  
        
        
        
      menu_display();   // Display Menu Table Using Post Request
        
        function menu_display(){
               $http.post("menu_api.php",{
                                           'request_type':'display'})
               .then(function (response) {$scope.names = response.data.Records;
           
              // $scope.xxx=$scope.names;
               })     
        };
     
       
        category_display();   // Display Category Table Using Post Request
        
        function category_display(){
                 $http.post("menu_api.php",{
                                             'request_type':'category_display'})
                 .then(function (response) {$scope.category = response.data.category;})
        }; 
        
         $scope.updateSave = function(x) {  
        var price;
         if(x.Discount_price==0)
         {price=0;}
         else{price=x.Price-x.Discount_price;}
         console.log("xxx"+x.Discount_price);
          console.log("xxx"+x.Discount_expiry);
           
         $http.post("today_special_api.php", {
                                                 'request_type':'updateData',
		                                 'item_id': x.Id,
		                                 'item_d_expiry':x.Discount_expiry,
		                                 'item_d_price':price
		                                  })
    
                  .success(function(data,status,headers,config){
                  
                   alert("Applied Successfully");
                 
                   
                  })
         
         
         
         };
        
            
        $scope.setSelected = function(idSelectedVote) {
       console.log(idSelectedVote);
    }
        
      
      $scope.StrToDate = function (str) {
            return new Date(str);
        }
      

   
   
      
  $scope.currentPage = 1;
  $scope.numPerPage = 5;
       
  $scope.paginate = function(value) {
  $scope.xxx=$scope.names;
  $scope.totalItems = $scope.xxx.length;
 
  
    var begin, end, index;
    begin = ($scope.currentPage - 1) * $scope.numPerPage;
    end = begin + $scope.numPerPage;
    index = $scope.xxx.indexOf(value);
    return (begin <= index && index < end);
  };
  
  
      
    
});
        
</script>  


  
     <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>
   
    
</body>  
</html> 