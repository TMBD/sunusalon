<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DB_FUNCTIONS_MODEL_ROUTE;
    require_once $wwwDir.INSCRIPTION_MODEL_ROUTE;

function insert_employe_in_DB($prenom, $nom, $tel, $adresse, $email, $password){

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
        
        _insert("employe_t", $fields);
        $result = true;
    }else $result = false;

    return $result;
}

function load_employe_from_DB(){
   
    $result = _select("*", "employe_t", false, false, true);
    return $result;
}


function update_employe_in_DB($employe, $old_email){
    $fields_to_change = [
        "prenom" => "'".$employe["prenom"]."'",
        "nom" => "'".$employe["nom"]."'",
        "tel" => "'".$employe["tel"]."'",
        "adresse" => "'".$employe["adresse"]."'",
        "email" => "'".$employe["email"]."'"
    ];

    $condition_str = "email = '".$old_email."'";
    // $nbRowAffected = 1;
    return _update("employe_t", $fields_to_change, $condition_str);

}

function delete_employe_in_DB($email){

    $condition_str = "email = '".$email."'";

    return _delete("employe_t", $condition_str);
}

