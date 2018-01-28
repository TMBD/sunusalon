<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DB_FUNCTIONS_MODEL_ROUTE;

function insert_client_in_DB($prenom, $nom, $tel, $adresse, $email, $password){

    $exists = verif_if_user_exists($email);

    if(!($exists)){
        $fields = [
            "nom" => "'".$nom."'",
            "prenom" => "'".$prenom."'",
            "tel" => "'".$tel."'",
            "adresse" => "'".$adresse."'",
            "email" => "'".$email."'",
            "password" => "'".$password."'"
        ];
        
        _insert("client_t", $fields);
        $result = true;
    }else $result = false;

    return $result;
}

//function select($fields_to_select, $table_name, $conditions = false, $fields_values = false, $multiple = false)
function select_Allclients_in_DB(){
    $result = _select("*", "client_t",false,false,true);
    return $result;

}

function verif_if_user_exists($email){
    $exists = false;

    $condition_str = "email = '".$email."'";

    $exists = _select("email", "gerant_t",$condition_str);
    if($exists)  return true;

    else $exists = _select("email", "employe_t", $condition_str);
    if($exists)  return true;

    else $exists = _select("email", "client_t", $condition_str);
    if($exists)  return true;
    else return false;
}
