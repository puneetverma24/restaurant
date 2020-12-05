<?php
require_once('login_check.php');


if(substr($_SESSION['permission'],2,1)=='0') 
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
       
               <div class="row"> 
                                 
                  <div class="panel panel-default">
                    
                      <div class="panel-body">
                        
                       
                       <div class="btn-group" >

	                         <button  class="btn btn-primary btn-md" ng-click="addUser()" >Add User Detail</button>
	        
                           </div>
                           
                            <div ng-hide="myUserPanel"  data-ng-init="myUserPanel = true">
                                                  
                              <h5>Add Details Here:</h5>

                              <form class="form-horizontal">
                              
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label" for="user_Number">Guest Mobile No.</label>
                                      <div class="col-sm-3">
                                           <input class="form-control" id="user_Number" type="number"  placeholder="Enter Mobile Number Here..." ng-model="user_Number">
                                      </div>
                                    
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
                                              <input class="btn btn-primary" type="button" value="Sumbit Detail" ng-hide="submitData" ng-click="insertUser()" />
                                               <input class="btn btn-primary" type="button" value="Update Detail" ng-hide="updateData" ng-click="updateUser()" />
                                              <input class="btn btn-primary" type="button" value="Cancel" ng-click="clear()" />
                                          </div>
                                      </div>
                                 </div>
     
                             </form>
							 
                          </div>  
                              
                    
                       
                        
                       
                        <div class="table-responsive">
                                    
            
                                 <table class="table table-striped " >
                                 
                                  
                                   <thead>  <!-- Heading of Menu Table -->
                                           <tr>
                                               
                                            
                                              <td> Name </td>
                                              <td> Gender </td>
                                              <td> Date of Birth </td>
                                              <td> Mobile No. </td>
                                              <td> Email </td>
                                              <td> Address </td>
                                            
                                          </tr>
                                   </thead>
    
                                   <tbody>
                                           <!-- Repeat Row for Menu Table Here -->
                                          <tr ng-repeat="x in names| filter:test |filter: paginate">   <!-- Filter Table According to Search Text And Category -->
                                              <td>{{ x.user_name }}</td>
                                             
                                              <td>{{ x.user_gender }}</td>
                                              <td>{{ x.user_dob | date : "dd-MM-y" }}</td>
                                              <td>{{ x.user_number }}</td>
                                              <td>{{ x.user_email }}</td>
                                               <td>{{ x.user_address}}</td>
                                               <!--- Edit & Delete Button for Each Row of Menu Table-->
                                               
                                              <td><button type="button" class="btn btn-success" ng-click="userSelectData(x)"><i class="glyphicon glyphicon-pencil"></i></button></td>
                                              <td><button type="button" class="btn btn-danger" ng-click="deleteData(x.user_id)"><i class="glyphicon glyphicon-trash"></i></button></td>
                                          </tr>
                                  </tbody>
    
                             </table>
                             
                                                          
                               
 
                         </div>
                         
                         <pagination class="pagination" total-items="totalItems" ng-model="currentPage" max-size="5" boundary-links="true" items-per-page="numPerPage" >
</pagination>                 '

				 
                        
                           </div>                       
                       
                      </div> <!--Panel Body Close -->
                      
                     
        
                  </div> <!--- Panel Close Here -->
        
              </div>  <!-- Row Ends Here -->
              
           </div>  <!-- Container-fluid End Here--->
  
      </div>    <!--- Content Ends Here--->
 
</div>   <!-- ng-App Div Ends Here-->

<script type="text/javascript">  
         
        var app = angular.module("mainApp",['ui.bootstrap']); 
      
        app.controller('CRUDController', function ($scope, $http ) {  
        
        
        
        //create (insert data in user profile)
        
        $scope.insertUser = function(){
                
                 
          
                $http.post("user_api.php", {
                                                 'request_type':'userDataDirect',
		                                 'user_name':$scope.user_Name,
		                                 'user_number':$scope.user_Number,
		                                 'user_gender':$scope.user_Gender,
		                                 'user_email':$scope.user_EmailId,
		                                 'user_dob':$scope.user_DOB
		                                 
		                                  })
               .then(function (response) {
                user_display();
               alert("Inserted Successfully");
                 
                $scope.myUserPanel = true;
               
               })     
        }
        
        
        
        $scope.updateUser = function(){
                 
                
          
                $http.post("user_api.php", {
                                                 'request_type':'updateUserData',
                                                 'user_id': $scope.user_Id,
		                                 'user_name':$scope.user_Name,
		                                 'user_number':$scope.user_Number,
		                                 'user_gender':$scope.user_Gender,
		                                 'user_email':$scope.user_EmailId,
		                                 'user_dob':$scope.user_DOB
		                                  
		                                  })
               .then(function (response) {
                user_display();
                $scope.clear();
                
                
               
               })     
        }
        
     
        
        user_display()//Display of User Data
        
        function user_display(){
               $http.post("user_api.php",{
                                           'request_type':'user_records'})
               .then(function (response) {$scope.names = response.data.userRecords;
               
               
               
               })  
               
                 
        };
        
         // Delete Menu Item from User Profile SQL Table Using post request using user_id
         
         $scope.deleteData=function(id){	
                   
                    alert(id);
        
                    var deleteConfirm = confirm("Do you really want to delete it?");  
                    if (deleteConfirm == true) {
     

                  $http.post("user_api.php", {
                                              'request_type':'delete',
		                              'user_id': id})
    
                  .success(function(data,status,headers,config){
                   alert("Successs");
                   user_display();
                   
                  });
                  
                  } 
         };
         
         $scope.userSelectData=function(x){
         
          $scope.myUserPanel = false;
          $scope.submitData = true;
          $scope.updateData = false;
          $scope.user_Id = x.user_id;
          $scope.user_Name = x.user_name;
	  $scope.user_Number=Number(x.user_number);
          $scope.user_Gender=x.user_gender;
	  $scope.user_EmailId=x.user_email;
	  $scope.user_DOB= new Date(x.user_dob);
	 //$scope.user_DOB = x.user_dob;
         
         
         }
         
         
        $scope.addUser = function() {
             
                $scope.updateData = true;   
                 $scope.submitData = false;             
                $scope.myUserPanel = !$scope.myUserPanel;
               
       }; 
 
 
       
        
        $scope.clear = function(){
        
            $scope.user_Name = "Guest";
            $scope.user_Number ="";
            $scope.user_Gender = 'male';
            $scope.user_EmailId = "";
            $scope.user_DOB = "";
            $scope.myUserPanel = true;
        };
 
 
         $scope.currentPage = 1;
         $scope.numPerPage = 10;
       
         $scope.paginate = function(value) {
         $scope.xxx=$scope.names;
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
