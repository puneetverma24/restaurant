<?php
require_once('login_check.php');
 if(substr($_SESSION['permission'],4,1)=='0') 
                {
                header("Location:".$url);
die();
               
                }

?>
    

<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  

<meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   
    <title>Gondia Restaurant</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="https://cdn.bootcss.com/pixeden-stroke-7-icon/1.2.3/dist/pe-icon-7-stroke.css" rel="stylesheet" />
  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-cookies.min.js" data-require="angularjs@1.4" data-semver="1.4.4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-sanitize.min.js" data-require="angularjs@1.4" data-semver="1.4.4"></script> 
    
    
<style>
     .pointer {cursor: pointer;}
     .strike { color: red;}
     
      body {
      background-color: brown; }
     
     .btn-cart {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
       }
   
     .btn-sq-lg {
        width: 150px !important;
        height: 150px !important;
       }

     .btn-sq-product {
        width: 150px !important;
        height: 150px !important;
         border: 1px;
        font-size: 15px;
        text-align: center;
       }
       
       .row-centered {
    text-align:center;
}

   
</style>     
</head> 
 
<body>  
<div ng-app="mainApp" data-ng-controller="CRUDController">  

  <div class="content">
      
    <div class="container-fluid">
         
      <!-- <div class="row">
            
                <div class="panel panel-default">
                    
                      <div class="panel-body  " ng-hide="tablePanel" ng-init="tablePanel=false">
                      
                        
                          <div class="btn-group">
                                 <button type="button" ng-repeat="t in tableName" style="background-color: {{t.Color}}; color:{{t.Text}};" class="btn btn-sq-lg btn-default" ng-click="table(t)"  ng-model="table_color"><img src="assets/images/table.png" width="75px" height="75px"> <br>{{t.Name}}  </button> 
                          </div>
                       </div>   
                           </div>
                        
                  
           </div>   
    
    -->
     
   
      <div class="row" ng-hide="cartPanel" ng-init="cartPanel=false">
      
        <div class="panel panel-default">
              
           <div class="panel-body"> 
              <div class ="row row-centered">
                  <p> {{restaurant_name}} </p>
                  <p> {{restaurant_address}}, +91-{{restaurant_phone}} </p>
                <div class="btn-group">
              
                <button type="button" ng-repeat="t in tableName" style="background-color: {{t.Color}}; color:{{t.Text}};" class="btn btn-default" ng-click="table(t)"  ng-model="table_color">  <br>  {{t.Name}} </button> 
                                 
              </div>
          
             </div>
          </div>
          
       </div>
      
      <div class="panel panel-default">
              
           <div class="panel-body" > 
              
                <div class="col-sm-2" style="background-color:white;" >
                
                <button type="button" class="btn btn-default btn" ng-click="categoryPanel()"><i class="glyphicon glyphicon-list"></i>Category</button>
                   
                     <table class="table table-striped" ng-show="myCategory" ng-init="myCategory=true">
                          <thead>
                             <tr>
                               <td> Category Names </td>
                             </tr>
                         </thead>
                         <tbody>
                            <tr ng-repeat="c in category" class="pointer">
                               <td ng-click="orderByMe(c.category_name)" > {{ c.category_name}} </td>  
                            </tr>
                         </tbody>
                     </table>
                      
               </div>
               
               <div class="col-sm-6">
                        
                  <div class="row">
                  
                       <div class="col-sm-6">
                            <input type="text" class="form-control"  ng-model="test"   placeholder="Search..">                              
                       </div>
                       <div class="col-sm-2">
                            <button type="button" class="btn btn-default"  ng-click="clearSearch()"> X </button>
                       </div>
                       <div class="col-sm-4">
                             <div class="pull-right">
                                 <button type="button" class="btn btn-default"  ng-hide="gridBtn" ng-init="gridBtn = true" ng-click="changeView()"> Grid View </button>  
                                 <button type="button" class="btn btn-default" ng-hide="listBtn" ng-init="listBtn = false"  ng-click="changeView()"> List View </button>  
                             </div>
                       </div>
                       
                  </div>
                     
                  <br> 
                  
                  <div class ="row"> 
                  
                     <div  class="btn-group" ng-hide="gridView" ng-init="gridView = false">
                     
                         <button type="button" ng-repeat="product in products| filter:test" class="btn btn-sq-product btn-default" ng-click="addItemToCart(product)" ><img ng-src="assets/upload/item_images/{{product.Image}}" style="width: 125px; height: 100px;"> <br> {{ product.Name }} <br>  {{product.Discount_price ==0 && '₹'+product.Price ||' '}} <strike class="strike"> {{product.Discount_price !=0 && '₹'+product.Price ||' '  }}</strike>                                  {{product.Discount_price !=0 && '₹'+(product.Price-product.Discount_price) ||' '}}</button> 
                     
                     </div>
                      
                    <table class="table table-striped" ng-hide="listView" ng-init="listView = true">
                 
                         <thead>
                            <tr>
                              <td> Name </td>
                              <td> Price </td>                            
                              <td> Category </td>
                              <td> Image </td>
                              <td> Cart</td>
                            </tr>
                         </thead>
                         <tbody>
                            <tr ng-repeat="product in products| filter:test">
                              <td>{{ product.Name }}</td>
                              <td>{{product.Discount_price ==0 && '₹'+product.Price ||' '  }}
                                   <strike class="strike"> {{product.Discount_price !=0 && '₹'+product.Price ||' '  }}</strike><br>
                                   {{product.Discount_price !=0 && '₹'+(product.Price-product.Discount_price) ||' '  }}</td>                               
                              <td>{{ product.Category }}</td>
                              <td><img ng-src="assets/upload/item_images/{{product.Image}}"></td>
                              <td> <button type="button" class="btn btn-default btn" ng-click="addItemToCart(product)" ><i class="glyphicon  glyphicon-shopping-cart"></i></button></td>
                            </tr>
                        </tbody>
         
                   </table>

                </div> <!--Close for Row-->
              
            </div> <!--Close for Column-->

            <div class="col-sm-4">
     
            Table No: {{table_no}}
           
             
                  <table class="table table-striped" >
                     <thead>
                       <tr>
                         <td> Sr. No</td>
                         <td> Name </td>
                         <td> Price </td>
                         <td> Qty </td>                        
                       </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="c in cart">
                        <td> {{$index+1}}</td>
                        <td>{{ c.Name }}</td>
                        <td>{{ c.Price-c.Discount_price| currency:"&#8377;" }}</td>
                        <td>
                          <button type="button" class="btn btn-default btn-cart" ng-click="removeItemCart(c)"><i class="glyphicon  glyphicon-minus"></i></button>
                           {{ c.count }} 
                          <button type="button" class="btn btn-default btn-cart" ng-click="addItemToCart(c)"><i class="glyphicon  glyphicon-plus"></i></button>  
                        </td>
                        
                        </tr>
                    </tbody>
                  
                  </table>
          
             Total : {{total | currency:"&#8377;" }}
             
            <br>
            
            <button type="button" class="btn btn-default btn" ng-click="save(cart,'printSectionId')"><i class="glyphicon  glyphicon-check"> Save</i></button>  
            
             
          <!--  <button type="button" class="btn btn-default btn" id="clickButton"  ng-click="printToCart('printSectionId')"><i class="glyphicon  glyphicon-check">Print</i></button>  -->
            
            <button type="button" class="btn btn-default btn" ng-click="checkOut(cart)"><i class="glyphicon  glyphicon-check"> Checkout</i></button> 
                 
          <!--  <button type="button" class="btn btn-default btn" ng-click="myy()"><i class="glyphicon  glyphicon-check">Puneet</i></button> --> 
                  
          </div> <!--Close of Cart Column-->
             
          <!---Print KOT--->
          
          
             <div id="printSectionId" class="hidden">
            
             <div class="row">
                 <div> {{restaurant_name}} </div>
                 <div class="pull-right">{{ today | date:'dd-MM-y HH:mm:ss'  }}</div>
                 <div class="pull-left">  Table No: {{table_no}}  </div>
             </div>
             <hr>
          
             <div class="col-sm-4"  >
                  <table class="table table-striped" >
                  <thead>
                     <tr>
                       <td>Item Name:</td>
                       <td>Item Qty: </td>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="k in puneet">
                        <td ng-if="k.count>0">{{ k.Name }}</td>
                        <td ng-if="k.count>0"> {{ k.count }}</td>
                  </tbody>
                  </table>
            
             <hr>
             Server: <?php  echo $_SESSION['username']; ?>
            </div>
        
         </div> <!--Close of KOT Print --->
                 
       </div> <!--Close Panel Body -->
        
    </div>  <!--close Panel -->
     
</div>  <!--Close Row -->
  
        </div>  <!--Close Container Fulid-->
        
    </div>  <!-- Container -->
    
</div>  <!-- Ng App Div Close -->

  
<script type="text/javascript"> 
 
        var app = angular.module("mainApp", [ ]);          
        app.controller('CRUDController', function ( $scope, $http ) {  
        
        $scope.today = new Date();        
    
        //Change View Gird to list & vice versa
        $scope.changeView= function(){
          
          $scope.gridBtn = !$scope.gridBtn;
          $scope.listBtn = !$scope.listBtn;
          $scope.gridView = !$scope.gridView;
          $scope.listView = ! $scope.listView;
         };
         
         //restaurant details
         rDisplay();   // Display Restaurant Details
        
        function rDisplay(){
        
               $http.post("setting_api.php",{
                                           'request_type':'rDisplay'})
               .then(function (response) {$scope.restaurant = response.data.Restaurant;
              
                 $scope.restaurant_id = $scope.restaurant[0].rId;
                 $scope.restaurant_name = $scope.restaurant[0].rName;
                 $scope.restaurant_address = $scope.restaurant[0].rAddress;
                 $scope.restaurant_phone= $scope.restaurant[0].rPhone;
                 $scope.restaurant_gstNo = $scope.restaurant[0].rGstNo;
                 $scope.restaurant_tax = $scope.restaurant[0].rTaxType;
                 $scope.myTableRange = $scope.restaurant[0].rNoTable;
                 //console.log($scope.myTableRange);
                 tDisplay();     
               })   
        };
         
 
        DisplayData();        
        function DisplayData() {
        
          $http.post("menu_api.php",{
          'request_type':'display'})
           .then(function (response) {$scope.products = response.data.Records;
            //console.log($scope.products);
           })
         
         };          

        categoryDisplay();        
        function categoryDisplay() {
        
           $http.post("menu_api.php",{
          'request_type':'category_display'})
           .then(function (response) {$scope.category = response.data.category;})
          
         };
                    
         
        $scope.puneet=[];
        $scope.temp=[];
        $scope.cart = [];
	$scope.total = 0;
	$scope.k=[];
        $scope.printSectionIdx;
        
        
        
        $scope.addItemToCart = function(product){
        
         
          
       
        //  kcart(product);
          	         
            if ($scope.cart.length === 0){
		 product.count = 1;
		 $scope.cart.push(product);
		 }
	    else{
		 var repeat = false;
		 for(var i = 0; i< $scope.cart.length; i++){
		         if($scope.cart[i].Id === product.Id){
		 	        repeat = true;
		 		$scope.cart[i].count +=1;
		 		}
		 }
		 		
	         if (!repeat) {
		 product.count = 1;
		 $scope.cart.push(product);
		 		 	 
		}	
	   }
		 		 
	   $scope.total += parseFloat(product.Price-product.Discount_price);
	   
	  
	   
	  };
		
		
	//$scope.myy=function(){	  
	function myy() {       	  
		 	  
		 $scope.puneet=angular.copy($scope.cart);
		  
		 for(var i=0;i<$scope.cart.length;i++)
		   {
		    //$scope.puneet.push($scope.cart[i]);		    
		    //$scope.puneet[i]= $scope.cart[i];
		    
		     for(var j=0;j<$scope.temp.length;j++)
		    { 
		        if($scope.cart[i].Id==$scope.temp[j].Id)
		            {
		               $scope.puneet[i].count=$scope.cart[i].count-$scope.temp[j].count;
		            }
		       else
		       {
		      // $scope.puneet[i]=$scope.cart[i];
		       
		       }      
		     }
		  }
		  
		  
		  
		  
		  
		  
		   
		   
	
        
         
		   
		  
	 };
		  
	
      $scope.removeItemCart = function(product){
	  
	              if(product.count===product.pcount)
	              {
	                alert(product.Name+"--is already served--"+"--"+product.pcount+"times"); //previous count se khela tha
	              }
	             
	             else{
	         //  kremove(product);
		   
	       if(product.count > 1){
		          product.count -= 1; 
		        }
	       else if(product.count === 1){
		          var index = $scope.cart.indexOf(product);
 			  $scope.cart.splice(index, 1);
		       }
		    
	      $scope.total -= parseFloat(product.Price-product.Discount_price);
	      }
	};
         

      $scope.checkOut=function(cart){
                         
                          if ($scope.cart.length === 0){
                                      alert("No Product In Cart!!");
                                    }
                          else{
   
                             $scope.items_cart_id= $scope.cart[0].Id;
                             $scope.items_cart_count= $scope.cart[0].count;
                             $scope.items_current_price= $scope.cart[0].Price;
                             $scope.items_cart_price= $scope.cart[0].Price-$scope.cart[0].Discount_price;
    
                             for(var i = 1; i< $scope.cart.length; i++){
    
                                  $scope.items_cart_id=$scope.items_cart_id+","+$scope.cart[i].Id;
                                  $scope.items_cart_count=$scope.items_cart_count+","+$scope.cart[i].count;
                                  $scope.items_current_price=$scope.items_current_price+","+$scope.cart[i].Price;
                                  $scope.items_cart_price=$scope.items_cart_price+","+($scope.cart[i].Price-$scope.cart[i].Discount_price);
                             }
                             
                            $http.post("order_api.php", {
                                              'request_type':'orderPlaced',
		                              'cart_item_id':$scope.items_cart_id,
		                              'cart_item_qty':$scope.items_cart_count,
		                              'current_item_price':$scope.items_current_price, 
		                              'cart_item_price':$scope.items_cart_price,    
		                              'cart_total':$scope.total,
		                              'table_no':$scope.table_no})
    
                                    .success(function(data,status,headers,config){
                                               
                 
                                           alert("Order Placed");                                           
                                           $scope.cart = [];
	                                   $scope.total = 0;
	                                  //$scope.cartPanel=true;
                                          //$scope.tablePanel=false;
                                        });
   
                          
              //To make table clear showing white color            
              i=$scope.table_no-1;
              $scope.tableName[i].Color="White";
              
               }
      };
 
    $scope.save=function(cart,printSectionId){
               
                $scope.printSectionIdx=printSectionId;
                
                  myy();
                 
               
                 
                            
                  i=$scope.table_no-1;
                  $scope.tableName[i].Color="Green";
                  $scope.tableName[i].Text="White";
                  
                 // $scope.tablePanel=false;
                 // $scope.cartPanel=false;
    
                  $http.post("order_api.php", {
                                              'request_type':'orderSave',
		                              'cart':$scope.cart,
		                              'save_id':$scope.items_cart_id,
		                              'table':$scope.table_no
		                              })
   
                       .success(
                       
                       
                       function(data,status,headers,config){
                            //console.log(status);
                             //alert("Order Saved");
                            //$scope.cart=[];
                            //$scope.k=[];
                           // $scope.total = 0;
                            //$scope.table_no = "";
                                 $scope.cart=[];
                            //$scope.puneet=[];
                           $scope.total = 0;
                    
                       var printConfirm = confirm("Do you really want to print it?");  
                    if (printConfirm == true) {
                       
                        $scope.printToCart($scope.printSectionIdx);                   
                   
                    }
                    
                 
                    
                    }
                    ); 
                    
               
    }  
    
    
    
    $scope.try=function ()
    {
      //document.getElementById('clickButton').click();
    
    }
    
    
    
   $scope.table=function(t){
                      $scope.tablePanel=true;
                      $scope.cartPanel=false;
        $scope.table_no= t.No;              
         
       for(i=0; i<$scope.tableName.length;i++)
          {
            if($scope.tableName[i].Color != "Green"){
              
               $scope.tableName[i].Color="White";
               $scope.tableName[i].Text="Black";
              }
          }
      
        if( $scope.tableName[t.No-1].Color != "Green")
        {
           $scope.tableName[t.No-1].Color="Orange";
            $scope.tableName[t.No-1].Text="Black";
        }
  

       $http.post("order_api.php",{
                                   'request_type':'reloadCart',
                                   'table_no':t.No})

                .then(function (response) {$scope.cart = response.data.orders;             
                 
                 $scope.temp=angular.copy($scope.cart); 
                 $scope.total = 0;
                 for(i=0;i<$scope.cart.length;i++)  
                 {
                   $scope.total+= ($scope.cart[i].Price-$scope.cart[i].Discount_price)*$scope.cart[i].count;
                   $scope.cart[i].pcount=$scope.cart[i].count;
                   $scope.cart[i].kcount=0;
                 }

               });
               
   }  //table function ends here 
          
    
    $scope.orderByMe = function(x) {          
                       $scope.test=x;
         };

    $scope.categoryPanel= function(){                       
                       $scope.myCategory = !$scope.myCategory;
         };
     
     $scope.clearSearch =function(){    
                       $scope.test="";
         };
    
    
  $scope.tableName =[];
     
  function tDisplay(){ 
     
           for(var i=0;i<$scope.myTableRange;i++)
                 {
                 
                  var x= {No:i+1, Name: "Table_No: "+(i+1), Color:"White",Text:"Black"}; 
                  $scope.tableName.push(x);
 
                 }

         };
         
           
 
    //print function goes here
    $scope.printToCart = function(printSectionId) {
          
       
  
        
       var innerContents = document.getElementById(printSectionId).innerHTML;
        var popupWinindow = window.open('', '_blank', 'width=600,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
        popupWinindow.document.open();
        popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + innerContents + '</html>');
        popupWinindow.document.close();
        
         
         
    
                            //$scope.table_no = "";
       
      }
     
     
  
  
});  //ng-conrolleer ng app ends here
</script>  
    
</body>  
</html> 