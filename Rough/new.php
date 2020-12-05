<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title></title>  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>  
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
    
</head>  
<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
<body>  
  
    <div ng-app="mainApp" data-ng-controller="CRUDController">  
    
 <form ng-hide="myVar">
Item Id:-<input type="text" ng-model="item_model_id" />
Item Name:-<input type="text" ng-model="item_model_name" />
Item Price:-<input type="text" ng-model="item_model_price" />

<input type="button" value="Submit" ng-click="insertData()" />
 <input type="button" value="Update" ng-click="updateData()"  />
</form>
    <button data-ng-click="toggle()">Add New Item</button>     
   <table>
   <tr ng-repeat="x in names">
    <td>{{ x.Id }}</td>
    <td>{{ x.Name }}</td>
    <td>{{ x.Price }}</td>
    
    <td> <input type="button" value="Delete" data-ng-click="deleteData(x.Id)"/> </td>
     <td> <input type="button" value="Edit"  data-ng-click="BindSelectedData(x)"/> </td>
   
    <td><div class="btn-group">
                <button type="button" class="btn btn-default btn" ng-click="edit($index);"><i class="glyphicon glyphicon-pencil"></i></button>  
                <button type="button" class="btn btn-default btn" ng-click="delete();"><i class="glyphicon glyphicon-trash"></i></button> 
                </div></td>
     
     
   </tr>
  </table>
   
         
    </div>  
    
      
    
   

  
    <script type="text/javascript">  
        var app = angular.module("mainApp", []);  
      
        app.controller('CRUDController', function ab($scope, $http) {  
        
        
         DisplayData();
        
        function DisplayData() {
         
          $http.get("item_learn.php")
          .then(function (response) {$scope.names = response.data.Records;});
          
          }
          
          $scope.insertData=function(){		
          $http.post("insert.php", {
		'item_id':$scope.item_model_id,
		'item_name':$scope.item_model_name,
		'item_price':$scope.item_model_price})
    
    .success(function(data,status,headers,config){
      DisplayData();
    console.log("Data Inserted Successfully");
     
    });
        }
         
           
       $scope.deleteData=function(Id){	
      
          $http.post("delete.php", {
		'item_id':Id})
    
    .success(function(data,status,headers,config){
      DisplayData();
     console.log(Id);
    });
        }
        
        
        
       
        
        
        
    
        $scope.BindSelectedData = function (x) {  
                $scope.item_model_id = x.Id;  
                $scope.item_model_name = x.Name;  
                $scope.item_model_price = x.Price;  
                $scope.toggle();
            }  
          
          
         $scope.updateData=function(){		
          $http.post("update.php", {
		'item_id':$scope.item_model_id,
		'item_name':$scope.item_model_name,
		'item_price':$scope.item_model_price})
    
    .success(function(data,status,headers,config){
      DisplayData();
    console.log("Data Updated Successfully");
    
     
    });
        }  
          
  
  $scope.myVar = true;
    $scope.toggle = function() {
        $scope.myVar = !$scope.myVar;
    };
    
       
            
        });  
    </script>  
</body>  
</html> 