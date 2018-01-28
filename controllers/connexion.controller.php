<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    //require_once $wwwDir.CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.USERS_MODEL_ROUTE;


if( isset($_POST["email"]) && isset($_POST["password"])){
    if(!is_null($_POST["email"]) && !is_null($_POST["password"])){
        
        $result_gerant = select_gerant_in_DB($_POST["email"]);
        $result_employe = select_employe_in_DB($_POST["email"]);
        $result_client = select_client_in_DB($_POST["email"]);

        if($result_gerant && $result_gerant["password"] == $_POST["password"]){ 
            $_SESSION["prenom"] = $result_gerant["prenom"];
            $_SESSION["nom"] = $result_gerant["nom"];
            $_SESSION["email"] = $result_gerant["email"];
            $_SESSION["adresse"] = $result_gerant["adresse"];
            $_SESSION["tel"] = $result_gerant["tel"];
            $_SESSION['user'] = "gerant";
            header("Location: ".ACCUEIL_VIEW_ROUTE."?status=connected");
            
        }
        else if($result_employe && $result_employe["password"] == $_POST["password"] && $result_employe["actif"] == 1) {

            $_SESSION["prenom"] = $result_employe["prenom"];
            $_SESSION["nom"] = $result_employe["nom"];
            $_SESSION["email"] = $result_employe["email"];
            $_SESSION["adresse"] = $result_employe["adresse"];
            $_SESSION["tel"] = $result_employe["tel"];
            $_SESSION['user'] = "employe";
            header("Location: ".ACCUEIL_VIEW_ROUTE."?status=connected");

        } 
        else if($result_client && $result_client["password"] == $_POST["password"] && $result_client["actif"] == 1) {

            $_SESSION["prenom"] = $result_client["prenom"];
            $_SESSION["nom"] = $result_client["nom"];
            $_SESSION["email"] = $result_client["email"];
            $_SESSION["adresse"] = $result_client["adresse"];
            $_SESSION["tel"] = $result_client["tel"];
            $_SESSION['user'] = "client";
            header("Location: ".ACCUEIL_VIEW_ROUTE."?status=connected");

        }else header("Location: ".CONNEXION_VIEW_ROUTE."?message=error_id");

    } else header("Location: ".CONNEXION_VIEW_ROUTE."?message=error_null");
    
}else header("Location: ".CONNEXION_VIEW_ROUTE."?message=error_isset");
