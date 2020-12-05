<?php
require_once('login_check.php');


if($_SESSION['username']!='admin') 
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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
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
                            
                          <form class="form-horizontal">

                               <div class="form-group">
                                  <label class="col-sm-1 control-label" for="user_role">Role:</label>
                                 
                                  <div class="col-sm-3">
                                     <select id="user_role" class="form-control"  ng-change="orderByMe()" ng-model="user_role" data-ng-init="user_role='Admin'" >
                                              <option  value="Admin">Admin</option>
                                              <option  value="Manager">Manager</option>
                                              <option  value="Waiter">Waiter</option>
                                    </select>
                              
                                 </div>
                                 
                                 <div class="col-sm-8">
                                       <button class="btn btn-primary" ng-click="orderByMe()"> Select Role  </button> 
                          
                                 
                                    
                                     <button class="btn btn-primary pull-right" ng-click="openAC()"> Create Account </button>
                                </div>
                          
                              </div>
                             
                           <div class="form-group" ng-hide="myselect" ng-init="myselect=true">
                           
                                <label class="col-sm-1 control-label" for="useraccessmodel">Name:</label>
                                       
                                       <div class="col-sm-3">
                                          <select id="useraccessmodel" class="form-control"  ng-model="useraccessmodel"  >
                                              
                                            <option ng-repeat="x in accounts | filter: x.role = test"  value="{{x}}">{{ x.username}}</option>          
                                             
                                          </select>
                                          
                                           
                                       </div> 
                                       
                                        <div class="col-sm-3">
                                       
                                      <button class=" btn btn-primary" ng-click="orderByUser()"> Select User </button> 
                                       
                                        </div>
                                      
                            </div>
                      </form>
                
                
      
                       
                       
                       <form class="form-horizontal" ng-hide="newAccount" data-ng-init="newAccount=true">
                       
                       <hr>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label" for="account_name">User Name:</label>
                                      <div class="col-sm-3">
                                           <input class="form-control" id="account_name" type="text" value="" placeholder="Enter UserName Here..." ng-model="account_name">
                                      </div>
                                      
                                      <label class="col-sm-1 control-label" for="account_pwd">Password:</label>
                                      <div class="col-sm-3">
                                           <input class="form-control" id="account_pwd" type="text" value="" placeholder="Enter Password Here..." ng-model="account_pwd">
                                      </div>
                                 </div>
                                
                                 
                                 <div class="form-group">
                                     
                                     <label class="col-sm-2 control-label" for="account_role">Account Role</label>
                                     <div class="col-sm-3">
                                       <select id="account_role" class="form-control"  ng-model="account_role" data-ng-init="account_role='Waiter'" >
                                             
                                              <option  value="Admin">Admin</option>
                                              <option  value="Manager">Manager</option>
                                              <option  value="Waiter">Waiter</option>
                                        </select>
                                      </div>   
                                 </div> 
                                   
                                 <div class="col-sm-10">
                                       <label class="col-sm-2 control-label"  > </label>
                                      <button class="btn btn-primary" ng-click="insertAccount()"> Sumbit Detail </button>
                                      <button class="btn btn-primary" ng-click="clear()"> Cancel</button>                                   
                                 </div>
                              
                      </form>           
                       
                       
             </div> <!-- A/C Creation Panel Body Close -->   
             
        </div> <!-- A/C Creation Panel End Here -->       
              
    </div> <!-- Row2 End Here-->                         
    
    <div class="row" ng-hide="myTable" data-ng-init="myTable=true">
           
        <div class="panel panel-default" >
      
              <div class="panel-body"> 
              
              <table class="table table-striped table-responsive ">
            
             <tr>
                <th>Sales Management</th>
                <td><input type="checkbox"  ng-model="salesManage"></input> {{salesManage}} </td>  
             </tr>   
             
             <tr>
                <th>Menu (Item Dish) Management</th>
                <td> <input type="checkbox"  ng-model="menuManage"></input>  {{menuManage}}</td>
             </tr>  
                  
             <tr>
                <th>User Management</th>
                <td><input type="checkbox" ng-model="userManage"  > </input>{{userManage}}</td>
             </tr> 
             
             
             <tr>
                <th>Today Dish Management</th>
                <td><input type="checkbox" ng-model="todayManage"  > </input>{{todayManage}}</td>
             </tr> 
             
              <tr>
                <th>Tab(frontend) Order Managament</th>
                <td  ><input type="checkbox" ng-model="frontManage"      > </input> {{frontManage}} </td>
             </tr>
             
              <tr>
                <th>Bill/Order Managament</th>
                <td  ><input type="checkbox" ng-model="billManage"      > </input> {{billManage}} </td>
             </tr> 
             
             <tr>
                <th>Restaurant Setting </th>
                <td  ><input type="checkbox" ng-model="settingManage"      > </input> {{settingManage}} </td>
             </tr> 
             
             <tr>
                <th> </th>
                <td><input type="button" class="btn btn-primary" ng-click="updatePermission()" value="Save"> </input> <input type="button" class="btn btn-primary" ng-click="deleteUser()" value="Delete User"> </input></td>
                  
                
             </tr>
                                   
            </table>
     
                </div> <!-- Table Panel Body Ends -->
                
             </div>   <!--- Table Panel End Here-->
  
           </div> <!--Row Ends Here-->
           
           
  
        </div> <!--container  div close -->

    </div> <!--content div close -->

</div> <!--ng app close div -->
  
<script type="text/javascript">  
        
        var app = angular.module("mainApp", [ ]); 
      
        app.controller('CRUDController', function ($scope, $http ) { 
        
        access_level();   // Display user access table Using Post Request
        
        function access_level(){
        
               $http.post("account_api.php",{
                                           'request_type':'accountDisplay'})
                                           
               .then(function (response) {$scope.accounts = response.data.access;
               
               //console.log($scope.accounts);
               
               })     
        };
        
        
         $scope.insertAccount=function(){		
         
                  if($scope.account_name && $scope.account_pwd && $scope.account_role)
                  {
                  $http.post("account_api.php", {
                                                 'request_type':'insertAC',
		                                 'user_name':$scope.account_name,
		                                 'user_pwd':$scope.account_pwd,
		                                 'user_role':$scope.account_role})
    
                  .success(function(data,status,headers,config){
                  
                   alert("Account Created Successfully");
                   $scope.clear(); 
                   
                  })
                  
                  }
                  else
                  {
                   alert("Please fill all the details in the input fields");
                  }
         };
          
        
        $scope.orderByMe = function() {  
        
        			$scope.myselect = false;
                                $scope.myTable = true;   
                                $scope.test= $scope.user_role;
                                $scope.newAccount = true;
                                
                           };
                           
        $scope.orderByUser = function() {  
         
        
                                var obj = JSON.parse($scope.useraccessmodel);
                               // console.log("haha"+obj.permission);
                               
                               $scope.user_id = obj.uid; //user id where to update permission data
                               $scope.user_name= obj.permission;
                               $scope.salesManage = Boolean(Number($scope.user_name.substring(0, 1)));
                               $scope.menuManage = Boolean(Number($scope.user_name.substring(1, 2)));
                               $scope.userManage = Boolean(Number($scope.user_name.substring(2, 3)));
                               $scope.todayManage = Boolean(Number($scope.user_name.substring(3, 4)));
                               $scope.frontManage = Boolean(Number($scope.user_name.substring(4, 5)));
                               $scope.billManage = Boolean(Number($scope.user_name.substring(5, 6)));
                               $scope.settingManage = Boolean(Number($scope.user_name.substring(6, 7)));
                               
                               $scope.myTable = false;
                                
                           };
                           
        $scope.openAC = function() { 
         
                                $scope.newAccount = !$scope.newAccount; 
                                $scope.myTable = true;
                                $scope.myselect = true;
                               
                           };
                           
        
        $scope.clear= function() {
           $scope.account_name=""; 
           $scope.account_pwd="";  
           $scope.account_role="Waiter";
           $scope.newAccount = true;
           $scope.myTable = true;
           $scope.myselect = true;
      
      };  
      
      $scope.updatePermission = function(){
      
           $scope.newPermission=""+Number(Boolean($scope.salesManage))+Number(Boolean($scope.menuManage))+Number(Boolean($scope.userManage))+Number(Boolean($scope.todayManage))+Number(Boolean($scope.frontManage))+Number(Boolean($scope.billManage))+Number(Boolean($scope.settingManage))+"0";
           
            //console.log($scope.newPermission);
           
            $http.post("account_api.php", {
                                                 'request_type':'new_permission',
		                                 'new_per_mission':$scope.newPermission,
		                                 'u_id': $scope.user_id 
		                                 
		                                    })
    
                  .success(function(data,status,headers,config){
                  
                   alert("Account Updated Successfully");
                    access_level(); 
                    //console.log($scope.user_id);
                   
                  })
           
      
      
      };
      
      
      $scope.deleteUser = function(){  
      
      var deleteConfirm = confirm("Do you really want to delete it?");  
                    if (deleteConfirm == true) {
     
                $http.post("account_api.php", {
                                                 'request_type':'deleteUser',
		                                 'u_id': $scope.user_id 
		                                 
		                                    })
    
                  .success(function(data,status,headers,config){
                  
                   alert("Account Deleted Successfully");
                   access_level();
                   $scope.clear(); 
                    
                   
                  })
                       }
          
         };
       
          
       
        });  // Compelete myapp controller close
        
</script>  
    
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    
</body>  
</html> 