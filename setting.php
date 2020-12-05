 <?php
require_once('login_check.php');
//date_default_timezone_set('Asia/Kolkata');



 


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


    
   
   <div ng-app="mainApp" data-ng-controller="CRUDController"> 
   
   <?php require_once('includes/panel.php') ?> 
  

      <div class="content">

         <div class="container-fluid">
       
              <div class="row">    
                                 
                  <div class="panel panel-default">
                    
                      <div class="panel-body">
                               
                                <h5>Restaurant Details:</h5>
                                
                                <form class="form-horizontal">

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label" for="restaurant_name">Name</label>
                                      <div class="col-sm-10">
                                           <input class="form-control" id="restaurant_name" type="text"   ng-model="restaurant_name">
                                      </div>
                                 </div>
                                 
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label" for="restaurant_address">Address</label>
                                      <div class="col-sm-10">
                                           <input class="form-control" id="restaurant_address" type="text"  ng-model="restaurant_address">
                                      </div>
                                 </div>
                                 
                                 
                                 
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label" for="restaurant_phone">Phone</label>
                                      <div class="col-sm-3">
                                           <input class="form-control" id="restaurant_phone" type="number"  ng-model="restaurant_phone">
                                           
                                          
                                      </div>
                                      
                                       
                                  </div>
                                     
                                    <div class="form-group">
                                    
                                      <label class="col-sm-2 control-label" for="restaurant_gstNo">GST No:</label>
                                      <div class="col-sm-3">
                                           <input class="form-control" id="restaurant_gstNo" type="text"  ng-model="restaurant_gstNo">
                                      </div>
                                      
                                      <label for="restaurant_tax" class="col-sm-2 control-label">Type & Tax</label>
                                      <div class="col-sm-3">
                                          <select id="restaurant_type" class="form-control" ng-model="restaurant_tax"  >
                                              <option  value="0">No Tax</option>
                                              <option  value="5">Non-AC (5%)</option>
                                              <option  value="12">AC (12%)</option>
                                          </select>
                                       </div>
                                     </div>
                                     
                                     
                                     <h5>Table Setting: </h5>
                      <div class="form-group">
                           <label class="col-sm-2 control-label"> </label>
                           
                          <div class="col-sm-2">
                              Max: <input class=" form-control"  type="number" ng-model="max">
                          </div>
                     
                               <label class="col-sm-2 control-label">Sets No. of Table:</label> <br>
                               <div class="col-sm-6">
                              
                               <input type="range" min="1" max="{{max}}" ng-model="myTableRange" id="myRange">
                               <p>No. of Table: {{myTableRange}} </p>
                               
                                </div>
                       </div>  
                       
                       <div class="form-group">
                                      <label class="col-sm-2 control-label"></label>
                                      <div class="col-sm-10">
                                          <div class="btn-group">
                                              <input class="btn btn-primary" value="Save" type="button" ng-click="updateRData()"/>
                                               
                                          </div>
                                      </div>
                                 </div>  
                     
                                 
     
                             </form>
                      
                       </div> <!--Panel Body Close -->
        
                  </div> <!--- Panel Close Here -->
        
              </div>  <!-- Row Ends Here -->
              
               <div class="row">    
                                 
                  <div class="panel panel-default">
                    
                      <div class="panel-body">
                      
                        
                
                      <h5>Discount Setting: </h5>
                          
                          <div class="form-group">
                                       
                                          <div class="btn-group">
                                           <input class="btn btn-primary" value="Add New Discount" type="button" ng-click="openDiscount()"/>
                                         
                                         </div>
                                       
                                 </div>
                                     
                                      
                         <div ng-hide="panelDiscount" data-ng-init="panelDiscount=true">
                          
                    
                            
                         <form class="form-horizontal" >
                                     
                                  <div class="form-group">
                                      
                                       
                                     
                                      <div class="col-sm-2">
                                      
                                       <label   class="control-label" for="discount_name">Name:</label>
                                           <input class="form-control" id="discount_name" type="text"   ng-model="discount_name">
                                      </div>
                                 
                         
                               
                                      <div class="col-sm-2">
                                        
                                       <label   class="control-label"  for="discount_type">Type:</label>
                                          <select id="discount_type" class="form-control" ng-model="discount_type"  >
                                              <option  value="0">Flat Discount(in Rs.)</option>
                                              <option  value="1">Percentage Discount(%)</option>
                                        
                                          </select>
                                       </div>
                                       
                                      
                                      
                                      <div class="col-sm-2">
                                       
                                      <label   class="control-label"  for="discount_name">Discount:</label>
                                           <input class="form-control" id="discount_rate" type="number" ng-model="discount_rate">
                                      </div>   
                                      
                                        
                                      
                                      <div class="col-sm-2">
                                      
                                      <label   class="control-label"  for="discount_mbill">Min Total Bill:</label>
                                           <input class="form-control" id="discount_mbill" type="number" ng-model="discount_mbill">
                                      </div> 
                                      
                                      <div class="col-sm-1">
                                         
                                      <label class="control-label"  for="rCoupon">Coupon Required:</label>
                                      <input type="checkbox" id="rCoupon" ng-model="rCoupon" ng-change="coupon()">
                                      </div> 
                                      
                                      <div class="col-sm-2" ng-hide="dCoupon" data-ng-init="dCoupon=true">
                                        
                                      <label class="control-label"  for="discount_coupon">Coupon Code:</label>
                                           <input class="form-control" id="discount_coupon" type="text" ng-model="discount_coupon">
                                      </div>   
                                      
                                       <div class="col-sm-6">
                                      
                                      <label   class="control-label"  for="discount_description">Description:</label>
                                            <textarea class="form-control" id="discount_description" ng-model="discount_description"> </textarea>
                                      </div> 
                                       
                                       <div class="col-sm-2">
                                         
                                      
                                       
                                      <label class="control-label"  for="activeCheck">To Activate Discount, tick in the checkbox & Set the expiry time</label> 
                                      <input type="checkbox" id="activeCheck" ng-model="discount_active" ng-change="changeDStatus()"> 
                                      </div> 
                                      
                                       <div class="col-sm-2">
                                         
                                      <label class="control-label"  for="discount_expiry">Set the Expiry Iime</label>
                                      <input class="form-control" type="date" id="discount_expiry" ng-model="discount_expiry" ng-hide="expiryTime" ng-init="expiryTime= true">
                                      </div> 
                              
                               
                                      
                                </div>   
                                   
                         </form>
                         
                          <div class="form-group">
                                       
                                      
                                          <div class="btn-group">
                                            
                                           <input class="btn btn-primary" value="Insert New" type="button" ng-hide="insertD" ng-init="insertD=false" ng-click="insertDiscount()"/>
                                           <input class="btn btn-primary" value="Update" type="button" ng-hide="updateD" ng-init="updateD=true" ng-click="updateDiscount()"/>
                                      </div>
                                 </div>
                                  
                         </div>
                         
                         <!---Discount Display-->
                         
                         <div class="table-responsive">
                         
                         
                         
                         <table class="  table table-striped"> 
                             <thead style=" background-color: white;">  <!-- Heading of Discount Table -->
              
                  
              
                                       <tr>
                                           <td>   Name 
                                           <a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Name of Discount">
                <span class='glyphicon glyphicon-info-sign'></span></a>
                                           
                                           </td>
                                           <td> Type 
                         <a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title='Type of Coupon &#13; Percentage Discount Flat Discount'>
                <span class='glyphicon glyphicon-info-sign'></span></a>
                                           
                                           </td>
                                           <td> Discount 
                                           <a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title='Write Discount &#13; '>
                <span class='glyphicon glyphicon-info-sign'></span></a>
                                           </td>
                                           <td> Min. Bill</td>
                                           <td> Coupon </td>
                                           <td> Expiry </td>
                                           <td> Description </td>
                                           <td> Status </td>
                                       </tr>
                
                              </thead>
                              
                              <tbody>
      
                                      <!-- Repeat Table Row For Each Discount-->
                                      <tr ng-repeat="d in discount">
                                      
                                           
                                         <td>   {{d.dName}} </td> 
                                         <td> {{d.dType==0 && 'Flat(in ₹)' || 'Percentage(in %)'}} </td> 
                                         <td> {{d.dType==0 && '₹'+d.dRate || d.dRate+'%' }} </td>
                                         <td> {{d.dMbill}} </td>
                                         <td> {{d.dCoupon=='0' && 'Not Requried' || d.dCoupon }} </td>
                                         <td> {{d.dExpiry| date : "dd-MM-y"}} </td>
                                         <td> {{d.dDescription}}</td>
                                        
                                          <td>  {{ d.dActive==1 && 'Active' || 'Not-Active' }}  </td>
                                          
                                           <!--- Edit & Delete Button for Each Row of Category Table-->
                                           
                                          <td>  
                                          <div class="btn-group"> 
                                          <input type="button" class="btn btn-primary" value="Edit" ng-click="bindDiscount(d)">    
                                         
                                          <input type="button" class="btn btn-primary"  value="Delete" ng-click="deleteDiscount(d.dId)"> 
                                             </div> 
                                             
                                           </td>            
                                      </tr>
                              
                                  </tbody>
       
                              </table>
                          
                          </div>
                      
                      
                       </div> <!--Panel Body Close -->
                      
                      
                      </div> <!--- Panel Close Here -->
        
              </div>  <!-- Row Ends Here -->
              
              
              
           </div>  <!-- Container-fluid End Here--->
  
      </div>    <!--- Content Ends Here--->
 
</div>   <!-- ng-App Div Ends Here-->
 
<script type="text/javascript">  
        
        var app = angular.module("mainApp", [ ]); 
      
        app.controller('CRUDController', function ($scope, $http ) {                     
     
     
           $scope.max = 10;
           $scope.discount_coupon = 0;
   
    $scope.coupon = function() {
        $scope.dCoupon = !$scope.rCoupon;
        $scope.discount_coupon = 0;
  
    };
    
     $scope.openDiscount = function() {
        $scope.panelDiscount = !$scope.panelDiscount;
        $scope.updateD = true;
	$scope.insertD = !$scope.updateD;
    };
           
           
              rDisplay();   // Display Restaurant Details
        
        function rDisplay(){
               $http.post("setting_api.php",{
                                           'request_type':'rDisplay'})
               .then(function (response) {$scope.restaurant = response.data.Restaurant;
                 //console.log($scope.restaurant)
                 $scope.restaurant_id = $scope.restaurant[0].rId;
                 $scope.restaurant_name = $scope.restaurant[0].rName;
                 $scope.restaurant_address = $scope.restaurant[0].rAddress;
                 $scope.restaurant_phone= Number($scope.restaurant[0].rPhone);
                 $scope.restaurant_gstNo = $scope.restaurant[0].rGstNo;
                 $scope.restaurant_tax = $scope.restaurant[0].rTaxType;
                 $scope.myTableRange = $scope.restaurant[0].rNoTable;
               })     
        };
        
        
        $scope.updateRData=function(){	
                  
                 
                  $http.post("setting_api.php", {
                  
                                              'request_type':'rUpdate',
                                              'rId': $scope.restaurant_id,
		                              'rName': $scope.restaurant_name,
		                              'rAddress':$scope.restaurant_address,
		                              'rPhone':$scope.restaurant_phone,
		                              'rGstNo':$scope.restaurant_gstNo,
		                              'rTaxType':$scope.restaurant_tax,
		                              'rNoTable':$scope.myTableRange
		                            		                              
		                              })
    
                  .success(function(data,status,headers,config){
                   
                  rDisplay();
                  
                  alert("Save Data Successfully");
            
                  });
         }  
         
         
         
             $scope.bindDiscount = function (x){  
             
                $scope.discount_id = x.dId;
		$scope.discount_name = x.dName;
		$scope.discount_type = x.dType;
		$scope.discount_description = x.dDescription;
		$scope.discount_rate = Number(x.dRate);
		$scope.discount_expiry= new Date(x.dExpiry);
		$scope.rCoupon = Boolean(x.dCoupon);
		if(x.dCoupon == 0){
		$scope.rCoupon = false;}
	        $scope.dCoupon = !$scope.rCoupon;
		$scope.discount_coupon = x.dCoupon;
		$scope.discount_mbill = Number(x.dMbill);
		$scope.panelDiscount = false;
		$scope.updateD = false;
		$scope.insertD = !$scope.updateD;
		$scope.discount_active = Boolean(x.dActive);
		if($scope.discount_active)
		{
                $scope.expiryTime=false;
                }
         }
         
         
        $scope.insertDiscount=function(){	
                  
                 
                  $http.post("setting_api.php", {
                  
                                              'request_type':'dInsert',
                                            
		                              'dName': $scope.discount_name,
		                              'dType':$scope.discount_type,
		                              'dRate':$scope.discount_rate,
		                              'dCoupon':$scope.discount_coupon,
		                              'dMbill' : $scope.discount_mbill,
		                              'dDescription': $scope.discount_description,
		                              'dActive': $scope.discount_active,
		                              'dExpiry': $scope.discount_expiry
		                                                        
		                              })
    
                  .success(function(data,status,headers,config){
                  dDisplay(); 
                  //alert("Data Insert Successfully");
            
                  });
         }  
         
         
          $scope.updateDiscount=function(){	
                  
                  console.log($scope.discount_expiry);
                  $http.post("setting_api.php", {
                  
                                              'request_type':'dUpdate',
                                              'dId' : $scope.discount_id,
		                              'dName': $scope.discount_name,
		                              'dType':$scope.discount_type,
		                              'dRate':$scope.discount_rate,
		                              'dCoupon':$scope.discount_coupon,
		                              'dMbill' : $scope.discount_mbill,
		                              'dDescription': $scope.discount_description,
		                              'dActive': $scope.discount_active,
		                              'dExpiry': $scope.discount_expiry
		                                                        
		                              })
    
                  .success(function(data,status,headers,config){
                    dDisplay(); 
                  //alert("Data Update Successfully");
            
                  });
         }  
        
        
          dDisplay();   // Display Restaurant Details
        
        function dDisplay(){
               $http.post("setting_api.php",{
                                           'request_type':'dDisplay'})
               .then(function (response) {$scope.discount = response.data.Discount;
               // console.log(angular.fromJson($scope.discount))
                  
               })     
        };
        
         $scope.deleteDiscount=function(Id){	
                    var deleteConfirm = confirm("Do you really want to delete it?");  
                    if (deleteConfirm == true) {
     

                  $http.post("setting_api.php", {
                                              'request_type':'dDelete',
		                              'dId':Id})
    
                  .success(function(data,status,headers,config){
                  dDisplay();
                  
                  });
                  
                  }  
         };
         
          $scope.changeDStatus=function(){
          
                   
                  $scope.expiryTime = !$scope.expiryTime;
                 
                   
                 /* $http.post("setting_api.php", {
                                              'request_type':'dStatus',
		                              'dId':x.dId,
		                              'dActive' : x.dActive
		                                })
    
                  .success(function(data,status,headers,config){
                  
                   
                  dDisplay();
               
                  //console.log(x.dId);
                  //console.log(x.dActive);
                  });
          
                   */
          
          };
         
         
         
         
        
        
        });  // Compelete myapp controller close
  


</script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>



<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>


</body>
</html>