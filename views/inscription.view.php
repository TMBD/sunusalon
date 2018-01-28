<?php 
    session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    require_once $wwwDir.USERS_MODEL_ROUTE;

    $action = (isset($_GET["_action"])) ? $_GET["_action"] : "";
    $prenom_to_modif = '';
    $nom_to_modif = '';
    $adresse_to_modif = '';
    $tel_to_modif = '';
    $email_to_modif = '';
    $password_to_modif = '';
    if( (isset($_GET["_action"]) && !is_null($_GET["_action"])) && ( !isset($_GET["message"]) || $_GET["message"] != 'inscription_success') ){
        if($_GET["_action"] == 'edit'){
            $client = select_client_in_DB($_GET["email"]);
            if($client){
                $action = $_GET["_action"];
                $prenom_to_modif = $client['prenom'];
                $nom_to_modif = $client['nom'];
                $adresse_to_modif = $client['adresse'];
                $tel_to_modif = $client['tel'];
                $email_to_modif = $client['email'];
                $password_to_modif = $client['password'];
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
<?php
    if(!isset($_SESSION)) session_start();if(!isset($_SESSION)) 
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    $_SESSION['active_page'] = INSCRIPTION_VIEW_ROUTE;

?>

<head>
    <meta charset="utf-8">
    <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap' rel='stylesheet'/>
    <link href="../styles/colors" rel="stylesheet" />
    <link href="../styles/paddings" rel="stylesheet" />
    <script src = "../js/jquery-3.2.1" ></script>
    
    <title>Inscription</title>
</head>

<body>

    <div class = "container" > 
        <?php include_once $wwwDir.HEAD_MENU_VIEW_ROUTE; ?> 
    </div>
    <form method="POST" action="<?php echo INSCRIPTION_CONTROLLER_ROUTE; ?>">

        <div class = "container  _margin-top" >

            <div class = "row text-center " >
                <section class= "col-lg-4 col-lg-push-4  graye ">
                <div class = "_title col-lg-12">
                    <div class = "_title col-lg-10  col-lg-push-1">
                            <legend>Inscription</legend>
                    </div>
                </div>

                    <div class="form-group has-error has-feedback ">
                        <?php 
                            if(isset($_GET["message"]) && !is_null($_GET["message"])) {
                        
                                if($_GET["message"]=="inscription_success"){
                                    ?>
                                        <div class="_success">
                                            <h4> INSCRIPTION REUSSIT </h4>
                                            <span class = "glyphicon glyphicon-ok" ></span>
                                        </div>
                                        <div class="_info">
                                            Nous vous avons envoyé un email d'activation
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="edit_success"){
                                    ?>
                                        <div class="_success">
                                            <h4> MISE A JOUR REUSSIT </h4>
                                            <span class = "glyphicon glyphicon-ok" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="inscription_error_db"){
                                    ?>
                                        <div class="_error">
                                            <h4> UNE ERREUR EST SURVENUE. VEUILLEZ RESSAYER </h4>
                                            <span class = "glyphicon glyphicon-alert" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="inscription_error_id" || $_GET["message"]=="edit_error_id"){
                                    ?>
                                        <div class="_error">
                                            <h4> CET EMAIL EXISTE DEJA </h4>
                                            <span class = "glyphicon glyphicon-alert" ></span>
                                        </div>
                                    <?php
                                }
                                else if($_GET["message"]=="error_isset" || $_GET["message"]=="error_null"){
                                    ?>
                                        <div class="_error">
                                            <h4> INSCRIPTION VEUILLEZ RENSEIGNER CORRECTEMENT LES CHAMPS </h4>
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
                            required = "true" value = <?php echo $nom_to_modif;?>>
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
                    
                    <div class = "col-lg-12" >
                        <a class = "form-group col-lg-6 col-lg-push-7" href="<?php echo VALIDER_INSCRIPTION_VIEW_ROUTE;?>">Activer voter compte</a>
                    </div>

                    <div class = "form-group" >
                        <input type="submit" class = "btn btn-primary" value = "Valider" >
                    </div>

                </section>
            </div>
        </div>
    </form>
</body>

</html>