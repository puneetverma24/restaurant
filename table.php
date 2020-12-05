  <?php
require_once('login_check.php');
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

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="https://cdn.bootcss.com/pixeden-stroke-7-icon/1.2.3/dist/pe-icon-7-stroke.css" rel="stylesheet" />
    
    
    

    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-cookies.min.js" data-require="angularjs@1.4" data-semver="1.4.4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular-sanitize.min.js" data-require="angularjs@1.4" data-semver="1.4.4"></script>
      
</head>  
 
<body> 


<div ng-app="mainApp" data-ng-controller="CRUDController">  

 <div class="content">
            
      <div class="container-fluid">

              <div class="row">
               
                 <div class="col-lg-12">
          <p>
            <a href="http://www.theviralplus.com/gondiashop/front.php?table_no=1" class="btn btn-sq-lg btn-primary">
                <i class="fa fa-cutlery fa-5x"></i><br/>
                Table No. 1<br>Button
            </a>
            <a href="http://www.theviralplus.com/gondiashop/front.php?table_no=2" class="btn btn-sq-lg btn-success">
              <i class="fa fa-cutlery fa-5x"></i><br/>
              Table No. 2 <br>Button
            </a>
            <a href="http://www.theviralplus.com/gondiashop/front.php?table_no=3" class="btn btn-sq-lg btn-info">
              <i class="fa fa-cutlery fa-5x"></i><br/>
              Table No. 3<br>Button
            </a>
            <a href="http://www.theviralplus.com/gondiashop/front.php?table_no=4" class="btn btn-sq-lg btn-warning">
              <i class="fa fa-cutlery fa-5x"></i><br/>
              Table No. 4 <br>Button
            </a>
            <a href="http://www.theviralplus.com/gondiashop/front.php?table_no=5" class="btn btn-sq-lg btn-danger">
              <i class="fa fa-cutlery fa-5x"></i><br/>
              Table No. 5 <br>Button
            </a>
          </p>
        </div>
    
    
              </div>
     </div>
 
 </div>

</body>
</html>