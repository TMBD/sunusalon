<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.LISTER_CLIENTS_VIEW_ROUTE;

    $_SESSION['active_page'] = CLIENTS_VIEW_ROUTE;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap' rel='stylesheet'>
    <link href="../styles/colors.css" rel="stylesheet" >
    <link href="../styles/paddings.css" rel="stylesheet" >
    <!-- <script src = "../js/jquery-3.2.1" ></script> -->
    <style>
tr:hover{
    background-color: lightblue;
    cursor: pointer;
    margin-top: "5px";
    margin-right: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    border-radius: 10px
}
</style>
    <title>Clients</title>
</head>

<body>

    <div class = "container" > 
            <?php include_once $wwwDir.HEAD_MENU_VIEW_ROUTE; ?> 
    </div>

    <form method="POST" action="<?php echo AJOUT_EMPLOYE_CONTROLLER_ROUTE?>">


        <div class = "container" >
            <div class = "row  text-center"  >
                <section class= "col-lg-12 table-responsive _margin-top">

                    <?php loadClients(); ?>
                    
                </section>
            </div>
        </div>
    </form>
</body>

</html>