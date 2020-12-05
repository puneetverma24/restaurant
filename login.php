<?php

 session_start();

$url="http://jobsali.website/anil/restaurant/index.php";

                 
//echo substr($_SESSION['permission'],0,1);  //source start length




if(isset($_SESSION['status']))
{




    if($_SESSION['status']=='success')
      {
       header("Location:".$url);
     die();
      }
      
     
      
      
}
else
{

  

}



?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

body {
       background: lightblue url("assets/images/food-background.jpg") no-repeat fixed center;
        }
        
        .center{
        
         color: White;
        }
        
        .input-field input[type=text] {
     
        color: White;
        font-size: 20px;
   }
      
       .input-field input[type=password] {
     
        color: White;
        font-size: 20px;
   }
          
         
</style>

<html ng-app="loginApp">

<head>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | Infinitya Restaurant Software </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.css">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
  
</head>
<body ng-controller="loginController">

 <div class="container-fluid"  >
       <div class="row">    
            <!--Login For Med Device Start Here -->
           <div class="col s12 m6 offset-m6">
                    <div class="row login_row">
                     <br><br><br>
                        <h5 class="center" >Infinitya Restaurant Software Admin Panel</h5>                     

                        <div class="col s12" >
                           <div class="input-field col s12 m6 offset-m3">
                               
                                 <input type="text" class="form-control" ng-model="username"  placeholder="username">

                           </div>
                        </div>

                        <div class="col s12" >
                            <div class="input-field col s12 m6 offset-m3">
                               	<input type="password" class="form-control" ng-model="password" placeholder="password">
                             </div>
                        </div>
                      
                      
                        <div class="input-field col s12 center " style="margin:-2.5% 0 0 0">
                            <br>
                            <a class="pink btn login-btn" ng-click="adminLogin(username,password)" style="border-radius: 20px 20px 20px 20px">LOGIN</a>
                        </div>
                    </div>
      </div>
     </div>
   
    <script>
    
    var app = angular.module('loginApp', []);

app.controller('loginController', function ($scope, $http) {




    $scope.adminLogin=function(username,password){
    	 
    	 $http({
            url: 'login_api.php',
            method: "POST",
            data: {
            	'username':username,
            	'password':password
            	 }
        }).then(function (response) {
			console.log(response);
	    //console.dir(JSON.stringify(response.data));
	     if(response.status==200){
	     	//window.location="index.php";
	     	console.log(response.data.status);
	     	
	     	if(response.data.status=='success')
	     	{
	     	
	     	console.log("redirect here");
	     	window.location="index.php";
	     	}
	     	
	     	
	     	else
	     	{
	     	console.log("Invalid");
	     	alert("Invalid");
	     	
	     	}
	     	
	     	
	     }
        });
    }
   
    
    
});
    </script>
    

</body>
</html>


