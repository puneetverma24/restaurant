<div class="sidebar" data-color="blue" data-image="assets/images/sidebar-5.jpg">
    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
        
        -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.theviralplus.com" class="simple-text">
            <?php echo  $_SESSION['restaurant_name']; 
                echo "<br>". $_SESSION['restaurant_phone'];?>
            </a>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="index">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <?php 
                if(substr($_SESSION['permission'],4,1)=='1') 
                {
                echo '
                <li>
                    <a href="front" target="_blank">
                        <i class="pe-7s-bell"></i>
                        <p>Tables</p>
                    </a>
                </li>';
                 }
                
                ?>
            <?php 
                if(substr($_SESSION['permission'],1,1)=='1') 
                {
                echo '
                <li>
                    <a href="menu">
                        <i class="pe-7s-user"></i>
                        <p>Menu Management</p>
                    </a>
                </li>';
                
                } ?>
            <?php 
                if(substr($_SESSION['permission'],5,1)=='1') 
                {
                echo '
                <li>
                    <a href="order">
                        <i class="pe-7s-note2"></i>
                        <p>Order Management</p>
                    </a>
                </li>';
                
                }
                
                ?>
            <?php 
                if(substr($_SESSION['permission'],0,1)=='1') 
                 {
                 echo '
                 <li>
                     <a href="sales">
                         <i class="pe-7s-news-paper"></i>
                         <p>Sales</p>
                     </a>
                 </li>';
                 
                 }
                 
                 ?>
            <?php 
                if(substr($_SESSION['permission'],2,1)=='1') 
                {
                echo '
                <li>
                    <a href="user">
                        <i class="pe-7s-science"></i>
                        <p>User Data</p>
                    </a>
                </li>';
                
                }
                
                ?>
            <?php
                 
                 echo '
                 <li>
                     <a href="setting">
                         <i class="pe-7s-map-marker"></i>
                         <p>Setting</p>
                     </a>
                 </li>';
                 ?>
            <?php 
                if(substr($_SESSION['permission'],3,1)=='1') 
                {
                echo '
                <li>
                    <a href="today_special">
                        <i class="pe-7s-bell"></i>
                        <p>Today Special</p>
                    </a>
                </li>';
                 }
                
                ?>
            <?php 
                if(($_SESSION['username'])=='admin') 
                {
                echo '
                <li>
                
                <li class="active-pro">
                    <a href="account">
                        <i class="pe-7s-rocket"></i>
                        <p>Account</p>
                    </a>
                </li>';
                }
                ?>
            <li>
                <a href="logout">
                    <p>Log out</p>
                </a>
            </li>
            </li>
            <li class="active-pro">
                <a href="#">
                    <p>Gondia Restaurant v1.1</p>
                    <br>For any help call
                    8669046705
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main-panel">
<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <!--         <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-globe"></i>
                            <b class="caret hidden-lg hidden-md"></b>
                    <p class="hidden-lg hidden-md">
                    5 Notifications
                    <b class="caret"></b>
                    </p>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Notification 1</a></li>
                        <li><a href="#">Notification 2</a></li>
                        <li><a href="#">Notification 3</a></li>
                        <li><a href="#">Notification 4</a></li>
                        <li><a href="#">Another notification</a></li>
                      </ul>
                    </li>
                    <li>
                    <a href="">
                        <i class="fa fa-search"></i>
                    <p class="hidden-lg hidden-md">Search</p>
                    </a>
                    </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--  <li>
                    <a href="account">
                        <p>Account</p>
                     </a>
                    </li> -->
                <!--   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <p>
                    Dropdown
                    <b class="caret"></b>
                    </p>
                    
                    </a>
                    <ul class="dropdown-menu ">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                    </li>  -->
            </ul>
        </div>
    </div>
</nav>