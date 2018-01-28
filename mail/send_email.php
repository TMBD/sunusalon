<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    // require_once $wwwDir.INSCRIPTION_MODEL_ROUTE;
    require_once $wwwDir.USERS_MODEL_ROUTE;
    require_once $wwwDir.SEND_EMAIL_ROUTE;
    require_once $wwwDir.MAIL_ROUTE;


    // $code = genere_code();
    // echo $code;
    // $result = add_inactive_account($_GET["email"], $code, "client");
    // echo " and result = ".$result;

    function code_manager($email, $prenom, $nom, $password, $user_type){
        $code = genere_code();
        $result = false;
        //sent_code_to_user($user_email, $prenom, $nom, $code, $password, $user_type)
        $success = sent_code_to_user($email, $prenom, $nom, $code, $password, $user_type);
        if($success)
            $result = add_inactive_account($email, $code, $user_type);
        return $result;
    }


    function genere_code(){
        $current_timestamp = time();
        $hasard = rand(100, 10000);
        $fact = rand(1, 100);
        return ($current_timestamp%$hasard)*$fact;
    }