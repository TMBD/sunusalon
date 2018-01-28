<?php

function getRootDir(){
    $dir = './';
    while(dirname($dir) != "sunusalon"){
        $dir = $dir."../";
    }
    return $dir;
}
//////////////////////////////////////////////////////////////////////////////////
///////////////////   VIEWS    ///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
if(!defined("INDEX_ROUTE"))
    define("INDEX_ROUTE","/sunusalon/index.php");

if(!defined("ACCUEIL_VIEW_ROUTE"))
    define("ACCUEIL_VIEW_ROUTE","/sunusalon/views/accueil.view.php");

if(!defined("AJOUT_EMPLOYE_VIEW_ROUTE"))
    define("AJOUT_EMPLOYE_VIEW_ROUTE","/sunusalon/views/ajout_employe.view.php");

if(!defined("CONNEXION_VIEW_ROUTE"))
    define("CONNEXION_VIEW_ROUTE","/sunusalon/views/connexion.view.php");

if(!defined("INSCRIPTION_VIEW_ROUTE"))
    define("INSCRIPTION_VIEW_ROUTE", "/sunusalon/views/inscription.view.php");

if(!defined("LISTER_EMPLOYE_VIEW_ROUTE"))
    define("LISTER_EMPLOYE_VIEW_ROUTE","/sunusalon/views/lister_employe.view.php");

if(!defined("CONNEXION_VIEW_ROUTE"))
    define("CONNEXION_VIEW_ROUTE","/sunusalon/views/connexion.view.php");

if(!defined("HEAD_MENU_VIEW_ROUTE"))
    define("HEAD_MENU_VIEW_ROUTE","/sunusalon/views/head_menu.view.php");

if(!defined("EMPLOYES_VIEW_ROUTE"))
    define("EMPLOYES_VIEW_ROUTE","/sunusalon/views/employes.view.php");

if(!defined("CLIENTS_VIEW_ROUTE"))
    define("CLIENTS_VIEW_ROUTE","/sunusalon/views/clients.view.php");

if(!defined("LISTER_CLIENTS_VIEW_ROUTE"))
    define("LISTER_CLIENTS_VIEW_ROUTE","/sunusalon/views/lister_clients.view.php");
if(!defined("VALIDER_INSCRIPTION_VIEW_ROUTE"))
    define("VALIDER_INSCRIPTION_VIEW_ROUTE","/sunusalon/views/valider_inscription.view.php");

//////////////////////////////////////////////////////////////////////////////////
///////////////////   CONTROLLERS    /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

if(!defined("AJOUT_EMPLOYE_CONTROLLER_ROUTE"))
    define("AJOUT_EMPLOYE_CONTROLLER_ROUTE","/sunusalon/controllers/ajout_employe.controller.php");


if(!defined("CONNEXION_CONTROLLER_ROUTE"))
    define("CONNEXION_CONTROLLER_ROUTE","/sunusalon/controllers/connexion.controller.php");


if(!defined("INSCRIPTION_CONTROLLER_ROUTE"))
    define("INSCRIPTION_CONTROLLER_ROUTE","/sunusalon/controllers/inscription.controller.php");

if(!defined("VALIDER_INSCRIPTION_CONTROLLER_ROUTE"))
    define("VALIDER_INSCRIPTION_CONTROLLER_ROUTE","/sunusalon/controllers/valider_inscription.controller.php");
//////////////////////////////////////////////////////////////////////////////////
///////////////////   MODELS    //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

// if(!defined("AJOUT_EMPLOYE_MODEL_ROUTE"))
//     define("AJOUT_EMPLOYE_MODEL_ROUTE","/sunusalon/models/ajout_employe.model.php");


// if(!defined("CONNEXION_MODEL_ROUTE"))
//     define("CONNEXION_MODEL_ROUTE","/sunusalon/models/connexion.model.php");


// if(!defined("INSCRIPTION_MODEL_ROUTE"))
//     define("INSCRIPTION_MODEL_ROUTE","/sunusalon/models/inscription.model.php");

if(!defined("DATABASE_CONNEXION_MODEL_ROUTE"))
    define("DATABASE_CONNEXION_MODEL_ROUTE","/sunusalon/models/Database_connexion.php");

if(!defined("DB_FUNCTIONS_MODEL_ROUTE"))
    define("DB_FUNCTIONS_MODEL_ROUTE","/sunusalon/models/db_functions.php");

if(!defined("DB_CONF_MODEL_ROUTE"))
    define("DB_CONF_MODEL_ROUTE","/sunusalon/models/conf/db.conf.php");

if(!defined("USERS_MODEL_ROUTE"))
    define("USERS_MODEL_ROUTE","/sunusalon/models/users.model.php");

if(!defined("DELETE_MODEL_ROUTE"))
    define("DELETE_MODEL_ROUTE","/sunusalon/models/delete.model.php");


//////////////////////////////////////////////////////////////////////////////////
///////////////////   EMAIL    //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

if(!defined("SEND_EMAIL_ROUTE"))
    define("SEND_EMAIL_ROUTE","/sunusalon/mail/send_email.php");

if(!defined("MAIL_ROUTE"))
    define("MAIL_ROUTE","/sunusalon/mail/mail.php");
?>