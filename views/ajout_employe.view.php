<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.LISTER_EMPLOYE_VIEW_ROUTE;
    //require_once $wwwDir.CONNEXION_MODEL_ROUTE;
    require_once $wwwDir.USERS_MODEL_ROUTE;
    $_SESSION['active_page'] = AJOUT_EMPLOYE_VIEW_ROUTE;

    $action = (isset($_GET["_action"])) ? $_GET["_action"] : "";
    $prenom_to_modif = '';
    $nom_to_modif = '';
    $adresse_to_modif = '';
    $tel_to_modif = '';
    $email_to_modif = '';
    $password_to_modif = '';
    
    if( (isset($_GET["_action"]) && !is_null($_GET["_action"])) && ( !isset($_GET["message"]) || $_GET["message"] != 'add_success') ){
        if($_GET["_action"] == 'edit'){
            $employe = select_employe_in_DB($_GET["email"]);
            if($employe){
                $action = $_GET["_action"];
                $prenom_to_modif = $employe['prenom'];
                $nom_to_modif = $employe['nom'];
                $adresse_to_modif = $employe['adresse'];
                $tel_to_modif = $employe['tel'];
                $email_to_modif = $employe['email'];
                $password_to_modif = $employe['password'];
            }
            
        }else if($_GET["_action"] == 'add') {
            $action = "add";

            if( isset($_GET["message"]) && !is_null($_GET["message"]) ){
                $prenom_to_modif = $_GET['prenom'];
                $nom_to_modif = $_GET['nom'];
                $adresse_to_modif = $_GET['adresse'];
                $tel_to_modif = $_GET['tel'];
                $email_to_modif = $_GET['email'];
            }

        }

        
    }
    
    


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap.css' rel='stylesheet'/>
    <link href='../styles/colors'  rel='stylesheet' />
    <link href='../styles/paddings'  rel='stylesheet' />
    <script src = "../js/jquery-3.2.1" ></script>

    <title>Ajout employé</title>
</head>
<style>

</style>

<body>

    <div class = "container" > 
            <?php include_once $wwwDir.HEAD_MENU_VIEW_ROUTE; ?> 
    </div>
    <form method="POST" action="/sunusalon/controllers/ajout_employe.controller.php">
        <div class = 'container text-center _margin-top' >
            <div class = "row   "  >
                <section class= "col-lg-4 col-lg-push-4 graye">
                    <div class = " col-lg-12">
                        <div class = "_title col-lg-10  col-lg-push-1">
                            <legend>Ajouter un employé</legend>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php 
                            if(isset($_GET["message"]) && !is_null($_GET["message"])) {
                                if($_GET["message"]=="add_success"){
                                    ?>
                                        <div class="_success">
                                            <h4> AJOUT REUSSIT </h4>
                                            <span class = "glyphicon glyphicon-ok" ></span>
                                        </div>
                                        <div class="_info">
                                            Nous avons envoyé un email d'activation à l'adresse specifié
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="edit_success"){
                                    ?>
                                        <div class="_success">
                                            <h4> MODIFICATION REUSSIT </h4>
                                            <span class = "glyphicon glyphicon-ok" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="add_error_id"){
                                    ?>
                                        <div class="_error">
                                            <h4> CETTE EMAIL EXISTE DEJA </h4>
                                            <span class = "glyphicon glyphicon-alert" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="edit_error_id"){
                                    ?>
                                        <div class="_error">
                                            <h4> AUCUN EMPLOYE NE PORTE CET IDENTIFIANT </h4>
                                            <span class = "glyphicon glyphicon-alert" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="error_isset" || $_GET["message"]=="error_null"){
                                    ?>
                                        <div class="_error">
                                            <h4> VEUILLEZ RENSEIGNER CORRECTEMENT LES CHAMPS </h4>
                                            <span class = "glyphicon glyphicon-alert" ></span>
                                        </div>
                                    <?php
                                }
                                ?>
                                    <script> 
                                        $("._success").slideDown(3000).delay(5000).fadeOut(3000);
                                        $("._error").slideDown(3000).delay(5000).fadeOut(5000);
                                        $("._info").delay(15000).fadeIn(3000).delay(5000).fadeOut(5000);
                                    </script>
                                <?php
                            }
                        ?>
                    </div> 




                            
                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class = "form-control input-lg" name = "prenom" placeholder = "Prenom" 
                            required = "true" value = <?php echo $prenom_to_modif;?> >
                    </div>

                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class = "form-control input-lg" name = "nom" placeholder = "Nom" 
                            required = "true" value = <?php echo $nom_to_modif;?> >
                    </div>

                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="text" class = "form-control input-lg" name = "adresse" placeholder = "Adresse" 
                            required = "true" value = <?php echo $adresse_to_modif;?> >
                    </div>

                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input type="text" class = "form-control input-lg" name = "tel" placeholder = "Téléphone" 
                            required = "true" value = <?php echo $tel_to_modif;?> >
                    </div>

                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class = "form-control input-lg" name = "email" placeholder = "Email" 
                            required = "true" value = <?php echo $email_to_modif;?> >
                    </div>

                    <div class = "form-group input-group" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class = "form-control input-lg" name = "password" placeholder = "Mot de passe"  
                            required = "true" value = <?php echo $password_to_modif;?> >
                    </div>

                    <input type='hidden' name = '_action' value = '<?php echo $action ;?>' >
                    <input type='hidden' name = 'old_email' value = '<?php echo $email_to_modif ;?>' >

                    <div class = "form-group" >
                        <input type="submit" class = "btn btn-primary" value = <?php echo $action == 'edit'? 'Editer':'Ajouter'?> "Ajouter" >
                    </div>

                </section>
            </div>
        </div>
    </form>
</body>

</html>