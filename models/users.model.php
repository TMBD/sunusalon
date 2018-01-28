<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.DB_FUNCTIONS_MODEL_ROUTE;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////AJOUT EMPLOYE MODEL/////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
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
    $exists = verif_if_user_exists_for_edit($client["email"], $old_email);
    if(!$exists){
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
    }else return false;


}

function delete_employe_in_DB($email){

    $condition_str = "email = '".$email."'";

    return _delete("employe_t", $condition_str);
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////CONNEXION MODEL/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

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


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////INSCRIPTION MODEL///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

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


function verif_if_user_exists_for_edit($new_email, $old_email){

    if($new_email != $old_email){
        $exists = false;
        $condition_str = "email = '".$email."'";

        $exists = _select("email", "gerant_t",$condition_str);
        if($exists)  return true;
    
        else $exists = _select("email", "employe_t", $condition_str);
        if($exists)  return true;
    
        else $exists = _select("email", "client_t", $condition_str);
        if($exists)  return true;
        else return false;

    } else return false;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////CLIENTS MODEL//////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


function load_clients_from_DB(){
   
    $result = _select("*", "client_t", false, false, true);
    return $result;
}


function delete_client_in_DB($email){

    $condition_str = "email = '".$email."'";

    return _delete("client_t", $condition_str);
}



function update_client_in_DB($client, $old_email){
    $exists = verif_if_user_exists_for_edit($client["email"], $old_email);
    if(!$exists){
        $fields_to_change = [
            "prenom" => "'".$client["prenom"]."'",
            "nom" => "'".$client["nom"]."'",
            "tel" => "'".$client["tel"]."'",
            "adresse" => "'".$client["adresse"]."'",
            "email" => "'".$client["email"]."'"
        ];
    
        $condition_str = "email = '".$old_email."'";
        // $nbRowAffected = 1;
        return _update("client_t", $fields_to_change, $condition_str);
    }else return false;
}

function add_inactive_account($email, $code, $user){
    // $fields = [
    //     "email" => "'".$email."'",
    //     "code" => "'".$code."'",
    //     "user" => "'".$user."'"
    // ];

    $fields = [
        "email" => "'".$email."'",
        "code" => "'".$code."'",
        "user" => "'".$user."'"
    ];
    $result = _insert("validation_account_t", $fields);
    if($result>=1) return true;
    else return false;
}


function active_acount($email, $code){
    $condition_str = "email = '".$email."' AND code = '".$code."'";
    $result = _select("*", "validation_account_t", $condition_str);
    if($result){
        $table_name = ($result["user"] == "client") ? "client_t" : "employe_t";
        $email_condition_str = "email = '".$email."'";
        $fields_to_change = [
            "actif" => "1"
        ];
        $updated = _update($table_name, $fields_to_change, $email_condition_str);
        if($updated == 1){
            _delete("validation_account_t", $email_condition_str);
            return true;
        }
    }
    return false;
}