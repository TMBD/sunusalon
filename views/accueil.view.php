<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    
    $_SESSION['active_page'] = ACCUEIL_VIEW_ROUTE;
    $current_timestamp = time();
echo $current_timestamp;
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset = "utf-8" >
        <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap' rel='stylesheet'>
        <link href="../styles/colors" rel="stylesheet" >
        <link href="../styles/paddings" rel="stylesheet" >

        <title>sunusalon</title>
    </head>

    <body>
        <div class = "container" >
            <?php include_once $wwwDir.HEAD_MENU_VIEW_ROUTE; ?>

        </div>
    </body>
</html>