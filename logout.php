<?php
session_start();
session_destroy();
header( "Location: http://localhost/gondiashop/login.php" );
/* Redirect browser */
exit();
?> 