<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DB_FUNCTIONS_MODEL_ROUTE;


function select_gerant_in_DB($email){
    $result = false;
    // $champs = [
    //     "email" => "'".$email."'"
    // ];
    $condition_str = "email = '".$email."'";
    $result = _select("*", "gerant_t", $condition_str);

    return $result;

}

function select_employe_in_DB($email){
    $result = false;
    // $champs = [
    //     "email" => "'".$email."'"
    // ];
    $condition_str = "email = '".$email."'";
    $result = _select("*", "employe_t", $condition_str);

    return $result;

}

function select_client_in_DB($email){
    $result = false;
    // $champs = [
    //     "email" => "'".$email."'"
    // ];

    $condition_str = "email = '".$email."'";
    $result = _select("*", "client_t", $condition_str);

    return $result;

}