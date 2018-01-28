<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.USERS_MODEL_ROUTE;

if(isset($_POST["email"]) && isset($_POST["code"])){
    if(!is_null($_POST["email"]) && !is_null($_POST["code"])){
        $result = active_acount($_POST["email"], $_POST["code"]);
        if($result){
            header("Location: ".CONNEXION_VIEW_ROUTE."?email=".$_POST["email"]);
        }else header("Location: ".VALIDER_INSCRIPTION_VIEW_ROUTE."?message=error_id");

    } else header("Location: ".VALIDER_INSCRIPTION_VIEW_ROUTE."?message=error_null");
}else header("Location: ".VALIDER_INSCRIPTION_VIEW_ROUTE."?message=error_isset");
