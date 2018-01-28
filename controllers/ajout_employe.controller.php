<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    // require_once $wwwDir.INSCRIPTION_MODEL_ROUTE;
    require_once $wwwDir.USERS_MODEL_ROUTE;
    require_once $wwwDir.SEND_EMAIL_ROUTE;


    if(isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["tel"]) && isset($_POST["adresse"]) && isset($_POST["email"]) && isset($_POST["password"])){
        if(!is_null($_POST["prenom"]) && !is_null($_POST["nom"]) && !is_null($_POST["tel"]) && !is_null($_POST["adresse"]) && !is_null($_POST["email"]) && !is_null($_POST["password"])){           
            
            if($_POST['_action'] == 'add'){
                //code_manager($email, $prenom, $nom, $password, $user_type)
                $send_status = code_manager($_POST["email"], $_POST["prenom"], $_POST["nom"], $_POST["password"], "employe");
                if($send_status){
                    $success = insert_employe_in_DB($_POST["prenom"], $_POST["nom"], $_POST["tel"], $_POST["adresse"], $_POST["email"], $_POST["password"]);
                    if($success>=1){

                        header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=add_success&_action=add");

                    } else header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=add_error_id&_action=add&prenom=".$_POST["prenom"]."&nom=".$_POST["nom"]."&adresse=".$_POST["adresse"]."&tel=".$_POST["tel"]."&email=".$_POST["email"]);
                }else header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=add_error_id&_action=add&prenom=".$_POST["prenom"]."&nom=".$_POST["nom"]."&adresse=".$_POST["adresse"]."&tel=".$_POST["tel"]."&email=".$_POST["email"]);
            
            }
                
            else if($_POST['_action'] == 'edit'){
                $fields = [
                    "prenom" => $_POST['prenom'],
                    "nom" => $_POST['nom'],
                    "tel" => $_POST['tel'],
                    "adresse" => $_POST['adresse'],
                    "email" => $_POST['email'],
                    "password" => $_POST['password']
                ];
                $success = update_employe_in_DB($fields, $_POST["old_email"]);
                if($success && $success>=1) 
                    header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=edit_success&_action=edit");
                else header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=edit_error_id&_action=edit&email=".$_POST["email"]);
            }

        } else header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=error_null&_action=".$_POST['_action']);
    
    }else header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?message=error_isset&_action".$_POST['_action']);
    