<?php
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";

    require_once $wwwDir.DATABASE_CONNEXION_MODEL_ROUTE;

function _select($fields_to_select_str, $table_name, $conditions_str = false, $fields_prepare = false, $multiple = false){
    $whereClause = "";
    if($conditions_str) $whereClause = " WHERE ".$conditions_str;
    $sql = "SELECT ".$fields_to_select_str." FROM ".$table_name." ".$whereClause;
    $result = Database_connexion::getInstance()->request($sql, $fields_prepare, $multiple);

    return $result['data'];
}



function _insert($table_name, $fields_to_insert, $fields_prepare = false){
    $values_to_insert = convert_Assoc_To_String_INSERT($fields_to_insert);
    $sql = "INSERT INTO ".$table_name." ".$values_to_insert;
    $result = Database_connexion::getInstance()->request($sql, $fields_prepare);

    return $result['rowCount'];
}


function _update($table_name, $fields_to_change, $conditions_str, $fields_prepare = false){
    $fields_to_change = convert_Assoc_To_String_SELECT($fields_to_change);
    $sql = "UPDATE ".$table_name." SET ".$fields_to_change." WHERE ".$conditions_str;
    $result = Database_connexion::getInstance()->request($sql, $fields_prepare);
    return $result['rowCount'];
}

function _delete($table_name, $conditions_str, $fields_prepare = false){
    $sql = "DELETE FROM ".$table_name." WHERE ".$conditions_str;
    $result = Database_connexion::getInstance()->request($sql, $fields_prepare);

    return $result['rowCount'];
}


function convert_Assoc_To_String_SELECT($fields){
    $result = "";
    foreach($fields as $cle=>$value){
        $result = $result.$cle."=".$value.",";
    }

    if(strlen($result) > 0) $result = substr($result, 0, strlen($result)-1);
    return $result;
}


function convert_Assoc_To_String_INSERT($fields){
    $result = "";
    $keys = "";
    $values = "";
    foreach($fields as $cle=>$valeur){
        $keys = $keys.$cle.",";
        $values = $values.$valeur.",";
    }

    if(strlen($keys) > 0) $keys = substr($keys, 0, strlen($keys)-1);
    if(strlen($values) > 0) $values = substr($values, 0, strlen($values)-1);
    $result = "(".$keys.") VALUES (".$values.")";
    return $result;
}