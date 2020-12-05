<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title></title>  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>  
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script> 
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
    
    
    
  
    
    <input ng-model="q" id="search" class="form-control" placeholder="Filter text">
    
   <select ng-model="pageSize" id="pageSize" class="form-control">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select> 
    
    
       
   <table>
   <tr ng-repeat="item in data | filter:q | startFrom:currentPage*pageSize | limitTo:pageSize">
    <td>{{item}}</td>
     
    
     
   </tr>
  </table>
   
   <button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1">
        Previous
    </button>
    {{currentPage+1}}/{{numberOfPages()}}
    <button ng-disabled="currentPage >= getData().length/pageSize - 1" ng-click="currentPage=currentPage+1">
        Next
    </button>
         
    </div>  
    
    
   

  
    <script type="text/javascript">  
    var app = angular.module("mainApp", []); 
    
     
    app.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
}); 
        
    app.controller('CRUDController', ['$scope', '$filter',    function ($scope, $filter) {
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.data = [];
    $scope.q = '';
      
        
        $scope.getData = function () {
      // needed for the pagination calc
      // https://docs.angularjs.org/api/ng/filter/filter
      return $filter('filter')($scope.data, $scope.q)
      }
      
      
        
        
        // DisplayData();
        
        //function DisplayData() {
         
          $http.get("item_learn.php")
          .then(function (response) {$scope.names = response.data.Records;});
          
         // }
          
        //  $scope.insertData=function(){		
         // $http.post("insert.php", {
	//	'item_id':$scope.item_model_id,
	//	'item_name':$scope.item_model_name,
	//	'item_price':$scope.item_model_price})
    
 //   .success(function(data,status,headers,config){
 //     DisplayData();
  //  console.log("Data Inserted Successfully");
     
  //  });
    //    }
         
           
      // $scope.deleteData=function(Id){	
      
       //   $http.post("delete.php", {
	//	'item_id':Id})
    
   // .success(function(data,status,headers,config){
   //   DisplayData();
   //  console.log(Id);
    // });
    //    }
        
        
        
       
        
        
        
    
        
    
        
       
       $scope.data = [1,2,3,12,12];
       
      $scope.numberOfPages=function(){
        return Math.ceil($scope.getData().length/$scope.pageSize);                
    }
    
   // for (var i=0; i<5; i++) {
   //     $scope.data[i] = $scope.n[i];
   // }
}]);


 
    </script>  
  
</body>  
</html> 