<?php
require_once('login_check.php');

if(substr($_SESSION['permission'],0,1)=='0') 
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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
        <div class="row">    
       
       <div class="col-md-4">
      <div class="panel panel-primary">
      <div class="panel-heading">Today</div>
      <div class="panel-body">{{today}}</div>
    </div>
   
     
     
     
       </div>
  
  <div class="col-md-4">
   
   
    <div class="panel panel-primary">
      <div class="panel-heading">Last 7 days</div>
      <div class="panel-body">{{d7}}</div>
    </div>
   
   
   
   
     </div>
   
   <div class="col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading">Last 30 day</div>
      <div class="panel-body">{{d30}}</div>
    </div>
   
      </div>
  
</div>

 <div class="row">  
 <div class="col-md-4">  
Tax Paid today
</div>
<div class="col-md-4">  
Tax Paid 7
</div>
<div class="col-md-4">  
Tax Paid 30
</div>
</div>
  
  
  <!-- graph start--> 
  <div class="row">  
 
 
 
  <div id="curve_chart"></div>
 
 
</div>
  
   <!-- graph end--> 
  
  
  
  
  
  </div>
  </div>
  </div>
  
<script type="text/javascript">  
        
        var app = angular.module("mainApp", [ ]); 
      
        app.controller('CRUDController', function ($scope, $http ) {  
      
        today();
        sevenDay();
        thirtyDay();
        getGraph();
     function today()
     {
     
      $http.post("sale_api.php",{
                                             'request_type':'sales_today'})
                 .then(function (response) {$scope.today = response.data.sales;
                 console.log($scope.today);
                 
                 })
     
     
    
     
     }
     
    function sevenDay()
     {
     
      $http.post("sale_api.php",{
                                             'request_type':'sales_seven'})
                 .then(function (response) {$scope.d7 = response.data.sales;
                 console.log($scope.d7);
                 
                 })
     
     }
     
     function thirtyDay()
     {
     
     $http.post("sale_api.php",{
                                             'request_type':'sales_thirty'})
                 .then(function (response) {$scope.d30 = response.data.sales;
                 console.log($scope.d30);
                 
                 })
     
     }
     
     
     function getGraph()
     {
     
    
     
     }
     

     
            
       
       
        });  // Compelete myapp controller close
        
</script>  



 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      
      
     var jsonData = $.ajax({
          type: 'POST', 
          url: "sale_api.php",
          data: {request_type: 'graph' },
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      
      
        var options = {
          title: 'Sales',
          curveType: 'function',
          legend: { position: 'bottom' }
        };



        var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>



<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    
</body>  
</html> 