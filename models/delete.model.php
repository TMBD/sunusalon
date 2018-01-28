<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.USERS_MODEL_ROUTE;
    
    if($_POST['user'] == 'employe'){
        if($_POST['_action'] == 'delete'){
            delete_employe_in_DB($_POST['email']);
            //essayer de supprimer la ligne suivante apres pour voir l'effet
            header("Location: ".AJOUT_EMPLOYE_VIEW_ROUTE."?".$_POST['email']);
        }

    }
    else if($_POST['user'] == 'client'){
        if($_POST['_action'] == 'delete'){
            delete_client_in_DB($_POST['email']);
            //header("Location: ".CLIENTS_VIEW_ROUTE."?".$_POST['email']);
        }

    }
