<?php
require_once('login_check.php');
if (substr($_SESSION['permission'], 1, 1) == '0') {
    header("Location:" . $url);
    die();
} //substr($_SESSION['permission'], 1, 1) == '0'
?>
<!-- DOCTYPE html -->  
<html>
    <!--html xmlns="http://www.w3.org/1999/xhtml"--> 
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
    <body >
        <!-- Panel Inculde --> 
        <div ng-app="mainApp" data-ng-controller="CRUDController">
            <?php require_once('includes/panel.php'); ?>
            <div class="content" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="panel panel-default" ng-cloak>
                            <div class="panel-body">
                                <div class="btn-group">
                                    <button  class="btn btn-primary btn-md" ng-click="toggle2()" >Add Category</button>
                                    <button  class="btn btn-primary btn-md" ng-click="toggle()" >Add Menu Item</button>
                                </div>
                                <!--- Category Panel Start Here---> 
                                <div id="item_category" ng-hide="myPanel2"  data-ng-init="myPanel2 = true">
                                    <h5>Add Category</h5>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="item_category">Category Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="item_category" type="text" value="" placeholder="Enter Category Name..." ng-model="item_category_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <div class="btn-group">
                                                    <input class="btn btn-primary" ng-hide="my_insert_btn_cat" data-ng-init="my_insert_btn_cat = false" type="button" value="Insert Category" ng-click="insertCateogry()" />
                                                    <input class="btn btn-primary" ng-hide="my_update_btn_cat" data-ng-init="my_update_btn_cat = false" type="button" value="Update Category" ng-click="updateCateogry()" />
                                                    <input class="btn btn-primary" type="button" value="Cancel" ng-click="cancel()" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--- Menu Panel Starts Here-->                   
                                <div id="item_menu"  ng-hide="myPanel"  data-ng-init="myPanel = true">
                                    <h5>Add New Item: In Menu</h5>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="item_name">Item Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="item_name" type="text" value="" placeholder="Enter Item Name..." ng-model="item_model_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_price" class="col-sm-2 control-label">Item Price</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="item_price" type="text" placeholder="Enter Item Price" ng-model="item_model_price" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_category" class="col-sm-2 control-label">Item Category</label>
                                            <div class="col-sm-10">
                                                <select id="item_cateogry" class="form-control" ng-model="item_model_category"  >
                                                    <option ng-repeat="c in category" value="{{c.category_name}}">{{c.category_name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr/>
                                    </form>
                                    <!---Image Upload Here--->             
                                    <form  class="form-horizontal" method="post" id="fileinfo" name="fileinfo" onsubmit="return submitForm();">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Select Item Image:</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" id="chkimagedefault" ng-model="defaultImage" ng-change="ShowHide()" />
                                                Assign a Default Image for this item
                                            </div>
                                        </div>
                                        <div class="form-group" ng-show="IsVisible" data-ng-init="IsVisible=true">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-10">
                                                <div class="col-sm-4">
                                                    <input type="file" id="fileInput" name="file" required />
                                                    <input type="submit" value="Upload"/>    
                                                    <span id="output"></span>
                                                </div>
                                                <div class="col-sm-3" ng-model="item_model_image">
                                                    <img ng-src="assets/upload/item_images/{{item_model_image}}">  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-10">
                                                <div class="btn-group">
                                                    <input ng-hide="my_insert_btn" data-ng-init="my_insert_btn = false"  class="btn btn-primary" type="button" value="Insert" ng-click="insertData()" />
                                                    <input ng-hide="my_update_btn" data-ng-init="my_update_btn = true" class="btn btn-primary" type="button" value="Update" ng-click="updateData()" />
                                                    <input class="btn btn-primary" type="button" value="Cancel" ng-click="cancel()" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Menu Panel Ends Here-->
                            </div>
                            <!--Panel Body Close -->
                        </div>
                        <!--- Panel Close Here -->
                    </div>
                    <!--Row 1 Close -->
                    <div class="row" ng-cloak>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-3 table-responsive" >
                                    <!-- Category Display ColumnStarts Here -->
                                    <div class="row">
                                        <input type="text"  class="form-control" ng-model="test" placeholder="Search...">
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped">
                                            <!-- Category Table Starts -->
                                            <thead style=" background-color: white;">
                                                <!-- Heading of Cateogry Table -->
                                                <tr>
                                                    <td> Category </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Repeat Table Row For Each Category -->
                                                <tr ng-repeat="c in category">
                                                    <td ng-click="orderByMe(c.category_name)"> {{ c.category_name}} </td>
                                                    <!--- Click To Filter Menu Table According Category -->
                                                    <!--- Edit & Delete Button for Each Row of Category Table-->
                                                    <td><button type="button" class="btn btn-default" ng-click="BindSelectedCategory(c)"><i class="glyphicon glyphicon-pencil"></i></button></td>
                                                    <td><button type="button" class="btn btn-default" ng-click="deleteCategory(c.category_id)"><i class="glyphicon glyphicon-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Category Column Ends Here-->
                                <div class="col-sm-9 table-responsive "  style="background-color: white;">
                                    <!--- Menu Column Start Here -->
                                    <!-- Menu Table Start Here-->
                                    <table class="table table-striped" >
                                        <thead>
                                            <!-- Heading of Menu Table -->
                                            <tr>
                                                <td> Id  </td>
                                                <td> Name </td>
                                                <td> Price </td>
                                                <td> Category </td>
                                                <td> Edit </td>
                                                <td> Delete </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Repeat Row for Menu Table Here -->
                                            <tr ng-repeat="x in names| filter:test | filter : paginate">
                                                <!-- Filter Table According to Search Text And Category -->
                                                <td>{{ x.Id }}</td>
                                                <!-- <td><img ng-src="assets/upload/item_images/{{x.Image}}"></td> -->
                                                <td>{{ x.Name }}</td>
                                                <td>{{ x.Price | currency:"&#8377;" }}</td>
                                                <td>{{ x.Category }}</td>
                                                <!--- Edit & Delete Button for Each Row of Menu Table-->
                                                <td><button type="button" class="btn btn-success" ng-click="BindSelectedData(x)"><i class="glyphicon glyphicon-pencil"></i></button></td>
                                                <td><button type="button" class="btn btn-danger" ng-click="deleteData(x.Id)"><i class="glyphicon glyphicon-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="pagination" total-items="totalItems" ng-model="currentPage" max-size="5" boundary-links="true" items-per-page="numPerPage" ></pagination>
                                </div>
                                <!-- Menu Column Ends Here-->
                            </div>
                            <!--Panel Body Close -->
                        </div>
                        <!--- Panel Close Here -->
                    </div>
                    <!-- Row Ends Here -->
                </div>
                <!-- Container-fluid End Here--->
            </div>
            <!--- Content Ends Here--->
        </div>
        <!-- ng-App Div Ends Here-->
        <!---- Previous Image Upload Code ...          
            <form method="post" id="fileinfo" name="fileinfo" onsubmit="return submitForm();">
                 <label>Select Item Image:</label><br>
                 <input type="file" name="file" required />
                 <input type="submit" value="Upload" />
             </form>
             <div id="output"></div>
                       
             <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  <span>Please wait<span class="dotdotdot"></span></span>
            </div>
            </div>   
            
            Ends Here -->                
        <script type="text/javascript">  
            var app = angular.module("mainApp",['ui.bootstrap']); 
            
            app.controller('CRUDController', function ($scope, $http ) {  
            
                $scope.item_model_image="white.png";
                
                $scope.ShowHide = function () {
                    
                    $scope.IsVisible = !$scope.defaultImage;
                };
              
               
              
            
            menu_display();   // Display Menu Table Using Post Request
            
            function menu_display(){
                   $http.post("menu_api.php",{
                                               'request_type':'display'})
                   .then(function (response) {$scope.names = response.data.Records;})     
            };
              
            
            category_display();   // Display Category Table Using Post Request
            
            function category_display(){
                     $http.post("menu_api.php",{
                                                 'request_type':'category_display'})
                     .then(function (response) {$scope.category = response.data.category;})
            }; 
            
            //Insert Category Name in Item Category SQL Table using post request
            
             $scope.insertCateogry=function(){
             	
                      $http.post("menu_api.php", {
                                                     'request_type':'category_insert',
                                       'item_category':$scope.item_category_name })
                     
                      .success(function(data,status,headers,config){
                      category_display();
                      alert("Category Inserted Successfully");
                      $scope.clear();
                      //console.log($scope.item_category_name);
                      })
             }
            
            // Insert Menu Item In Menu Item Table SQL using post request
            
             $scope.insertData=function(){	
             
                      var iOut = document.getElementById("output").innerHTML;
                      if($scope.defaultImage == true){ $scope.item_model_image = 'index.png';
                      }
                      else { $scope.item_model_image = iOut;	
                      }
                      if($scope.item_model_name && $scope.item_model_price && $scope.item_model_category && $scope.item_model_image)
                      {
                      
                     
                      $http.post("menu_api.php", {
                                                     'request_type':'insert',
                                       'item_category':$scope.item_model_category,
                                       'item_name':$scope.item_model_name,
                                       'item_price':$scope.item_model_price,
                                       'item_image':$scope.item_model_image})
            
                      .success(function(data,status,headers,config){
							menu_display();
							alert("Item Inserted Successfully");
							$scope.clear(); 
							console.log("Data Inserted Successfully");
                      })
                      }
                      else
                      {
                       alert("Please fill all the details in the input fields");
                      }
             }
             
              // Delete Category from Category Table SQL Using post request using category_id
             
             $scope.deleteCategory=function(Id){	
                        var deleteConfirm = confirm("Do you really want to delete it?");  
                        if (deleteConfirm == true) {
            
            
                            $http.post("menu_api.php", {
                                                    'request_type':'delete_category',
                                              'category_id':Id})
            
                           .success(function(data,status,headers,config){
                           category_display();
                           //console.log(Id);
                           });
                      
                            } else {
                              //alert( "You pressed Cancel!");
                            }
            }
             
            // Delete Menu Item from Menu Item Table SQL Using post request using item_id
             
            $scope.deleteData=function(Id){	
                        var deleteConfirm = confirm("Do you really want to delete it?");  
                        if (deleteConfirm == true) {
            
            
                      $http.post("menu_api.php", {
                                                  'request_type':'delete',
                                    'item_id':Id})
            
                      .success(function(data,status,headers,config){
                      menu_display();
                      console.log(Id);
                      });
                      
                      } else {
                              //alert( "You pressed Cancel!");
                            }
             }
                               
             // Select the row which is to be edit sending 'x' corresponding to that row   
            
             $scope.BindSelectedData = function (x){  
                    $scope.item_model_id = x.Id;  
                    $scope.item_model_name = x.Name;  
                    $scope.item_model_price = x.Price;  
                    $scope.item_model_category = x.Category;
                    $scope.item_model_image = x.Image;
                  
                    $scope.myPanel = false;
                    $scope.my_update_btn = false;
                    $scope.my_insert_btn = true;
                    $scope.myPanel2 = true;
                    
                    
                    
             }  
             
             // Select the category row which is to be edit sending 'x' corresponding to that row  
             
             $scope.BindSelectedCategory = function (x){  
                     
                    $scope.item_category_name = x.category_name; 
                    $scope.bind_category_id = x.category_id; 
                    
                    $scope.myPanel2 = false;
                    $scope.my_update_btn_cat = false;
                    $scope.my_insert_btn_cat = true;
                    
                    
                    
             } 
              
             // Update the menu item in SQL table using post request
             $scope.updateData=function(){	
                      
                      var iOut = document.getElementById("output").innerHTML;
                      
                      if($scope.defaultImage == true)
                      { $scope.item_model_image = 'index.png';
                      }
                      else if (iOut)
                      {
                          $scope.item_model_image = iOut;
                      }
             	
                      $http.post("menu_api.php", {
                                                  'request_type':'update',
                                    'item_category':$scope.item_model_category,
                                    'item_id':$scope.item_model_id,
                                    'item_name':$scope.item_model_name,
                                    'item_price':$scope.item_model_price,
                                    'item_image':$scope.item_model_image})
            
                      .success(function(data,status,headers,config){
                       
                      menu_display();
                      $scope.cancel();
                      alert("Update Data Successfully");
                      console.log("Data Updated Successfully");
                      });
             }  
             
               // Update the Category Name in SQL table using post request
             $scope.updateCateogry=function(){		
                      $http.post("menu_api.php", {
                                                  'request_type':'update_category',
                                    'category_id': $scope.bind_category_id,
                                    'category_name':$scope.item_category_name
                                     })
            
                      .success(function(data,status,headers,config){
                       $scope.myPanel2 = true;
                       category_display();
                       menu_display(); 
                       alert("Update Category Data Successfully");
                      //console.log($scope.bind_category_id);
                      });
             }
            
            
            
             
            
            // Cancel Close all the open panel & also clear variables
            $scope.cancel = function() {
                     
                    $scope.myPanel = true;
                    $scope.myPanel2 = true;
                    $scope.clear();
                    
            };   
            
            // It toggle Add Menu Button & also close category panel
            $scope.toggle = function() {
                     
                    $scope.myPanel2 = true;
                    $scope.myPanel = !$scope.myPanel;
                    $scope.my_insert_btn = false;
                    $scope.my_update_btn = true;
                    $scope.clear();
            }; 
            
            // It toggle Add Category Button &also close menu panel
            $scope.toggle2 = function() {
                  
                    $scope.myPanel = true;
                    $scope.myPanel2 = !$scope.myPanel2;
                    $scope.my_insert_btn_cat = false;
                    $scope.my_update_btn_cat = true;
                    $scope.clear();
                  
            }; 
            
            // It clear all the input text variables
            $scope.clear = function(){
            
                    $scope.item_model_id = '';  
                    $scope.item_model_name = '';  
                    $scope.item_model_price = '';  
                    $scope.item_model_category = '';
                    $scope.item_category_name = ''; 
                    $scope.bind_category_id = ''; 
                   
                    $scope.item_model_image="white.png";
                    document.getElementById("output").innerHTML = "";
                    $scope.defaultImage = false;
                    $scope.IsVisible = !$scope.defaultImage; 
                    
            };
            
            // filter by category 
            
            $scope.orderByMe = function(x) {  
                                    $scope.test=x;
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
            
            
            
            });  // Compelete myapp controller close
            
        </script>    
        <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>   
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript">
            function submitForm() {
                console.log("submit event");
                document.getElementById("output").innerHTML = "Uploading please wait...";
                var fd = new FormData(document.getElementById("fileinfo"));
                fd.append("label", "ORG_");
                $.ajax({
                  url: "upload.php",
                  type: "POST",
                  data: fd,
                  processData: false,  // tell jQuery not to process the data
                  contentType: false   // tell jQuery not to set contentType
                }).done(function( data ) {
                    console.log("PHP Output:");
                    console.log( data );
                    
                      document.getElementById("output").innerHTML = data;
                      // $("#fileInput").replaceWith($("#fileInput").val('').clone(true)); //To Clear File Choosen Code (thinking more)....
                });
                return false;
            }
        </script>
        <!-- <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script> comment by anil to check whethr this need --> 
    </body>
</html>